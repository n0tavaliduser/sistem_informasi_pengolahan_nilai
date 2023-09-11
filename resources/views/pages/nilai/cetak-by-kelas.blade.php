@extends('layouts.master')
@section('title')
    CETAK NILAI AKHIR
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')
    <a href="{{ url()->previous() }}">Nilai Akhir</a>
@endslot
@slot('title')
Detail Nilai Akhir
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
                    <div class="card-body p-4 pb-0 border-top border-top-dashed">
                        <div class="row g-3">
                            <div class="col-6">
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Informasi</h6>
                                <p class="fw-medium mb-2" id="billing-name"><span class="text-muted">Rekap Nilai Akhir {{ $kelas->nama_kelas }}</span></p>
                                <p class="text-muted mb-1" id="billing-address-line-1">Wali Kelas : {{ $kelas->guru?->nama_lengkap }}</p>
                                {{-- <p class="text-muted mb-1"><span>Telepon: +</span><span id="billing-phone-no">{{ $siswa->telepon }}</span></p>
                                <p class="text-muted mb-0"><span>Jurusan: </span><span id="billing-tax-no">{{ $siswa->kelas?->jurusan?->nama_jurusan }}</span> </p> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-lg-12">
                    <div class="card-body p-4 pt-2">
                        <div class="table-responsive">
                            <table class="table-borderless table table-nowrap">
                                <thead>
                                    <tr>
                                        <th>Mata Pelajaran</th>
                                        <th>Nama Siswa</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        if (!empty(Request::get('mata_pelajaran_id'))) {
                                            $semua_mata_pelajaran = $semua_mata_pelajaran->where('id', Request::get('mata_pelajaran_id'));
                                        }
                                    @endphp
                                    @foreach ($semua_mata_pelajaran as $mata_pelajaran)
                                        <tr class="border-top">
                                            <td rowspan="{{ \App\Models\Siswa::where('kelas_id', $kelas->id)->count() + 1 }}">{{ $mata_pelajaran->nama }}</td>
                                        </tr>
                                        @foreach ($semua_nilai->where('mata_pelajaran_id', $mata_pelajaran->id) as $nilai)
                                        <tr>
                                            <td>{{ $nilai->siswa?->nama_lengkap }}</td>
                                            <td>{{ $nilai->nilai }}</td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
                        <div class="border-top border-top-dashed mt-2">
                            <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                <tbody>
                                    <tr class="border-top">
                                        <td colspan="2" class="text-end fw-bolder">Total</td>
                                        <td>{{ $semua_nilai->sum('nilai') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-end fw-bolder">Rata-rata</td>
                                        @php
                                            $average = $semua_nilai->average('nilai');
    
                                            $average_format = number_format($average, 2, '.', '');
    
                                            $average_dua_desimal = substr($average_format, 0, -1);
                                        @endphp
                                        <td>{{ $average_dua_desimal }}</td>
                                    </tr>
                                </tbody>
                            </table>
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
