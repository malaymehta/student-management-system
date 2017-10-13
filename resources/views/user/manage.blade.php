@extends('layouts.app')

@section('page_title')
    {{isset($employee)?'Update Employee' : 'Add Employee'}} |
@endsection

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{isset($employee)?'Update Employee' : 'Add Employee'}}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">@include('layouts.notification')</div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            @if(isset($employee))
                                {!! Form::open(['route'=> ['employees.update', $employee->id], 'method'=>'put', 'name'=>'my_employee', 'id'=>'my_employee', 'class'=>'form-horizontal form-label-left']) !!}
                            @else
                                {!! Form::open(['route'=>['employees.store'], 'name'=>'my_employee', 'id'=>'my_employee', 'class'=>'form-horizontal form-label-left']) !!}
                            @endif

                            <div class="form-group">
                                {!! Form::label('role_id', 'Role', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('role_id', $userRoles, isset($employee)? $employee->role_id : '', ['placeholder' => 'Pick a role...', 'class'=>'form-control col-md-7 col-xs-12', 'id'=>'role_id']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('title', 'Title', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('title', title(), isset($employee)? $employee->title : '', ['placeholder' => 'Pick a title...', 'class'=>'form-control col-md-7 col-xs-12', 'id'=>'title']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('name', 'Name', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('name', isset($employee)? $employee->name : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'name']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Email', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('email',isset($employee)? $employee->email : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'email']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('mob_no', 'Mobile Number', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('mob_no', isset($employee)? $employee->mob_no : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'mob_no']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('gender', 'Gender', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('gender', gender(), isset($employee)? $employee->gender : '', ['placeholder' => 'Pick a gender...', 'class'=>'form-control col-md-7 col-xs-12', 'id'=>'gender']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('dob', 'Date of Birth', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('dob', (isset($employee) && isset($employee->dob)) ? date('d-m-Y', strtotime($employee->dob)) : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'dob']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('doj', 'Date of Joining', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('doj', (isset($employee) && isset($employee->doj))? \Carbon\Carbon::parse($employee->doj)->format('d-m-Y') : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'doj']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('total_exp_year', 'Total Experience', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    {!! Form::select('total_exp_year', expYears(), isset($employee)? $employee->total_exp_year : '', ['placeholder' => 'Year', 'class'=>'form-control col-md-3 col-xs-12', 'id'=>'total_exp_year']) !!}
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    {!! Form::select('total_exp_month', expMonths(), isset($employee)? $employee->total_exp_month : '', ['placeholder' => 'Month', 'class'=>'form-control col-md-3 col-xs-12', 'id'=>'total_exp_month']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('department_id', 'Department', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('department_id', $departments, isset($employee)? $employee->department_id : '', ['placeholder' => 'Pick a department...', 'class'=>'form-control col-md-7 col-xs-12', 'id'=>'department_id']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('designation_id', 'Designation', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('designation_id', $designations, isset($employee)? $employee->designation_id : '', ['placeholder' => 'Pick a designation...', 'class'=>'form-control col-md-7 col-xs-12', 'id'=>'designation_id']) !!}
                                </div>
                            </div>

                            @if(!isset($employee))
                                <div class="form-group">
                                    {!! Form::label('password', 'Password', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::password('password', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'password']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('con_password', 'Confirm Password', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        {!! Form::password('con_password', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'con_password']) !!}
                                    </div>
                                </div>
                            @endif


                            {!! Form::hidden('id', isset($employee) ? $employee->id : '') !!}


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {!! Form::submit(isset($employee) ? 'Update Employee': 'Add Employee', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
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
    <script type="text/javascript" src="{{asset('js/custom/employee.js')}}"></script>
    <script>
        $(document).ready(function () {
            Employee.manage();
        });
    </script>
@endsection
