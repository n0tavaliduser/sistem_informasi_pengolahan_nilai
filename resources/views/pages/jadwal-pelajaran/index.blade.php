@extends('layouts.master')
@section('title') JADWAL PELAJARAN @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Menu @endslot
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
                                                    @if (Auth::user()->role->name == 'Guru')
                                                        @if ($jadwal_pelajaran->guru_id == \App\Models\Guru::where('user_id', Auth::user()->id)->first()?->id)
                                                        <a href="#" class="text-primary m-0" data-bs-toggle="modal" data-bs-target="#updateModal-{{ $jadwal_pelajaran->id }}">
                                                            <i class="ri-settings-4-line"></i>
                                                        </a>
                                                        @endif
                                                    @elseif (Auth::user()->role->name == 'Admin')
                                                        <a href="#" class="text-primary m-0" data-bs-toggle="modal" data-bs-target="#updateModal-{{ $jadwal_pelajaran->id }}">
                                                            <i class="ri-settings-4-line"></i>
                                                        </a>
                                                    @endif
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
</div>


<!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/modal.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
