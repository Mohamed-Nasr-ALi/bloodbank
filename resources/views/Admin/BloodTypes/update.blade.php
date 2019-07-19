@extends('Admin.admintemplet')
@section('title','update blood types')
@section('content')
<div class="container">
    @include('alerts.errors')
    <div class="box box-info"  style="margin-top: 50px">
        <div class="box-header with-border">
            <h3 class="box-title">update BloodType</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="{{ route('blood-type.update',$bloodtype->id) }}">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="box-body">
                <div class="form-group">
                    <label for="Blood Type" class="col-sm-2 control-label">Blood Type</label>

                    <div class="col-sm-10">
                        <input type="text" name="bloodtype" class="form-control" id="Blood Type" placeholder="Blood Type" value="{{$bloodtype->name}}">
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
