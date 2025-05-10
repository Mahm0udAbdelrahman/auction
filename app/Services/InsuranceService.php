<?php
namespace App\Services;

use Stripe\Stripe;
use App\Models\Insurance;
use App\Models\BalanceInsurance;
use App\Models\TypePayment;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class InsuranceService
{
    protected $baseUrl;
    protected $secretKey;
    protected $publicKey;
    protected $cardId;
    protected $api_key;
    protected $walletId;
    protected $walletIdFrame;
    protected $cardIdFrame;

    public function __construct()
    {
        $this->baseUrl = env('PAYMOB_API_URL');
        $this->secretKey = env('PAYMOB_SECRET_KEY');
        $this->publicKey = env('PAYMOB_PUBLIC_KEY');
        $this->cardId = env('PAYMOB_INTEGRATION_ID');
        $this->walletId = env('PAYMOB_WALLET_INTEGRATION_ID');
        $this->api_key = env('PAYMOB_API_KEY');
        $this->cardIdFrame = env('PAYMOB_IFRAME_ID');
        $this->walletIdFrame = env('PAYMOB_WALLET_IFRAME_ID');
    }

    public function store($data)
    {
        $user = auth()->user();
        


        if (!$user) {
            return response()->json(['success' => false, 'message' => 'المستخدم غير موجود'], 401);
        }
        
        // $currency = BalanceInsurance::where('service',$user->service)->where('country_id',auth()->user()->country_id)->first();
        
         $currency = BalanceInsurance::where('service',$user->service)->first();
        

        if(Insurance::where('user_id', $user->id)->where('payment_status','paid')->exists())
        {
            return response()->json(['success' => false, 'message' => 'لديك تأمين نشط بالفعل'], 400);
        }

        $type = request()->input('payment_type');

        $typePayment = TypePayment::where('id', $type)->first();

        if ($typePayment) {
            if ($typePayment->name === 'paymob') {
                return $this->processPaymobPayment($data, $user,$currency);
            } elseif ($typePayment->name === 'stripe') {
                return $this->processStripePayment($data, $user);
            }
        }
        return response()->json(['success' => false, 'message' => 'طريقة دفع غير مدعومة'], 400);

    }

    private function processPaymobPayment($data, $user ,$currency)
    {
       $insurance_stripe = Insurance::where('user_id', $user->id)->where('payment_status','pending')->where('payment_type','stripe')->first();
        if($insurance_stripe)
        {
            $insurance_stripe->delete();
        }
        $authResponse = Http::post("{$this->baseUrl}/api/auth/tokens", [
            'api_key' => $this->api_key,
        ]);

        if (!$authResponse->successful()) {
            return response()->json(['success' => false, 'message' => 'فشل في المصادقة مع Paymob'], 500);
        }

        $authToken = $authResponse->json()['token'];

        $orderResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $authToken,
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/api/ecommerce/orders", [
            'auth_token' => $authToken,
            'delivery_needed' => false,
            'amount_cents' => $currency->min_balance * 100,
            'currency' => $currency->currency,
            'items' => [],
        ]);

        if (!$orderResponse->successful()) {
            return response()->json(['success' => false, 'message' => 'فشل في إنشاء الطلب في Paymob'], 500);
        }

        $paymobOrderId = $orderResponse->json()['id'];

        $billing = [
            "apartment" => "123",
            "first_name" => $user->name,
            "last_name" => "غير محدد",
            "street" => 'لا يوجد عنوان',
            "building" => "456",
            "phone_number" => $user->phone,
            "city" => 'غير محدد',
            // "country" => "EG",
            "country" => $currency->currency === 'SAR' ? "SA":"EG",
            "email" => $user->email,
            "floor" => "1",
            "state" => 'غير محدد',
            "postal_code" => "12345",
            "shipping_method" => "PKG"
        ];

        $integrationId = request()->input('payment_method') == 'card' ? $this->cardId : $this->walletId;

        $paymentKeyResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $authToken,
            'Content-Type' => 'application/json',
        ])->post("{$this->baseUrl}/api/acceptance/payment_keys", [
            'auth_token' => $authToken,
            'amount_cents' => $currency->min_balance * 100,
            'expiration' => 3600,
            'order_id' => $paymobOrderId,
            'billing_data' => $billing,
            'currency' => $currency->currency,
            'integration_id' => $integrationId,
        ]);

        if (!$paymentKeyResponse->successful()) {
            Log::error('Paymob Payment Key Error:', $paymentKeyResponse->json());
            return response()->json(['success' => false, 'message' => 'فشل في إنشاء مفتاح الدفع'], 500);
        }

        
        
        
        $insurance = Insurance::updateOrCreate(
    ['user_id' => $user->id], 
    [
        'balance' => 0,
        'payment_method' => request('payment_method'),
        'payment_id' => $paymobOrderId ?? null,
        'payment_status' => 'pending',
        'type' => $data['type'] ?? 'app',
        'payment_type' => 'paymob',
    ]
);

        $paymentKey = $paymentKeyResponse->json()['token'];
        $iframeId = request()->input('payment_method') == 'card' ? $this->cardIdFrame : $this->walletIdFrame;

        return [
            'payment_id' => $paymobOrderId,
            'balance' =>$currency->min_balance,
            'redirect_url' => "https://accept.paymob.com/api/acceptance/iframes/{$iframeId}?payment_token={$paymentKey}&amount={$currency->min_balance}",
        ];
    }

    private function processStripePayment($data, $user)
    {
        $insurance_paymob = Insurance::where('user_id', $user->id)->where('payment_status','pending')->where('payment_type','paymob')->first();
        if($insurance_paymob)
        {
            $insurance_paymob->delete();
        }


        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Insurance Payment',
                        ],
                        'unit_amount' => $data['balance'] * 100, // تحويل المبلغ إلى سنتات
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                // 'success_url' => route('payment.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
                'success_url' => route('payment.success', ['balance' => $data['balance'] , 'session_id' => '{CHECKOUT_SESSION_ID}' , 'user_id' => $user->id]),

                'cancel_url' => route('payment.cancel'),
            ]);

            $insurance = Insurance::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'balance' => 0,
                    'payment_method' => 'card',
                    'payment_id' => $session->id,
                    'payment_status' => 'pending',
                    'payment_type' => 'stripe',
                    'type' => $data['type'] ?? 'app',

                ]
            );

            return [
                'payment_id' => $session->id,
                'balance' => $data['balance'],
                'redirect_url' => $session->url,
            ];
        } catch (\Exception $e) {
            Log::error('Stripe Payment Error:', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'فشل في إنشاء طلب الدفع عبر Stripe'], 500);
        }
    }
}
