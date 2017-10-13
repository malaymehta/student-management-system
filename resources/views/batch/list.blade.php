@extends('layouts.app')

@section('page_title')
    Batches |
@endsection


@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Batch Listing</h3>
                </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">@include('flash::message')</div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">

                            <table id="batch_table" class="table table-striped table-bordered">
                                <thead>
                                    <tr  role="row">
                                        <td colspan="6" align="right"><a href="{{route('batches.create')}}" class="btn btn-default"><i class="fa fa-plus-square"></i>  Add Batch</a></td>
                                    </tr>
                                    <tr  role="row">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Alias</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <td>Action</td>
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

    <script type="text/javascript" src="{{asset('js/custom/batch.js')}}"></script>
    <script type="text/javascript">
        var ajaxListRoute = '{!! route('ajax_batches') !!}';
        $(document).ready(function () {
            Batch.list(ajaxListRoute);
        });
    </script>

@endsection
