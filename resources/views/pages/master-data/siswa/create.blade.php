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
            <form method="post" action="{{ route('master-data..store') }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="tahun_mulai">Tahun Mulai <small class="text-danger">*</small></label>
                            <input type="number" name="tahun_mulai" id="tahun_mulai" value="{{ old('tahun_mulai') }}" class="form-control {{ !$errors->has('tahun_mulai')?:'is-invalid' }}" placeholder="Tahun Mulai" required>
                            @error('tahun_mulai')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3 col-6">
                            <label for="tahun_berakhir">Tahun Berakhir <small class="text-danger">*</small></label>
                            <input type="number" name="tahun_berakhir" id="tahun_berakhir" value="{{ old('tahun_berakhir') }}" class="form-control {{ !$errors->has('tahun_berakhir')?:'is-invalid' }}" placeholder="Tahun Berakhir" required>
                            @error('tahun_berakhir')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
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
