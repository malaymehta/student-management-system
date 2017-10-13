@extends('layouts.app')

@section('content')


    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Delete Batch</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />

                            {!! Form::open(['route'=>['batches.destroy',$batch->id ], 'method'=>'delete', 'onsubmit' => 'return confirm("are you sure ?")', 'class'=>'form-horizontal form-label-left']) !!}

                            <div class="form-group">
                                {!! Form::label('name', 'Name:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('name', $batch->name, ['class'=>'control-label col-md-2 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('alias', 'Alias:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('alias', $batch->alias, ['class'=>'control-label col-md-2 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('start_date', 'Start Date:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('start_date', date('d-m-y', strtotime($batch->start_date)), ['class'=>'control-label col-md-2 col-xs-4']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('end_date', 'End Date:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('end_date', date('d-m-y', strtotime($batch->end_date)), ['class'=>'control-label col-md-2 col-xs-4']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('academic_year', 'Academic Year:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('academic_year', $academicYear[0], ['class'=>'control-label col-md-2 col-xs-4']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('course', 'Course:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('course',$course[0], ['class'=>'control-label col-md-2 col-xs-4']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('images', 'Images:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @if(isset($images))
                                        @foreach($images as $img)
                                            {{ Form::image('uploads/'.$img, 'images',  ['style' =>'width: 39px', 'class'=>'control-label col-md-2 col-xs-4']) }}
                                        @endforeach
                                    @else
                                        {!!  Form::label('images', '-', ['class'=>'control-label col-md-2 col-xs-4']) !!}
                                    @endif
                                </div>
                            </div>



                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {!! Form::submit('Delete Batch', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
                                </div>
                            </div>

                            <br><br>

                            <table border=1 class="table table-striped table-bordered">
                                <tr>
                                    <td>Student Name</td>
                                    <td>Course</td>
                                </tr>
                                @foreach($batch->students as $stud)
                                    <tr>
                                        <td>{{$stud->name}}</td>
                                        <td>{{$stud->course}}</td>
                                    </tr>
                                @endforeach
                            </table>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection