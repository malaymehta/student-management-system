@extends('layouts.app')\

@section('page_title')
    Assign Shift |
@endsection

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Assign Shift</h3>
                </div>

            </div>

            <div class="clearfix"></div>

            <div class="col-md-12">@include('flash::message')</div>

            <div class="clearfix"></div>

            <div class="x_panel">
                <div class="x_title">
                    <h2>Search Employee</h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <br />

                    {!! Form::open(['route'=>['emp_search'], 'name'=>'my_search', 'id'=>'my_search', 'class'=>'form-inline']) !!}

                        <div class="form-group">
                            {!! Form::label('department', 'Department') !!}
                            {!! Form::select('department', $departments, isset($department) ? $department : '', ['placeholder' => 'Pick a department...', 'class'=>'form-control', 'id'=>'department_id']) !!}
                        </div>
                        &nbsp;&nbsp;&nbsp;
                        <div class="form-group">
                            {!! Form::label('designation', 'Designation') !!}
                            {!! Form::select('designation', $designations, isset($designation) ? $designation : '', ['placeholder' => 'Pick a designation...', 'class'=>'form-control', 'id'=>'designation_id']) !!}
                        </div>
                        &nbsp;&nbsp;&nbsp;
                        <div class="form-group">
                            {!! Form::label('name', 'Emp. Name') !!}
                            {!! Form::text('name', isset($name)? $name : '', ['class'=>'form-control', 'id'=>'name']) !!}
                        </div>
                        &nbsp;&nbsp;&nbsp;
                        {!! Form::button('Reset', ['class'=>'btn btn-yellow', 'id'=>'reset']) !!}
                        &nbsp;&nbsp;&nbsp;
                        {!! Form::submit('Search', ['class'=>'btn btn-primary']) !!}

                        {!! Form::close() !!}

                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="x_panel">

                        {!! Form::open(['route'=>['shift-allocations.store'], 'name'=>'my_allocation', 'id'=>'my_allocation', 'class'=>'form-inline']) !!}
                        <div class="x_title">
                            <h2>Shift And Effective Date</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="form-group">
                                {!! Form::select('shift_id', $shifts, isset($shift) ? $shift : '', ['placeholder' => 'Pick a shift...', 'class'=>'form-control col-md-3']) !!}
                            </div>
                            &nbsp;&nbsp;&nbsp;
                            <div class="form-group">
                                {!! Form::text('effective_date', isset($effective_date)? $effective_date : '', ['placeholder' => 'Select Effective Date', 'class'=>'form-control', 'id'=>'effective_date']) !!}
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <br>

                        <div class="x_title">
                            <h2>Employee Listing</h2>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">

                            <table id="user_table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>{!! Form::checkbox('all', 'all', '', ['class'=>'all', 'id'=>'all']) !!} All</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Shift</th>
                                </tr>
                                </thead>

                            </table>

                         </div>

                        {!! Form::submit('Assign', ['class'=>'btn btn-primary']) !!}

                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('custom_js')

    <script type="text/javascript" src="{{asset('js/custom/shiftAllocation.js')}}"></script>
    <script>
        var ajaxListRoute = '{!! route('ajax_shiftAllocations') !!}';
        $(document).ready(function () {
            ShiftAllocation.list(ajaxListRoute);
            ShiftAllocation.manage();
        });
        ShiftAllocation.clickEvent();

    </script>

@endsection