@extends('layouts.app')

@section('page_title')
    {{isset($subject)?'Update Subject' : 'Add Subject'}} |
@endsection

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{isset($subject)?'Update Subject' : 'Add Subject'}}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">@include('layouts.notification')</div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            @if(isset($subject))
                                {!! Form::open(['route'=> ['subjects.update', $subject->id], 'method'=>'put', 'name'=>'my_subject', 'id'=>'my_subject', 'class'=>'form-horizontal form-label-left']) !!}
                            @else
                                {!! Form::open(['route'=>['subjects.store'], 'name'=>'my_subject', 'id'=>'my_subject', 'class'=>'form-horizontal form-label-left']) !!}
                            @endif

                            <div class="form-group">
                                {!! Form::label('name', 'Name', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('name', isset($subject)? $subject->name : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'name']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('alias', 'Alias', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('alias',isset($subject)? $subject->alias : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'alias']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('code', 'Code', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('code', isset($subject)? $subject->code : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'code']) !!}
                                </div>
                            </div>

                            {!! Form::hidden('id', isset($subject) ? $subject->id : '') !!}


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {!! Form::submit(isset($subject) ? 'Update Subject': 'Add Subject', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
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
    <script type="text/javascript" src="{{asset('js/custom/subject.js')}}"></script>
    <script>
        $(document).ready(function () {
            Subject.manage();
        });
    </script>
@endsection
