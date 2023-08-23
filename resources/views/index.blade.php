@extends('layouts.master')
@section('title') DASHBOARD @endsection
@section('css')
<link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div class="row">
    <div class="col">

        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-16 mb-1">Halo, {{ Auth::user()->name }}!</h4>
                            <p class="text-muted mb-0">Data statistik SMK Negeri 1 Maros saat ini</p>
                        </div>
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            @if (Auth::user()->role->name === 'Admin' || Auth::user()->role->name === 'Kepala Sekolah')
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Jumlah Jurusan</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ \App\Models\Jurusan::count() }}"></span> Jurusan
                                    </h4>
                                    @if (Auth::user()->role->name === 'Admin')
                                    <a href="{{ route('master-data.jurusan.index') }}" class="link-secondary text-decoration-underline">Lihat semua jurusan</a>
                                    @endif
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                        <i class="bx bxs-graduation text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Jumlah Guru</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ \App\Models\Guru::count() }}"></span> Guru</h4>
                                    @if (Auth::user()->role->name === 'Admin')
                                    <a href="{{ route('master-data.guru.index') }}" class="link-secondary text-decoration-underline">Lihat semua guru</a>
                                    @endif
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                        <i class="bx bx-user-circle text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Jumlah Mata Pelajaran</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ \App\Models\MataPelajaran::count() }}"></span> Mata Pelajaran</h4>
                                    @if (Auth::user()->role->name === 'Admin')
                                    <a href="{{ route('master-data.mata-pelajaran.index') }}" class="link-secondary text-decoration-underline">Lihat mata pelajaran</a>
                                    @endif
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                        <i class="bx bx-book-open text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Jumlah Siswa</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ \App\Models\Siswa::count() }}"></span> Siswa</h4>
                                    @if (Auth::user()->role->name === 'Admin')
                                    <a href="{{ route('master-data.mata-pelajaran.index') }}" class="link-secondary text-decoration-underline">Lihat mata pelajaran</a>
                                    @endif
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                        <i class="bx bx-book-open text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Grafik Absensi Keseluruhan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="lineChart" class="chartjs-chart" data-colors='["--vz-primary-rgb, 0.2", "--vz-primary", "--vz-info-rgb, 0.2", "--vz-info"]'></canvas>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            @endif

        </div> <!-- end .h-100-->

    </div> <!-- end col -->
</div>

@php
    use App\Models\Siswa;

    $kehadiranData = [];
    $alphaData = [];
    $lastSevenDays = now()->subDays(6)->toDateString(); // 7 days ago

    // Retrieve "Kehadiran" data for each day
    foreach (range(0, 6) as $daysAgo) {
        $tanggal = now()->subDays($daysAgo)->toDateString();

        $kehadiranCount = Siswa::with('absensis')
            ->whereHas('absensis', function ($query) use ($tanggal) {
                $query->where('tanggal', $tanggal)
                    ->where('keterangan', 'hadir');
            })
            ->count();

        $kehadiranData[] = $kehadiranCount;
    }

    foreach (range(0, 6) as $daysAgo) {
        $tanggal = now()->subDays($daysAgo)->toDateString();

        $alphaCount = Siswa::with('absensis')
            ->whereHas('absensis', function ($query) use ($tanggal) {
                $query->where('tanggal', $tanggal)
                    ->where('keterangan', 'alpha');
            })
            ->count();

        $alphaData[] = $alphaCount;
    }
@endphp


@endsection
@section('script')
<script src="{{ URL::asset('build/libs/chart.js/chart.min.js') }}"></script>
<script>
    // get colors array from the string
    function getChartColorsArray(chartId) {
        var chartElement = document.getElementById(chartId);
        if (chartElement !== null) {
            var colors = chartElement.getAttribute("data-colors");
            colors = JSON.parse(colors);
            return colors.map(function (value) {
                var newValue = value.replace(" ", "");
                if (newValue.indexOf(",") === -1) {
                    var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                    return color.trim() || newValue;
                } else {
                    var val = value.split(',');
                    if (val.length === 2) {
                        var rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
                        rgbaColor = "rgba(" + rgbaColor + "," + val[1] + ")";
                        return rgbaColor;
                    } else {
                        return newValue;
                    }
                }
            });
        }
        return []; // Return an empty array if the chart element is not found
    }

    Chart.defaults.borderColor = "rgba(133, 141, 152, 0.1)";
    Chart.defaults.color = "#858d98";

    // line chart
    var islinechart = document.getElementById('lineChart');
    var lineChartColor = getChartColorsArray('lineChart');
    if (lineChartColor.length > 0) {
        islinechart.setAttribute("width", islinechart.parentElement.offsetWidth);

        var lineChart = new Chart(islinechart, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_map(fn($i) => now()->subDays($i)->toDateString(), range(0, 6))) !!},
                datasets: [
                    {
                        label: "Kehadiran",
                        fill: true,
                        lineTension: 0.5,
                        backgroundColor: lineChartColor[0],
                        borderColor: lineChartColor[1],
                        startFromZero: true,
                        data: {!! json_encode($kehadiranData) !!}
                    },
                    {
                        label: "Alpha",
                        fill: true,
                        lineTension: 0.5,
                        backgroundColor: lineChartColor[0],
                        borderColor: lineChartColor[1],
                        startFromZero: true,
                        data: {!! json_encode($alphaData) !!}
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>

</script>
<!-- apexcharts -->
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>
<!-- dashboard init -->
<script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
