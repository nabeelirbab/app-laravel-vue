<?php

namespace App\Traits\Marketplace;

use App\User;
use Stripe\Account as StripeAccount;
use Stripe\AccountLink as StripeAccountLink;
use Stripe\Checkout\Session as StripeCheckoutSession;
use Stripe\Subscription as StripeSubscription;

trait Account
{
    public function getAccount()
    {
        if (!$this->accountId()) return;

        return StripeAccount::retrieve($this->accountId(), $this->stripeOptions());
    }

    public function getAccountByUser($id)
    {
        if (!$id) return;

        return StripeAccount::retrieve($id, $this->stripeOptions());
    }

    public function createAccount($data)
    {
        $account = StripeAccount::create([
            'country' => !empty($data['country']) ? $data['country'] : 'GB',
            'type' => 'custom',
            'requested_capabilities' => ['card_payments', 'transfers'],
            'email' => $data['account']['email'],
            'metadata' => [
                'internal_id' => $this->id,
            ],
        ], $this->stripeOptions());

        $sessionCheckout = $this->sessionCheckoutSetup($account->country);

        $accountLink = $this->createAccountLink($account->id, $this->is_pro, $sessionCheckout->url);

        $this->stripe_account_id = $account->id;
        $this->save();

        return $accountLink->url;
        // return $account;
    }

    public function createAccountLink($id, $isPro, $checkoutUrl)
    {

        return StripeAccountLink::create([
            'account' => $id,
            'refresh_url' => env('STRIPE_REFRESH_URL'),
            'return_url' => $isPro ? $checkoutUrl : env('STRIPE_RETURN_URL'),
            'type' => 'account_onboarding',
            'collect' => 'eventually_due',
        ], $this->stripeOptions());
    }

    public function sessionCheckoutSetup($country)
    {
        return StripeCheckoutSession::create([
            'mode' => 'setup',
            'customer' => $this->stripe_id,
            'payment_method_types' => $country == 'GB' ? ['bacs_debit'] : ['sepa_debit'],
            'success_url' => env('STRIPE_CHECKOUT_RETURN_URL'),
            'cancel_url' =>  env('STRIPE_REFRESH_URL')
        ], $this->stripeOptions());
    }

    public function subscriptionCheckout()
    {
        // dd("asdasdasd", $this);
        $stripeAccount = $this->getAccount();
        // dd($stripeAccount);

        $checkout =  StripeSubscription::create([
            'customer' => $this->stripe_id,
            'items' => [
                $stripeAccount['country'] === "GB" ? ['price' => 'artist_pro'] : ['price' => 'price_1NuW5kJ05tUsYkdQvvsV61DV'],
            ],
            'trial_period_days' => '30',
        ], $this->stripeOptions());

        // dd($checkout);

        return [
            'user_id' => $stripeAccount['metadata']['internal_id'],
            'subscription_details' => $checkout
        ];
    }

    public function updateAccountFile($data)
    {
        $person_id = explode('.', $data['requireFor'][0])[0];
        if ($person_id == 'individual') {
            return StripeAccount::update($this->accountId(), [
                'account_token' => $data['account_token'],
            ], $this->stripeOptions());
        } else {
            StripeAccount::updatePerson($this->accountId(), $person_id, [
                'verification' => [
                    'document' => [
                        'front' => $data['verification']['document']['front']
                    ]
                ],
            ], $this->stripeOptions());
            return StripeAccount::update($this->accountId(), [
                'account_token' => $data['account_token'],
                'business_profile' => $data['business_profile']
            ], $this->stripeOptions());
        }
    }

    public function updateAccount($data)
    {
        $accountLink = StripeAccountLink::create([
            'account' => $data['account_id'],
            'refresh_url' => env('STRIPE_REFRESH_URL'),
            'return_url' => env('STRIPE_UPDATE_RETURN_URL'),
            'type' => 'account_update',
            'collect' => 'eventually_due',
        ], $this->stripeOptions());

        return $accountLink->url;
    }

    public function deleteAccount()
    {
        $account =  StripeAccount::retrieve($this->accountId(), $this->stripeOptions());
        User::where('stripe_account_id', $account->id)->update(['stripe_account_id' => null]);
        return $account->delete();
    }
}
