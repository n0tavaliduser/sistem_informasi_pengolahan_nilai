@extends('layouts.master')
@section('title')
    CETAK NILAI MATA PELAJARAN
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
    <a href="{{ url()->previous() }}">Nilai Mata Pelajaran</a>
@endslot
@slot('title')
Detail Nilai Mata Pelajaran
@endslot
@endcomponent
<div class="row justify-content-center">
    <div class="col-xxl-9">
        <div class="card" id="demo">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-header border-bottom-dashed p-4">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <img src="{{ URL::asset('assets/img/logo.png') }}" class="card-logo card-logo-dark mb-3" alt="logo dark" height="100">
                                <h4 class="fw-bolder">SMKN 1 Maros</h4>
                                <div class="mt-4">
                                    <h6 class="text-muted text-uppercase fw-semibold">Alamat</h6>
                                    <p class="text-muted mb-1" id="address-details">Jl. Ps. Ikan No.63, Allepolea, Kec. Lau, Kabupaten Maros, Sulawesi Selatan</p>
                                    <p class="text-muted mb-0" id="zip-code"><span>Kode Pos:</span> 90511</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 mt-sm-0 mt-3">
                                <h6><span class="text-muted fw-normal">Website:</span> <a href="http://www.smkn1maros.sch.id/" target="_blank" class="link-primary" id="website">www.smkn1maros.sch.id</a></h6>
                                <h6 class="mb-0"><span class="text-muted fw-normal">Contact No:</span> <span id="contact-no"> (0411) 388 1444</span></h6>
                            </div>
                        </div>
                    </div>
                    <!--end card-header-->
                </div>
                <div class="col-lg-12">
                    <div class="card-body p-4 pt-2">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Nama Siswa</th>
                                        <th rowspan="2">NIS</th>
                                        <th colspan="{{ $semua_nilai_mata_pelajaran->groupBy('pertemuan')->count() }}">Nilai Sumatif</th>
                                        <th rowspan="2">Total</th>
                                        <th rowspan="2">Rata-rata</th>
                                    </tr>
                                    <tr>
                                        @foreach ($semua_nilai_mata_pelajaran->sortBy('pertemuan')->groupBy('pertemuan') as $key => $pertemuan)
                                        <th>{{ \App\Models\MataPelajaran::where('id', $mata_pelajaran->id)->first()->kode }}-{{ $pertemuan->first()->pertemuan }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semua_siswa as $siswa)
                                        <tr>
                                            <td>{{ $siswa->nama_lengkap }}</td>
                                            <td>{{ $siswa->nomor_induk }}</td>
                                            @if ($semua_nilai_mata_pelajaran->count() == 0)
                                                <td></td>
                                            @endif
                                            @foreach ($semua_nilai_mata_pelajaran->sortBy('pertemuan')->groupBy('pertemuan') as $key => $pertemuan)
                                                <td>
                                                    @foreach ($semua_nilai_mata_pelajaran as $nilai_mata_pelajaran)
                                                        @if ($nilai_mata_pelajaran->pertemuan == $pertemuan->first()->pertemuan && $nilai_mata_pelajaran->siswa_id == $siswa->id)
                                                        <div class="d-flex gap-2 justify-content-center align-items-center">
                                                            {{ $nilai_mata_pelajaran->nilai }} 
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                </td>
                                            @endforeach
                                            <td>{{ $semua_nilai_mata_pelajaran->where('siswa_id', $siswa->id)->sum('nilai') }}</td>
                                            <td>{{ $semua_nilai_mata_pelajaran->where('siswa_id', $siswa->id)->average('nilai') }}</td>
                                            @if (Auth::user()->role->name == 'Guru')
                                            <td>
                                                <div class="d-flex gap-2 align-items-center">
                                                    <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-create-{{ $siswa->id }}"><i class="ri-file-add-fill me-2"></i>tambah</a>
                                                    @include('pages.nilai-mata-pelajaran._modal_create')
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="border-top border-top-dashed mt-2">
                            
                        </div>
                        <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                            <a href="javascript:window.print()" class="btn btn-soft-primary"><i class="ri-printer-line align-bottom me-1"></i>Print</a>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection
@section('script')
<script>
    document.title = 'CETAK NILAI AKHIR | SIPP SMK Negeri 1 MAROS'
</script>
{{-- <script src="{{ URL::asset('build/js/pages/invoicedetails.js') }}"></script> --}}
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
