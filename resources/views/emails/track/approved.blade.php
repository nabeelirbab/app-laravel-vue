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
## Hey {{ $user->first_name }}, we have finished processing your track and it has been approved to go live on phase!
<br><br>
Your track will be going live on it will go live on the date & time is has been scheduled for
<br/>

@component('mail::button', ['url' => config('app.url').'/account/releases'])
    My Releases →
@endcomponent

<br/><br/><br/>
 Once a track has been approved it will go live instantly, if it has been scheduled, it will go live on the date & time is has been scheduled for.

@endcomponent

@endcomponent
