@component('mail::message')
# Introduction

Hello {{ $user->full_name }}
Invoice created on {{ $invoice->invoice_date }} with amount: {{ $invoice->amount }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
