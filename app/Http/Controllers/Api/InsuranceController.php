<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Insurance\InsuranceRequest;
use App\Models\Insurance;
use App\Models\Car;
use App\Models\Auction;
use App\Services\InsuranceService;

class InsuranceController extends Controller
{
    public function __construct(public InsuranceService $insuranceService){}
    public function store(InsuranceRequest $insuranceRequest)
    {
        return $this->insuranceService->store($insuranceRequest->validated());
    }

    // public function callback(Request $request)
    // {
    //     $data = $request->all();

    //     if($data){
    //         $insurance=Insurance::where('payment_id','=',$data['order'])->first();
    //         if($data['success']==true||$data['success']=="true"){
    //             $balance = $data['amount_cents'] / 100;
                
    //             $insurance->update(['payment_status'=>'paid','balance'=>$balance]);
                
                
                
    //             // $url = 'https://auctionmycar.online/api/callback/?id=' . $data['id'] . '&is_true=' . $data['success'];
    //             $url = route('web.home');
                
    //             if($insurance->type == 'web')
    //             {
    //              $insurance->update(['payment_status'=>'paid','balance'=>$balance]);

    //             return view('WebPayment', compact('insurance', 'url'));
    //             }else{
    //                                 $insurance->update(['payment_status'=>'paid','balance'=>$balance]);

    //                  return view('payment', compact('insurance', 'url'));
    //             }
    //         }
    //         elseif($data['success']==false||$data['success']=="false"){
    //             $insurance->update(['payment_status'=>'faild']);
    //             $url = 'https://auctionmycar.online/api/callback/?id=' . $data['id'] . '&is_true=' . $data['success'];
    //              if($insurance->type == 'web')
    //             {
                    
    //             return view('WebPayment', compact('insurance', 'url'));
    //             }else{
    //                  return view('payment', compact('insurance', 'url'));
    //             }
    //         }
    //     }
    // }
    
//   public function callback(Request $request)
// {
//     $data = $request->all();

//     if ($data) {
//         $insurance = Insurance::where('payment_id', $data['order'])->first();

//         if (!$insurance) {
//             abort(404, 'Insurance not found');
//         }

//         $url = route('web.home'); // default URL
//         $success = filter_var($data['success'], FILTER_VALIDATE_BOOLEAN);       

//         if ($success) {
//             $balance = $data['amount_cents'] / 100;
//             $insurance->update([
//                 'payment_status' => 'paid',
//                 'balance' => $balance
//             ]);
            

// $car_my = Car::where('user_id', $insurance->user_id)->first();
// if($car_my->user->service = 'vendor' && $car_my->user->category = 'my')
// {
//      $car->update([
//         'status' => 'approved',
//     ]);

//     Auction::firstOrCreate([
//         'car_id' => $car_my->id,
//         'user_id' => $car_my->user->id,
//     ], [
//         'start_date'   => now(),
//         'end_date'     => now()->addWeeks(4),
//         'start_price'  => $car_my->price,
//     ]);
    
//      $insurance->update([
//                 'balance' => 0
//             ]);
    
// }

// $cars = Car::where('user_id', $insurance->user_id)->get();


// foreach ($cars as $car) {
//     $car->update([
//         'status' => 'approved',
//     ]);

//     Auction::firstOrCreate([
//         'car_id' => $car->id,
//         'user_id' => $car->user->id,
//     ], [
//         'start_date'   => now(),
//         'end_date'     => now()->addWeeks(4),
//         'start_price'  => $car->price,
//     ]);
// }

            
            
//         } else {
//             $insurance->update([
//                 'payment_status' => 'faild'
//             ]);
//             $url = 'https://auctionmycar.online/api/callback/?id=' . $data['id'] . '&is_true=' . $data['success'];
//         }

  
//         $view = $insurance->type == 'web' ? 'WebPayment' : 'payment';
//         return view($view, compact('insurance', 'url'));
//     }
// }


public function callback(Request $request)
{
    $data = $request->all();

    if ($data) {
        $insurance = Insurance::where('payment_id', $data['order'])->first();

        if (!$insurance) {
            abort(404, 'Insurance not found');
        }

        $url = route('web.home'); 
        $success = filter_var($data['success'], FILTER_VALIDATE_BOOLEAN);       

        if ($success) {
            $balance = $data['amount_cents'] / 100;
            $insurance->update([
                'payment_status' => 'paid',
                'balance' => $balance
            ]);

           
            $car_my = Car::where('user_id', $insurance->user_id)->first();

            if ($car_my && $car_my->user->service == 'vendor' && $car_my->user->category == 'my') {
               
                $car_my->update([
                    'status' => 'approved',
                ]);

                Auction::firstOrCreate([
                    'car_id' => $car_my->id,
                    'user_id' => $car_my->user->id,
                ], [
                    'start_date'   => now(),
                    'end_date'     => now()->addWeeks(4),
                    'start_price'  => $car_my->price,
                ]);

              
                $insurance->delete();
            }

            
            $cars = Car::where('user_id', $insurance->user_id)->get();

            foreach ($cars as $car) {
                $car->update([
                    'status' => 'approved',
                ]);

                Auction::firstOrCreate([
                    'car_id' => $car->id,
                    'user_id' => $car->user->id,
                ], [
                    'start_date'   => now(),
                    'end_date'     => now()->addWeeks(4),
                    'start_price'  => $car->price,
                ]);
            }
            
        } else {
            $insurance->update([
                'payment_status' => 'faild'
            ]);
            $url = 'https://auctionmycar.online/api/callback/?id=' . $data['id'] . '&is_true=' . $data['success'];
        }

       
        $view = $insurance->type == 'web' ? 'WebPayment' : 'payment';
        return view($view, compact('insurance', 'url'));
    }
}


}
