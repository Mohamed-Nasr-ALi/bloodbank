@component('mail::message')
# Introduction

Hello!! {{$user->name}} from Blood Bank
<h5>Your reset password is:-</h5>
<h1>{{$user->pin_code}}</h1>



Thanks,<br>
{{ config('app.name') }}
@endcomponent
