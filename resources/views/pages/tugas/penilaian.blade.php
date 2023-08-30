@extends('layouts.master')
@section('title') NILAI TUGAS @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('root') }}">LMS</a> @endslot
@slot('title') Nilai Tugas @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2 w-50">
                    <form method="get" class="w-100">
                        <div class="d-flex gap-3">
                            <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Pilih mata pelajaran</option>
                                @foreach ($semua_mata_pelajaran as $mata_pelajaran)
                                <option value="{{ $mata_pelajaran->id }}" {{ $mata_pelajaran->id == Request::get('mata_pelajaran_id') ? 'selected' : '' }}>{{ $mata_pelajaran->nama }}</option>
                                @endforeach
                            </select>

                            @if (Auth::user()->role->name == 'Guru')
                            <select name="kelas_id" id="kelas_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Pilih kelas</option>
                                @foreach (\App\Models\Kelas::all() as $kelas)
                                <option value="{{ $kelas->id }}" {{ $kelas->id == Request::get('kelas_id') ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </form>
                    @php
                        $semua_tugas = \App\Models\Tugas::where('mata_pelajaran_id', Request::get('mata_pelajaran_id'))->where('kelas_id', Request::get('kelas_id'))->get();
                    @endphp
                    @if ($semua_tugas->count() > 0)
                        <a href="{{ route('tugas.cetak-rekap-nilai', ['mata_pelajaran' => \App\Models\MataPelajaran::where('id', Request::get('mata_pelajaran_id'))->first(), 'kelas' => \App\Models\Kelas::where('id', Request::get('kelas_id'))->first()]) }}" class="btn btn-success">Cetak</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (Auth::user()->role->name == 'Guru')
                    
                    @if ($semua_tugas->count() == 0)
                        tidak ada data ditemukan
                    @else
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
                                        {{ $pengumpulan_tugas->where('mata_pelajaran_id', Request::get('mata_pelajaran_id'))->where('siswa_id', $siswa->id)->sum('nilai') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if (!empty($pengumpulan_tugas))
                                        {{ substr(number_format($pengumpulan_tugas->where('mata_pelajaran_id', Request::get('mata_pelajaran_id'))->where('siswa_id', $siswa->id)->average('nilai'), 2, '.', ''), 0, -1) }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
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
