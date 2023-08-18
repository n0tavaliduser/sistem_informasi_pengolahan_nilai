<div class="modal fade" id="updateModal-{{ $jadwal_pelajaran->id }}" tabindex="-1" aria-labelledby="updateModalLabel-{{ $jadwal_pelajaran->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel-{{ $jadwal_pelajaran->id }}">Update Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('jadwal-pelajaran.update', $jadwal_pelajaran) }}">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="hari">Hari</label>
                        <select name="hari" id="hari" class="form-control {{ !$errors->has('hari')?:'is-invalid' }}">
                            <option value="">Pilih hari</option>
                            <option value="Senin" {{ $jadwal_pelajaran->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                            <option value="Selasa" {{ $jadwal_pelajaran->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                            <option value="Rabu" {{ $jadwal_pelajaran->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                            <option value="Kamis" {{ $jadwal_pelajaran->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                            <option value="Jumat" {{ $jadwal_pelajaran->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                        </select>
                        @error('hari')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" value="{{ \Carbon\Carbon::parse($jadwal_pelajaran->jam_mulai)->format('H:i') }}" class="form-control {{ !$errors->has('jam_mulai')?:'is-invalid' }}">
                        @error('jam_mulai')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="jam_berakhir">Jam Berakhir</label>
                        <input type="time" name="jam_berakhir" id="jam_berakhir" value="{{ \Carbon\Carbon::parse($jadwal_pelajaran->jam_berakhir)->format('H:i') }}" class="form-control {{ !$errors->has('jam_berakhir')?:'is-invalid' }}">
                        @error('jam_berakhir')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="kelas_id">Kelas</label>
                        <select name="kelas_id" id="kelas_id" value="{{ old('kelas_id') }}" class="form-control {{ !$errors->has('kelas_id')?:'is-invalid' }}">
                            <option value="">Pilih kelas</option>
                            @foreach ($semua_kelas as $kelas)
                            <option value="{{ $kelas->id }}" {{ $kelas->id === $jadwal_pelajaran->kelas_id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
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
                            <option value="{{ $tahun_ajaran->id }}" {{ $tahun_ajaran->id == $jadwal_pelajaran->tahun_ajaran_id ? 'selected' : '' }}>{{ $tahun_ajaran->tahun_mulai }} - {{ $tahun_ajaran->tahun_berakhir }}</option>
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
                            <option value="Ganjil" {{ $jadwal_pelajaran->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ $jadwal_pelajaran->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
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
                            <option value="{{ $guru->id }}" {{ $jadwal_pelajaran->guru_id == $guru->id ? 'selected' : '' }}>{{ $guru->nama_lengkap }}</option>
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
                            @foreach ($semua_mata_pelajaran->sortBy('nama') as $mata_pelajaran)
                            <option value="{{ $mata_pelajaran->id }}" {{ $jadwal_pelajaran->mata_pelajaran_id == $mata_pelajaran->id ? 'selected' : '' }}>{{ $mata_pelajaran->kode }} - {{ $mata_pelajaran->jurusan->nama_jurusan }}</option>
                            @endforeach
                        </select>
                        @error('mata_pelajaran_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                    <button type="submit" class="btn btn-primary ">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
