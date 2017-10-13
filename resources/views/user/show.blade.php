@extends('layouts.app')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Delete Employee</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />

                            {!! Form::open(['route'=>['employees.destroy',$employee->id ], 'method'=>'delete', 'onsubmit' => 'return confirm("are you sure ?")', 'class'=>'form-horizontal form-label-left']) !!}

                            <div class="form-group">
                                {!! Form::label('role', 'Role:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('role', $employee->userRole->role_name, ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('name', 'Name:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('name', $employee->title." ".$employee->name, ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('gender', 'Gender:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('gender', gender()[$employee->gender], ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'Email:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('email', $employee->email, ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('mob', 'Mobile:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('mob', $employee->mob_no, ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('dob', 'Date of Birth:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('dob', (isset($employee->dob)) ?date('d-m-y', strtotime($employee->dob)):"NA", ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('doj', 'Date of Joining:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('doj', (isset($employee->doj)) ? date('d-m-y', strtotime($employee->doj)) : "NA", ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('exp', 'Total Exp:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('exp', expYears()[(isset($employee->total_exp_year)) ? $employee->total_exp_year:0]." Year(s) ".expMonths()[(isset($employee->total_exp_month)) ? $employee->total_exp_month:0]." Month(s)", ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>


                            <div class="form-group">
                                {!! Form::label('department', 'Department:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('department', $employee->department->name, ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('designation', 'Designation:', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12'] ) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::label('designation', $employee->designation->name, ['class'=>'control-label col-md-4 col-xs-4']) !!}
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {!! Form::submit('Delete Employee', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
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