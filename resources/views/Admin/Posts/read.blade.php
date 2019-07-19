@extends('Admin.admintemplet')
@section('title','posts')
@section('content')
    <div class="container">
        @if(session('msg'))
            <div style="margin-bottom:100px; ">
                @include('alerts.msg')
            </div>
        @endif
        <div style="margin-top: 50px">
            <div class="box">

                <div class="box-header">
                    <h3 class="box-title margin">posts</h3>
                    <div class="row">
                        <div class="col-sm-3 pull-right">

                            <a href="{{route('posts.create')}}" class="pull-right btn btn-success">ADD NEW</a>

                        </div>
                    </div>

                    <form action="{{ route('posts.index') }}" method="get">

                        <div class="row">
                            <div class="col-md-4">
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="keyword" class="form-control" placeholder="search By Title OR Post Body IN Category you choice" value="{{ request()->keyword }}">
                                <mark>search in all categories:- </mark><input type="checkbox"  name="action" value="all">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-search"></i>search</button>
                            </div>

                        </div>
                    </form><!-- end of form -->
                    <hr>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-condensed text-center table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>title</th>
                            <th>image</th>
                            <th>body</th>
                            <th>category</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($posts->count() > 0)
                            @foreach($posts as $index=>$post)

                                <tr>
                                    <td>
                                        {{$index+1}}
                                    </td>
                                    <td>
                                        {{$post->title}}
                                    </td>
                                    <td>
                                        <img src="{{asset('storage/thumbnails/'.$post->image)}}" alt="Lights" class="img-thumbnail" width="100px" height="100px" style="min-height: 100px !important; max-height: 100px !important;">
                                    </td>
                                    <td>
                                        {{$post->body}}
                                    </td>
                                    <td>
                                        {{$post->category->name}}
                                    </td>
                                    <td>
                                        <a href="{{route('posts.edit',$post->id)}}"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <div id="exampleModal" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Deleting</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('posts.destroy', $post->id) }}" method="post" style="display: inline-block">
                                                            {{ csrf_field() }}
                                                            {{ method_field('delete') }}
                                                            <button type="submit" class="btn btn-danger delete">Delete</button>
                                                        </form><!-- end of form -->
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <mark class="pull-right">total:- {{count($posts)}}</mark>
                </div>
                <!-- /.box-body -->
               <div class="margin text-center">
                   {{$posts->links()}}
               </div>
            </div>
        </div>
    </div>


@endsection
