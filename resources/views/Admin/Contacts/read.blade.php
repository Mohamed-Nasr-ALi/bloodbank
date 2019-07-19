@extends('Admin.admintemplet')
@section('title','Contacts')
@section('content')
    <div class="container-fluid">
        @if(session('msg'))
            <div style="margin-bottom:100px; ">
                @include('alerts.msg')
            </div>
        @endif
        <div style="margin-top: 50px">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Contacts</h3>
                    <form action="{{ route('contacts') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="keyword" class="form-control" placeholder="search By Email or Phone" value="{{ request()->keyword }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>search</button>
                            </div>

                        </div>
                    </form><!-- end of form -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding table-responsive">
                    <table class="table table-condensed text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>email</th>
                            <th>phone</th>
                            <th>subject</th>
                            <th>MSG</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($contacts->count() > 0)
                            @foreach($contacts as $index=>$contact)

                                <tr>
                                    <td>
                                        {{$index+1}}
                                    </td>
                                    <td>
                                        {{$contact->name}}
                                    </td>
                                    <td>
                                        {{$contact->email}}
                                    </td>
                                    <td>
                                        {{$contact->phone}}
                                    </td>
                                    <td>
                                        {{$contact->subject}}
                                    </td>
                                    <td>
                                        {{$contact->message}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <mark class="pull-right">total:- {{count($contacts)}}</mark>
                </div>
                <!-- /.box-body -->
                <div class="margin text-center">
                    {{$contacts->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection
