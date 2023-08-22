@extends('layouts.master')
@section('title') MASTER DATA GURU @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') LMS @endslot
@slot('title') Tugas @endslot
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

                    <form method="get">
                        <div class="d-flex gap-2">
                            <select name="kelas_id" id="kelas_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Pilih kelas</option>
                                @foreach (\App\Models\Kelas::all() as $kelas)
                                <option value="{{ $kelas->id }}" {{ $kelas->id == Request::get('kelas_id') ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="find" id="find" class="form-control h-100" placeholder="Cari">
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-striped-columns table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                @if (Auth::user()->role->name == 'Guru')
                                    <th>Kelas</th>
                                    <th>Pengumpul Tugas</th>
                                @endif
                                <th scope="col">Judul</th>
                                <th scope="col">Tenggat Waktu</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua_tugas as $tugas)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm">
                                            <div
                                                class="avatar-title bg-light text-primary rounded fs-24">
                                                <i class="ri-folder-zip-line"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3 flex-grow-1">
                                            <h5 class="fs-14 mb-0"><a href="#" class="text-dark">{{ $tugas->mata_pelajaran?->nama }}</a></h5>
                                            @if ($tugas->file)
                                                <p>download berkas: <a href="{{ route('tugas.download-file', $tugas) }}">disini</a></p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                @if (Auth::user()->role->name == 'Guru')
                                    <td class="fw-bold">{{ $tugas->kelas?->nama_kelas }}</td>
                                    <td><span class="fw-bold">{{ $tugas->pengumpulan_tugas->count() }}</span> dari <span class="fw-bold">{{ count($tugas->kelas?->siswas) }}</span> siswa</td>
                                @endif
                                <td>{{ $tugas->judul }}</td>
                                <td>{{ \Carbon\Carbon::parse($tugas->tanggal_deadline)->format('d-m-Y') }}</td>
                                <td>
                                    <div class="hstack gap-3 fs-15">
                                        <a href="{{ route('tugas.show', $tugas) }}"><i class="ri-eye-line"></i></a>
                                        @if ($tugas->status == 'open')
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalUpdate-{{ $tugas->id }}"><i class="ri-settings-4-line"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $tugas->id }}" class="text-danger"><i class="ri-delete-bin-5-line"></i></a>
                                        @endif
                                    </div>
                                    @include('pages.tugas._modal_update')
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($semua_tugas->lastPage() != 1)  
            <div class="card-footer">
                @include('components.pagination', [
                    'data' => $semua_tugas,
                    'route' => 'master-data.guru.index'
                ])
            </div>
            @endif
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
