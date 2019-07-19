@extends('Admin.admintemplet')
@section('title','Admin Home')
@section('content')
    <div class="container">

        <div class="row">
            @inject('posts','App\Models\Post')
            <div class="margin">
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Posts</span>
                            <span class="info-box-number">{{$posts->count()}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
            @inject('client','App\Models\Client')
            <div class="margin">
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{$client->count()}}</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
            </div>
            @inject('orders','App\Models\Order')
            <div class="margin">
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{$orders->count()}}</h3>

                            <p>Orders</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <a href="{{route('orders')}}" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
