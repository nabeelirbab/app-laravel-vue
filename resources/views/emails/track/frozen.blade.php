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
## Hey {{ $user->first_name }}, unfortunately  we have recieved information that your track: {{ $track->name }} contains inappropriate content or is subject to copyright infringement, these track(s) are frozen whilst we investigate.
<br/>
@component('mail::button', ['url' => config('app.url').'/account/releases'])
    My Releases →
@endcomponent
<p style="text-align: center;">
 phase reserves the right and has a duty to freeze any content potentially in breach whilst it is investigated. You will receive an update once this process is complete.
</p>
<p style="text-align: center;">
<strong>Please review our copyright policy <a href="{{ config('app.url').'/terms' }}">HERE</a>,for futher help on copyright visit our Help & Support center <a href="{{ config('app.url').'/help' }}">HERE</a></strong>
</p>
@endcomponent

@endcomponent

