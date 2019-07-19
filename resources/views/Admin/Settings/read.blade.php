@extends('Admin.admintemplet')
@section('title','settings')
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
                    <h3 class="box-title">settings</h3>

{{--                    <a href="{{route('settings.create')}}" class="pull-right btn btn-success">ADD NEW</a>--}}

                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding table-responsive">
                    <table class="table table-condensed text-center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>phone</th>
                            <th>email</th>
                            <th>about_app</th>
                            <th>fb_link</th>
                            <th>tw_link</th>
                            <th>tub_link</th>
                            <th>insta_link</th>
                            <th>whatsapp_link</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($settings->count() > 0)
                            @foreach($settings as $index=>$setting)

                                <tr>
                                    <td>
                                        {{$index+1}}
                                    </td>
                                    <td>
                                        {{$setting->phone}}
                                    </td>
                                    <td>
                                        {{$setting->email}}
                                    </td>
                                    <td>
                                        {{$setting->about_app}}
                                    </td>
                                    <td>
                                        {{$setting->fb_link}}
                                    </td>
                                    <td>
                                        {{$setting->tw_link}}
                                    </td>
                                    <td>
                                        {{$setting->tub_link}}
                                    </td>
                                    <td>
                                        {{$setting->insta_link}}
                                    </td>
                                    <td>
                                        {{$setting->whatsapp_link}}
                                    </td>
                                    <td>
                                        <a href="{{route('settings.edit',$setting->id)}}"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>

@endsection
