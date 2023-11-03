<?php

namespace App\Http\Controllers\Account;

use App\Mail\AccountDowngraded;
use App\Mail\AccountResumed;
use App\Plan;
use App\Subscription;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use App\Http\Controllers\Controller;
use App\Services\SubscriptionService;
use Auth;

class SubscriptionController extends Controller
{
    public function getPlans()
    {
        // return Plan::where('price', '>', 0)->get();
        return SubscriptionService::getSubscriptionProducts();
    }

    public function getSubscriptions(Request $request)
    {
        // return SubscriptionService::getSubscriptions();
        return $request->user()->subscriptions;
    }

    public function subscribeToPlan(Request $request)
    {
        $user = Auth::user();

        $subscription = SubscriptionService::createSubscriptionWithCheckout($user);


        // dd($subscription);
        // $plan = Plan::findOrFail($planid);
        // $stripeUser = $request->user()->createOrGetStripeCustomer();
        // $user = Cashier::findBillable($stripeUser->id);

        // if (!$user->hasPaymentMethod()) {
        //     return [
        //         'success' => false,
        //         'message' => 'You need to add a card to your billing section first.'
        //     ];
        // }

        // $subscription = $user->newSubscription('default', Str::snake($plan->title))
        //     ->create($user->defaultPaymentMethod()->id, [
        //         'email' => $user->email
        //     ]);

        // $user->syncRoles('pro');

        return [
            'success' => true,
            'subscription' => $subscription->url,
        ];
    }

    public function unsubscribeFromPlan(Request $request, $planid)
    {
        $updatedSubscription = SubscriptionService::cancelSubscripton($planid);

        $user = $request->user();
        $subscription = Subscription::with('user')->where("user_id", $user->id)->first();

        if ($subscription) {
            // Update the stripe_status
            $subscription->stripe_status = $updatedSubscription['status'];
            $subscription->save();
        }

        $user->syncRoles('artist');

        Mail::to($user->email)->send(new AccountDowngraded($user));

        return [
            'success' => true,
            'subscription' => $subscription,
        ];
    }

    public function resumeSubscription(Request $request, $planid)
    {
        $plan = Plan::findOrFail($planid);
        $user = $request->user();

        $subscription = $user->subscription('default', Str::snake($plan->title))->resume();

        $user->syncRoles('pro');

        Mail::to($user->email)->send(new AccountResumed($user));
        return [
            'success' => true,
            'subscription' => $subscription->refresh(),
        ];
    }

    public function restartSubscription(Request $request, $planid)
    {
        //        $plan = Plan::findOrFail($planid);
        //        $user = $request->user();
        //
        //        $subscription = Subscription::findUserOnPlan($user->id, $plan->id)->first();
        //
        //        $subscription->restart();
        //
        //        return [
        //            'success' => true,
        //            'subscription' => $subscription->refresh(),
        //        ];
    }
}
