<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/img/logo.png') }}" alt="" height="34">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/img/logo.png') }}" alt="" height="30" class="me-2"> <span class="fw-bolder text-white">SMK NEGERI 1 MAROS</span>
            </span>
        </a>
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/img/logo.png') }}" alt="" height="34">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/img/logo.png') }}" alt="" height="30" class="me-2"> <span class="fw-bolder text-dark">SMK NEGERI 1 MAROS</span>
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

                    <li class="menu-title"><span>Dashboard</span></li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('root') }}" role="button">
                            <i class="ri-dashboard-fill"></i> <span>Dashboard</span>
                        </a>
                    </li>

                    {{-- Guru || Admin || Siswa Sidebar LMS Label --}}
                    @if (Auth::user()->role->name === 'Guru' || Auth::user()->role->name === 'Siswa')
                        <li class="menu-title"><span>LMS</span></li>      

                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('manajemen-tugas/tugas') ? 'active' : '' }}" href="{{ route('tugas.index') }}" role="button">
                                <i class="ri-quill-pen-line"></i> <span>Tugas</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('materi') ? 'active' : '' }}" href="{{ route('materi.index') }}" role="button">
                                <i class="ri-book-open-fill"></i> <span>Materi</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('manajemen-tugas/rekap-nilai') ? 'active' : '' }}" href="{{ route('tugas.rekap-nilai') }}" role="button">
                                <i class="ri-list-unordered"></i> <span>Nilai Tugas</span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::user()->role->name == 'Guru' || Auth::user()->role->name == 'Siswa')
                        <li class="menu-title"><span>MENU</span></li>   
                    @endif

                    @if (Auth::user()->role->name == 'Guru')
                        @if (!empty(\App\Models\Kelas::where('guru_id', \App\Models\Guru::where('user_id', Auth::user()->id)->first()->id)->first()))                            
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('nilai/*/rekap') ? 'active' : '' }}" href="{{ route('nilai.ranking', \App\Models\Kelas::where('guru_id', \App\Models\Guru::where('user_id', Auth::user()->id)->first()->id)->first()) }}" role="button">
                                <i class="ri-list-ordered"></i> <span>Rekap Nilai {{ \App\Models\Kelas::where('guru_id', \App\Models\Guru::where('user_id', Auth::user()->id)->first()->id)->first()->nama_kelas }}</span>
                            </a>
                        </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('absensi') ? 'active' : '' }}" href="{{ route('absensi.index') }}" role="button">
                                <i class="ri-list-unordered"></i> <span>Absensi</span>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('absensi/rekap') ? 'active' : '' }}" href="{{ route('absensi.rekap') }}" role="button">
                                <i class="ri-calendar-line"></i> <span>Rekap Absensi</span>
                            </a>
                        </li>
                    @endif
                        
                    @if (Auth::user()->role->name == 'Guru' || Auth::user()->role->name == 'Siswa')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('jadwal-pelajaran') ? 'active' : '' }}" href="{{ route('jadwal-pelajaran.index') }}" role="button">
                                <i class="ri-calendar-line"></i> <span>Jadwal Pelajaran</span>
                            </a>
                        </li>
                    @endif

                    {{-- Guru || Siswa Sidebar LMS --}}
                    @if (Auth::user()->role->name === 'Guru' || Auth::user()->role->name == 'Siswa')
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ Request::is('manajemen-kelas/daftar-kelas') ? 'active' : '' }}" href="{{ route('manajemen-kelas.daftar-kelas') }}" role="button">
                                <i class="ri-ball-pen-line"></i> <span>Daftar Kelas</span>
                            </a>
                        </li> --}}
                    @endif

                    {{-- Siswa sidebar MENU --}}
                    @if (Auth::user()->role->name == 'Siswa')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('manajemen-nilai/nilai') ? 'active' : '' }}" href="{{ route('nilai.index', ['siswa_id' => \App\Models\Siswa::where('user_id', Auth::user()->id)->first()->id]) }}" role="button">
                            <i class="ri-checkbox-line"></i> <span>Lihat Nilai Akhir</span>
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

                    <li class="menu-title"><span>Menu</span></li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('absensi/rekap') ? 'active' : '' }}" href="{{ route('absensi.rekap') }}" role="button">
                            <i class="ri-calendar-line"></i> <span>Rekap Absensi</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('jadwal-pelajaran') ? 'active' : '' }}" href="{{ route('jadwal-pelajaran.index') }}" role="button">
                            <i class="ri-calendar-line"></i> <span>Kelola Jadwal Pelajaran</span>
                        </a>
                    </li>
                    @endif

                    @if (Auth::user()->role->name == 'Guru')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('manajemen-nilai/nilai-mata-pelajaran') ? 'active' : '' }}" href="{{ route('nilai-mata-pelajaran.index') }}" role="button">
                            <i class="ri-checkbox-line"></i> <span>Nilai Mata Pelajaran</span>
                        </a>
                    </li>
                    @endif

                    @if(Auth::user()->role->name == 'Admin')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarPengolahanNilai" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                            <i data-feather="home" class="icon-dual"></i> <span>Pengolahan Nilai</span>
                        </a>
                        <div class="collapse menu-dropdown {{ strpos(Request::path(), 'manajemen-nilai') !== false ? 'show' : '' }}" id="sidebarPengolahanNilai">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('nilai.index') }}" class="nav-link {{ Request::is('manajemen-nilai/nilai') ? 'active' : '' }}">Nilai Akhir</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('nilai-mata-pelajaran.index') }}" class="nav-link {{ Request::is('manajemen-nilai/nilai-mata-pelajaran') ? 'active' : '' }}">Nilai Mata Pelajaran</a>
                                </li>
                            </ul>
                        </div>
                    </li>
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
