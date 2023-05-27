<?php

namespace App\Http\Controllers\Auth;

use App\Events\Register;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarketplaceController extends Controller
{
    public function store(Request $request)
    {
        try {
            $user = User::find($request->user_id);
            // dd($request);
            $user->createAccount($request);
            if ($request->phone) {
                $user->phone = $request->phone;
                $user->save();
            }

            if ($request->artist_user_type) {
                $user->artist_user_type_id = $request->artist_user_type;
                $user->save();
            }

            // dd($user);
            if (date('Y-d-m', strtotime($user['created_at'])) >= date('Y-d-m')) {
                event(new Register($user));
            }
            // event(new Register($user));


            return $user;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);;
        }
    }

    public function update(Request $request)
    {
        $user = User::find($request->user_id);

        $user->updateAccount([
            'account_token' => $request->token,
            'business_profile' => $request->business_profile,
        ]);

        event(new Register($user));

        return $user;
    }
}
