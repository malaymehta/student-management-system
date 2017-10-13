@extends('layouts.app')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Delete Year</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />

                            {!! Form::open(['route'=>['academic-year.destroy',$year->id ], 'method'=>'delete', 'onsubmit' => 'return confirm("are you sure ?")', 'class'=>'form-horizontal form-label-left']) !!}

                            <div class="form-group">
                                {!! Form::label('name', 'Name:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('name', $year->name, ['class'=>'control-label col-md-2 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('start_date', 'Start Date:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('start_date', date('d-m-y', strtotime($year->start_date)), ['class'=>'control-label col-md-2 col-xs-4']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('end_date', 'End Date:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('end_date', date('d-m-y', strtotime($year->end_date)), ['class'=>'control-label col-md-2 col-xs-4']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('status', ($year->status==1) ? 'Active' : 'Inactive', ['class'=>'control-label col-md-2 col-xs-4']) !!}
                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {!! Form::submit('Delete Year', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
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