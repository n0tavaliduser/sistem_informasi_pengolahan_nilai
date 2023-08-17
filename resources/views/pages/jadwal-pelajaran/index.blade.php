@extends('layouts.master')
@section('title') @lang('translation.basic-tables') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Master Data @endslot
@slot('title') Jadwal Pelajaran @endslot
@endcomponent

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-7">
                        <form method="get">
                            <div class="row">
                                <div class="form-group mb-3 col-6">
                                    <label for="find_by_hari" class="form-label">Hari</label>
                                    <select name="find_by_hari" id="find_by_hari" class="form-control" onchange="this.form.submit()">
                                        <option value="">Pilih hari</option>
                                        <option value="Senin" {{ Request::get('find_by_hari') === 'Senin' ? 'selected' : '' }}>Senin</option>
                                        <option value="Selasa" {{ Request::get('find_by_hari') === 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                        <option value="Rabu" {{ Request::get('find_by_hari') === 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                        <option value="Kamis" {{ Request::get('find_by_hari') === 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                        <option value="Jumat" {{ Request::get('find_by_hari') === 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3 col-6">
                                    <label for="find_by_tingkat" class="form-label">Kelas</label>
                                    <select name="find_by_tingkat" id="find_by_tingkat" class="form-control" onchange="this.form.submit()">
                                        <option value="">Pilih tingkat</option>
                                        <option value="10" {{ Request::get('find_by_tingkat') === '10' ? 'selected' : '' }}>X</option>
                                        <option value="11" {{ Request::get('find_by_tingkat') === '11' ? 'selected' : '' }}>XI</option>
                                        <option value="12" {{ Request::get('find_by_tingkat') === '12' ? 'selected' : '' }}>XII</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    @php
                    $data_kelas = \App\Models\Kelas::where('tingkat', '12')->get();
                    $data_jadwal = \App\Models\JadwalPelajaran::all();
                    $hari = 'Senin';

                    if (!empty(Request::get("find_by_hari"))) $hari = Request::get('find_by_hari');
                    if (!empty(Request::get("find_by_tingkat"))) $data_kelas = \App\Models\Kelas::where('tingkat', Request::get('find_by_tingkat'))->get();;
                    @endphp
                    <table class="table table-bordered border-dark table-nowrap text-center">
                        <thead>
                            <tr>
                                <th rowspan="2">HARI</th>
                                <th rowspan="2">WAKTU</th>
                                <th colspan="{{ $data_kelas->count() }}">KELAS</th>
                            </tr>
                            <tr>
                                @foreach ($data_kelas as $kelas)
                                <th>{{ $kelas->nama_kelas }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="{{ $data_jadwal->where('hari', $hari)->count() + 3 }}">{{ $hari }}</td>
                                @if($hari === 'Senin')
                                <td>07:30 - 08:15</td>
                                <td colspan="{{ $data_kelas->count() }}"><span class="fw-bolder">UPACARA BENDERA</span></td>
                                @endif
                            </tr>

                            @foreach ($data_jadwal->where('hari', $hari) as $jadwal)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_berakhir)->format('H:i') }}</td>
                                @foreach ($data_kelas as $kelas)
                                <td>
                                    @if($kelas->jadwal_pelajarans)
                                        @foreach (\App\Models\JadwalPelajaran::where('hari', $hari)->get() as $jadwal_pelajaran)
                                            @if($jadwal_pelajaran->jam_mulai == $jadwal->jam_mulai && $jadwal_pelajaran->kelas_id == $kelas->id)
                                                {{-- @if(!empty($jadwal_pelajaran->mata_pelajaran)) --}}
                                                    {{ $jadwal_pelajaran->mata_pelajaran?->kode }}
                                                {{-- @else --}}
                                                    {{-- sudah ada jadwal namun belum ada mata pelajaran --}}
                                                    <a href="#" class="text-primary m-0" data-bs-toggle="modal" data-bs-target="#updateModal-{{ $jadwal_pelajaran->id }}">
                                                        <i class="ri-settings-4-line"></i>
                                                    </a>
                                                    @include('pages.jadwal-pelajaran._modal_update')
                                                {{-- @endif                                 --}}
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                @endforeach
                            </tr>

                            @if (\Carbon\Carbon::parse($jadwal->jam_berakhir)->format('H:i') == '15:30')
                                @break
                            @endif

                            @if($hari != 'Jumat')
                                @if (\Carbon\Carbon::parse($jadwal->jam_berakhir)->format('H:i') === '10:30')
                                <tr>
                                    <td>10:30 - 10:45</td>
                                    <td colspan="{{ $data_kelas->count() }}"><span class="fw-bolder">ISTIRAHAT</span></td>
                                </tr>
                                @endif
                            @else
                                @if (\Carbon\Carbon::parse($jadwal->jam_berakhir)->format('H:i') === '10:15')
                                <tr>
                                    <td>10:15 - 10:30</td>
                                    <td colspan="{{ $data_kelas->count() }}"><span class="fw-bolder">ISTIRAHAT</span></td>
                                </tr>
                                @endif
                            @endif

                            @if($hari != 'Jumat')
                                @if (\Carbon\Carbon::parse($jadwal->jam_berakhir)->format('H:i') === '12:15')
                                <tr>
                                    <td>12:15 - 12:30</td>
                                    <td colspan="{{ $data_kelas->count() }}"><span class="fw-bolder">ISTIRAHAT</span></td>
                                </tr>
                                @endif
                            @else
                                @if (\Carbon\Carbon::parse($jadwal->jam_berakhir)->format('H:i') === '12:00')
                                <tr>
                                    <td rowspan="2">12:15 - 12:30</td>
                                    <td colspan="{{ $data_kelas->count() }}"><span class="fw-bolder">A G M</span></td>
                                </tr>
                                <tr>
                                    <td colspan="{{ $data_kelas->count() }}"><span class="fw-bolder">I S H O M A</span></td>
                                </tr>
                                @endif
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="col-xl-3">
        <div class="card">
            <form method="post" action="{{ route('jadwal-pelajaran.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="hari">Hari</label>
                        <select name="hari" id="hari" value="{{ old('hari') }}" class="form-control {{ !$errors->has('hari')?:'is-invalid' }}">
                            <option value="">Pilih hari</option>
                            <option value="Senin" selected>Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                        @error('hari')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai') }}" class="form-control {{ !$errors->has('jam_mulai')?:'is-invalid' }}">
                        @error('jam_mulai')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="jam_berakhir">Jam Berakhir</label>
                        <input type="time" name="jam_berakhir" id="jam_berakhir" value="{{ old('jam_berakhir') }}" class="form-control {{ !$errors->has('jam_berakhir')?:'is-invalid' }}">
                        @error('jam_berakhir')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="kelas_id">Kelas</label>
                        <select name="kelas_id" id="kelas_id" value="{{ old('kelas_id') }}" class="form-control {{ !$errors->has('kelas_id')?:'is-invalid' }}">
                            <option value="">Pilih kelas</option>
                            @foreach ($semua_kelas as $kelas)
                            <option value="{{ $kelas->id }}" {{ $kelas->nama_kelas === 'XII APAT B' ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="tahun_ajaran_id">Tahun Ajaran</label>
                        <select name="tahun_ajaran_id" id="tahun_ajaran_id" value="{{ old('tahun_ajaran_id') }}" class="form-control {{ !$errors->has('tahun_ajaran_id')?:'is-invalid' }}">
                            <option value="">Pilih tahun ajaran</option>
                            @foreach ($semua_tahun_ajaran as $tahun_ajaran)
                            <option value="{{ $tahun_ajaran->id }}" selected>{{ $tahun_ajaran->tahun_mulai }} - {{ $tahun_ajaran->tahun_berakhir }}</option>
                            @endforeach
                        </select>
                        @error('tahun_ajaran_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="semester">Semester</label>
                        <select name="semester" id="semester" class="form-control {{ !$errors->has('semester')?:'is-invalid' }}">
                            <option value="">Pilih semester</option>
                            <option value="Ganjil" selected>Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                        @error('semester')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="guru_id">Guru</label>
                        <select name="guru_id" id="guru_id" class="form-control {{ !$errors->has('guru_id')?:'is-invalid' }}">
                            <option value="">Pilih guru</option>
                            @foreach ($semua_guru as $guru)
                            <option value="{{ $guru->id }}">{{ $guru->nama_lengkap }}</option>
                            @endforeach
                        </select>
                        @error('guru_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="mata_pelajaran_id">Mata Pelajaran</label>
                        <select name="mata_pelajaran_id" id="mata_pelajaran_id" class="form-control {{ !$errors->has('mata_pelajaran_id')?:'is-invalid' }}">
                            <option value="">Pilih mata pelajaran</option>
                            @foreach ($semua_mata_pelajaran as $mata_pelajaran)
                            <option value="{{ $mata_pelajaran->id }}">{{ $mata_pelajaran->nama }}</option>
                            @endforeach
                        </select>
                        @error('mata_pelajaran_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary ">Tambah</button>
                </div>
            </form>
        </div>
    </div> --}}
</div>


<!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/modal.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
