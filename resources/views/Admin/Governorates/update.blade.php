@extends('Admin.admintemplet')
@section('title','update governorates')
@section('content')
<div class="container">
    @include('alerts.errors')
    <div class="box box-info"  style="margin-top: 50px">
        <div class="box-header with-border">
            <h3 class="box-title">update governorate</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="{{ route('governorates.update',$governorate->id) }}">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="box-body">
                <div class="form-group">
                    <label for="governorate" class="col-sm-2 control-label">governorate</label>

                    <div class="col-sm-10">
                        <input type="text" name="governorate" class="form-control" id="governorate" placeholder="governorate" value="{{$governorate->name}}">
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
