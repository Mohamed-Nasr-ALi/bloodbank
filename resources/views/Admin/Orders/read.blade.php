@extends('Admin.admintemplet')
@section('title','orders')
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
                    <h3 class="box-title">orders</h3>

                    <form action="{{ route('orders') }}" method="get">

                        <div class="row">
                            <div class="col-md-4">
                                <select name="city_id" class="form-control">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="keyword" class="form-control" placeholder="search By Patient name OR phone Body IN city you choice" value="{{ request()->keyword }}">
                                <mark>search in all whatever the city is:- </mark><input type="checkbox"  name="action" value="all">
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
                    <table class="table table-condensed text-center table-responsive">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>patient name</th>
                            <th>patient age</th>
                            <th>blood type</th>
                            <th>quantity</th>
                            <th>hospital name</th>
                            <th>city</th>
                            <th>hospital Address</th>
                            <th>phone</th>
                            <th>client made order</th>
                            <th>created at</th>
                            <th>notes</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($orders->count() > 0)
                            @foreach($orders as $index=>$order)

                                <tr>
                                    <td>
                                        {{$index+1}}
                                    </td>
                                    <td>
                                        {{$order->patient_name}}
                                    </td>
                                    <td>
                                        {{$order->patient_age}}
                                    </td>
                                    <td>
                                        @foreach($bloodtypes as $bloodtype)
                                        @if($order->blood_type_id == $bloodtype->id)
                                            {{$bloodtype->name}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        {{$order->quantity}}
                                    </td>
                                    <td>
                                        {{$order->hospital_name}}
                                    </td>
                                    <td>
                                        {{$order->city->name}}
                                    </td>
                                    <td>
                                        {{$order->hospital_address}}
                                    </td>
                                    <td>
                                        {{$order->phone}}
                                    </td>
                                    <td>
                                        {{$order->client->name}}
                                    </td>
                                    <td>
                                        {{$order->created_at}}
                                    </td>
                                    <td>
                                        {{$order->notes}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <mark class="pull-right">total:- {{count($orders)}}</mark>
                </div>
                <!-- /.box-body -->
                <div class="margin text-center">
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>


@endsection
