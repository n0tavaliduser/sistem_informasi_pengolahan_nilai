@extends('layouts.master')
@section('title') MATERI @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') LMS @endslot
@slot('title') Materi @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                @if (Auth::user()->role->name == 'Guru')
                <div class="d-flex align-items-center">
                    <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-tambah-materi"><i></i> Tambah</a>
                </div>
                @include('pages.materi._modal_create')
                
                <div class="d-flex gap-2">
                    <a href="{{ route('materi.index') }}" class="btn btn-outline-primary btn-border">
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
                        </div>
                    </form>
                </div>
                @elseif(Auth::user()->role->name == 'Siswa')
                <form method="get">
                    <div class="d-flex gap-2">
                        <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="form-control" onchange="this.form.submit()">
                            <option value="">Pilih mata pelajaran</option>
                            @foreach ($semua_mata_pelajaran as $kelas)
                            <option value="{{ $kelas->id }}" {{ $kelas->id == Request::get('mata_pelajaran_id') ? 'selected' : '' }}>{{ $kelas->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-striped-columns table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Mata Pelajaran</th>
                                @if (Auth::user()->role->name == 'Guru')
                                    <th>Kelas</th>
                                @endif
                                <th scope="col">Tanggal</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua_materi as $materi)
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
                                            <h5 class="fs-14 mb-0"><a href="#" class="text-dark">{{ $materi->judul }}</a></h5>
                                            @if ($materi->file)
                                                <p>download berkas: <a href="{{ route('materi.download-file', $materi) }}">disini</a></p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $materi->jadwal_pelajaran?->mata_pelajaran?->nama }}</td>
                                @if (Auth::user()->role->name == 'Guru')
                                    <td class="fw-bold">{{ $materi->jadwal_pelajaran?->kelas?->nama_kelas }}</td>
                                @endif
                                <td>{{ \Carbon\Carbon::parse($materi->tanggal)->format('d-m-Y') }}</td>
                                <td>
                                    <div class="hstack gap-3 fs-15">
                                        @if (!$materi->tanggal->isPast())
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#updateModal-{{ $materi->id }}"><i class="ri-settings-4-line"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $materi->id }}" class="text-danger"><i class="ri-delete-bin-5-line"></i></a>
                                        @endif
                                    </div>
                                    @include('pages.materi._modal_update')
                                    @include('pages.materi._modal_delete')
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($semua_materi->lastPage() != 1)  
            <div class="card-footer">
                @include('components.pagination', [
                    'data' => $semua_materi,
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
