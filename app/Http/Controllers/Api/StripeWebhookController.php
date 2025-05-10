<?php

namespace App\Http\Controllers\Api;

use Stripe\Webhook;
use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;


class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        }

        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;

            $insurance = Insurance::where('payment_id', $session->id)->first();

            if ($insurance) {
                $balance = $session->amount_total / 100;
                $insurance->update([
                    'payment_status' => 'paid',
                    'balance' => $balance,
                ]);
            }

        } elseif ($event->type == 'checkout.session.expired') {
            $session = $event->data->object;

            $insurance = Insurance::where('payment_id', $session->id)->first();

            if ($insurance) {
                $insurance->update(['payment_status' => 'failed']);
            }
        }

        return response('Webhook handled', 200);
    }
}
