<?php

namespace App\Traits\Marketplace;

use Stripe\Account as StripeAccount;

trait Account
{
    public function getAccount()
    {
        if (!$this->accountId()) return;

        return StripeAccount::retrieve($this->accountId(), $this->stripeOptions());
    }

    public function createAccount($data)
    {
        // dd($data['account']['address']['city']);
        if ($data['account']['business_type'] == 'Individual') {
            $account = StripeAccount::create([
                'country' => !empty($data['account']['country']) ? $data['account']['country'] : 'GB',
                'type' => 'custom',
                'requested_capabilities' => ['card_payments', 'transfers'],
                'account_token' => $data['account_token'],
                'email' => $this->email,
                'metadata' => [
                    'internal_id' => $this->id,
                ],
                // 'individual' => [
                //     'first_name' => $data['account']['first_name'],
                //     'last_name' => $data['account']['last_name'],
                //     'email' => $data['account']['email'],
                //     'phone' => $data['account']['phone'],
                //     'nationality' => $data['account']['country'],
                //     'dob' => [
                //         'day' => $data['account']['dob']['day'],
                //         'month' => $data['account']['dob']['month'],
                //         'year' => $data['account']['dob']['year'],
                //     ],
                //     'address' => [
                //         'city' => $data['account']['address']['city'],
                //         'line1' => $data['account']['address']['line1'],
                //         'line2' => $data['account']['address']['line2'],
                //         'postal_code' => $data['account']['address']['postal_code'],
                //         'country' => $data['account']['country'],
                //     ],
                // 'relationship' => [
                //     'title' => $data['account']['title'],
                //     'percent_ownership' => $data['account']['percentage'],
                //     'country' => $data['account']['country'],
                //     'director' => $data['account']['relationship'] == 'director' ? true : false,
                //     'owner' => $data['account']['relationship'] == 'owner' ? true : false,
                //     'representative' => $data['account']['relationship'] == 'representative' ? true : false,
                // ],
                // ],
                'external_account' => [
                    'object' => 'bank_account',
                    'account' => $data['account_token'],
                    'bank_name' => 'Test Bank',
                    'country' => 'GB',
                    "currency" => "gbp",
                    "account_number" => "GB82WEST12345698765432"
                ],
                'business_profile' => [
                    'mcc' => 5815,
                    'name' => 'phase',
                    'url' => isset($data['account']['website']) ? $data['account']['website'] : 'https://phase.com',
                    'product_description' => 'Music in digital form (WAV/MP3) formats',
                ],
            ], $this->stripeOptions());
        } else {

            $account = StripeAccount::create([
                'country' => !empty($data['account']['country']) ? $data['account']['country'] : 'GB',
                'type' => 'custom',
                'requested_capabilities' => ['card_payments', 'transfers'],
                'account_token' => $data['account_token'],
                'email' => $this->email,
                'metadata' => [
                    'internal_id' => $this->id,
                ],
                // 'individual' => [
                //     'first_name' => $data['account']['first_name'],
                //     'last_name' => $data['account']['last_name'],
                //     'email' => $data['account']['email'],
                //     'phone' => $data['account']['phone'],
                //     'nationality' => $data['account']['country'],
                //     'dob' => [
                //         'day' => $data['account']['dob']['day'],
                //         'month' => $data['account']['dob']['month'],
                //         'year' => $data['account']['dob']['year'],
                //     ],
                //     'address' => [
                //         'city' => $data['account']['address']['city'],
                //         'line1' => $data['account']['address']['line1'],
                //         'line2' => $data['account']['address']['line2'],
                //         'postal_code' => $data['account']['address']['postal_code'],
                //         'country' => $data['account']['country'],
                //     ],
                // 'relationship' => [
                //     'title' => $data['account']['title'],
                //     'percent_ownership' => $data['account']['percentage'],
                //     'country' => $data['account']['country'],
                //     'director' => $data['account']['relationship'] == 'director' ? true : false,
                //     'owner' => $data['account']['relationship'] == 'owner' ? true : false,
                //     'representative' => $data['account']['relationship'] == 'representative' ? true : false,
                // ],
                // ],
                // 'company' => [
                //     'name' => $data['account']['company_name'] ? $data['account']['company_name'] : "Phase",
                //     'phone' => $data['account']['business_number'],
                //     'registration_number' => $data['account']['crn'],
                //     'structure' => $data['account']['business_structure'],
                //     'address' => [
                //         'city' => $data['account']['companyAddress']['city'],
                //         'line1' => $data['account']['companyAddress']['line1'],
                //         'line2' => $data['account']['companyAddress']['line2'],
                //         'postal_code' => $data['account']['companyAddress']['postal_code'],
                //         'country' => $data['account']['country'],
                //     ],
                // ],
                'external_account' => [
                    'object' => 'bank_account',
                    'account' => $data['account_token'],
                    'bank_name' => 'Test Bank',
                    'country' => $data['account']['account_country'],
                    "currency" => "gbp",
                    "account_number" => $data['account']['account_number']
                ],
                'business_profile' => [
                    'mcc' => 5815,
                    'name' => 'phase',
                    'url' => isset($data['account']['website']) ? $data['account']['website'] : 'https://phase.com',
                    'product_description' => 'Music in digital form (WAV/MP3) formats',
                ],
            ], $this->stripeOptions());

            $person = StripeAccount::createPerson($account['id'], [
                'first_name' => $data['account']['first_name'],
                'last_name' => $data['account']['last_name'],
                'email' => $data['account']['email'],
                'phone' => $data['account']['phone'],
                'nationality' => $data['account']['country'],
                'dob' => [
                    'day' => $data['account']['dob']['day'],
                    'month' => $data['account']['dob']['month'],
                    'year' => $data['account']['dob']['year'],
                ],
                'address' => [
                    'city' => $data['account']['address']['city'],
                    'line1' => $data['account']['address']['line1'],
                    'line2' => $data['account']['address']['line2'],
                    'postal_code' => $data['account']['address']['postal_code'],
                    'country' => $data['account']['country'],
                ],
                'relationship' => [
                    'title' => $data['account']['title'],
                    'percent_ownership' => $data['account']['percentage'],
                    // 'country' => $data['account']['country'],
                    'director' => $data['account']['relationship'] == 'director' ? true : false,
                    'owner' => $data['account']['relationship'] == 'owner' ? true : true,
                    'representative' => $data['account']['relationship'] == 'representative' ? true : true,
                ],
            ], $this->stripeOptions());
        }


        $this->stripe_account_id = $account->id;
        $this->save();

        return $account;
    }

    public function updateAccount($data)
    {
        return StripeAccount::update($this->accountId(), [
            'account_token' => $data['account_token'],
            'business_profile' => $data['business_profile']
        ], $this->stripeOptions());
    }
}
