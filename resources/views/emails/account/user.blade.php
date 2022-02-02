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
## WELCOME
Hey {{ $user->first_name }}, we are excited for you to be part of the community!

<ul>
    <li>
        <strong>User type:</strong> {{ \Illuminate\Support\Str::title($user->roles->first()->name) }} 
    </li>
    <li> 
        <strong>Status:</strong><em> {!! $user->roles->first()->name === 'artist' || $user->roles->first()->name === 'artist_pro' ? '<span style="color:#f8bd01;font-weight:bold;">Processing</span>' : 'Awaiting email verification' !!}</em> 
    </li>
</ul>

<br/>
@component('mail::button', ['url' => config('app.url'),'style' => 'font-size:16px;color:#666666;display:inline-block;background:#EFEFEF;border-radius:25px;text-align:center;padding:8px 8px 8px 8px']) Please verify your email address → 
@endcomponent

@if ($user->roles->first()->name === 'artist' || $user->roles->first()->name === 'artist_pro')
<h5 > We are in the process of verifying your profile and will update you once this is finished, until then you can access Phase as a standard user.</h5>
@endif
<br/><br/> 

<p style="color:#666666;padding-bottom:20px;border-bottom:solid;border-width:1px;border-color:#485FFF;margin-bottom:20px"><i>"Our passion is music and our vision is  to provide a platform that supports the music industry. Instead of taking away from the Artists, Labels, and Producers we aim to give back to the people that deserve it, providing fans access to the latest quality music and providing musicians with the tools and environment to build their own audience, develop what they love doing, connect people through music on a platform enriched with amazing individuals and music for everyone to discover."</i>
</p>

<br/>
@if ($user->roles->first()->name === 'standard')
    @include('emails.partials.standard-icons')
@else
    @include('emails.partials.artist-icons')
@endif

@endcomponent

@endcomponent
