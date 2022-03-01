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
# {{ $subscription->subscription_plan->name }} Resumed

Hey {{ $subscription->user->first_name }},

This email is just to confirm that your subscription to {{ $subscription->subscription_plan->name }} has been resumed.
This means that your plan was originally cancelled but has been resumed during the grace period (before the subscription
ended). This means that you will be billed &pound;{{ penniesAsPounds($subscription->subscription_plan->monthly_cost) }}
again on {{ $subscription->ends_at->format('d/m/Y') }} which is when you would have originally been billed.

You can cancel your subscription at any time by visiting your account page.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@endcomponent