@extends('layouts.app')

@section('page_title')
    {{isset($section)?'Update Section' : 'Add Section'}} |
@endsection


@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{isset($section)?'Update Section' : 'Add Section'}}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">@include('layouts.notification')</div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            @if(isset($section))
                                {!! Form::open(['route'=> ['sections.update', $section->id], 'method'=>'put', 'name'=>'my_section', 'id'=>'my_section', 'class'=>'form-horizontal form-label-left']) !!}
                            @else
                                {!! Form::open(['route'=>['sections.store'], 'name'=>'my_section', 'id'=>'my_section', 'class'=>'form-horizontal form-label-left']) !!}
                            @endif

                            <div class="form-group">
                                {!! Form::label('name', 'Name', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('name', isset($section)? $section->name : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'name']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('academic_year_id', 'Academic Year', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('academic_year_id', $academicYear, isset($section)? $sectionAcademicYear : '', ['placeholder' => 'Pick a year...', 'class'=>'form-control col-md-7 col-xs-12', 'id'=>'academic_year_id']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('batch_id', 'Batch', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('batch_id', $batch, isset($section)? $sectionBatch : '', ['placeholder' => 'Pick a batch...', 'class'=>'form-control col-md-7 col-xs-12', 'id'=>'batch_id']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('status', [0=>'Inactive', 1=>'Active'], isset($section) ? $section->status : 1, ['placeholder' => 'Pick a status...', 'class'=>'form-control col-md-7 col-xs-12', 'id'=>'status']) !!}
                                </div>
                            </div>

                            {!! Form::hidden('id', isset($section) ? $section->id : '') !!}


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {!! Form::submit(isset($section) ? 'Update Section': 'Add Section', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
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
    <script type="text/javascript" src="{{asset('js/custom/section.js')}}"></script>
    <script>
        var routeUrl = '{{route('ajax_sectionsBatch')}}';
        $(document).ready(function () {
            Section.manage(routeUrl);
        });
    </script>
@endsection
