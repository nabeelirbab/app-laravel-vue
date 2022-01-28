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
## Hey {{ $user->first_name }}, we have freezed your profile! 

<ul>
    <li>User type: {{ \Illuminate\Support\Str::title($user->roles->first()->name) }} </li>
    <li>Status: <span style="color:#a1eee1;font-weight:bold;">Freezed</span></li>
</ul>

<br/>
<br/>

Please contact to administrator if you want to approve your profile


@endcomponent

@endcomponent
