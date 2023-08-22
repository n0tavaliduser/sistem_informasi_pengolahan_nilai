@extends('layouts.master')
@section('title')
DAFTAR KELAS
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
LMS
@endslot
@slot('title')
Daftar Kelas
@endslot
@endcomponent
<div class="row">
    @foreach ($semua_jadwal as $jadwal)

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

    <div class="col-xl-3 col-lg-6">
        <div class="card ribbon-box right overflow-hidden">
            <div class="card-body text-center p-4">
                <div class="ribbon ribbon-primary ribbon-shape trending-ribbon"><i class="ri-home-4-line text-white align-bottom"></i> <span class="trending-ribbon-text">{{ $jadwal->kelas->nama_kelas }}</span></div>
                <i class="bx bxs-graduation text-primary" style="font-size: 5rem;"></i>
                <h5 class="mb-1 mt-4"><a href="{{ route('manajemen-kelas.ruang-kelas', $jadwal) }}" class="link-secondary">{{ $jadwal->kelas->jurusan->nama_jurusan }}</a></h5>
                <p class="text-muted mb-0">{{ $jadwal->hari }} | {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_berakhir)->format('H:i') }}</p>
                <small class="mb-4 text-{{ $isInvalidTime ? 'danger' : 'success' }}">
                    {{
                        $isInvalidTime ? 'Tutup' : 'Kelas Dibuka'
                    }}
                </small>
                <div class="row mt-4">
                    <div class="col-lg-6 border-end-dashed border-end">
                        <h5>{{ $jadwal->kelas->siswas->count() }}</h5>
                        <span class="text-muted">Siswa</span>
                    </div>
                    <div class="col-lg-6">
                        <h5>{{ $jadwal->mata_pelajaran?->kode }}</h5>
                        <span class="text-muted">Kode Pelajaran</span>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('manajemen-kelas.ruang-kelas', $jadwal) }}" class="btn btn-light w-100 @php                
                        if (Auth::user()->role->name == 'Siswa') {
                            if ($isInvalidTime) { 
                                // echo 'disabled';
                            }
                        }
                    @endphp">Masuk Kelas</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!--end row-->

<div class="row g-0 text-center text-sm-start align-items-center mb-3">
    @include('components.pagination', [
    'route' => 'manajemen-kelas.daftar-kelas',
    'data' => $semua_jadwal
    ])
</div><!-- end row -->
@endsection
@section('script')
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/sellers.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
