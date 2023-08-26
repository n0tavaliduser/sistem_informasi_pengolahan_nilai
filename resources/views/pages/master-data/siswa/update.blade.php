@extends('layouts.master')
@section('title') @lang('translation.basic-tables') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('master-data.siswa.index') }}">Siswa</a> @endslot
@slot('title') Edit @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Edit Data Siswa</h4>
            </div>
            <form method="post" action="{{ route('master-data.siswa.update', $siswa) }}">
                @csrf
                @method('patch')
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="nama_lengkap">Nama lengkap <small class="text-danger">*</small></label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ $siswa?->nama_lengkap }}" class="form-control {{ !$errors->has('nama_lengkap')?:'is-invalid' }}" placeholder="Nama Lengkap" required>
                        @error('nama_lengkap')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nomor_induk">Nomor Induk <span class="text-danger">*</span></label>
                        <input type="number" name="nomor_induk" id="nomor_induk" value="{{ $siswa->nomor_induk }}" class="form-control {{ !$errors->has('nomor_induk')?:'is-invalid' }}" placeholder="Nomor Induk Siswa">
                        @error('nomor_induk')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="telepon">Nomor Telepon <small class="text-danger">*</small></label>
                        <input type="text" name="telepon" id="telepon" value="{{ $siswa?->telepon }}" class="form-control {{ !$errors->has('telepon')?:'is-invalid' }}" placeholder="Nomor Telepon" required>
                        @error('telepon')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="agama">Agama <small class="text-danger">*</small></label>
                        <select name="agama" id="agama" class="form-control {{ !$errors->has('agama')?:'is-invalid' }}">
                            <option value="">Pilih agama</option>
                            <option value="Islam" {{ $siswa->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ $siswa->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katholik" {{ $siswa->agama == 'Katholik' ? 'selected' : '' }}>Katholik</option>
                            <option value="Budha" {{ $siswa->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                            <option value="Hindu" {{ $siswa->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        </select>
                        @error('agama')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin <small class="text-danger">*</small></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control {{ !$errors->has('jenis_kelamin')?:'is-invalid' }}" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki" {{ $siswa?->jenis_kelamin === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $siswa?->jenis_kelamin === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="tempat_lahir">Tempat Lahir <small class="text-danger">*</small></label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ $siswa?->tempat_lahir }}" class="form-control {{ !$errors->has('tempat_lahir')?:'is-invalid' }}" placeholder="Tempat Lahir" required>
                            @error('tempat_lahir')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group mb-3 col-6">
                            <label for="tanggal_lahir">Tanggal Lahir <small class="text-danger">*</small></label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ \Carbon\Carbon::parse($siswa?->tanggal_lahir)->format('Y-m-d') }}" class="form-control {{ !$errors->has('tanggal_lahir')?:'is-invalid' }}" required>
                            @error('tanggal_lahir')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat <small class="text-danger">*</small></label>
                        <textarea name="alamat" id="alamat" class="form-control {{ !$errors->has('alamat')?:'is-invalid' }}" cols="30" rows="3" placeholder="Alamat" required>{{ $siswa?->alamat }}</textarea>
                        @error('alamat')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="kelas_id">Kelas <small class="text-danger">*</small></label>
                        <select name="kelas_id" id="kelas_id" class="form-control {{ !$errors->has('kelas_id')?:'is-invalid' }}">
                            <option value="">Pilih kelas</option>
                            @foreach (\App\Models\Kelas::all() as $kelas)
                            <option value="{{ $kelas->id }}" {{ $siswa->kelas_id == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('master-data.guru.index') }}" class="btn btn-link link-success fw-medium"><i class="ri-close-line me-1 align-middle"></i> Kembali</a>
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
<script src="{{ URL::asset('build/js/pages/modal.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
