@extends('Admin.main')
@section('title','create roles')
@inject('permissions','App\Models\Permission')
@section('content')
    <div class="container-fluid">
        @include('alerts.errors')
        <div class="box box-info" style="margin-top: 50px">
            <div class="box-header with-border">
                <h3 class="box-title">Add role</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('roles.store') }}">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">الاسم</label>

                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="name" placeholder="role">
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="display_name" class="col-sm-2 control-label">الاسم المعروض</label>

                        <div class="col-sm-10">
                            <input type="text" name="display_name" class="form-control" id="display_name" placeholder="display_name">
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">الوصف</label>

                        <div class="col-sm-10">
                            <textarea name="description" placeholder="xx"></textarea>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group row">
                        <label for="permission_list" class="col-sm-2 control-label">الصلاحيات</label>



                        <div class="col-sm-10">
                            <div class="row margin">
                                <input id="select-all" type="checkbox" ><label for='select-all'>اختيار الكل</label>
                            </div>
                             @foreach($permissions->all() as $permission)
                                <div class="col-sm-3">
                                    <input type="checkbox" name="permission_list[]" value="{{$permission->id}}">{{$permission->display_name}}
                                </div>
                            @endforeach
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
    @push('scripts')
        <script>
            $("#select-all").click(function(){
                $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

            });
        </script>
    @endpush

@endsection
