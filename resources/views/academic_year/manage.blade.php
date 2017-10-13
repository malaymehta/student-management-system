@extends('layouts.app')

@section('page_title')
    {{isset($year)?'Update Academic Year' : 'Add Academic Year'}} |
@endsection

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    {{--{!! Breadcrumbs::render('AcademicYearStore') !!}--}}<h3>{{isset($year)?'Update Year' : 'Add Year'}}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">@include('layouts.notification')</div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <br />
                                @if(isset($year))
                                    {!! Form::open(['route'=> ['academic-year.update', $year->id], 'method'=>'put', 'name'=>'my_year', 'id'=>'my_year', 'class'=>'form-horizontal form-label-left']) !!}
                                @else
                                    {!! Form::open(['route'=>['academic-year.store'], 'name'=>'my_year', 'id'=>'my_year', 'data-parsley-validate', 'class'=>'form-horizontal form-label-left']) !!}
                                @endif

                                    <div class="form-group">
                                        {!! Form::label('name', 'Name', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::text('name', isset($year)? $year->name : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'name']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('start_date', 'Start Date', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::text('start_date', isset($year)? date('d-m-Y', strtotime($year->start_date)) : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'start_date']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('end_date', 'End Date', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::text('end_date', isset($year)? date('d-m-Y', strtotime($year->end_date)) : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'end_date']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('status', 'Status', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            {!! Form::select('status', [0=>'Inactive', 1=>'Active'], isset($year) ? $year->status : 1, ['class'=>'form-control col-md-7 col-xs-12', 'placeholder' => 'Pick a status...']) !!}
                                        </div>
                                    </div>

                                    {!! Form::hidden('id', isset($year) ? $year->id : '') !!}


                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            {!! Form::submit(isset($year) ? 'Update Year': 'Add Year', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
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
    <script type="text/javascript" src="{{asset('js/custom/academic_year.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            AcademicYear.manage();
        });
    </script>
@endsection
