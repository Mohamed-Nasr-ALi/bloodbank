@extends('Admin.admintemplet')
@section('title','update category')
@section('content')
<div class="container">
    @include('alerts.errors')
    <div class="box box-info"  style="margin-top: 50px">
        <div class="box-header with-border">
            <h3 class="box-title">update category</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="{{ route('categories.update',$category->id) }}">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="box-body">
                <div class="form-group">
                    <label for="category" class="col-sm-2 control-label">category</label>

                    <div class="col-sm-10">
                        <input type="text" name="category" class="form-control" id="category" placeholder="category" value="{{$category->name}}">
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
