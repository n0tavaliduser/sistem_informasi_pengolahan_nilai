@extends('layouts.master')
@section('title') ABSENSI @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') LMS @endslot
@slot('title') Absensi @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-end align-items-center">
                <div class="d-flex gap-2">
                    <a href="{{ route('tugas.index') }}" class="btn btn-outline-primary btn-border">
                        <i class="ri-refresh-line"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Jam</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua_jadwal as $jadwal)
                                <tr>
                                    <td>{{ $jadwal->first()->mata_pelajaran?->nama }}</td>
                                    <td>{{ $jadwal->first()->kelas?->nama_kelas }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->first()->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->last()->jam_berakhir)->format('H:i') }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('absensi.show', ['mata_pelajaran' => $jadwal->first()->mata_pelajaran, 'kelas' => $jadwal->first()->kelas, 'jadwal' => $jadwal->first()]) }}" class="btn btn-sm btn-success">absensi</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/modal.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
