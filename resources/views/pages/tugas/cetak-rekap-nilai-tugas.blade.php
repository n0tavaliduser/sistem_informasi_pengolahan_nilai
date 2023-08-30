@extends('layouts.master')
@section('title')
    CETAK NILAI TUGAS
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
    <a href="{{ url()->previous() }}">Nilai Tugas</a>
@endslot
@slot('title')
Detail Nilai Tugas
@endslot
@endcomponent
@php
    $semua_tugas = \App\Models\Tugas::where('mata_pelajaran_id', $mata_pelajaran->id)->where('kelas_id', $kelas->id)->get();
@endphp
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
                            <table class="table">
                                <thead>
                                    <tr class="table-active">
                                        <th rowspan="2">Nama</th>
                                        <th colspan="{{ count($semua_tugas) }}" class="text-center">Tugas Ke-</th>
                                        <th rowspan="2" class="text-center">Total</th>
                                        <th rowspan="2" class="text-center">Rata-rata</th>
                                    </tr>
                                    <tr>
                                        @foreach ($semua_tugas as $index => $tugas)
                                            <td class="text-center">T-{{ ++$index }}</td>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semua_siswa as $siswa)
                                    <tr>
                                        <td>{{ $siswa->nama_lengkap }}</td>
                                        @foreach ($semua_tugas as $tugas)
                                        <td class="text-center">
                                            @if ($semua_pengumpulan_tugas->where('siswa_id', $siswa->id)->where('tugas_id', $tugas->id)->count() != 0)
                                                @foreach ($semua_pengumpulan_tugas as $pengumpulan_tugas) 
                                                    @if ($pengumpulan_tugas->siswa_id == $siswa->id && $pengumpulan_tugas->tugas_id == $tugas->id)
                                                        {{ $pengumpulan_tugas->nilai }}
                                                    @endif
                                                @endforeach
                                            @else
                                                0
                                            @endif
                                        </td>
                                        @endforeach
                                        <td class="text-center">
                                            @if (!empty($pengumpulan_tugas))
                                                {{ $pengumpulan_tugas->where('mata_pelajaran_id', $mata_pelajaran->id)->where('siswa_id', $siswa->id)->sum('nilai') }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if (!empty($pengumpulan_tugas))
                                                {{ substr(number_format($pengumpulan_tugas->where('mata_pelajaran_id', $mata_pelajaran->id)->where('siswa_id', $siswa->id)->average('nilai'), 2, '.', ''), 0, -1) }}
                                            @endif
                                        </td>
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
