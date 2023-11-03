<?php

namespace App\Services;

use App\Subscription;
use Auth;
use Laravel\Cashier\Cashier;
use Stripe\Price;
use Stripe\Product;
use Stripe\Subscription as StripeSubscription;
use Stripe\Checkout\Session as StripeCheckoutSession;
use Stripe\Customer;

class SubscriptionService
{
    public function createSubscription($userSubsDetails)
    {
        $subscriptionDetails = $userSubsDetails['subscription_details'];

        $id = $subscriptionDetails['id'];
        $name = $subscriptionDetails['items']['data'][0]['plan']['nickname'];
        $endsAt = $subscriptionDetails['current_period_end'];
        $trailEndsAt = $subscriptionDetails['trial_end'];
        $status = $subscriptionDetails['status'];

        $subscriptionData = [
            'user_id' => $userSubsDetails['user_id'],
            'stripe_id' => $id,
            'name' => 'default',
            'stripe_status' => $status,
            'stripe_plan' => $name,
            'quantity' => 1,
            'trial_ends_at' => ($status == 'trialing') ? $trailEndsAt : null,
            'ends_at' => ($status !== 'trialing') ? $endsAt : null,
        ];

        return Subscription::create($subscriptionData);
    }

    public static function createSubscriptionForPro(){
        $subscriptionService = new SubscriptionService();
        $subsDetail = [
            'subscription_details' => self::getSubscriptions()[0],
            'user_id' => Auth::user()->id
        ];

        return $subscriptionService->createSubscription($subsDetail);
    }

    public static function createSubscriptionWithCheckout($user)
    {
        $userAcc = $user->getAccount();

        // dd($userAcc->country);
        return StripeCheckoutSession::create([
            'mode' => 'subscription',
            'customer' => $user->stripe_id,
            'line_items' => [
                [
                    'price' => $userAcc->country == 'GB' ? 'artist_pro' : 'price_1NuW5kJ05tUsYkdQvvsV61DV',
                    'quantity' => 1,
                ],
            ],
            'subscription_data' => [
                'trial_period_days' => '30',
            ],
            'payment_method_types' => $userAcc->country == 'GB' ? ['bacs_debit'] : ['sepa_debit'],
            // 'payment_method_options' => [
            //     $userAcc->country == 'GB' ? 'bacs_debit' : 'sepa_debit' => [
            //         'setup_future_usage' => 'off_session'
            //     ],
            // ],
            'success_url' => env('STRIPE_CHECKOUT_SUB_RETURN_URL'),
            'cancel_url' =>  env('STRIPE_REFRESH_URL'),
            'custom_text' => [
                'submit' => ['message' => 'By signing up to this agreement you are agreeing to a monthly subscription of £10 or €12 for Phase - Artist PRO (EU).'],
            ],
        ], Cashier::stripeOptions());
    }

    public static function getSubscriptionProducts()
    {
        // return StripeSubscription::all(['customer' => auth()->user()->stripe_id], Cashier::stripeOptions())['data'];
        // $products = Product::all(['limit' => 3], Cashier::stripeOptions());
        return Price::all(null, Cashier::stripeOptions())['data'];
    }

    public static function getSubscriptions()
    {
        return StripeSubscription::all(['customer' => auth()->user()->stripe_id], Cashier::stripeOptions())['data'];
        // $products = Product::all(['limit' => 3], Cashier::stripeOptions());
        // return Price::all(null, Cashier::stripeOptions())['data'];
    }

    public static function cancelSubscripton($id)
    {
        $subcription = StripeSubscription::retrieve($id, Cashier::stripeOptions())->cancel();
        return $subcription;
    }
}
