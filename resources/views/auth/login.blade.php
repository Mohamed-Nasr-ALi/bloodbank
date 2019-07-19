@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{url('/')}}">{{config('app.name')}}</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">قم بتسجيل الدخول</p>

                <form autocomplete="off" action="{{url('/login')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="form-control" placeholder="البريد الالكتروني" required="" name="email">
                        @if ($errors->has('email'))
                            <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" placeholder="كلمة المرور" required="" name="password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-flat">تسجيل الدخول</button>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
