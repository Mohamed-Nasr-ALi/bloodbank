@extends('Admin.admintemplet')
@section('title','blood types')
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
                    <h3 class="box-title">Blood Types</h3>

                    <div class="row">
                        <div class="col-sm-3 pull-right">

                            <a href="{{route('blood-type.create')}}" class="pull-right btn btn-success">ADD NEW</a>

                        </div>
                    </div>

                    <form action="{{ route('blood-type.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="name" class="form-control" placeholder="search By BloodType name" value="{{ request()->name }}">
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
                    <table class="table table-condensed text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Blood Type</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($bloodtypes->count() > 0)
                            @foreach($bloodtypes as $index=>$bloodtype)

                                <tr>
                                    <td>
                                        {{$index+1}}
                                    </td>
                                    <td>
                                        {{$bloodtype->name}}
                                    </td>
                                    <td>
                                        <a href="{{route('blood-type.edit',$bloodtype->id)}}"><i class="fa fa-edit"></i></a>
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
                                                        <form action="{{ route('blood-type.destroy', $bloodtype->id) }}" method="post" style="display: inline-block">
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
                    <mark class="pull-right">total:- {{count($bloodtypes)}}</mark>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

@endsection
