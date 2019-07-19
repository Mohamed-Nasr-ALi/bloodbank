@extends('Admin.main')
@section('title','create settings')
@section('content')
    <div class="container">
        @include('alerts.errors')
        <div class="box box-info" style="margin-top: 50px">
            <div class="box-header with-border">
                <h3 class="box-title">Add setting</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('settings.store') }}">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">phone</label>

                        <div class="col-sm-10">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">email</label>

                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="email" placeholder="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="about_app" class="col-sm-2 control-label">about_app</label>

                        <div class="col-sm-10">
                            <input type="text" name="about_app" class="form-control" id="about_app" placeholder="about_app">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fb_link" class="col-sm-2 control-label">fb_link</label>

                        <div class="col-sm-10">
                            <input type="url" name="fb_link" class="form-control" id="fb_link" placeholder="fb_link">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tw_link" class="col-sm-2 control-label">tw_link</label>

                        <div class="col-sm-10">
                            <input type="url" name="tw_link" class="form-control" id="tw_link" placeholder="tw_link">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tub_link" class="col-sm-2 control-label">tub_link</label>

                        <div class="col-sm-10">
                            <input type="url" name="tub_link" class="form-control" id="tub_link" placeholder="tub_link">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="insta_link" class="col-sm-2 control-label">insta_link</label>

                        <div class="col-sm-10">
                            <input type="url" name="insta_link" class="form-control" id="insta_link" placeholder="insta_link">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="whatsapp_link" class="col-sm-2 control-label">whatsapp_link</label>

                        <div class="col-sm-10">
                            <input type="url" name="whatsapp_link" class="form-control" id="whatsapp_link" placeholder="whatsapp_link">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">ADD</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
@endsection
