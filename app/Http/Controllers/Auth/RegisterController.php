<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Events\Register;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Mailcoach\Models\Tag;
use App\Http\Controllers\Controller;
use App\Otp;
use App\Rules\Recaptcha;
use Spatie\Mailcoach\Models\EmailList;
use Spatie\Mailcoach\Models\Subscriber;
use Twilio\Rest\Client;
use Exception;

class RegisterController extends Controller
{
    protected $types = [
        'standard',
        'artist',
        'pro',
    ];

    protected $rules = [
        'all' => [
            'personal.firstname' => 'required|string|max:255',
            'personal.surname' => 'required|string|max:255',
            'personal.email' => 'required|email|unique:users,email|max:255',
            'personal.password' => 'required|string|confirmed',
            'personal.password_confirmation' => 'required|string',

            'interests.genres' => 'required|between:1,4',
            'interests.genres.*.id' => 'required|exists:genres,id',
            'newsletter' => 'nullable',
            'guestCart' => 'nullable',
        ],
        'standard' => [
            'personal.username' => 'required|string|unique:users,name|max:20',
        ],
        'pro' => [
            'personal.artist_user_type' => 'required',
            'artist.username' => 'required|string|unique:users,name|max:20',
            'artist.genres' => 'required|between:1,4',
            'artist.genres.*.id' => 'required|exists:genres,id',

            'social.website' => 'nullable|string|max:255',
            'social.facebook' => 'nullable|string|max:255',
            'social.twitter' => 'nullable|string|max:255',
            'social.soundcloud' => 'nullable|string|max:255',
            'social.youtube' => 'nullable|string|max:255',

        ],
    ];

    public function register(Request $request, $type, Recaptcha $recaptcha)
    {
        if (!in_array($type, $this->types)) {
            throw new \Exception('membership type not valid');
        }

        $this->rules['all']['recaptcha'] = ['required', $recaptcha];

        $validated = $request->validate(
            array_merge(
                $this->rules['all'],
                $type === 'standard' ? $this->rules['standard'] : $this->rules['pro']
            )
        );

        return $this->createAccount($validated, $type);
    }

    protected function createAccount(array $data, $type = 'standard')
    {
        $user = User::create([
            'name' => $type === 'standard' ? $data['personal']['username'] : $data['artist']['username'],
            'email' => $data['personal']['email'],
            'first_name' => $data['personal']['firstname'],
            'last_name' => $data['personal']['surname'],
            'path' => $type === 'standard' ? $data['personal']['username'] : $data['artist']['username'],
            'password' => $data['personal']['password'],
        ]);
        $user->status = 'awaiting';
        // random string with current timestamp for activation token
        $randomString = time() . substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 15);
        $user->activation_token = $randomString;
        $user->save();

        if ($type !== 'standard') {
            $user->social_web = $data['social']['website'];
            $user->social_youtube = $data['social']['youtube'];
            $user->social_facebook = $data['social']['facebook'];
            $user->social_twitter = $data['social']['twitter'];
            $user->artist_user_type_id = $data['personal']['artist_user_type'];
            $user->save();
        }

        if ($type === 'standard') {
            $user->approved_at = now();
            $user->save();
        }

        if ($type === 'pro' || $type == 'artist') {

            if ($type == 'pro') {
                $user->createAsStripeCustomer([
                    'name' => $data['personal']['firstname'] . ' ' . $data['personal']['surname'],
                ]);
                $user->trial_ends_at = now()->addDays(30);
            }

            $genreIDs = collect($data['artist']['genres'])->pluck('id');

            $user->genres()->sync($genreIDs->all());
            $user->save();
        }

