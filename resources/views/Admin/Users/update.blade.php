@extends('Admin.admintemplet')
@section('title','update user')
@inject('roles','App\Models\Role')
@section('content')
<div class="container">
    @include('alerts.errors')
    @if(session('msg'))
        <div style="margin-bottom:100px; ">
            @include('alerts.msg')
        </div>
    @endif
    <div class="box box-info"  style="margin-top: 50px">
        <div class="box-header with-border">
            <h3 class="box-title">update user</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->

        <form class="form-horizontal" method="POST" action="{{ route('users.update',$user->id) }}">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="box-body">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">الاسم</label>

                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="name" placeholder="الاسم" value="{{$user->name}}">
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">البريد الالكتروني</label>

                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="email" placeholder="البريد الالكتروني" value="{{$user->email}}">
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">كلمه المرور</label>

                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" id="password" placeholder="كلمه المرور">
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label for="password_confirmation" class="col-sm-2 control-label">تاكيد كلمه المرور</label>

                <div class="col-sm-10">
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="كلمه المرور">
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group row">
                <label for="permission_list" class="col-sm-2 control-label">الرتبه</label>
                <br>
                <div class="col-md-10">
                    <select name="roles_list[]" multiple size="10">
                        @foreach($roles->all() as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">update</button>
        </div>
        <!-- /.box-footer -->
    </form>
    </div>
</div>
@stop






{{--<div class="well">--}}

{{--            {!! Form::model($user,['action'=> ['UsersController@update', $user->id],'id'=>'myForm','role'=>'form','method'=>'PUT']) !!}--}}
{{--            {{csrf_field()}}--}}
{{--            <fieldset>--}}

{{--                <!-- Name -->--}}
{{--                <div class="form-group">--}}
{{--                    {!! Form::label('name', 'Name:', ['class' => 'col-lg-2 control-label']) !!}--}}
{{--                    <div class="col-lg-10">--}}
{{--                        {!! Form::text('text', $value = $user->name, ['class' => 'form-control', 'placeholder' => 'name','type'=>'text']) !!}--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Email -->--}}
{{--                <div class="form-group">--}}
{{--                    {!! Form::label('email', 'Email:', ['class' => 'col-lg-2 control-label']) !!}--}}
{{--                    <div class="col-lg-10">--}}
{{--                        {!! Form::email('email', $value = $user->email, ['class' => 'form-control', 'placeholder' => 'email','type'=>'email']) !!}--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Password -->--}}
{{--                <div class="form-group">--}}
{{--                    {!! Form::label('password', 'Password:', ['class' => 'col-lg-2 control-label']) !!}--}}
{{--                    <div class="col-lg-10">--}}
{{--                        {!! Form::password('password',['class' => 'form-control', 'placeholder' => 'Password', 'type' => 'password']) !!}--}}

{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Password_confirmation -->--}}
{{--                <div class="form-group">--}}
{{--                    {!! Form::label('password_confirmation', 'Password_confirmation:', ['class' => 'col-lg-2 control-label']) !!}--}}
{{--                    <div class="col-lg-10">--}}
{{--                        {!! Form::password('password_confirmation',['class' => 'form-control', 'placeholder' => 'Password_confirmation', 'type' => 'password']) !!}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Select Multiple -->--}}
{{--                <div class="form-group">--}}
{{--                    <div class="col-lg-10">--}}
{{--                        {!! Form::select('roles_list[]',$roles,null,[--}}
{{--                        'class'=>'form-control',--}}
{{--                        'multiple'=>'multiple'--}}
{{--                        ]) !!}--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Submit Button -->--}}
{{--                <div class="form-group">--}}
{{--                    <div class="col-lg-10 col-lg-offset-2">--}}
{{--                        {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </fieldset>--}}

{{--            {!! Form::close()  !!}--}}

{{--        </div>--}}
