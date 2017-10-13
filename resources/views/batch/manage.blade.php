@extends('layouts.app')

@section('page_title')
    {{isset($class)?'Update Batch' : 'Add Batch'}} |
@endsection

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{isset($class)?'Update Batch' : 'Add Batch'}}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">@include('layouts.notification')</div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            @if(isset($batch))
                                {!! Form::open(['route'=> ['batches.update', $batch->id], 'method'=>'put', 'name'=>'my_batch', 'id'=>'my_batch', 'class'=>'form-horizontal form-label-left']) !!}
                            @else
                                {!! Form::open(['route'=>['batches.store'], 'name'=>'my_batch', 'id'=>'my_batch', 'class'=>'form-horizontal form-label-left']) !!}
                            @endif

                            <div class="form-group">
                                {!! Form::label('name', 'Name', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('name', isset($batch)? $batch->name : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'name']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('alias', 'Alias', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('alias',isset($batch)? $batch->alias : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'alias']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('start_date', 'Start Date', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('start_date', isset($batch)? date('d-m-Y', strtotime($batch->start_date)) : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'start_date']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('end_date', 'End Date', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('end_date', isset($batch)? date('d-m-Y', strtotime($batch->end_date)) : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'end_date']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('academic_year_id', 'Academic Year', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('academic_year_id', $academicYear, isset($batch)? $batchAcademicYear : '', ['placeholder' => 'Pick a year...', 'class'=>'form-control col-md-7 col-xs-12', 'id'=>'academic_year_id']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('course_id', 'Course', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('course_id', $course, isset($batch)? $batchCourse : '', ['placeholder' => 'Pick a course...', 'class'=>'form-control col-md-7 col-xs-12', 'id'=>'course_id']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('status', [0=>'Inactive', 1=>'Active'], isset($batch) ? $batch->status : 1, ['placeholder' => 'Pick a status...', 'class'=>'form-control col-md-7 col-xs-12', 'id'=>'status']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('image', 'Image', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="dynamicImagesArray dropzone" id="dropzoneFileUpload">
                                            {!! Form::hidden('images', (isset($images)) ? 1 :'', ['id'=>'images']) !!}
                                            @if(isset($images))
                                                @php $cnt=0; @endphp
                                                @foreach($images as $key=>$val)
                                                    @php $cnt++; @endphp
                                                    {!! Form::hidden('image_name[]', $val, ['class'=>'image_name', 'id'=>'image_name_'.$cnt]) !!}
                                                    {!! Form::hidden('image_id[]', $key, ['class'=>'image_id', 'id'=>'image_id_'.$cnt]) !!}
                                                @endforeach
                                            @endif
                                    </div>
                                </div>
                            </div>

                            {!! Form::hidden('id', isset($batch) ? $batch->id : '') !!}


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {!! Form::submit(isset($batch) ? 'Update Batch': 'Add Batch', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
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
    <script>
        var routeUrl = '{{route('ajax_batchImageUpload')}}';
        var token = $('input[name="_token"]').val();
        var imageEdit = $("#images").val();
        var imageStoragePath = '{{URL::to("/uploads")}}';
        var routeImgDelete = '{{route('ajax_batchImageDelete')}}';
        var entityID = '{{isset($batch) ? $batch->id : ''}}';
        var allowNoFiles = 3;
    </script>

    <script type="text/javascript" src="{{asset('js/custom/batch.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/custom/dropzone_init.js')}}"></script>
    <script>
        $(document).ready(function(){
            Batch.manage();
        });
    </script>
@endsection
