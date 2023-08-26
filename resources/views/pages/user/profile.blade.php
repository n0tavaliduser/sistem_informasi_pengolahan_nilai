@extends('layouts.master')
@section('title')
@lang('translation.profile')
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">
@endsection
@section('content')
<div class="profile-foreground position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg">
        <img src="{{ URL::asset('build/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" />
    </div>
</div>
<div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
    <div class="row g-4">
        <div class="col-auto">
            <div class="profile-user position-relative d-inline-block mx-auto">
                <img src="@if (Auth::user()->avatar != '') {{ URL::asset('storage/' . Auth::user()->avatar) }}@else{{ URL::asset('assets/img/person-dummy.jpg') }} @endif"
                    class="rounded-circle avatar-lg img-thumbnail user-profile-image" alt="user-profile-image">
                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                    <form method="post" action="{{ route('user.change-profile-pic', Auth::user()) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input id="avatar" name="avatar" type="file" class="profile-img-file-input" onchange="this.form.submit()">
                        <label for="avatar" class="profile-photo-edit avatar-xs">
                            <span class="avatar-title rounded-circle bg-light text-body">
                                <i class="ri-camera-fill"></i>
                            </span>
                        </label>
                    </form>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col">
            <div class="p-2">
                <h3 class="text-white mb-1">{{ Auth::user()->name }}</h3>
                <p class="text-white-75">{{ Auth::user()->kelas?->nama_kelas }}</p>
                <div class="hstack text-white-50 gap-1">
                    <div class="me-2"><i class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>{{ Auth::user()->siswas->where('user_id', Auth::user()->id)->first()?->alamat }}</div>
                    <div><i class="ri-mail-fill me-1 text-white-75 fs-16 align-middle"></i>{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div>
            <div class="d-flex profile-wrapper">
                <!-- Nav tabs -->
                <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#detail-tab" role="tab">
                            <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Detail</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-14" data-bs-toggle="tab" href="#ganti-password" role="tab">
                            <i class="ri-list-unordered d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Ganti Password</span>
                        </a>
                    </li>
                </ul>
                @if (Auth::user()->role->name == 'Siswa')
                <div class="flex-shrink-0">
                    <a href="{{ route('user.edit-siswa-profile', \App\Models\Siswa::where('user_id', Auth::user()->id)->first()) }}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                </div>
                @endif

                @if (Auth::user()->role->name == 'Guru')
                <div class="flex-shrink-0">
                    <a href="{{ route('user.edit-guru-profile', \App\Models\Guru::where('user_id', Auth::user()->id)->first()) }}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                </div>
                @endif
            </div>

            <div class="mt-3">
                @include('components.alert')
            </div>
            <!-- Tab panes -->
            <div class="tab-content pt-4 text-muted">
                <div class="tab-pane active" id="detail-tab" role="tabpanel">
                    <div class="row">
                        <div class="col-xxl-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Informasi</h5>
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <th class="ps-0" scope="row">Nama Lengkap :</th>
                                                    <td class="text-muted">{{ Auth::user()->siswas->where('user_id', Auth::user()->id)->first()?->nama_lengkap }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Jenis Kelamin :</th>
                                                    <td class="text-muted">{{ Auth::user()->siswas->where('user_id', Auth::user()->id)->first()?->jenis_kelamin }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Nomor Telp :</th>
                                                    <td class="text-muted">{{ Auth::user()->siswas->where('user_id', Auth::user()->id)->first()?->telepon }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Agama :</th>
                                                    <td class="text-muted">{{ Auth::user()->siswas->where('user_id', Auth::user()->id)->first()?->agama }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Email :</th>
                                                    <td class="text-muted">{{ Auth::user()->siswas->where('user_id', Auth::user()->id)->first()?->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Tempat Lahir :</th>
                                                    <td class="text-muted">{{ Auth::user()->siswas->where('user_id', Auth::user()->id)->first()?->tempat_lahir }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Tanggal Lahir :</th>
                                                    <td class="text-muted">{{ \Carbon\Carbon::parse(Auth::user()->siswas->where('user_id', Auth::user()->id)->first()?->tanggal_lahir)->format('d-m-Y') }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Kelas :</th>
                                                    <td class="text-muted">{{ Auth::user()->siswas->where('user_id', Auth::user()->id)->first()?->kelas->nama_kelas }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Tingkat :</th>
                                                    <td class="text-muted">{{ Auth::user()->siswas->where('user_id', Auth::user()->id)->first()?->kelas->tingkat }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <!--end col-->
                        <div class="col-xxl-9">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">About</h5>
                                    <p>{{ Auth::user()->siswas->where('user_id', Auth::user()->id)->first()?->catatan }}</p>
                                </div>
                                <!--end card-body-->
                            </div><!-- end card -->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>

                {{-- change password tab pane --}}
                @include('pages.user.change-password')
            </div>
            <!--end tab-content-->
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

<script src="{{ URL::asset('build/js/pages/profile.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
