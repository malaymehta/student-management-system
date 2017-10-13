<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a href="{{route('home')}}" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
            @if(checkPermission(['Super Admin', 'Admin']))
                <li><a><i class="fa fa-graduation-cap"></i> Course Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route('academic-year.index')}}"><i class="fa fa-calendar"></i> Academic Year</a></li>
                        <li><a href="{{route('courses.index')}}"><i class="fa fa-graduation-cap"></i> Course</a></li>
                        {{--<li><a href="javascript:void(0);"><i class="fa fa-info-circle"></i> Year Wise Course</a></li>--}}
                        <li><a href="{{route('subjects.index')}}"><i class="fa fa-book"></i> Subject</a></li>
                        <li><a href="{{route('batches.index')}}"><i class="fa fa-sitemap"></i> Batches</a></li>
                        <li><a href="{{route('sections.index')}}"><i class="fa fa-share-alt"></i> Section</a></li>
                    </ul>
                </li>
            @endif
            <li>
                <a href="javascript:void(0);"><i class="fa fa-users"></i> Student<span
                            class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    {{--<li><a href="javascript:void(0);"><i class="fa fa-sort-alpha-asc"></i> Admission Category</a></li>--}}
                    <li><a href="{{route('students.index')}}"><i class="fa fa-reorder"></i> Manage Student</a></li>
                </ul>
            </li>
            @if(checkPermission(['Super Admin', 'Admin']))
                <li><a href="javascript:void(0);"><i class="fa fa-user"></i> Emp. Management<span
                                class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('department.index') }}"><i class="fa fa-sitemap"></i> Department</a></li>
                        <li><a href="{{ route('designation.index') }}"><i class="fa fa-signal"></i> Designation</a></li>
                        <li><a href="{{route('employees.index')}}"><i class="fa fa-user-plus"></i> Employees</a></li>
                        <li><a href="{{route('shifts.index')}}"><i class="fa fa-clock-o"></i> Shifts</a></li>
                        <li><a href="{{route('shift-allocations.index')}}"><i class="fa fa-plus-square"></i> Shift Allocation</a></li>
                        {{--<li><a href="javascript:void(0);"><i class="fa fa-user"></i> Employee Setting</a></li>--}}
                    </ul>
                </li>
            @endif

            <li><a href="javascript:void(0);"><i class="fa fa-list"></i> Online Test<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('question-category.index') }}"><i class="fa fa-link"></i> Question Category</a></li>
                    <li><a href="#"><i class="fa fa-question-circle"></i> Question</a></li>
                    <li><a href="#"><i class="fa fa-sort-alpha-asc"></i> Grading System</a></li>
                    <li><a href="#"><i class="fa fa-list-alt"></i> Online Test</a></li>
                    <li><a href="#"><i class="fa fa-file-text"></i> View Result</a></li>
                </ul>
            </li>

        </ul>
    </div>
</div>