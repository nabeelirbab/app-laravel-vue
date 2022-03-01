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

# New Contact Form Submission
**Name:** {{ $formData['name'] }}<br>
**Email:** {{ $formData['email'] }}

## The message received is as follows:
<hr>
{!! nl2br($formData['message']) !!}
<hr>

Thanks,<br>
{{ config('app.name') }}
@endcomponent

@endcomponent

