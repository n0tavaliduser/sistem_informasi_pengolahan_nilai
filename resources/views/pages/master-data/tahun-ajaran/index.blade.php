@extends('layouts.master')
@section('title') MASTER DATA TAHUN AJARAN @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master Data @endslot
@slot('title') Tahun Ajaran @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('master-data.tahun-ajaran.create') }}" class="btn btn-outline-success btn-border d-flex align-items-center">
                    <i class="ri-add-circle-line me-2"></i>
                    <span>Tambah</span>
                </a>
                
                <div class="d-flex gap-2">
                    <a href="{{ route('master-data.tahun-ajaran.index') }}" class="btn btn-outline-primary btn-border">
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
                                <th scope="col">Tahun Ajaran</th>
                                <th scope="col">Jumlah Semester</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua_tahun_ajaran as $tahun_ajaran)
                            <tr>
                                <td>{{ $tahun_ajaran->tahun_mulai }} - {{ $tahun_ajaran->tahun_berakhir }}</td>
                                <td>{{ $tahun_ajaran->jumlah_semester }} Semester</td>
                                <td><span class="badge badge-label bg-{{ $tahun_ajaran->status === 'active' ? 'success' : 'danger' }}"><i class="mdi mdi-circle-medium"></i> {{ $tahun_ajaran->status }}</span></td>
                                <td>
                                    <div class="hstack gap-3 fs-15">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#updateModal-{{ $tahun_ajaran->id }}"><i class="ri-settings-4-line"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $tahun_ajaran->id }}" class="text-danger"><i class="ri-delete-bin-5-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @include('pages.master-data.tahun-ajaran._modal_update')
                            @include('pages.master-data.tahun-ajaran._modal_delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($semua_tahun_ajaran->lastPage() != 1)  
                @include('components.pagination', [
                    'data' => $semua_tahun_ajaran,
                    'route' => 'master-data.tahun-ajaran.index'
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
