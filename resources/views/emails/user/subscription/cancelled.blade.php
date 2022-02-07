@component('mail::message')
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
