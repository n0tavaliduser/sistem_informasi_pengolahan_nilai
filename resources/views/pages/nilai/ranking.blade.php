@extends('layouts.master')
@section('title') RANKING NILAI AKHIR @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') <a href="{{ route('root') }}">Ranking Nilai</a> @endslot
        @slot('title') {{ $kelas->nama_kelas }} @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5>Ranking Nilai Kelas {{ $kelas->nama_kelas }}</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-bordered table">
                            <thead>
                                <tr>
                                    <th><a href="{{ route('nilai.ranking', ['kelas' => $kelas, 'sort' => Request::get('sort') == 'ASC' ? 'DESC' : 'ASC', 'field' => 'nama_lengkap']) }}">Nama Siswa</a></th>
                                    <th><a href="{{ route('nilai.ranking', ['kelas' => $kelas, 'sort' => Request::get('sort') == 'ASC' ? 'DESC' : 'ASC', 'field' => 'sum']) }}">Total Nilai</a></th>
                                    <th><a href="{{ route('nilai.ranking', ['kelas' => $kelas, 'sort' => Request::get('sort') == 'ASC' ? 'DESC' : 'ASC', 'field' => 'average']) }}">Rata-rata</a></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Convert JSON strings into arrays and group the collection by 'siswa'
                                    $semua_nilai = $semua_nilai->groupBy('siswa.nama_lengkap');

                                    // Get the sorting field and order from the request
                                    $sortField = Request::get('field');
                                    $sortBy = Request::get('sort');

                                    // Define the default sorting callback based on the sum of 'nilai'
                                    $defaultSortingCallback = function ($query) {
                                        return $query->sum('nilai');
                                    };

                                    // Determine the sorting direction (ascending or descending)
                                    if ($sortBy === 'ASC') {
                                        $sortingDirection = 'sortBy';
                                    } elseif ($sortBy === 'DESC') {
                                        $sortingDirection = 'sortByDesc';
                                    } else {
                                        // Default to descending sorting if no sorting direction is specified
                                        $sortingDirection = 'sortByDesc';
                                    }

                                    // Sort the collection based on the selected field or default callback
                                    if ($sortField === 'nama_lengkap') {
                                        if ($sortBy == 'ASC') {
                                            $semua_nilai = $semua_nilai->sortKeys();
                                        } else {
                                            $semua_nilai = $semua_nilai->sortKeysDesc();
                                        }
                                    } elseif ($sortField === 'average') {
                                        $semua_nilai = $semua_nilai->$sortingDirection(function ($query) {
                                            return $query->average('nilai');
                                        });
                                    } else {
                                        // If the sorting field is not 'nama_lengkap', use the default sorting callback
                                        $semua_nilai = $semua_nilai->$sortingDirection($defaultSortingCallback);
                                    }
                                @endphp


                                @foreach ($semua_nilai as $nilai)
                                <tr>
                                    <td>{{ $nilai[0]->siswa?->nama_lengkap }}</td>
                                    <td>{{ $nilai->sum('nilai') }}</td>
                                    @php
                                        $average = $nilai->average('nilai');

                                        $average_format = number_format($average, 2, '.', '');

                                        $average_dua_desimal = substr($average_format, 0, -1);
                                    @endphp
                                    <td>{{ $average_dua_desimal }}</td>
                                    <td>
                                        <a href="{{ route('nilai.index', ['kelas_id' => $kelas->id, 'siswa_id' => $nilai[0]->siswa?->id]) }}" class="btn btn-md btn-success">detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection