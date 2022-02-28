@component('mail::message')

<table align="center">
    <tr>
        <td>
            <img src="{{ asset('img/emails/main-logo.png') }}" alt="Phase Logo" width="180">
        </td>
    </tr>
    <tr>
        <td>
            <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:19px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:23px;color:#666666;text-align: center;">phase:<span style="color:#ff3366;">admin</span></p>
        </td>
    </tr>
</table>

@component('mail::subcopy')

# {{ ucwords(str_replace("_", " ",$subscription->stripe_plan)) }} Cancellation

Hey {{ $subscription->user->first_name }},

This email is just to confirm that your subscription to {{ ucwords(str_replace("_", " ",$subscription->stripe_plan)) }} has been cancelled.
You will no longer be charged for this plan and you will remain subscribed until this month of the subscription expires
on {{ date("m/d/Y", strtotime($subscription->ends_at)) }}.

You can resume your subscription on your original billing cycle any time between now and
{{ date("m/d/Y", strtotime($subscription->ends_at)) }}. After that you will need to restart your subscription.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@endcomponent
