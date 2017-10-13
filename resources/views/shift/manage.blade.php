@extends('layouts.app')

@section('page_title')
    {{isset($shift)?'Update Shift' : 'Add Shift'}} |
@endsection

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{isset($shift)?'Update Shift' : 'Add Shift'}}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">@include('layouts.notification')</div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            @if(isset($shift))
                                {!! Form::open(['route'=> ['shifts.update', $shift->id], 'method'=>'put', 'name'=>'my_shift', 'id'=>'my_shift', 'class'=>'form-horizontal form-label-left']) !!}
                            @else
                                {!! Form::open(['route'=>['shifts.store'], 'name'=>'my_shift', 'id'=>'my_shift', 'class'=>'form-horizontal form-label-left']) !!}
                            @endif

                            <div class="form-group">
                                {!! Form::label('name', 'Name', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('name', isset($shift)? $shift->name : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'name']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('start_time', 'Start Time', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('start_time',isset($shift)? date('H:i A', strtotime($shift->start_time)) : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'start_time']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('end_time', 'End Time', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('end_time', isset($shift)? date('H:i A', strtotime($shift->end_time)) : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'end_time']) !!}
                                </div>
                            </div>

                            {!! Form::hidden('id', isset($shift) ? $shift->id : '') !!}


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {!! Form::submit(isset($shift) ? 'Update Shift': 'Add Shift', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('custom_js')
    <script type="text/javascript" src="{{asset('js/custom/shift.js')}}"></script>
    <script>
        $(document).ready(function(){
            Shift.manage();
        });
    </script>
@endsection