        if (!empty($data['newsletter'])) {
            $emailList = EmailList::where('name', 'General')->first();
            if (!empty($emailList)) {
                Subscriber::createWithEmail($data['personal']['email'])
                    ->withAttributes([
                        'first_name' => $data['personal']['firstname'],
                        'last_name' => $data['personal']['surname']
                    ])
                    ->skipConfirmation()
                    ->subscribeTo($emailList);
            }

            if ($type === 'pro') {
                $emailList = EmailList::where('name', 'Artist Pro')->first();
                if (!empty($emailList)) {
                    Subscriber::createWithEmail($data['personal']['email'])
                        ->withAttributes([
                            'first_name' => $data['personal']['firstname'],
                            'last_name' => $data['personal']['surname']
                        ])
                        ->skipConfirmation()
                        ->subscribeTo($emailList);
                }
            }
            if ($type === 'artist') {
                $emailList = EmailList::where('name', 'Artist')->first();
                if (!empty($emailList)) {
                    Subscriber::createWithEmail($data['personal']['email'])
                        ->withAttributes([
                            'first_name' => $data['personal']['firstname'],
                            'last_name' => $data['personal']['surname']
                        ])
                        ->skipConfirmation()
                        ->subscribeTo($emailList);
                }
            }
        }

        $this->createNotificationSettings($user, $data['newsletter']);

        $user->assignRole([$type]);

        $genreIDs = collect($data['interests']['genres'])->pluck('id');

        $user->interests()->sync($genreIDs->all());

        /** Transfer over the guest cart if applicable */
        if (!is_null($data['guestCart'])) {
            $user->syncGuestCart($data['guestCart']);
        }

        if ($type === 'standard') {
            event(new Register($user));
        }

        return $user;
    }

    protected function createNotificationSettings($user, $newsletter)
    {
        $user->notification_setting()->create([
            'activity_follower_on_me_email' => false,
            'activity_share_on_mine_email' => false,
            'activity_post_from_followee_email' => false,
            'activity_like_on_mine_email' => false,
            'activity_comment_on_mine_email' => false,
            'activity_message_email' => false,
            'phase_new_features_email' => false,
            'phase_surveys_feedback_email' => false,
            'phase_tips_offers_email' => false,
            'phase_newsletter_email' => $newsletter,
        ]);

        return $this;
    }

    public function createOTP(Request $req)
    {
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        try {
            $otp = Otp::create([
                'code' => $code,
            ]);

            // dd($otp);
            if ($otp) {
                $client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
                $res = $client->messages->create($req->phone, [
                    'from' => "Phase",
                    'body' => "Your Phase verification code is: " . $code
                ]);
                // dd($res);
                // $alpha_sender = $client->messaging->v1->services("MGd6e57aaa0bab52a58e955292e2a08799")
                // ->alphaSenders
                // ->create("Phase");
                // dd($alpha_sender->sid);
                // Success response
                return response()->json(['message' => 'OTP created and code sent successfully.', 'otp_id' => $otp->id]);
            }
        } catch (Exception $e) {
            // Error handling
            return response()->json(['message' => 'Error occurred while creating OTP.'], 500);
        }
    }

    public function resendOTP(Request $req)
    {
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        try {
            $otp = Otp::where('id', $req->id)->first();

            // FOR RESEND: Check if the OTP record exists
            if ($otp) {
                // Delete the OTP record
                $otp->delete();
            }

            $otp = Otp::create([
                'code' => $code,
            ]);

            if ($otp) {
                $client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
                $res = $client->messages->create($req->phone, [
                    'from' => "Phase",
                    'body' => "Your Phase verification code is: " . $code
                ]);
                // Success response
                return response()->json(['message' => 'OTP created and code sent successfully.', 'otp_id' => $otp->id]);
            }
        } catch (Exception $e) {
            // Error handling
            return response()->json(['message' => 'Error occurred while creating OTP.'], 500);
        }
    }

    public function verification(Request $req)
    {
        // dd($req);
        $code = $req->code;
        $id = $req->id;

        // Retrieve the OTP record based on the user ID
        $otp = Otp::where('id', $id)->first();

        // Check if the OTP record exists and the code matches
        if ($otp && $otp->code === $code) {
            // Verification successful
            // Delete the OTP record
            $otp->delete();
            return response()->json(['message' => 'OTP verification successful.']);
        } else {
            // Verification failed
            return response()->json(['message' => 'Invalid OTP code.'], 400);
        }
    }
}
