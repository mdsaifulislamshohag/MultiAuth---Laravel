<header class="main-header">
    <!-- Logo -->
    <a href="/dashboard" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            @if(isset($app->image))
            <img src="{{ asset("images/app/$app->image") }}" alt="Logo" style="width:40px;height: 40px;">
            @else
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:40px;height: 40px;">
            @endif
        </span>
        {{-- <span class="logo-mini"><b>A</b>LT</span> --}}
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            @if(isset($app->image))
            <img src="{{ asset("images/app/$app->image") }}" alt="Logo" style="width:40px;height: 40px;">
            @else
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:40px;height: 40px;">
            @endif
            {{ $app->name }}
        </span>
        
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">@if(count($msgtop) != 0){{ count($msgtop) }}@endif</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have @if(count($msgtop) != 0){{ count($msgtop) }}@else no @endif unread messages</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @php
                                $i = 1;
                                @endphp
                                @foreach($msgtop as $showmsg)
                                <li>
                                    <a href="{{route('admin.message',[$showmsg->id])}}">
                                        <i class="fa fa-envelope"></i>&nbsp;
                                        <span>
                                            {{ str_limit($showmsg->name, $limit = 30, $end = '...') }}
                                            <small>
                                            <i class="pull-right"><i class="fa fa-clock-o"></i>&nbsp;{{ $showmsg->created_at->diffForHumans(null, true) }}</i>
                                            </small>
                                            <br>
                                            <small style="color: #000;">
                                            {{ str_limit($showmsg->subject, $limit = 50, $end = '...') }}
                                            </small>
                                        </span>
                                    </a>
                                </li>
                                @php
                                if($i == 10){
                                break;
                                }
                                $i++;
                                @endphp
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer"><a href="/admin/mailbox">See All Messages</a></li>
                    </ul>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                        page and may cause design problems
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-red"></i> 5 new members joined
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i> You changed your username
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">@if(count($taskcount) != 0){{ count($taskcount) }}@endif</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have @if(count($taskcount) != 0){{ count($taskcount) }}@else no @endif incomplete task</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @php
                                $i = 1;
                                @endphp
                                @foreach($tasktop as $task)
                                <!-- end task item -->
                                <li><!-- Task item -->
                                <a href="#">
                                    <h3>
                                        @if($task->status != 0)
                                        <i class="fa fa-check"></i>&nbsp;
                                        {{ str_limit($task->task, $limit = 30, $end = '...') }}
                                        @else
                                        <i class="fa fa-square"></i>&nbsp;
                                        {{ str_limit($task->task, $limit = 30, $end = '...') }}
                                        @endif

                                    </h3>
                                </a>
                            </li>
                            <!-- end task item -->
                            @php
                            if($i == 10){
                            break;
                            }
                            $i++;
                            @endphp
                            @endforeach
                        
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="#">View all tasks</a>
                    </li>
                </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    @if(isset(auth('admin')->user()->image))
                    <img src="/images/admin/{{ auth('admin')->user()->image }}" class="user-image" alt="User Image" style="max-width: 30px!important;">
                    @else
                    <img src="/images/profile.jpg" class="user-image" alt="User Image" style="max-width: 30px!important;">
                    @endif
                    <span class="hidden-xs">{{ auth('admin')->user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        @if(isset(auth('admin')->user()->image))
                        <img src="/images/admin/{{ auth('admin')->user()->image }}" class="img-circle" alt="User Image">
                        @else
                        <img src="/images/profile.jpg" class="img-circle" alt="User Image">
                        @endif
                        <p class="text-center"">
                            {{ auth('admin')->user()->name }} - Admin
                            <small>Member since {{ auth('admin')->user()->created_at }}</small>
                        </p>
                    </li>
                    <!-- Menu Body -->
                    {{-- <li class="user-body">
                        <div class="row">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </div>
                        <!-- /.row -->
                    </li> --}}
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="/admin/profile" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a href="/admin/logout" class="btn btn-default btn-flat"  onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Sign out</a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
        </ul>
    </div>
</nav>
</header>