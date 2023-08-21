@extends('layouts.master')
@section('title') MASTER DATA GURU @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master Data @endslot
@slot('title') Guru @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2">
                    <a href="{{ route('master-data.guru.create') }}" class="btn btn-outline-success btn-border d-flex align-items-center">
                        <i class="ri-add-circle-line me-2"></i>
                        <span>Tambah</span>
                    </a>

                    <form method="get">
                        <select class="form-select" id="jurusan_id" name="jurusan_id" onchange="this.form.submit()">
                            <option selected>Pilih Kelas</option>
                            @foreach (\App\Models\Jurusan::all() as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ Request::get('jurusan_id') == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                
                <div class="d-flex gap-2">
                    <a href="{{ route('master-data.guru.index') }}" class="btn btn-outline-primary btn-border">
                        <i class="ri-refresh-line"></i>
                    </a>

                    <form method="get">
                        <input type="text" name="find" id="find" class="form-control h-100" placeholder="Cari">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-striped-columns table-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua_guru as $guru)
                            <tr>
                                <td>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('assets/img/person-dummy.jpg') }}" alt="" class="avatar-xs rounded-circle" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0">{{ $guru->nama_lengkap }}</p>
                                            <small>{{ $guru->jenis_kelamin }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $guru->jurusan->nama_jurusan }}</td>
                                <td>
                                    <div class="hstack gap-3 fs-15">
                                        <a href="{{ route('master-data.guru.edit', $guru) }}"><i class="ri-settings-4-line"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $guru->id }}" class="text-danger"><i class="ri-delete-bin-5-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @include('pages.master-data.guru._modal_delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($semua_guru->lastPage() != 1)  
                @include('pages.master-data.guru.pagination', [
                    'data' => $semua_guru,
                    'route' => 'master-data.guru.index'
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
