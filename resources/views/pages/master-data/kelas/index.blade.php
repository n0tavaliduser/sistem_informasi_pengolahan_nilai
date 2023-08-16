@extends('layouts.master')
@section('title') @lang('translation.basic-tables') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master Data @endslot
@slot('title') Kelas @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('master-data.kelas.create') }}" class="btn btn-outline-success btn-border d-flex align-items-center">
                    <i class="ri-add-circle-line me-2"></i>
                    <span>Tambah</span>
                </a>
                
                <div class="d-flex gap-2">
                    <a href="{{ route('master-data.kelas.index') }}" class="btn btn-outline-primary btn-border">
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
                                <th scope="col">Nama Kelas</th>
                                <th scope="col">Tingkat</th>
                                <th scope="col">Wali Kelas</th>
                                <th scope="col">Jurusan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua_kelas as $kelas)
                            <tr>
                                <td>{{ $kelas->nama_kelas }}</td>
                                <td>{{ $kelas->tingkat }}</td>
                                <td>{{ $kelas->guru->nama_lengkap }}</td>
                                <td>{{ $kelas->jurusan->nama_jurusan }}</td>
                                <td>
                                    <div class="hstack gap-3 fs-15">
                                        <a href="{{ route('master-data.kelas.edit', $kelas) }}"><i class="ri-settings-4-line"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $kelas->id }}" class="text-danger"><i class="ri-delete-bin-5-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            {{-- @include('pages.master-data.kelas._modal_update') --}}
                            @include('pages.master-data.kelas._modal_delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($semua_kelas->lastPage() != 1)  
                @include('components.pagination', [
                    'data' => $semua_kelas,
                    'route' => 'master-data.kelas.index'
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
