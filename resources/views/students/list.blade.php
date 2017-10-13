@extends('layouts.app')

@section('page_title')
    Students |
@endsection


@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Student Listing</h3>
                </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">@include('flash::message')</div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">

                            <table id="student_table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <td colspan="5" align="right"><a href="{{route('students.create')}}" class="btn btn-default"><i class="fa fa-plus-square"></i>  Add Student</a></td>
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Batch</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                            </table>

                         </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('custom_js')

    <script type="text/javascript" src="{{asset('js/custom/student.js')}}"></script>
    <script>
        var ajaxListRoute = '{!! route('ajax_students') !!}';
        $(document).ready(function () {
            Student.list(ajaxListRoute);
        });
    </script>
    

@endsection