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
Hey {{ $user->first_name }}, thanks for your release! we are just validating details and ensuring it's ready to go live on phase.<br><br>If you want to check the status of your releases then click the button below.
<br/>

@component('mail::button', ['url' => config('app.url').'/account/releases'])
    My Releases →
@endcomponent


<i>Please note, validating a release can take up to  24 hours, you will recieve an email confirmation when it has been approved.</i>

@endcomponent

@endcomponent
