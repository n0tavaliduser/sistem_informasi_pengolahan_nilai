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
                    <div class="card card-animate bg-primary bg-gradient">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-light text-truncate mb-0">
                                        Jumlah Jurusan</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-light"><span class="counter-value" data-target="{{ \App\Models\Jurusan::count() }}"></span> Jurusan
                                    </h4>
                                    @if (Auth::user()->role->name === 'Admin')
                                    <a href="{{ route('master-data.jurusan.index') }}" class="link-secondary text-decoration-underline text-light">Lihat semua jurusan</a>
                                    @endif
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-dark rounded fs-3">
                                        <i class="bx bxs-graduation text-light"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate bg-success bg-gradient">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-truncate mb-0 text-light">Jumlah Guru</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-light"><span class="counter-value" data-target="{{ \App\Models\Guru::count() }}"></span> Guru</h4>
                                    @if (Auth::user()->role->name === 'Admin')
                                    <a href="{{ route('master-data.guru.index') }}" class="link-secondary text-decoration-underline text-light">Lihat semua guru</a>
                                    @endif
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-dark rounded fs-3">
                                        <i class="bx bx-user-circle text-light"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate bg-warning bg-gradient">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-truncate mb-0 text-light">Jumlah Mata Pelajaran</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-light"><span class="counter-value" data-target="{{ \App\Models\MataPelajaran::count() }}"></span> Mata Pelajaran</h4>
                                    @if (Auth::user()->role->name === 'Admin')
                                    <a href="{{ route('master-data.mata-pelajaran.index') }}" class="link-secondary text-decoration-underline text-light">Lihat mata pelajaran</a>
                                    @endif
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-dark rounded fs-3">
                                        <i class="bx bx-book-open text-light"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate bg-danger bg-gradient">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-truncate mb-0 text-light">Jumlah Siswa</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-light"><span class="counter-value" data-target="{{ \App\Models\Siswa::where('status', 'active')->count() }}"></span> Siswa</h4>
                                    @if (Auth::user()->role->name === 'Admin')
                                    <a href="{{ route('master-data.siswa.index') }}" class="link-secondary text-decoration-underline text-light">Lihat siswa</a>
                                    @endif
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-dark rounded fs-3">
                                        <i class="bx bx-user-pin text-light"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->

            <div class="row">
                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Grafik Jumlah Siswa Tiap Jurusan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="lineChart" class="chartjs-chart" data-colors='["--vz-primary-rgb, 0.2", "--vz-primary", "--vz-info-rgb, 0.2", "--vz-info"]'></canvas>
                        </div>
                    </div>
                </div> <!-- end col -->

                @php
                    $rataRataKeseluruhan = \App\Models\Nilai::with(['siswa'])
                        ->whereHas('siswa.kelas', function ($query) {
                            $query->where('jurusan_id', Request::get('jurusan_id'));
                        })
                        ->get()
                        ->average('nilai');

                    $totalNilaiKeseluruhan = \App\Models\Nilai::with(['siswa'])
                        ->whereHas('siswa.kelas', function ($query) {
                            $query->where('jurusan_id', Request::get('jurusan_id'));
                        })
                        ->get()
                        ->sum('nilai');

                    $totalSiswa = \App\Models\Siswa::whereHas('kelas', function ($query) {
                        $query->where('jurusan_id', Request::get('jurusan_id'));
                    })
                    ->where('status', 'active')
                    ->count();
                @endphp

                <div class="col-xxl-6">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Rata Rata Nilai Tiap Jurusan</h4>
                            <div>
                                <form method="get">
                                    <select name="jurusan_id" id="jurusan_id" class="form-control" onchange="this.form.submit()">
                                        <option value="">Pilih jurusan</option>
                                        @foreach (\App\Models\Jurusan::all() as $jurusan)
                                            <option value="{{ $jurusan->id }}" {{ $jurusan->id == Request::get('jurusan_id') ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-header p-0 border-0 bg-soft-light">
                            <div class="row g-0 text-center">
                                <div class="col-6 col-sm-4">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value" data-target="{{ substr(number_format($rataRataKeseluruhan, 2, '.', ''), 0, -1) }}">0</span></h5>
                                        <p class="text-muted mb-0">Rata rata nilai keseluruhan</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-4">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value" data-target="{{ $totalNilaiKeseluruhan }}">0</span></h5>
                                        <p class="text-muted mb-0">Total nilai keseluruhan</p>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-6 col-sm-4">
                                    <div class="p-3 border border-dashed border-start-0">
                                        <h5 class="mb-1"><span class="counter-value" data-target="{{ $totalSiswa }}">0</span></h5>
                                        <p class="text-muted mb-0">Total siswa</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body p-0 pb-2">
                            <div>
                                <div id="audiences_metrics_charts" data-colors='["--vz-primary", "--vz-light"]'
                                    class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
            @endif

        </div> <!-- end .h-100-->

    </div> <!-- end col -->
</div>

@php
    $jurusanIds = \App\Models\Jurusan::orderBy('id')->pluck('id')->toArray();
    $jumlahSiswaPerJurusan = [];

    foreach ($jurusanIds as $jurusanId) {
        $siswaCount = 0;
        foreach (\App\Models\Kelas::where('jurusan_id', $jurusanId)->pluck('id') as $kelasId) {
            $siswaCount += \App\Models\Siswa::where('kelas_id', $kelasId)->where('status', 'active')->count();
        }
        array_push($jumlahSiswaPerJurusan, $siswaCount);
    }
@endphp

@endsection
@section('script')
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
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
            type: 'bar',
            data: {
                labels: {!! json_encode(\App\Models\Jurusan::orderBy('id')->pluck('nama_jurusan')->toArray()) !!},
                datasets: [
                    {
                        label: "Jumlah Siswa",
                        fill: true,
                        lineTension: 0.5,
                        backgroundColor: lineChartColor[0],
                        borderColor: lineChartColor[1],
                        startFromZero: true,
                        data: {!! json_encode($jumlahSiswaPerJurusan) !!},
                        backgroundColor: ['#204071', '#9264FB', '#FEBF42']
                    },
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

@php
    $kelasIds = \App\Models\Kelas::where('jurusan_id', Request::get('jurusan_id'))->pluck('id');
    $kelasNames = \App\Models\Kelas::where('jurusan_id', Request::get('jurusan_id'))->pluck('nama_kelas');
    $rataRataNilaiAkhir = [];

    
    foreach ($kelasIds as $kelasId) {
        $averageNilai = \App\Models\Nilai::with(['siswa'])
            ->whereHas('siswa', function ($query) use ($kelasId) {
                $query->where('kelas_id', $kelasId);
            })
            ->whereHas('mata_pelajaran.jadwal_pelajarans.kelas', function ($query) {
                $query->where('jurusan_id', Request::get('jurusan_id'));
            })
            ->get()
            ->average('nilai');

        $average_format = number_format($averageNilai, 2, '.', '');

        $average_dua_desimal = substr($average_format, 0, -1);

        array_push($rataRataNilaiAkhir, $average_dua_desimal);
    }
@endphp

<script>

    // Heatmap Charts Generatedata
    function generateData(count, yrange) {
        var i = 0;
        var series = [];
        while (i < count) {
            var x = (i + 1).toString() + "h";
            var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

            series.push({
                x: x,
                y: y
            });
            i++;
        }
        return series;
    }

    // Audiences metrics column charts
    var chartAudienceColumnChartsColors = getChartColorsArray("audiences_metrics_charts");
    if (chartAudienceColumnChartsColors) {
        var columnoptions = {
            series: [{
                name: 'Nilai Rata-Rata',
                data: {!! json_encode($rataRataNilaiAkhir) !!}
            }],
            chart: {
                type: 'bar',
                height: 309,
                stacked: true,
                toolbar: {
                    show: true,
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '20%',
                    borderRadius: 6,
                },
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: true,
                position: 'bottom',
                horizontalAlign: 'center',
                fontWeight: 400,
                fontSize: '8px',
                offsetX: 0,
                offsetY: 0,
                markers: {
                    width: 9,
                    height: 9,
                    radius: 4,
                },
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            grid: {
                show: false,
            },
            colors: chartAudienceColumnChartsColors,
            xaxis: {
                categories: {!! json_encode(\App\Models\Kelas::where('jurusan_id', Request::get('jurusan_id'))->pluck('nama_kelas')) !!},
                axisTicks: {
                    show: false,
                },
                axisBorder: {
                    show: true,
                    strokeDashArray: 1,
                    height: 1,
                    width: '100%',
                    offsetX: 0,
                    offsetY: 0
                },
            },
            yaxis: {
                show: true
            },
            fill: {
                opacity: 0.8,
                colors: ['#204071', '#9264FB', '#FEBF42']
            }
        };
        var chart = new ApexCharts(document.querySelector("#audiences_metrics_charts"), columnoptions);
        chart.render();
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
