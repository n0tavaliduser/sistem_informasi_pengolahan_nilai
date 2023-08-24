@extends('layouts.master')
@section('title') NILAI TUGAS @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('root') }}">LMS</a> @endslot
@slot('title') Nilai Tugas @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2 w-50">
                    <form method="get" class="w-100">
                        <div class="d-flex gap-3">
                            <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Pilih mata pelajaran</option>
                                @foreach ($semua_mata_pelajaran as $mata_pelajaran)
                                <option value="{{ $mata_pelajaran->id }}" {{ $mata_pelajaran->id == Request::get('mata_pelajaran_id') ? 'selected' : '' }}>{{ $mata_pelajaran->nama }}</option>
                                @endforeach
                            </select>

                            @if (Auth::user()->role->name == 'Guru')
                            <select name="kelas_id" id="kelas_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Pilih kelas</option>
                                @foreach (\App\Models\Kelas::all() as $kelas)
                                <option value="{{ $kelas->id }}" {{ $kelas->id == Request::get('kelas_id') ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>

                            <select name="siswa_id" id="siswa_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Pilih siswa</option>
                                @foreach ($semua_siswa as $siswa)
                                <option value="{{ $siswa->id }}" {{ $siswa->id == Request::get('siswa_id') ? 'selected' : '' }}>{{ $siswa->nama_lengkap }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Siswa</th>
                                <th>Tanggal</th>
                                <th>Berkas</th>
                                <th>Nilai</th>
                                @if (Auth::user()->role->name == 'Guru')
                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua_pengumpulan_tugas as $index => $pengumpulan_tugas)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pengumpulan_tugas->siswa?->nama_lengkap }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pengumpulan_tugas->tugas?->created_at)->format('d-m-Y') }}</td>
                                    <td><a href="{{ route('pengumpulan-tugas.download-file', $pengumpulan_tugas) }}">download</a></td>
                                    <td>{{ $pengumpulan_tugas->nilai }}</td>
                                    @if (Auth::user()->role->name == 'Guru')
                                    <td>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-update-{{ $pengumpulan_tugas->id }}"><i class="ri-settings-4-line"></i></a>
                                        @include('pages.tugas._modal_update_penilaian')
                                    </td>
                                    @endif
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
