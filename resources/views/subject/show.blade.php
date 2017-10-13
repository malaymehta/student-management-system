@extends('layouts.app')

@section('content')

    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{link_to_route('home', $title = "Dashboard")}}/{{link_to_route('subjects.index', $title = "Subject Listing")}}/Delete Subject</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">

                                {!! Form::open(['route'=>['subjects.destroy',$subject->id ], 'method'=>'delete', 'onsubmit' => 'return confirm("are you sure ?")']) !!}

                                <div class="form-group">
                                    {!! Form::label('Name:') !!}
                                    {!! Form::label($subject->name) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('Alias:') !!}
                                    {!! Form::label($subject->alias) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('Code:') !!}
                                    {!! Form::label($subject->code) !!}
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