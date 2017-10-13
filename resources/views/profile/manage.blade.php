@extends('layouts.app')

@section('page_title')
    Edit Profile |
@endsection

@section('content')


    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Edit Profile</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">@include('layouts.notification')</div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            {!! Form::open(['route'=> ['profile.update', Auth::user()->id], 'method'=>'put', 'name'=>'my_profile', 'id'=>'my_profile', 'class'=>'form-horizontal form-label-left']) !!}

                            <div class="form-group">
                                {!! Form::label('name', 'Name', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('name', Auth::user()->name, ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'name']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('country', 'Country', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('country', Auth::user()->country, ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'country']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('state', 'State', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('state', Auth::user()->state, ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'state']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('city', 'City', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('city', Auth::user()->city, ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'academic_year_id']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('image', 'Image', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="dynamicImagesArray dropzone" id="dropzoneFileUpload">
                                        {!! Form::hidden('images', (Auth::user()->image!='') ? 1 :'', ['id'=>'images']) !!}
                                        @if(Auth::user()->image!='')
                                                {!! Form::hidden('image_name[]', Auth::user()->image, ['class'=>'image_name', 'id'=>'image_name']) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {!! Form::submit('Update Profile', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{link_to_route('home', $title = 'Dashboard')}}/{{link_to_route('profile.index', $title = 'Profile')}}/Edit Profile</div>

                    @include('layouts.notification')

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                {!! Form::open(['route'=> ['profile.update', Auth::user()->id], 'method'=>'put', 'name'=>'my_profile', 'id'=>'my_profile']) !!}

                                <div class="form-group">
                                    {!! Form::label('Name') !!}<span style="color:red;">*</span>
                                    {!! Form::text('name', Auth::user()->name, ['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('Country') !!}<span style="color:red;">*</span>
                                    {!! Form::text('country', Auth::user()->country, ['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('State') !!}<span style="color:red;">*</span>
                                    {!! Form::text('state', Auth::user()->state, ['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('City') !!}<span style="color:red;">*</span>
                                    {!! Form::text('city', Auth::user()->city, ['class'=>'form-control']) !!}
                                </div>


                               --}}{{-- {!! Form::hidden('id', Auth::user()->id  !!}--}}{{--

                                {!! Form::submit('Update Profile', ['class'=>'btn btn-default']) !!}

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}

@endsection

@section('custom_js')

    <script>
        var routeUrl = '{{route('ajax_profileImageUpload')}}';
        var token = $('input[name="_token"]').val();
        var imageEdit = $("#images").val();
        var imageStoragePath = '{{URL::to("/uploads")}}';
        var routeImgDelete = '{{route('ajax_profileImageDelete')}}';
        var entityID = '{{Auth::user()->id}}';
        var allowNoFiles = 1;
    </script>

    <script type="text/javascript" src="{{asset('js/custom/profile.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/custom/dropzone_init.js')}}"></script>

@endsection
