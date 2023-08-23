@extends('layouts.master')
@section('title') BUKU ABSENSI @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('absensi.index') }}">Absensi</a> @endslot
@slot('title') Daftar Siswa @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-end align-items-center">
                <div class="d-flex gap-2">
                    <a href="{{ route('tugas.index') }}" class="btn btn-outline-primary btn-border">
                        <i class="ri-refresh-line"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Jumlah Absensi</th>
                                <th>Persentase Absensi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua_siswa as $siswa)
                                <tr>
                                    <td>{{ $siswa->nama_lengkap }}</td>
                                    @php
                                        $jumlahHadir = \App\Models\Absensi::where('siswa_id', $siswa->id)->where('mata_pelajaran_id', $mata_pelajaran->id)->where('kelas_id', $kelas->id)->where('keterangan', 'Hadir')->count();
                                        $jumlahIzin = \App\Models\Absensi::where('siswa_id', $siswa->id)->where('mata_pelajaran_id', $mata_pelajaran->id)->where('kelas_id', $kelas->id)->where('keterangan', 'Izin')->count() * 0.5;
                                    @endphp
                                    <td>{{ $jumlahHadir + $jumlahIzin }} / 16</td>
                                    <td>{{ ($jumlahHadir + $jumlahIzin) / 16 * 100 }}%</td>
                                    <td>
                                        @php
                                            $absensis = $siswa->absensis->where('mata_pelajaran_id', $mata_pelajaran->id)->where('siswa_id', $siswa->id);

                                            $tanggal_absensi = [];
                                            foreach ($absensis as $absensi) {
                                                array_push($tanggal_absensi, \Carbon\Carbon::parse($absensi->tanggal)->format('Y-m-d'));
                                            }

                                            $absensi = false;
                                            if (in_array(\Carbon\Carbon::now()->format('Y-m-d'), $tanggal_absensi)) {
                                                $absensi = true;
                                            }
                                        @endphp
                                        @if (!$absensi)
                                        <div class="d-flex gap-2">
                                            <form method="post" action="{{ route('absensi.store', ['siswa' => $siswa, 'jadwal' => $jadwal]) }}">
                                                @csrf
                                                <input type="hidden" name="keterangan" id="keterangan" value="Hadir">
                                                <button type="submit" class="btn btn-success btn-sm">hadir</button>
                                            </form>
                                            <form method="post" action="{{ route('absensi.store', ['siswa' => $siswa, 'jadwal' => $jadwal]) }}">
                                                @csrf
                                                <input type="hidden" name="keterangan" id="keterangan" value="Izin">
                                                <button type="submit" class="btn btn-warning btn-sm">izin</button>
                                            </form>
                                            <form method="post" action="{{ route('absensi.store', ['siswa' => $siswa, 'jadwal' => $jadwal]) }}">
                                                @csrf
                                                <input type="hidden" name="keterangan" id="keterangan" value="Alpha">
                                                <button type="submit" class="btn btn-danger btn-sm">tidak masuk</button>
                                            </form>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
