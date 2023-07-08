<?php

namespace App\Traits\Marketplace;

use App\User;
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
        // dd($data['account']['identity_document']['document']['front']);
        if ($data['account']['business_type'] == 'individual') {
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
                    'bank_name' => $data['account']['account_name'],
                    'country' => $data['account']['account_country'],
                    "currency" => "gbp",
                    "account_number" => $data['account']['account_number']
                ],
                'business_profile' => [
                    'mcc' => 5815,
                    'name' => $data['account']['company_name'],
                    'url' => isset($data['account']['website']) ? $data['account']['website'] : 'https://phase.uk',
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
                    'bank_name' => $data['account']['account_name'],
                    'country' => $data['account']['account_country'],
                    "currency" => "gbp",
                    "account_number" => $data['account']['account_number']
                ],
                'business_profile' => [
                    'mcc' => 5815,
                    'name' => $data['account']['company_name'],
                    'url' => isset($data['account']['website']) ? $data['account']['website'] : 'https://phase.uk',
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
                'verification' => [
                    'document' => [
                        'front' => $data['account']['identity_document']['document']['front']
                    ]
                ],
            ], $this->stripeOptions());
        }

        $this->stripe_account_id = $account->id;
        $this->save();

        return $account;
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
        // dd($data);
        if ($data['business_type'] == 'individual') {
            $updateData = [
                'account_token' => $data['account_token'],
                'email' => $data['account']['email'],
                'business_profile' => [
                    'url' => isset($data['account']['website']) ? $data['account']['website'] : 'https://phase.uk',
                ]
            ];

            if (isset($data['bank']['account_number'])) {
                $updateData['external_account'] = [
                    'object' => 'bank_account',
                    'account' => $data['account_token'],
                    'bank_name' => $data['bank']['name'],
                    'country' => $data['bank']['country'],
                    'currency' => 'gbp',
                    'account_number' => $data['bank']['account_number']
                ];
            }
            
            return StripeAccount::update($this->accountId(), $updateData, $this->stripeOptions());
        } elseif ($data['business_type'] == 'company') {
            return StripeAccount::update($this->accountId(), [
                'account_token' => $data['account_token'],
                'email' => $data['account']['email'],
            ], $this->stripeOptions());
        } else {
            return StripeAccount::update($this->accountId(), [
                'account_token' => $data['account_token'],
                'email' => $data['account']['email'],
            ], $this->stripeOptions());
        }
    }

    public function deleteAccount()
    {
        $account =  StripeAccount::retrieve($this->accountId(), $this->stripeOptions());
        User::where('stripe_account_id', $account->id)->update(['stripe_account_id' => null]);
        return $account->delete();
    }
}
