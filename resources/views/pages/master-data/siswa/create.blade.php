@extends('layouts.master')
@section('title') @lang('translation.basic-tables') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('master-data.siswa.index') }}">Siswa</a> @endslot
@slot('title') Tambah @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Tambah Siswa</h4>
            </div>
            <form method="post" action="{{ route('master-data.siswa.store') }}">
                @csrf
                <div class="card-body">

                    <input type="text" name="role_id" id="role_id" value="{{ \App\Models\Role::where('name', 'Siswa')->first()->id }}" style="display: none;">

                    <div class="form-group mb-3">
                        <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control {{ !$errors->has('nama_lengkap')?:'is-invalid' }}" placeholder="Nama Lengkap Siswa">
                        @error('nama_lengkap')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nomor_induk">Nomor Induk <span class="text-danger">*</span></label>
                        <input type="number" name="nomor_induk" id="nomor_induk" class="form-control {{ !$errors->has('nomor_induk')?:'is-invalid' }}" placeholder="Nomor Induk Siswa">
                        @error('nomor_induk')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control {{ !$errors->has('tempat_lahir')?:'is-invalid' }}" placeholder="Nomor Telepon">
                            @error('tempat_lahir')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3 col-6">
                            <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control {{ !$errors->has('tanggal_lahir')?:'is-invalid' }}" placeholder="Nomor Telepon">
                            @error('tanggal_lahir')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="alamat">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" id="alamat" cols="30" rows="4" class="form-control {{ !$errors->has('alamat')?:'is-invalid' }}" placeholder="Alamat"></textarea>
                        @error('alamat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control {{ !$errors->has('jenis_kelamin')?:'is-invalid' }}">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="agama">Agama <span class="text-danger">*</span></label>
                        <select name="agama" id="agama" class="form-control {{ !$errors->has('agama')?:'is-invalid' }}">
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Budha">Budha</option>
                            <option value="Hindu">Hindu</option>
                        </select>
                        @error('agama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="telepon">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="telepon" id="telepon" class="form-control {{ !$errors->has('telepon')?:'is-invalid' }}" placeholder="Nomor Telepon">
                        @error('telepon')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control {{ !$errors->has('email')?:'is-invalid' }}" placeholder="Email">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="kelas_id">Kelas <span class="text-danger">*</span></label>
                        <select name="kelas_id" id="kelas_id" class="form-control {{ !$errors->has('kelas_id')?:'is-invalid' }}">
                            <option value="">Pilih kelas</option>
                            @foreach (\App\Models\Kelas::all() as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('master-data.siswa.index') }}" class="btn btn-link link-success fw-medium"><i class="ri-close-line me-1 align-middle"></i> Kembali</a>
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
