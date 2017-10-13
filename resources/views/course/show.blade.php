@extends('layouts.app')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Delete Course</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />

                            {!! Form::open(['route'=>['courses.destroy',$course->id ], 'method'=>'delete', 'onsubmit' => 'return confirm("are you sure ?")', 'class'=>'form-horizontal form-label-left']) !!}

                            <div class="form-group">
                                {!! Form::label('name', 'Name:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('name', $course->name, ['class'=>'control-label col-md-2 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('alias', 'Alias:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('alias', $course->alias, ['class'=>'control-label col-md-2 col-xs-4']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('code', 'Code:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('code', $course->code, ['class'=>'control-label col-md-2 col-xs-4']) !!}
                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {!! Form::submit('Delete Course', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
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