@extends('layouts.master')
@section('title') MASTER DATA ROLES @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master Data @endslot
@slot('title') Role @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ route('master-data.role.index') }}"  data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-outline-success btn-border d-flex align-items-center">
                    <i class="ri-add-circle-line me-2"></i>
                    <span>Tambah</span>
                </a>
                @include('pages.master-data.role._modal_create')
                
                <div class="d-flex gap-2">
                    <a href="{{ route('master-data.role.index') }}" class="btn btn-outline-primary btn-border">
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
                                <th scope="col">Nama Role</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua_role as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>
                                    <div class="hstack gap-3 fs-15">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#updateModal-{{ $role->id }}"><i class="ri-settings-4-line"></i></a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $role->id }}" class="text-danger"><i class="ri-delete-bin-5-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @include('pages.master-data.role._modal_update')
                            @include('pages.master-data.role._modal_delete')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                @if($semua_role->lastPage() != 1)  
                @include('components.pagination', [
                    'data' => $semua_role,
                    'route' => 'master-data.role.index'
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
