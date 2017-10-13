@extends('layouts.app')

@section('page_title')
    {{isset($department)?'Update Department' : 'Add Department'}} |
@endsection

@section('content')
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">{{link_to_route('home', $title = "Dashboard")}}
                        / {{link_to_route('department.index', $title = "Department Listing")}}
                        / {{!empty($department) ? 'Update' : 'Add'}}</div>
                    <div class="panel-body">
                        @include('layouts.notification')
                        @if(!empty($department) && count($department))
                            {{ Form::model($department, array('route' => array('department.update', $department->id), 'method' => 'PUT',
                            'class' => 'smart-form', 'id' => 'department-form')) }}
                        @else
                            {{ Form::open(array('route' => 'department.store', 'class' => 'smart-form', 'id' => 'department-form')) }}
                        @endif
                        @include('department.form')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="text/javascript" src="{{ asset('js/custom/department.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            Department.manage();
        });
    </script>
@endsection