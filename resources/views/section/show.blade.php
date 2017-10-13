@extends('layouts.app')

@section('content')

    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="{{route('home')}}">Dashboard</a>/<a href="{{route('sections.index')}}">Section Listing</a>/Delete Section</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                {!! Form::open(['route'=>['sections.destroy',$section->id ], 'method'=>'delete', 'onsubmit' => 'return confirm("are you sure ?")']) !!}

                                <div class="form-group">
                                    {!! Form::label('Name:') !!}
                                    {!! Form::label($section->name) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('Academic Year:') !!}
                                    {!! Form::label($academicYear[0]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('Course:') !!}
                                    {!! Form::label($batch[0]) !!}
                                </div>

                                {!! Form::submit('Delete record') !!}

                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection