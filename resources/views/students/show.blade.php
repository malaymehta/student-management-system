@extends('layouts.app')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Delete Student</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />

                            {!! Form::open(['route'=>['students.destroy',$record->id ], 'method'=>'delete', 'onsubmit' => 'return confirm("are you sure ?")', 'class'=>'form-horizontal form-label-left']) !!}

                            <div class="form-group">
                                {!! Form::label('name', 'Name:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('name', $record->name, ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('academic_year', 'Academic Year:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('academic_year',$academicYear[0], ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('course', 'Course:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('course',$record->course->name, ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('batch', 'Batch:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('batch',$batch[0], ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('section', 'Section:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('section',$section[0], ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('images', 'Images:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @if(isset($images))
                                        @foreach($images as $img)
                                            {{ Form::image('uploads/'.$img, 'images', ['style' =>'width: 80px', 'class'=>'control-label col-md-4 col-xs-4']) }}
                                        @endforeach
                                    @else
                                        {!!  Form::label('images', '-', ['class'=>'control-label col-md-4 col-xs-4'])  !!}
                                    @endif
                                </div>
                            </div>



                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {!! Form::submit('Delete Student', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
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
                    <div class="panel-heading"><a href="{{route('home')}}">Dashboard</a>/<a href="{{route('students.index')}}">Student Listing</a>/Delete Student</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                {!! Form::open(['route'=>['students.destroy',$record->id ], 'method'=>'delete', 'onsubmit' => 'return confirm("are you sure ?")']) !!}

                                <div class="form-group">
                                    <label>Name:</label>
                                    {!! Form::label( $record->name) !!}
                                </div>

                                <div class="form-group">
                                    <label>Course:</label>
                                    {!! Form::label($record->course)!!}
                                </div>

                                <div class="form-group">
                                    <label>Class:</label>
                                    {!! Form::label($record->batches->class_name)!!}
                                </div>

                                <div class="form-group">
                                    <label>Quality:</label>
                                    {!! Form::label(implode(',', $record->qualities->pluck('quality')->all()))!!}
                                </div>

                                <div class="form-group">
                                    <label>Profile:</label>

                                    @if(isset($images))
                                        @foreach($images as $img)
                                            {{ Form::image('uploads/'.$img, 'btnSub', ['style' =>'width: 39px']) }}
                                        @endforeach
                                    @else
                                        {!!  Form::label('-')  !!}
                                    @endif
                                </div>

                                {!! Form::submit('Delete record') !!}

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}

@endsection