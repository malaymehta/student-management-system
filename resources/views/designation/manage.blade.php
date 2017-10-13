@extends('layouts.app')

@section('page_title')
    {{isset($designation)?'Update Designation' : 'Add Designation'}} |
@endsection

@section('content')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">{{link_to_route('home', $title = "Dashboard")}}
                        / {{link_to_route('designation.index', $title = "Designation Listing")}}
                        / {{!empty($designation) ? 'Update' : 'Add'}}</div>
                    <div class="panel-body">
                        @include('layouts.notification')
                        @if(!empty($designation) && count($designation))
                            {{ Form::model($designation, array('route' => array('designation.update', $designation->id), 'method' => 'PUT',
                            'class' => 'smart-form', 'id' => 'designation-form')) }}
                        @else
                            {{ Form::open(array('route' => 'designation.store', 'class' => 'smart-form', 'id' => 'designation-form')) }}
                        @endif
                        @include('designation.form')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="text/javascript" src="{{ asset('js/custom/designation.js') }}"></script>
    <script>
        $(document).ready(function () {
            Designation.manage();
        });
    </script>
@endsection