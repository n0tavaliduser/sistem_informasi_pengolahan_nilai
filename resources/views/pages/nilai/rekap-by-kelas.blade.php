@extends('layouts.master')
@section('title') REKAP NILAI AKHIR @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('nilai.ranking', $kelas) }}">Rekap Nilai</a> @endslot
        @slot('title') {{ $kelas->nama_kelas }} @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5>Rekap Nilai Kelas {{ $kelas->nama_kelas }}</h5>

                        <form method="get">
                            <div class="d-flex gap-3">
                                <div class="form-group">
                                    <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="form-control" onchange="this.form.submit()">
                                        <option value="">Semua mata pelajaran</option>
                                        @foreach ($semua_mata_pelajaran as $mata_pelajaran)
                                            <option value="{{ $mata_pelajaran->id }}" {{ $mata_pelajaran->id == Request::get('mata_pelajaran_id') ? 'selected' : '' }}>{{ $mata_pelajaran->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @if ($semua_nilai->count() > 0)
                                    
                                @endif
                                <div class="form-group">
                                    @php
                                        $mata_pelajaran_id = \App\Models\MataPelajaran::where('id', Request::get('mata_pelajaran_id'))->first()?->id;
                                    @endphp
                                    <a class="btn btn-md btn-success" href="{{ route('nilai.cetak-by-kelas', ['kelas' => $kelas, 'mata_pelajaran_id' => $mata_pelajaran_id == null ? null : $mata_pelajaran_id]) }}">cetak</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-bordered table">
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
                                    <tr>
                                        <td rowspan="{{ \App\Models\Siswa::where('kelas_id', $kelas->id)->count() + 1 }}">{{ $mata_pelajaran->nama }}</td>
                                    </tr>
                                    @foreach ($semua_nilai->where('mata_pelajaran_id', $mata_pelajaran->id)->sortByDesc('nilai') as $nilai)
                                    <tr>
                                        <td>{{ $nilai->siswa?->nama_lengkap }}</td>
                                        <td>{{ $nilai->nilai }}</td>
                                    </tr>
                                    @endforeach
                                @endforeach
                                <tr>
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
                </div>
            </div>
        </div>
    </div>

@endsection