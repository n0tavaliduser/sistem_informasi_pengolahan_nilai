@extends('layouts.master')
@section('title') REKAP ABSENSI @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Menu @endslot
        @slot('title') Rekap Absensi @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-7 row">
                            <form method="get" class="col-9">
                                <div class="row">
                                    <div class="form-group mb-3 col-5">
                                        <label for="kelas_id" class="form-label">Kelas <span class="text-muted">(required)</span> <span class="text-danger">*</span></label>
                                        <select name="kelas_id" id="kelas_id" class="form-control" onchange="this.form.submit()">
                                            <option value="">Pilih kelas</option>
                                            @foreach ($semua_kelas as $kelas)
                                            <option value="{{ $kelas->id }}" {{ Request::get('kelas_id') == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3 col-5">
                                        <label for="mata_pelajaran_id" class="form-label">Mata Pelajaran <span class="text-muted">(required)</span> <span class="text-danger">*</span></label>
                                        <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="form-control" onchange="this.form.submit()">
                                            <option value="">Pilih mata pelajaran</option>
                                            @foreach ($semua_mata_pelajaran as $mata_pelajaran)
                                            <option value="{{ $mata_pelajaran->id }}" {{ Request::get('mata_pelajaran_id') == $mata_pelajaran->id ? 'selected' : '' }}>{{ $mata_pelajaran->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @if (Request::get('mata_pelajaran_id') && Auth::user()->role->name == 'Admin')
                                    <div class="form-group mb-3 col-2">
                                        <label for="" class="text-white">cetak</label>
                                        <a href="{{ route('absensi.cetak', ['kelas' => \App\Models\Kelas::where('id', Request::get('kelas_id'))->first(), 'mata_pelajaran' => \App\Models\MataPelajaran::where('id', Request::get('mata_pelajaran_id'))->first()]) }}" class="btn btn-sm btn-success d-flex align-items-center justify-content-center h-50">Cetak</a>
                                    </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="table-responsive">
                        @if ($semua_tanggal_absensi->count() != 0)
                        <table class="table table-bordered">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Nama</th>
                                    <th>L</th>
                                    <th colspan="{{ $semua_tanggal_absensi->count() }}">REKAP ABSENSI</th>
                                    <th rowspan="2">Hadir</th>
                                    <th rowspan="2">Izin</th>
                                    <th rowspan="2">Alpha</th>
                                </tr>
                                <tr>
                                    <th>P</th>
                                    @foreach ($semua_tanggal_absensi as $tanggal)
                                    <th>{{ \Carbon\Carbon::parse($tanggal[0]->tanggal)->format('d-m-Y') }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semua_siswa as $index => $siswa)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $siswa->nama_lengkap }}</td>
                                    <td class="text-center">@if ($siswa->jenis_kelamin == 'Laki-laki')
                                        L
                                    @else
                                        P                                    
                                    @endif</td>
                                    @foreach ($semua_tanggal_absensi as $absensi)
                                    <td class="text-center">
                                        @foreach ($absensi as $absen)
                                            @if ($absen->siswa_id == $siswa->id && $absen->keterangan == 'Hadir')
                                                <i class="ri-checkbox-fill text-success fs-2"></i>
                                            @elseif ($absen->siswa_id == $siswa->id && $absen->keterangan == 'Alpha')
                                                <i class="ri-close-circle-fill text-danger fs-2"></i>
                                            @elseif ($absen->siswa_id == $siswa->id && $absen->keterangan == 'Izin')
                                                <i class="ri-spam-2-line text-warning fs-2"></i>
                                            @endif
                                        @endforeach
                                    </td>
                                    @endforeach
                                    <td class="text-center">{{ $siswa->absensis->where('mata_pelajaran_id', Request::get('mata_pelajaran_id'))->where('keterangan', 'Hadir')->count() }}</td>
                                    <td class="text-center">{{ $siswa->absensis->where('mata_pelajaran_id', Request::get('mata_pelajaran_id'))->where('keterangan', 'Izin')->count() }}</td>
                                    <td class="text-center">{{ $siswa->absensis->where('mata_pelajaran_id', Request::get('mata_pelajaran_id'))->where('keterangan', 'Alpha')->count() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <!-- Warning Alert -->
                        <div class="alert alert-warning alert-top-border alert-dismissible fade show" role="alert">
                            <i class="ri-alert-line me-3 align-middle fs-16 text-warning"></i><strong>Informasi</strong> - Tidak ada data absensi ditemukan
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                    </div>
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
