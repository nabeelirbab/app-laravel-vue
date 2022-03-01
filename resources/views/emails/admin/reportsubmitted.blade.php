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

# Phase Content

A new report has been submitted for a {{ $report->reportable->type }} on Phase. Log into the control panel to
review this report and the associated {{ $report->reportable->type }}.

## The user who reported the {{ $report->reportable->type }} was:
@component('mail::panel')
    {{ $report->user->name }}
@endcomponent

## The provided reason for the report was:
@component('mail::panel')
    {{ $report->message }}
@endcomponent

@component('mail::button', ['url' => $url])
    View Report
@endcomponent

@endcomponent

@endcomponent
