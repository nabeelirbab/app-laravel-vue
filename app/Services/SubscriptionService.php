<?php

namespace App\Services;

use App\Subscription;
use Laravel\Cashier\Cashier;
use Stripe\Price;
use Stripe\Product;
use Stripe\Subscription as StripeSubscription;

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
