@extends('layouts.app')

@section('page_title')
    {{isset($student)?'Update Student' : 'Add Student'}} |
@endsection

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{isset($student)?'Update Student' : 'Add Student'}}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">@include('layouts.notification')</div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            @if(isset($student))
                                {!! Form::open(['route'=> ['students.update', $student->id], 'method'=>'put', 'files'=>true, 'enctype' => 'multipart/form-data', 'name'=>'student-form', 'id'=>'student-form', 'class'=>'form-horizontal form-label-left']) !!}
                            @else
                                {!! Form::open(['route'=>['students.store'], 'files'=>true, 'enctype' => 'multipart/form-data', 'name'=>'student-form', 'id'=>'student-form', 'class'=>'form-horizontal form-label-left']) !!}
                            @endif

                            <div class="form-group">
                                {!! Form::label('name', 'Name', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('name', isset($student)? $student->name : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'name']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Email', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('email', isset($student)? $student->email : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'email']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('gr_no', 'GR No', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('gr_no', isset($student)? $student->gr_no : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'gr_no']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('academic_year_id', 'Academic Year', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('academic_year_id', $academicYears, isset($student)? $student->academic_year_id : '', ['placeholder'=> 'Pick a year...','class'=>'form-control col-md-7 col-xs-12', 'id'=>'academic_year_id']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('course', 'Course', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('course_id', $courses, isset($student)? $student->course_id : '', ['placeholder'=> 'Pick a course...','class'=>'form-control col-md-7 col-xs-12', 'id'=>'course_id']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('batch_id', 'Batch', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('batch_id', $batches, isset($student)? $student->batch_id:'', ['placeholder' => 'Pick a batch...', 'class'=>'form-control col-md-7 col-xs-12', 'id'=>'batch_id']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('section_id', 'Section', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('section_id', $sections, isset($student)? $student->section_id:'', ['placeholder' => 'Pick a section...', 'class'=>'form-control col-md-7 col-xs-12', 'id'=>'section_id']) !!}
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

                            {!! Form::hidden('id', isset($student) ? $student->id : '') !!}

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {!! Form::submit(isset($student) ? 'Update Student': 'Add Student', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
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
    <script>
        var routeUrl = '{{route('ajax_studImageUpload')}}';
        var token = $('input[name="_token"]').val();
        var imageEdit = $("#images").val();
        var imageStoragePath = '{{URL::to("/uploads")}}';
        var routeImgDelete = '{{route('ajax_studImageDelete')}}';
        var entityID = '{{isset($student )? $student->id:''}}';
        var routeBatchUrl = '{{route('ajax_yearBatch')}}';
        var routeSectionUrl = '{{route('ajax_batchSection')}}';
        var allowNoFiles = 3;
    </script>

    <script type="text/javascript" src="{{asset('js/custom/student.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/custom/dropzone_init.js')}}"></script>
    <script>
        $(document).ready(function () {
            Student.manage();
        });
    </script>
@endsection

