@extends('layouts.master')
@section('title') MASTER DATA SISWA @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master Data @endslot
@slot('title') Siswa @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2">
                    <a href="{{ route('master-data.siswa.create') }}" class="btn btn-outline-success btn-border d-flex align-items-center">
                        <i class="ri-add-circle-line me-2"></i>
                        <span>Tambah</span>
                    </a>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('master-data.siswa.index') }}" class="btn btn-outline-primary btn-border">
                        <i class="ri-refresh-line"></i>
                    </a>

                    <form method="get">
                        <div class="d-flex gap-3">
                            <select class="form-select" id="kelas_id" name="kelas_id" onchange="this.form.submit()">
                                <option selected>Pilih Kelas</option>
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
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua_siswa as $siswa)
                            <tr>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="@if ($siswa->user?->avatar != ''){{ URL::asset('storage/' . $siswa->user?->avatar) }}@else{{ URL::asset('assets/img/person-dummy.jpg') }}@endif" alt="" class="avatar-xs rounded-circle" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0">{{ $siswa->nama_lengkap }}</p>
                                            <small>Nomor Induk : {{ $siswa->nomor_induk }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex-grow-1">
                                        <p class="mb-0">{{ $siswa->kelas->nama_kelas }}</p>
                                        <small>{{ $siswa->kelas->jurusan->nama_jurusan }}</small>
                                    </div>
                                </td>
                                <td>{{ $siswa->status == 'active' ? 'Aktif' : 'Tidak Aktif' }}</td>
                                <td>
                                    <div class="hstack gap-3 fs-15">
                                        <a href="{{ route('master-data.siswa.edit', $siswa) }}"><i class="ri-settings-4-line"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $siswa->id }}" class="text-danger"><i class="ri-delete-bin-5-line"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#resetPasswordModal-{{ $siswa->id }}" class="text-secondary"><i class="ri-shield-keyhole-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @include('pages.master-data.siswa._modal_delete')
                            @include('pages.master-data.siswa._modal_reset_password')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($semua_siswa->lastPage() != 1)
                @include('components.pagination', [
                'data' => $semua_siswa,
                'route' => 'master-data.siswa.index'
                ])
                @endif
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
