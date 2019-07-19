@extends('Admin.admintemplet')
@section('title','clients')
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
                    <h3 class="box-title">clients</h3>

                    <form action="{{ route('clients') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <select name="city_id" class="form-control">
                                    @foreach($cities as $city)
                                    <option  value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="keyword" class="form-control" placeholder="search By Name or phone" value="{{ request()->keyword }}">
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
                    <table class="table table-condensed text-center table-responsive table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>email</th>
                            <th>Birth date</th>
                            <th>Blood Type</th>
                            <th>city</th>
                            <th>phone</th>
                            <th>last order date</th>
                            <th>status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if ($clients->count() > 0)
                                @foreach($clients as $index=>$client)

                                    <tr>
                                        <td>
                                            {{$index+1}}
                                        </td>
                                        <td>
                                            {{$client->name}}
                                        </td>
                                        <td>
                                            {{$client->email}}
                                        </td>
                                        <td>
                                            {{$client->b_o_d}}
                                        </td>
                                        <td>
{{--                                            {{optional($client->blood_type)->name}}--}}
                                            @foreach($bloodtypes as $bloodtype)
                                                @if($client->blood_type_id == $bloodtype->id)
                                                    {{$bloodtype->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($cities as $city)
                                                @if($client->city_id == $city->id)
                                                    {{$city->name}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            {{$client->phone}}
                                        </td>
                                        <td>
                                            {{$client->order_last_date}}
                                        </td>
                                        <td>
                                            @if($client->is_active)
                                                <span class="text-success">Active</span>
                                            @else
                                                <span class="text-danger">Des-Active</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($client->is_active)
                                                <a href="{{route('clientupdate',$client->id)}}" class="btn btn-danger">الغاء التفعيل</a>
                                                @else
                                                <a href="{{route('clientupdate',$client->id)}}" class="btn btn-success">تفعيل</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                        <mark class="pull-right">total:- {{count($clients)}}</mark>
                </div>
                    <!-- /.box-body -->
                    <div class="margin text-center">
                        {{$clients->links()}}
                    </div>
            </div>
        </div>
    </div>


@endsection
