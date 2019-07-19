@extends('Admin.admintemplet')
@section('title','users')
@inject('roles','App\Models\Role')
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
                    <h3 class="box-title">users</h3>

                    <a href="{{route('users.create')}}" class="pull-right btn btn-success">ADD NEW</a>

                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table table-condensed text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>email</th>
                            <th>roles</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($users->count() > 0)
                            @foreach($users as $index=>$user)

                                <tr>
                                    <td>
                                        {{$index+1}}
                                    </td>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td>
                                        @foreach($user->roles as $role)
                                             <span class="btn-success margin">{{$role->display_name}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{route('users.edit',$user->id)}}"><i class="fa fa-edit"></i></a>
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
                                                        <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display: inline-block">
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
                    <mark class="pull-right">total:- {{count($users)}}</mark>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

@endsection
