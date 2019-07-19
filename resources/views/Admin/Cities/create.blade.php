@extends('Admin.main')
@section('title','create cities')
@section('content')
    <div class="container">
        @include('alerts.errors')
        <div class="box box-info" style="margin-top: 50px">
            <div class="box-header with-border">
                <h3 class="box-title">Add city</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('cities.store') }}">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="city" class="col-sm-2 control-label">city</label>

                        <div class="col-sm-10">
                            <input type="text" name="city" class="form-control" id="city" placeholder="city">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="governorates" class="col-sm-2 control-label">governorates</label>

                        <div class="col-sm-10">
                            <select class="form-control" name="governorate" >
                                @foreach($governorates as $governorate)
                                    <option value="{{$governorate->id}}">{{$governorate->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">ADD</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
@endsection
