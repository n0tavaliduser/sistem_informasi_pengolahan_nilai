<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">

                @if(Auth::user()->role->id === 1)                    
                <ul class="navbar-nav" id="navbar-nav">
                    <li class="menu-title"><span>Master Data</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                            <i data-feather="home" class="icon-dual"></i> <span>Master Data</span>
                        </a>
                        <div class="collapse menu-dropdown {{ strpos(Request::path(), 'master-data/') !== false ? 'show' : '' }}" id="sidebarDashboards">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('master-data.role.index') }}" class="nav-link {{ Request::is('master-data/role') ? 'active' : '' }}">Role</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('master-data.jurusan.index') }}" class="nav-link {{ Request::is('master-data/jurusan') ? 'active' : '' }}">Jurusan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('master-data.mata-pelajaran.index') }}" class="nav-link {{ Request::is('master-data/mata-pelajaran') ? 'active' : '' }}">Mata Pelajaran</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                </ul>
                @endif
            </div>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
