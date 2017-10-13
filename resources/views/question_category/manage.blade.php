@extends('layouts.app')

@section('page_title')
    {{isset($questionCat)?'Update Question Category' : 'Add Question Category'}} |
@endsection

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>{{isset($questionCat)?'Update Question Category' : 'Add Question Category'}}</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">@include('layouts.notification')</div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            @if(isset($questionCat))
                                {!! Form::open(['route'=> ['question-category.update', $questionCat->id], 'method'=>'put', 'name'=>'my_category', 'id'=>'my_category', 'class'=>'form-horizontal form-label-left']) !!}
                            @else
                                {!! Form::open(['route'=>['question-category.store'], 'name'=>'my_category', 'id'=>'my_category', 'class'=>'form-horizontal form-label-left']) !!}
                            @endif

                            <div class="form-group">
                                {!! Form::label('name', 'Name', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('name', isset($questionCat)? $questionCat->name : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'name']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('alias', 'Alias', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('course_id', $course, isset($questionCat)? $questionCat->course->id : '', ['placeholder' => 'Pick a course...', 'class'=>'form-control col-md-7 col-xs-12', 'id'=>'course_id']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Description', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12 required']) !!}
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::textarea('description', isset($questionCat)? $questionCat->description : '', ['class'=>'form-control col-md-7 col-xs-12', 'id'=>'description']) !!}
                                </div>
                            </div>

                            {!! Form::hidden('id', isset($questionCat) ? $questionCat->id : '') !!}


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    {!! Form::submit(isset($questionCat) ? 'Update Question Category': 'Add Question Category', ['class'=>'btn btn-primary', 'style'=>'float:right;']) !!}
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
    <script type="text/javascript" src="{{asset('js/custom/question_category.js')}}"></script>
    <script>
        $(document).ready(function () {
            QuestionCategory.manage();
        });
    </script>
@endsection
