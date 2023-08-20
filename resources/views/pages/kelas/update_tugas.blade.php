@extends('layouts.master')
@section('title') @lang('translation.basic-tables') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('manajemen-kelas.ruang-kelas', $jadwal) }}">Ruang Kelas</a> @endslot
@slot('title') Edit Tugas @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Edit Tugas</h4>
            </div>
            <form method="post" action="{{ route('tugas.update', $tugas) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="judul">Judul Tugas <small class="text-danger">*</small></label>
                        <input type="text" name="judul" id="judul" value="{{ $tugas->judul }}" class="form-control {{ !$errors->has('judul')?:'is-invalid' }}" placeholder="Judul Tugas">
                        @error('judul')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi <small class="text-danger">*</small></label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control {{ !$errors->has('deskripsi')?:'is-invalid' }}" placeholder="Deskripsi Tugas">{{ $tugas->deskripsi }}</textarea>
                        @error('deskripsi')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="tanggal_deadline">Batas Waktu <small class="text-danger">*</small></label>
                        <input type="date" name="tanggal_deadline" id="tanggal_deadline" value="{{ \Carbon\Carbon::parse($tugas->tanggal_deadline)->format('Y-m-d') }}" class="form-control {{ !$errors->has('tanggal_deadline')?:'is-invalid' }}">
                        @error('tanggal_deadline')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="file">File <span class="text-muted">(jika ada)</span></label>
                        <input type="file" name="file" id="file" class="form-control {{ !$errors->has('file')?:'is-invalid' }}">
                        @error('file')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="tipe">Tipe Tugas <small class="text-danger">*</small> <span class="text-muted">(contoh: Tugas Harian / Tugas Mingguan / dsb)</span></label>
                        <input type="text" name="tipe" id="tipe" value="{{ $tugas->tipe }}" class="form-control {{ !$errors->has('tipe')?:'is-invalid' }}" placeholder="Tipe Tugas">
                        @error('tipe')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('manajemen-kelas.ruang-kelas', $jadwal) }}" class="btn btn-link link-success fw-medium"><i class="ri-close-line me-1 align-middle"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary ">Update</button>
                </div>
            </form>
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
