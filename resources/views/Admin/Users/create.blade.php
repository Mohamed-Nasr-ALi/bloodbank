@extends('Admin.main')
@section('title','create users')
@inject('roles','App\Models\Role')
@section('content')
    <div class="container-fluid">
        @include('alerts.errors')
        <div class="box box-info" style="margin-top: 50px">
            <div class="box-header with-border">
                <h3 class="box-title">Add user</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form autocomplete="off" class="form-horizontal" method="POST" action="{{ route('users.store') }}">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">الاسم</label>

                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="name" placeholder="الاسم">
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">البريد الالكتروني</label>

                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="email" placeholder="البريد الالكتروني">
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
                    <button type="submit" class="btn btn-info pull-right">اضف</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
@endsection
