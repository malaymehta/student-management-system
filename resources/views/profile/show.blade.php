@extends('layouts.app')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>User Profile</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            @include('flash::message')

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>User Report <small>Activity report</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view" src="{{(Auth::user()->image=='') ? asset('theme/images/default.jpg') : asset('uploads/'.Auth::user()->image)}}" alt="Avatar" title="Change the avatar">
                                    </div>
                                </div>
                                <h3>{{Auth::user()->name}}</h3>

                                <ul class="list-unstyled user_data">
                                    @php $address = Auth::user()->country.", ".Auth::user()->state.", ".Auth::user()->city; @endphp
                                    <li><i class="fa fa-map-marker user-profile-icon"></i> {{(!empty(Auth::user()->country)) ? $address : 'NA'}}
                                    </li>

                                    <li>
                                        <i class="fa fa-briefcase user-profile-icon"></i> Software Engineer
                                    </li>

                                    <li class="m-top-xs">
                                        <i class="fa fa-external-link user-profile-icon"></i>
                                        <a href="#" target="_blank">{{Auth::user()->email}}</a>
                                    </li>
                                </ul>

                                <a href="{{route('profile.edit', ['id'=>Auth::user()->id])}}" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                                <br />

                                <!-- start skills -->
                                <h4>Skills</h4>
                                <ul class="list-unstyled user_data">
                                    <li>
                                        <p>Web Applications</p>
                                        <div class="progress progress_sm">
                                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <p>Website Design</p>
                                        <div class="progress progress_sm">
                                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <p>Automation & Testing</p>
                                        <div class="progress progress_sm">
                                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <p>UI / UX</p>
                                        <div class="progress progress_sm">
                                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                        </div>
                                    </li>
                                </ul>
                                <!-- end of skills -->

                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a>
                                        </li>
                                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                                        </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                                            <!-- start recent activity -->
                                            <ul class="messages">
                                                @if(isset($latestActivities))
                                                    @foreach($latestActivities as $activity)
                                                        <li>
                                                            <img src="{{(Auth::user()->image=='') ? asset('theme/images/default.jpg') : asset('uploads/'.Auth::user()->image)}}" class="avatar" alt="Avatar">
                                                            <div class="message_date">
                                                                <h3 class="date text-info">{{date('d', strtotime($activity->updated_at))}}</h3>
                                                                <p class="month">{{date('M', strtotime($activity->updated_at))}}</p>
                                                            </div>
                                                            <div class="message_wrapper">
                                                                <h4 class="heading">{{Auth::user()->name}}</h4>
                                                                <blockquote class="message">{{$activity->text}}</blockquote>
                                                                <br />
                                                               {{-- <p class="url">
                                                                    <span class="fs1 text-info" aria-hidden="true" data-icon="?"></span>
                                                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                                                </p>--}}
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li>
                                                        No Recent Activity
                                                    </li>

                                                @endif

                                            </ul>
                                            <!-- end recent activity -->

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                                            <!-- start user projects -->
                                            <table class="data table table-striped no-margin">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Project Name</th>
                                                    <th>Client Company</th>
                                                    <th class="hidden-phone">Hours Spent</th>
                                                    <th>Contribution</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>New Company Takeover Review</td>
                                                    <td>Deveint Inc</td>
                                                    <td class="hidden-phone">18</td>
                                                    <td class="vertical-align-mid">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>New Partner Contracts Consultanci</td>
                                                    <td>Deveint Inc</td>
                                                    <td class="hidden-phone">13</td>
                                                    <td class="vertical-align-mid">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Partners and Inverstors report</td>
                                                    <td>Deveint Inc</td>
                                                    <td class="hidden-phone">30</td>
                                                    <td class="vertical-align-mid">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>New Company Takeover Review</td>
                                                    <td>Deveint Inc</td>
                                                    <td class="hidden-phone">28</td>
                                                    <td class="vertical-align-mid">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <!-- end user projects -->

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                                            <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                                                photo booth letterpress, commodo enim craft beer mlkshk </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection