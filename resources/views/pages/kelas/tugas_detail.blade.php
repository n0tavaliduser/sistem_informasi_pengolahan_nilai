@extends('layouts.master')
@section('title')
    DETAIL TUGAS
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            <a href="{{ URL::previous() }}">Tugas</a>
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
                                                                <h5 class="fs-13 mb-1"><a href="{{ route('tugas.download-file', $tugas) }}" class="text-body text-truncate d-block" style="text-transform: uppercase;">{{ pathinfo($tugas->file, PATHINFO_EXTENSION) }} FILE</a></h5>
                                                                @if (is_file(public_path('storage/' . $tugas->file)))
                                                                    <div>{{ round(filesize(public_path('storage/' . $tugas->file)) / 1024 / 1024, 2) }} MB</div>
                                                                @else
                                                                    <div>File not found or inaccessible</div>
                                                                @endif
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

                                @if (Auth::user()->role->name == 'Siswa')
                                <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-submit-tugas">pengumpulan tugas</a>
                                @include('pages.kelas._modal_submit_tugas')
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-card">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">Siswa</th>
                                                    <th scope="col">File</th>
                                                    <th scope="col">Tipe</th>
                                                    <th scope="col">Ukuran</th>
                                                    <th scope="col">Tanggal Upload</th>
                                                    <th scope="col">Nilai</th>
                                                    <th scope="col" style="width: 120px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($tugas->pengumpulan_tugas->count() == 0)
                                                    <tr>
                                                        <td colspan="6" class="text-center">
                                                            belum ada yang mengumpulkan tugas
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach ($tugas->pengumpulan_tugas as $pengumpulan_tugas)
                                                    <tr>
                                                        <td>
                                                            {{ $pengumpulan_tugas->siswa?->nama_lengkap }}
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-light text-primary rounded fs-24">
                                                                        <i class="ri-folder-zip-line"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-3 flex-grow-1">
                                                                    <h5 class="fs-14 mb-0"><a href="{{ route('pengumpulan-tugas.download-file', $pengumpulan_tugas) }}" class="text-dark">{{ $pengumpulan_tugas->title }}</a>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style="text-transform: uppercase;">{{ pathinfo($pengumpulan_tugas->file, PATHINFO_EXTENSION) }} FILE</td>
                                                        <td>
                                                            @if (is_file(public_path('storage/' . $pengumpulan_tugas->file)))
                                                                <div>{{ round(filesize(public_path('storage/' . $pengumpulan_tugas->file)) / 1024 / 1024, 2) }} MB</div>
                                                            @else
                                                                <div>File not found or inaccessible</div>
                                                            @endif
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($tugas->created_at)->format('d-m-Y') }}</td>
                                                        <td>{{ $pengumpulan_tugas->nilai }}</td>
                                                        <td>
                                                            @if ((Auth::user()->role->name == 'Siswa' && Auth::user()->id == $pengumpulan_tugas->siswa?->user_id) || Auth::user()->role->name == 'Guru')  
                                                            <div class="dropdown">
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-soft-primary btn-sm btn-icon"
                                                                    data-bs-toggle="dropdown" aria-expanded="true">
                                                                    <i class="ri-more-fill"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    @if (Auth::user()->role->name == 'Siswa' && Auth::user()->id == $pengumpulan_tugas->siswa?->user_id)
                                                                    <li>
                                                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#updateModal-{{ $pengumpulan_tugas->id }}"><i class="ri-edit-line me-2 align-bottom text-muted"></i>Edit</a>
                                                                    </li>
                                                                    @endif
                                                                    @if (Auth::user()->role->name == 'Guru')
                                                                    <li>
                                                                        <a class="dropdown-item" href="{{ route('pengumpulan-tugas.download-file', $pengumpulan_tugas) }}"><i class="ri-download-2-fill me-2 align-bottom text-muted"></i>Download</a>
                                                                        <a class="dropdown-item" href="javascript:void(0);" href="#" data-bs-toggle="modal" data-bs-target="#modal-update-{{ $pengumpulan_tugas->id }}"><i class="ri-settings-4-line me-2 text-muted align-bottom"></i>Beri Nilai</a>
                                                                    </li>
                                                                    @endif
                                                                    @if (Auth::user()->role->name == 'Siswa' && Auth::user()->id == $pengumpulan_tugas->siswa?->user_id)
                                                                    <li class="dropdown-divider"></li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-submission-{{ $pengumpulan_tugas->id }}"><i class="ri-delete-bin-5-fill me-2 align-bottom text-muted"></i>Hapus</a>
                                                                    </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                            @include('pages.tugas._modal_update_penilaian')
                                                            @if (Auth::user()->role->name == 'Guru')
                                                                
                                                            @endif
                                                            @include('pages.kelas._modal_delete_submission_tugas')
                                                            @include('pages.kelas._modal_update_submission_tugas')
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
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
