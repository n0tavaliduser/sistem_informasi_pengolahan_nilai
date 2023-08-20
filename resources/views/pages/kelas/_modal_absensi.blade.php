<div class="modal fade" id="modal_absensi" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Absensi {{ $jadwal->kelas?->nama_kelas }} - {{ $jadwal->mata_pelajaran?->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive table-card">
                    <table class="table align-middle table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Siswa</th>
                                <th scope="col">Email</th>
                                <th scope="col">Absen</th>
                                <th scope="col">Persentase</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwal->kelas->siswas as $siswa)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('assets/img/person-dummy.jpg') }}" alt="" class="avatar-xs rounded-circle" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0">{{ $siswa->nama_lengkap }}</p>
                                            <small>{{ $siswa->jenis_kelamin }}</small>
                                        </div>
                                    </div>
                                </th>
                                <td>{{ $siswa->user->email }}</td>
                                <td>{{ \App\Models\Absensi::where('siswa_id', $siswa->id)->where('kelas_id', $jadwal->kelas->id)->where('keterangan', 'Hadir')->count() }} / 16</td>
                                <td>
                                    @php
                                        $persentase_absensi = \App\Models\Absensi::where('siswa_id', $siswa->id)->where('kelas_id', $jadwal->kelas->id)->where('keterangan', 'Hadir')->count() / 16 * 100;
                                    @endphp
                                    <span class="text-@php
                                        if ($persentase_absensi >= 50 && $persentase_absensi < 75) {
                                            echo 'warning';
                                        } elseif ($persentase_absensi > 75) {
                                            echo 'success';
                                        } else {
                                            echo 'danger';
                                        }
                                    @endphp">{{ $persentase_absensi }}</span> %</td>
                                <td>
                                    @if ($siswa->absensis->where('mata_pelajaran_id', $jadwal->mata_pelajaran_id)->where('siswa_id', $siswa->id)->count() == 0)   
                                    <div class="d-flex gap-2">
                                        <form method="post" action="{{ route('absensi.store', ['siswa' => $siswa, 'jadwal' => $jadwal]) }}">
                                            @csrf
                                            <input type="hidden" name="keterangan" id="keterangan" value="Hadir">
                                            <button type="submit" class="btn btn-success btn-sm">hadir</button>
                                        </form>
                                        <form method="post" action="{{ route('absensi.store', ['siswa' => $siswa, 'jadwal' => $jadwal]) }}">
                                            @csrf
                                            <input type="hidden" name="keterangan" id="keterangan" value="Alpha">
                                            <button type="submit" class="btn btn-danger btn-sm">tidak masuk</button>
                                        </form>
                                    </div>
                                    @else
                                    <div class="d-flex gap-1">
                                        <span class="badge rounded-pill text-bg-{{ $siswa->absensis->where('mata_pelajaran_id', $jadwal->mata_pelajaran_id)->where('siswa_id', $siswa->id)->first()->keterangan == 'Hadir' ? 'success' : 'warning' }}">
                                            {{ $siswa->absensis->where('mata_pelajaran_id', $jadwal->mata_pelajaran_id)->where('siswa_id', $siswa->id)->first()->keterangan }}
                                        </span>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->