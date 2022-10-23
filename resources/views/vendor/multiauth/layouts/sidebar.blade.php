<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if(isset(auth('admin')->user()->image))
                <img src="/images/admin/{{ auth('admin')->user()->image }}" class="img-circle" alt="User Image">
                @else
                <img src="/images/profile.jpg" class="img-circle" alt="User Image">
                @endif
            </div>
            <div class="pull-left info">
                <p>{{ auth('admin')->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            @admin('super')
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview {{-- {{ request()->is('/') ? 'active' : '' }} --}}">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{-- {{ request()->is('/') ? 'active' : '' }} --}}"><a href="/admin"><i class="fa fa-circle-o"></i> Dashboard</a></li>
                    <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                </ul>
            </li>

            
            <li class="treeview {{ request()->is('admin*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span> Admin</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=" {{ request()->is('/admin/show') ? 'active' : '' }}">
                        <a href="{{ route('admin.show') }}"><i class="fa fa-circle-o"></i> All Admins</a>
                    </li>
                    <li class=" {{ request()->is('/admin/role*') ? 'active' : '' }}">
                        <a href="{{ route('admin.roles') }}"><i class="fa fa-circle-o"></i> Rules</a>
                    </li>
                    <li class=" {{ request()->is('/admin/app*') ? 'active' : '' }}">
                        <a href="{{ route('admin.app.home') }}"><i class="fa fa-circle-o"></i> App Setting</a>
                    </li>
                </ul>
            </li>

            @endadmin
            {{-- <li><a href="../../documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li> --}}
            <li class="header">LABELS</li>
            <li class="treeview {{ request()->is('mailbox*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-envelope text-blue"></i>
                    <span>Mailbox</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->is('mailbox*/inbox') ? 'active' : '' }}">
                        <a href="{{ route('admin.inbox') }}"><i class="fa fa-circle-o"></i> Inbox</a>
                    </li>
                    <li class="{{ request()->is('mailbox*/sent') ? 'active' : '' }}">
                        <a href="{{ route('admin.sent') }}"><i class="fa fa-circle-o"></i> Sent</a>
                    </li>
                    <li class="{{ request()->is('mailbox*/draft') ? 'active' : '' }}">
                        <a href="{{ route('admin.draft') }}"><i class="fa fa-circle-o"></i> Draft</a>
                    </li>
                    <li class="{{ request()->is('mailbox*/trash') ? 'active' : '' }}">
                        <a href="{{ route('admin.trash') }}"><i class="fa fa-circle-o"></i> Trash</a>
                    </li>
                    <li class="{{ request()->is('mailbox*/compose') ? 'active' : '' }}">
                        <a href="{{ route('admin.compose') }}"><i class="fa fa-circle-o"></i> Compose</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{ request()->is('todo*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-envelope text-blue"></i>
                    <span>Tasks</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->is('todo*/list') ? 'active' : '' }}">
                        <a href="{{ route('todo.list') }}"><i class="fa fa-circle-o"></i> Task List</a>
                    </li>
                </ul>
            </li>
            
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>