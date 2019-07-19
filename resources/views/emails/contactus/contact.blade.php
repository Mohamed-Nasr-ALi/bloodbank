@component('mail::message')
# Introduction

hi i'm <mark>{{$user->name}}</mark> and my msg:-
<p>{{$user->message}}</p>
<hr>
<h1>contact info:</h1>
phone:- <b>{{$user->phone}}</b><br>
email:- <b> {{$user->email}} </b>
<hr>
@component('mail::button', ['url' => 'facebook.com'])
FaceBook
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
