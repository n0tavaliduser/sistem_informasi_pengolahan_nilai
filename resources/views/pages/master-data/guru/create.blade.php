@extends('layouts.master')
@section('title') @lang('translation.basic-tables') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') <a href="{{ route('master-data.guru.index') }}">Guru</a> @endslot
@slot('title') Tambah @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        @include('components.alert')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Tambah Guru</h4>
            </div>
            <form method="post" action="{{ route('master-data.guru.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="nama_lengkap">Nama lengkap <small class="text-danger">*</small></label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control {{ !$errors->has('nama_lengkap')?:'is-invalid' }}" placeholder="Nama Lengkap" required>
                        @error('nama_lengkap')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin <small class="text-danger">*</small></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control {{ !$errors->has('jenis_kelamin')?:'is-invalid' }}" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="tanggal_lahir">Tanggal Lahir <small class="text-danger">*</small></label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control {{ !$errors->has('tanggal_lahir')?:'is-invalid' }}" required>
                        @error('tanggal_lahir')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat <small class="text-danger">*</small></label>
                        <textarea name="alamat" id="alamat" class="form-control {{ !$errors->has('alamat')?:'is-invalid' }}" cols="30" rows="3" placeholder="Alamat" required></textarea>
                        @error('alamat')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="jurusan_id">Jurusan <small class="text-danger">*</small></label>
                        <select name="jurusan_id" id="jurusan_id" class="form-control {{ !$errors->has('jurusan_id')?:'is-invalid' }}" required>
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
                        <label for="user_id">User (data login guru) <small class="text-danger">*</small></label>
                        <select name="user_id" id="user_id" class="form-control {{ !$errors->has('user_id')?:'is-invalid' }}" {{ count($users) == 0 ? 'disabled' : '' }} required>
                            <option value="">Pilih user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @if (count($users) == 0)
                            <small>Belum ada user baru dengan role guru yang terdaftar? <a href="">daftar user</a></small>
                        @endif
                        @error('user_id')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('master-data.guru.index') }}" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Kembali</a>
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
