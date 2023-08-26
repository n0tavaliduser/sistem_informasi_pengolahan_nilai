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
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Informasi Absensi</h6>
                                <p class="fw-medium mb-2" id="billing-name">{{ $kelas->nama_lengkap }}</p>
                                <p class="text-muted mb-1" id="billing-address-line-1">{{ $kelas->alamat }}</p>
                                <p class="text-muted mb-1"><span>Kelas: </span><span id="billing-phone-no">{{ $kelas->nama_kelas }}</span></p>
                                <p class="text-muted mb-1"><span>Mata Pelajaran: </span><span id="billing-tax-no">{{ $mata_pelajaran->nama }}</span> </p>
                                <p class="text-muted mb-0"><span>Tahun Akademik: </span><span id="billing-tax-no">{{ \App\Models\TahunAjaran::where('status', 'active')->first()->tahun_mulai }}/{{ \App\Models\TahunAjaran::where('status', 'active')->first()->tahun_berakhir }}</span> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-lg-12">
                    <div class="card-body p-4 pt-2">
                        <div>
                            <table class="table table-bordered text-center table-nowrap align-middle mb-0" style="font-size: 12px;">
                                <thead>
                                    <tr class="">
                                        <th rowspan="2" scope="col" style="width: 50px;">No</th>
                                        <th rowspan="2" scope="col">Nama Siswa</th>
                                        <th rowspan="2" scope="col">NIS</th>
                                        <th scope="col">L</th>
                                        <th scope="col" colspan="{{ $semua_tanggal_absensi->count() }}">REKAP ABSENSI</th>
                                        <th scope="col" rowspan="2">Hadir</th>
                                        <th scope="col" rowspan="2">Izin</th>
                                        <th scope="col" rowspan="2">Alpha</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">P</th>
                                        @foreach ($semua_tanggal_absensi as $tanggal)
                                        <th scope="col">{{ \Carbon\Carbon::parse($tanggal[0]->tanggal)->format('d-m-Y') }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody id="products-list">
                                    @foreach ($semua_siswa as $index => $siswa)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $siswa->nama_lengkap }}</td>
                                        <td>{{ $siswa->nomor_induk }}</td>
                                        <td class="text-center">@if ($siswa->jenis_kelamin == 'Laki-laki')
                                            L
                                            @else
                                            P
                                            @endif</td>
                                        @foreach ($semua_tanggal_absensi as $absensi)
                                        <td class="text-center">
                                            @foreach ($absensi as $absen)
                                            @if ($absen->siswa_id == $siswa->id && $absen->keterangan == 'Hadir')
                                            <i class="bx bx-check text-success fs-6"></i>
                                            @elseif ($absen->siswa_id == $siswa->id && $absen->keterangan == 'Alpha')
                                            <i class="bx bx-x text-danger fs-6"></i>
                                            @elseif ($absen->siswa_id == $siswa->id && $absen->keterangan == 'Izin')
                                            <i class="bx bx-minus text-warning fs-6"></i>
                                            @endif
                                            @endforeach
                                        </td>
                                        @endforeach
                                        <td class="text-center">{{ $siswa->absensis->where('mata_pelajaran_id', $mata_pelajaran->id)->where('keterangan', 'Hadir')->count() }}</td>
                                        <td class="text-center">{{ $siswa->absensis->where('mata_pelajaran_id', $mata_pelajaran->id)->where('keterangan', 'Izin')->count() }}</td>
                                        <td class="text-center">{{ $siswa->absensis->where('mata_pelajaran_id', $mata_pelajaran->id)->where('keterangan', 'Alpha')->count() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--end table-->
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
    document.title = 'CETAK REKAP ABSENSI | SIPP SMK Negeri 1 MAROS'

</script>
{{-- <script src="{{ URL::asset('build/js/pages/invoicedetails.js') }}"></script> --}}
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
