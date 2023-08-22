@extends('layouts.master')
@section('title')
    RUANG KELAS
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/gridjs/theme/mermaid.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            <a href="{{ route('manajemen-kelas.daftar-kelas') }}">Daftar Kelas</a>
        @endslot
        @slot('title')
            {{ $jadwal->kelas->nama_kelas }}
        @endslot
    @endcomponent

    @php
        $daysOfWeekInIndonesian = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            0 => 'Minggu',
        ];
        
        $currentDay = $daysOfWeekInIndonesian[\Carbon\Carbon::now()->dayOfWeek];
        $isInvalidTime = ($jadwal->hari != $currentDay || 
            \Carbon\Carbon::now()->lessThan($jadwal->jam_mulai) || 
            \Carbon\Carbon::now()->greaterThan($jadwal->jam_berakhir));
    @endphp

    <div class="row">
        <div class="col-xxl-3">
            <div class="card">
                <div class="card-body p-4">
                    <div>
                        <div class="flex-shrink-0 avatar-md mx-auto">
                            <div class="avatar-title bg-light rounded">
                                <i class="bx bxs-graduation text-primary" style="font-size: 5rem;"></i>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <h5 class="mb-1">{{ $jadwal->mata_pelajaran?->nama }}</h5>
                            <p class="text-muted">{{ $jadwal->kelas->nama_kelas }}</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless">
                                <tbody>
                                    <tr>
                                        <th><span class="fw-medium">Wali Kelas</span></th>
                                        <td>{{ $jadwal->kelas?->guru?->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <th><span class="fw-medium">NIP Wali Kelas</span></th>
                                        <td>{{ $jadwal->nomor_nip ? $jadwal->nomor_nip : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th><span class="fw-medium">Pengajar</span></th>
                                        <td>{{ $jadwal->guru?->nama_lengkap ? $jadwal->guru?->nama_lengkap : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th><span class="fw-medium">NIP Pengajar</span></th>
                                        <td>{{ $jadwal->guru?->nomor_nip ? $jadwal->guru?->nomor_nip : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th><span class="fw-medium">Email</span></th>
                                        <td>{{ $jadwal->guru?->user?->email }}</td>
                                    </tr>
                                    <tr>
                                        <th><span class="fw-medium">Hari</span></th>
                                        <td>{{ $jadwal->hari }}</td>
                                    </tr>
                                    <tr>
                                        <th><span class="fw-medium">Jam</span></th>
                                        <td>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_berakhir)->format('H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th><span class="fw-medium">Semester</span></th>
                                        <td>{{ $jadwal->semester }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if ($jadwal->mata_pelajaran?->tugas)                                
                <div class="card-body p-4 border-top border-top-dashed">
                    <h6 class="text-muted text-uppercase fw-semibold mb-4">Tugas</h6>
                    <!-- Swiper -->
                    <div class="align-items-center p-3 justify-content-between d-flex flex-wrap">
                        <div class="flex-shrink-0">
                            <div class="text-muted"><span class="fw-semibold">{{ $jadwal->mata_pelajaran?->tugas->where('status', 'open')->count() }}</span> dari <span class="fw-semibold">{{ $jadwal->mata_pelajaran?->tugas->count() }}</span> dibuka</div>
                        </div>
                        @if (Auth::user()->role->name == 'Guru')
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tambah-tugas"><i class="ri-add-line align-middle me-1"></i> Tambah Tugas</button>
                            @include('pages.kelas._modal_tambah_tugas')
                        @endif
                    </div><!-- end card header -->

                    <div data-simplebar style="max-height: 257px;">
                        <ul class="list-group list-group-flush border-dashed">   
                            @foreach ($jadwal->mata_pelajaran?->tugas as $tugas)                       
                            <li class="list-group-item ps-0">
                                <div class="d-grid">
                                    <div class="flex-grow-1">
                                        <label class="form-check-label mb-0" for="task_one">{{ $tugas->judul }}</label>
                                        <p class="text-muted fs-12 mb-1">Tenggat Waktu : {{ \Carbon\Carbon::parse($tugas->tanggal_deadline)->format('d-m-Y') }}</p>
                                    </div>
                                    <div class="d-flex gap-1">
                                    @if (Auth::user()->role->name == 'Guru')
                                        @if($tugas->status == 'open')
                                            <a href="{{ route('tugas.close-tugas', $tugas) }}" class="btn btn-sm btn-danger w-100 mb-1">tutup</a>
                                        @elseif ($tugas->status == 'closed')
                                            <a href="{{ route('tugas.open-tugas', $tugas) }}" class="btn btn-sm btn-success w-100 mb-1">buka</a>
                                        @endif
                                            <a href="{{ route('tugas.show', $tugas) }}" class="btn btn-sm btn-primary w-100 mb-1">lihat</a>
                                            <a href="{{ route('tugas.edit', ['tugas' => $tugas, 'jadwal' => $jadwal]) }}" class="btn btn-sm btn-warning w-100 mb-1">update</a>
                                            <a href="#" class="btn btn-sm btn-secondary w-100 mb-1">hasil</a>
                                    @else
                                        @if ($tugas->status == 'open')                                      
                                            <a href="{{ route('tugas.show', $tugas) }}" class="btn btn-sm btn-primary w-100 mb-1">lihat</a>
                                            <button class="btn btn-sm btn-success w-100">submit</button>
                                        @else
                                            <button class="btn btn-sm btn-muted disabled">closed</button>
                                        @endif
                                    @endif
                                    </div>
                                </div>
                            </li>
                            @endforeach    
                        </ul>
                    </div>
                </div>
                @endif                      
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <div class="col-xxl-9">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Statistik Kelas</h4>
                </div><!-- end card header -->

                <div class="card-header p-0 border-0 bg-soft-light">
                    <div class="row g-0 text-center">
                        <div class="col-6 col-sm-4">
                            <div class="p-3 border border-dashed border-start-0">
                                <h5 class="mb-1"><span class="counter-value" data-target="{{ $jadwal->kelas->siswas->count() }}">0</span>
                                </h5>
                                <p class="text-muted mb-0">Siswa Kelas</p>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-6 col-sm-4">
                            <div class="p-3 border border-dashed border-start-0">
                                <h5 class="mb-1"><span class="counter-value" data-target="{{ $jadwal->mata_pelajaran?->tugas->count() }}">0</span> 
                                </h5>
                                <p class="text-muted mb-0">Jumlah Tugas</p>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-12 col-sm-4">
                            <div class="p-3 border border-dashed border-start-0">
                                @php
                                    $persentase_absensi_kelas = \App\Models\Absensi::where('mata_pelajaran_id', $jadwal->mata_pelajaran_id)->where('kelas_id', $jadwal->kelas_id)->where('keterangan', 'Hadir')->count() / (16 * $jadwal->kelas->siswas->count()) * 100;
                                @endphp
                                <h5 class="mb-1"><span class="counter-value text-@php
                                    if ($persentase_absensi_kelas >= 60 && $persentase_absensi_kelas < 75) {
                                        echo 'warning';
                                    } elseif ($persentase_absensi_kelas >= 75) {
                                        echo 'success';
                                    } else {
                                        echo 'danger';
                                    }
                                @endphp" data-target="{{ $persentase_absensi_kelas }}">0</span>%
                                </h5>
                                <p class="text-muted mb-0">Persentase Absensi</p>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                </div><!-- end card header -->
            </div><!-- end card -->

            <div class="row g-4 mb-3">
                <div class="col-sm-auto">
                    <div>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_absensi">
                            <i class="ri-file-edit-fill"></i> Buka Absensi
                        </a>
                        @include('pages.kelas._modal_absensi')
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="text-muted">Daftar Siswa</h4>
                    <div class="live-preview">
                        <div class="table-responsive table-card">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Siswa</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Nomor Induk</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal->kelas->siswas as $siswa)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ URL::asset('assets/img/person-dummy.jpg') }}" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="mb-0">{{ $siswa->nama_lengkap }}</p>
                                                    <small>{{ $siswa->jenis_kelamin }}</small>
                                                </div>
                                            </div>
                                        </th>
                                        <td>{{ $siswa->user->email }}</td>
                                        <td>{{ $siswa->nomor_induk }}</td>
                                        <td><a href="{{ route('manajemen-kelas.detail-siswa', $siswa) }}" class="link-success">Detail <i class="ri-arrow-right-line align-middle"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('build/libs/nouislider/nouislider.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/wnumb/wNumb.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>
<script src="https://unpkg.com/gridjs/plugins/selection/dist/selection.umd.js"></script>
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/seller-details.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
