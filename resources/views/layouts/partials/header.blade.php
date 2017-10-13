<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page_title'){{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('theme/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('theme/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('theme/css/animate.min.css') }}" rel="stylesheet">
    <!-- Datepicker -->
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <!-- Timepicker -->
    <link href="{{ asset('css/jquery.timepicker.min.css') }}" rel="stylesheet">
    <!-- Dropzone CSS -->
    <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('theme/css/custom.min.css')}}" rel="stylesheet">


    <style>
        .required:after{
            content:'*';
            color:red;
            padding-left:5px;
        }

        input.error, select.error, textarea.error {
            background: #FAEDEC;
            border: 1px solid #E85445;
        }

        label.error{
            color: red;!important;
        }

    </style>

</head>