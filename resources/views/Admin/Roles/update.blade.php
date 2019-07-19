@extends('Admin.admintemplet')
@section('title','update role')
@inject('permissions','App\Models\Permission')
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
            <h3 class="box-title">update role</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="{{ route('roles.update',$role->id) }}">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">الاسم</label>

                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" placeholder="role" value="{{$role->name}}">
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="display_name" class="col-sm-2 control-label">الاسم المعروض</label>

                    <div class="col-sm-10">
                        <input type="text" name="display_name" class="form-control" id="display_name" placeholder="display_name" value="{{$role->display_name}}">
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">الوصف</label>

                    <textarea class="margin col-sm-9 description" name="description" placeholder="description" value="{{$role->description}}">
                        {{$role->description}}
                    </textarea>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="permission_list" class="col-sm-2 control-label">الصلاحيات</label>
                    <br>
                    <div class="col-sm-10">

                        @foreach($permissions->all() as $permission)
                            <div class="col-sm-3">

                                <input type="checkbox"  name="permission_list[]" value="{{$permission->id}}"
                                    @if($role->hasPermission($permission->name))
                                        checked
                                        @endif
                                >{{$permission->display_name}}

                            </div>
                        @endforeach

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

@endsection
