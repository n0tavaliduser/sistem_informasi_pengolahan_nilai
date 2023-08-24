<div class="modal fade" id="modal-update-{{ $nilai_mata_pelajaran->id }}" tabindex="-1" aria-labelledby="modal-createLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-judul" id="modal-createLabel">Update Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('nilai-mata-pelajaran.update', $nilai_mata_pelajaran) }}">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group mb-3" style="display: none;">
                        <label for="mata_pelajaran_id">Mata Pelajaran ID</label>
                        <input type="text" name="mata_pelajaran_id" id="mata_pelajaran_id" value="{{ Request::get('mata_pelajaran_id') }}" class="form-control {{ !$errors->has('mata_pelajaran_id')?:'is-invalid' }}">
                        @error('mata_pelajaran_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3" style="display: none;">
                        <label for="siswa_id">Siswa ID</label>
                        <input type="text" name="siswa_id" id="siswa_id" value="{{ $siswa->id }}" class="form-control {{ !$errors->has('siswa_id')?:'is-invalid' }}">
                        @error('siswa_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3 text-start">
                        @php
                            $pertemuans = 'pertemuan_' . $siswa->id;
                            $$pertemuans = \App\Models\NilaiMataPelajaran::where('mata_pelajaran_id', Request::get('mata_pelajaran_id'))->where('siswa_id', $siswa->id)->plucK('pertemuan')->toArray();
                        @endphp
                        <label for="pertemuan" class="form-label">Pertemuan</label>
                        <select name="pertemuan" id="pertemuan" class="form-control {{ !$errors->has('pertemuan')?:'is-invalid' }}">
                            <option value="{{ $nilai_mata_pelajaran->pertemuan }}">{{ \App\Models\MataPelajaran::where('id', Request::get('mata_pelajaran_id'))->first()->kode . '-' . $nilai_mata_pelajaran->pertemuan }}</option>
                            @for ($i = 1; $i <= 16; $i++)
                                @if (!in_array($i, $$pertemuans))
                                <option value="{{ $i }}">{{ \App\Models\MataPelajaran::where('id', Request::get('mata_pelajaran_id'))->first()->kode . '-' . $i }}</option>
                                @endif
                            @endfor
                        </select>
                        @error('pertemuan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3 text-start">
                        <label for="nilai">Nilai</label>
                        <input type="number" min="0" max="100" name="nilai" id="nilai" value="{{ $nilai_mata_pelajaran->nilai }}" class="form-control {{ !$errors->has('nilai')?:'is-invalid' }}" placeholder="Nilai">
                        @error('nilai')
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
