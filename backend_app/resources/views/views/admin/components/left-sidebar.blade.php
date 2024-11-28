<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                                      <!-- User, Authen, Author-->
                @canany(['user', 'role', 'permission'])
                    <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Quản lý người dùng</span></li>
                    @can('user')
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('users.index') }}" aria-expanded="false"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Người dùng</span></a></li>
                    @endcan
                    @can('role')
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('roles.index') }}" aria-expanded="false"><i class="mdi mdi-cube-send"></i><span class="hide-menu">Vai trò hệ thống</span></a></li>
                    @endcan
                    @can('permission')
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('permissions.index') }}" aria-expanded="false"><i class="mdi mdi-dns"></i><span class="hide-menu">Chức năng hệ thống</span></a></li>
                    @endcan
                @endcanany
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('logout') }}" aria-expanded="false"><i class="mdi mdi-directions"></i><span class="hide-menu">Log Out</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
