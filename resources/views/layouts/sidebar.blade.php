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

                <ul class="navbar-nav" id="navbar-nav">

                    {{-- Kepala Sekolah ||  Admin Sidebar Dashboard --}}
                    @if(Auth::user()->role->name === 'Kepala Sekolah' || Auth::user()->role->name === 'Admin')
                        <li class="menu-title"><span>Dashboard</span></li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('root') }}" role="button">
                                <i class="ri-dashboard-fill"></i> <span>Dashboard</span>
                            </a>
                        </li>
                    @endif

                    {{-- Guru || Admin || Siswa Sidebar LMS Label --}}
                    @if (Auth::user()->role->name === 'Guru' || Auth::user()->role->name === 'Admin' || Auth::user()->role->name === 'Siswa')
                        <li class="menu-title"><span>LMS</span></li>              
                    @endif

                    {{-- Admin Sidebar LMS --}}
                    @if (Auth::user()->role->name === 'Admin' || Auth::user()->role->name === 'Guru')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('jadwal-pelajaran.index') }}" role="button">
                                <i class="ri-shield-user-fill"></i> <span>Guru Pelajaran</span>
                            </a>
                        </li>
                    @endif

                    {{-- Guru Sidebar LMS --}}
                    @if (Auth::user()->role->name === 'Guru')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('root') }}" role="button">
                                <i class="ri-ball-pen-line"></i> <span>Input Tugas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('root') }}" role="button">
                                <i class="ri-list-check"></i> <span>Nilai Tugas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('root') }}" role="button">
                                <i class="ri-file-paper-2-line"></i> <span>Input Materi</span>
                            </a>
                        </li>
                    @endif

                    {{-- Siswa Sidebar LMS --}}
                    @if(Auth::user()->role->name === 'Siswa')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('root') }}" role="button">
                                <i class="ri-edit-box-line"></i> <span>Tugas</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('root') }}" role="button">
                                <i class="ri-search-eye-line"></i> <span>Materi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('root') }}" role="button">
                                <i class="ri-checkbox-line"></i> <span>Nilai Tugas</span>
                            </a>
                        </li>
                    @endif

                    {{-- Admin Sidebar Master Data --}}
                    @if(Auth::user()->role->name === 'Admin')
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
                                <li class="nav-item">
                                    <a href="{{ route('master-data.kelas.index') }}" class="nav-link {{ Request::is('master-data/kelas') ? 'active' : '' }}">Kelas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('master-data.guru.index') }}" class="nav-link {{ Request::is('master-data/guru') ? 'active' : '' }}">Guru</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('master-data.siswa.index') }}" class="nav-link {{ Request::is('master-data/siswa') ? 'active' : '' }}">Siswa</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('master-data.tahun-ajaran.index') }}" class="nav-link {{ Request::is('master-data/tahun-ajaran') ? 'active' : '' }}">Tahun Ajaran</a>
                                </li>
                            </ul>
                        </div>
                    </li> <!-- end Dashboard Menu -->
                    @endif
                </ul>
            </div>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
