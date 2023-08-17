@extends('layouts.master')
@section('title') @lang('translation.basic-tables') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master Data @endslot
@slot('title') Mata Pelajaran @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('master-data.mata-pelajaran.index') }}"  data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-outline-success btn-border d-flex align-items-center">
                    <i class="ri-add-circle-line me-2"></i>
                    <span>Tambah</span>
                </a>
                @include('pages.master-data.mata-pelajaran._modal_create')
                
                <div class="d-flex gap-2">
                    <a href="{{ route('master-data.mata-pelajaran.index') }}" class="btn btn-outline-primary btn-border">
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
                                <th scope="col">Nama Mata Pelajaran</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua_mata_pelajaran as $mata_pelajaran)
                            <tr>
                                <td>{{ $mata_pelajaran->nama }} ({{ $mata_pelajaran->kode }})</td>
                                <td>{{ $mata_pelajaran->keterangan }}</td>
                                <td>
                                    <div class="hstack gap-3 fs-15">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#updateModal-{{ $mata_pelajaran->id }}"><i class="ri-settings-4-line"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $mata_pelajaran->id }}" class="text-danger"><i class="ri-delete-bin-5-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @include('pages.master-data.mata-pelajaran._modal_update')
                            @include('pages.master-data.mata-pelajaran._modal_delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($semua_mata_pelajaran->lastPage() != 1)  
                @include('components.pagination', [
                    'data' => $semua_mata_pelajaran,
                    'route' => 'master-data.mata-pelajaran.index'
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
