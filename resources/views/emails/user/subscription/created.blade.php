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

# Welcome to {{ $subscription->subscription_plan->name }}

Hey {{ $subscription->user->first_name }},

This email is just to confirm that your free trial of {{ $subscription->subscription_plan->name }} has started. You
won't be charged for this month but the plan is set to renew automatically on {{ $subscription->ends_at->format('d/m/Y') }}
when you will be charged &pound;{{ penniesAsPounds($subscription->subscription_plan->monthly_cost) }}.

You can cancel your subscription at any time by visiting your account page.

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@endcomponent
