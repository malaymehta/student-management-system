@extends('layouts.app')

@section('page_title')
    {{isset($course)?'Update Course' : 'Add Course'}} |
@endsection

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{isset($course)?'Update Course' : 'Add Course'}}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">@include('layouts.notification')</div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            @if(isset($course))
                                {!! Form::open(['route'=> ['courses.update', $course->id], 'method'=>'put', 'name'=>'my_course', 'id'=>'my_course', 'class'=>'form-horizontal form-label-left']) !!}
                            @else
                                {!! Form::open(['route'=>['courses.store'], 'name'=>'my_course', 'id'=>'my_course', 'class'=>'form-horizontal form-label-left']) !!}
                            @endif

                            <div class="form-group">
                                {!! Form::label('name', 'Name', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('name',isset($course)? $course->name : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'name']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('alias', 'Alias', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('alias', isset($course)? $course->alias : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'alias']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('code', 'Code', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('code', isset($course)? $course->code : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'code']) !!}
                                </div>
                            </div>

                            {!! Form::hidden('id', isset($course) ? $course->id : '') !!}


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {!! Form::submit(isset($course) ? 'Update Course': 'Add Course', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('custom_js')
    <script type="text/javascript" src="{{asset('js/custom/course.js')}}"></script>
    <script>
        $(document).ready(function(){
            Course.manage();
        });
    </script>
@endsection
