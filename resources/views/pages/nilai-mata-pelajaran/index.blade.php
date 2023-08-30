@extends('layouts.master')
@section('title') PENGOLAHAN NILAI @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('root') }}">LMS</a> @endslot
@slot('title') Pengolahan Nilai @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex gap-2 w-50">
                    <form method="get" class="w-100">
                        <div class="d-flex gap-3">
                            <select name="kelas_id" id="kelas_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Pilih kelas</option>
                                @foreach ($semua_kelas as $kelas)
                                <option value="{{ $kelas->id }}" {{ $kelas->id == Request::get('kelas_id') ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>

                            @if (Request::get('kelas_id'))
                                <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="form-control" onchange="this.form.submit()">
                                    <option value="">Pilih mata pelajaran</option>
                                    @foreach ($semua_mata_pelajaran as $mata_pelajaran)
                                    <option value="{{ $mata_pelajaran->id }}" {{ $mata_pelajaran->id == Request::get('mata_pelajaran_id') ? 'selected' : '' }}>{{ $mata_pelajaran->nama }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </form>
                    @if (Request::get('mata_pelajaran_id'))
                        <a href="{{ route('nilai-mata-pelajaran.cetak', ['kelas' => \App\Models\Kelas::where('id', Request::get('kelas_id'))->first(), 'mata_pelajaran' => \App\Models\MataPelajaran::where('id', Request::get('mata_pelajaran_id'))->first()]) }}" class="btn btn-success">cetak</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (Request::get('mata_pelajaran_id'))
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th rowspan="2">Nama Siswa</th>
                                    <th rowspan="2">NIS</th>
                                    <th colspan="{{ $semua_nilai_mata_pelajaran->groupBy('pertemuan')->count() }}">Nilai Sumatif</th>
                                    <th rowspan="2">Total</th>
                                    <th rowspan="2">Rata-rata</th>
                                    @if (Auth::user()->role->name == 'Guru')
                                    <th rowspan="2">Action</th>
                                    @endif
                                </tr>
                                <tr>
                                    @foreach ($semua_nilai_mata_pelajaran->sortBy('pertemuan')->groupBy('pertemuan') as $key => $pertemuan)
                                    <th>{{ \App\Models\MataPelajaran::where('id', Request::get('mata_pelajaran_id'))->first()->kode }}-{{ $pertemuan->first()->pertemuan }}</th>
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
                                                        @if (Auth::user()->role->name == 'Guru')
                                                        <form method="post" action="{{ route('nilai-mata-pelajaran.destroy', $nilai_mata_pelajaran) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="p-0 m-0 btn"><i class="ri-delete-bin-line text-danger"></i></button>
                                                        </form>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-update-{{ $nilai_mata_pelajaran->id }}"><i class="ri-ball-pen-line"></i></a>
                                                        @endif
                                                    </div>
                                                    @include('pages.nilai-mata-pelajaran._modal_update')
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
