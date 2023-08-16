@extends('layouts.master')
@section('title') @lang('translation.basic-tables') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('master-data.kelas.index') }}">Kelas</a> @endslot
@slot('title') Tambah @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Tambah Kelas</h4>
            </div>
            <form method="post" action="{{ route('master-data.kelas.store') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="nama_kelas">Nama Kelas <small class="text-danger">*</small></label>
                            <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas') }}" class="form-control {{ !$errors->has('nama_kelas')?:'is-invalid' }}" placeholder="Nama Kelas" required>
                            @error('nama_kelas')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3 col-6">
                            <label for="tingkat">Tingkat <small class="text-danger">*</small></label>
                            <input type="number" name="tingkat" id="tingkat" value="{{ old('tingkat') }}" class="form-control {{ !$errors->has('tingkat')?:'is-invalid' }}" placeholder="Tingkat" required>
                            @error('tingkat')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="guru_id">Guru <small class="text-danger">*</small></label>
                            <select name="guru_id" id="guru_id" class="form-control {{ !$errors->has('guru_id')?:'is-invalid' }}">
                                <option value="">Pilih guru</option>
                                @foreach ($semua_guru as $guru)
                                    <option value="{{ $guru->id }}">{{ $guru->nama_lengkap }}</option>
                                @endforeach
                            </select>
                            @error('guru_id')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="jurusan_id">Jurusan <small class="text-danger">*</small></label>
                            <select name="jurusan_id" id="jurusan_id" class="form-control {{ !$errors->has('jurusan_id')?:'is-invalid' }}">
                                <option value="">Pilih jurusan</option>
                                @foreach ($semua_jurusan as $jurusan)
                                    <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                                @endforeach
                            </select>
                            @error('jurusan_id')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tahun_ajaran_id">Tingkat <small class="text-danger">*</small></label>
                            <select name="tahun_ajaran_id" id="tahun_ajaran_id" class="form-control {{ !$errors->has('tahun_ajaran_id')?:'is-invalid' }}">
                                <option value="">Pilih tahun ajaran</option>
                                @foreach ($semua_tahun_ajaran as $tahun_ajaran)
                                <option value="{{ $tahun_ajaran->id }}">{{ $tahun_ajaran->tahun_mulai }} - {{ $tahun_ajaran->tahun_berakhir }}</option>
                                @endforeach
                            </select>
                            @error('tahun_ajaran_id')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('master-data.kelas.index') }}" class="btn btn-link link-success fw-medium"><i class="ri-close-line me-1 align-middle"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
{{-- <script src="{{ URL::asset('build/js/pages/modal.init.js') }}"></script> --}}

<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
