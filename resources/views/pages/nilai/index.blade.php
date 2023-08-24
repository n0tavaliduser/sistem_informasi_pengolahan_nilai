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
                                @foreach (\App\Models\Kelas::all() as $kelas)
                                <option value="{{ $kelas->id }}" {{ $kelas->id == Request::get('kelas_id') ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>

                            @if (Request::get('kelas_id'))
                            <select name="siswa_id" id="siswa_id" class="form-control" onchange="this.form.submit()">
                                <option value="">Pilih siswa</option>
                                @foreach (\App\Models\Siswa::where('kelas_id', Request::get('kelas_id'))->get() as $siswa)
                                <option value="{{ $siswa->id }}" {{ $siswa->id == Request::get('siswa_id') ? 'selected' : '' }}>{{ $siswa->nama_lengkap }}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (!empty(Request::get('siswa_id')))
                    <table class="table-bordered table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua_mata_pelajaran as $index => $mata_pelajaran)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $mata_pelajaran->nama }}</td>
                                    <td>
                                        @foreach ($semua_nilai as $nilai)
                                            @if ($nilai->mata_pelajaran_id == $mata_pelajaran->id)
                                                @if ($nilai->nilai)
                                                    {{ $nilai->nilai }}
                                                @endif
                                            @endif
                                        @endforeach
                                        @if ($semua_nilai->where('mata_pelajaran_id', $mata_pelajaran->id)->count() == 0)
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-create">
                                            <i class="ri-quill-pen-line text-success fs-5"></i>
                                        </a>
                                        @include('pages.nilai._modal_create')
                                        @else
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-update-{{ $mata_pelajaran->id }}">
                                            <i class="ri-settings-4-line fs-5"></i>
                                        </a>
                                        @include('pages.nilai._modal_update')
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2" class="text-end fw-bolder">Total</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-end fw-bolder">Rata-rata</td>
                                <td></td>
                            </tr>
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
