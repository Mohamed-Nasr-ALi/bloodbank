@extends('Admin.admintemplet')
@section('title','update posts')
@section('content')
<div class="container">
    @include('alerts.errors')
    <div class="box box-info"  style="margin-top: 50px">
        <div class="box-header with-border">
            <h3 class="box-title">update post</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ route('posts.update',$post->id) }}">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="box-body">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">title</label>

                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" id="title" placeholder="title" value="{{$post->title}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="image" class="col-sm-2 control-label">image</label>

                    <div class="col-sm-10">
                        <input type="file" name="image" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="body" class="col-sm-2 control-label">body</label>

                    <div class="col-sm-10">
                        <textarea maxlength="1000" name="body" class="form-control" id="body" placeholder="body">{{$post->body}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-sm-2 control-label">category</label>

                    <div class="col-sm-10">
                        <select class="form-control" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">update</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
</div>

@endsection
