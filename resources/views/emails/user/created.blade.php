@component('mail::message')
# Introduction

Hello {{ $user->full_name }}
You are successfully registered to our service.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
