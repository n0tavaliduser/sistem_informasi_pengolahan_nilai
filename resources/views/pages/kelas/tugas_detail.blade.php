@extends('layouts.master')
@section('title')
    DETAIL TUGAS
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            <a href="{{ URL::previous() }}">Ruang Kelas</a>
        @endslot
        @slot('title')
            Detail Tugas
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-n4 mx-n4 border-0">
                <div class="bg-soft-primary">
                    <div class="card-body pb-0 px-4">
                        <div class="row mb-3">
                            <div class="col-md">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-auto">
                                        <div class="avatar-md">
                                            <div class="avatar-title bg-white rounded-circle">
                                                <i class="bx bxs-graduation text-primary" style="font-size: 5rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div>
                                            <h4 class="fw-bold">{{ $tugas->judul }}</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div class="text-muted">Dibuat tanggal : <span class="fw-medium">{{ \Carbon\Carbon::parse($tugas->created_at)->format('d-m-Y') }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#project-overview"
                                    role="tab">
                                    Detail
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#project-documents" role="tab">
                                    Berkas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="tab-content text-muted">
                <div class="tab-pane fade show active" id="project-overview" role="tabpanel">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-muted">
                                        <h6 class="mb-3 fw-semibold text-uppercase">Deskripsi</h6>
                                        <p>{{ $tugas->deskripsi }}</p>

                                        <div class="pt-3 border-top border-top-dashed mt-4">
                                            <div class="row">
                                                <div class="col-lg-3 col-sm-6">
                                                    <div>
                                                        <p class="mb-2 text-uppercase fw-medium">Tenggat Waktu :</p>
                                                        <h5 class="fs-15 mb-0">{{ \Carbon\Carbon::parse($tugas->tanggal_deadline)->format('d-m-Y') }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if (!empty($tugas->file))                                            
                                        <div class="pt-3 border-top border-top-dashed mt-4">
                                            <h6 class="mb-3 fw-semibold text-uppercase">File Tugas</h6>
                                            <div class="row g-3">
                                                <div class="col-xxl-4 col-lg-6">
                                                    <div class="border rounded border-dashed p-2">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-light text-primary rounded fs-24">
                                                                        <i class="ri-folder-zip-line"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <h5 class="fs-13 mb-1"><a href="#"
                                                                        class="text-body text-truncate d-block">{{ $tugas->file }}</a></h5>
                                                                <div>{{ round(filesize($tugas->file) / 1024 / 1024, 2) }} MB</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- end tab pane -->
                <div class="tab-pane fade" id="project-documents" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <h5 class="card-title flex-grow-1">Berkas Pengumpulan</h5>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive table-card">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">Siswa</th>
                                                    <th scope="col">Tipe</th>
                                                    <th scope="col">Ukuran</th>
                                                    <th scope="col">Tanggal Upload</th>
                                                    <th scope="col" style="width: 120px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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
                                                                <h5 class="fs-14 mb-0"><a href="javascript:void(0)"
                                                                        class="text-dark">tugas1-bindo-siswa1.zip</a>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Zip File</td>
                                                    <td>4.57 MB</td>
                                                    <td>18 Aug 2023</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0);"
                                                                class="btn btn-soft-primary btn-sm btn-icon"
                                                                data-bs-toggle="dropdown" aria-expanded="true">
                                                                <i class="ri-more-fill"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="ri-eye-fill me-2 align-bottom text-muted"></i>View</a>
                                                                </li>
                                                                <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="ri-download-2-fill me-2 align-bottom text-muted"></i>Download</a>
                                                                </li>
                                                                <li class="dropdown-divider"></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0);"><i
                                                                            class="ri-delete-bin-5-fill me-2 align-bottom text-muted"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/pages/project-overview.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
