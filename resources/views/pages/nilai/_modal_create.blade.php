<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="modal-createLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-judul" id="modal-createLabel">Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('nilai.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3" style="display: none;">
                        <label for="mata_pelajaran_id">Mata Pelajaran ID</label>
                        <input type="text" name="mata_pelajaran_id" id="mata_pelajaran_id" value="{{ $mata_pelajaran->id }}" class="form-control {{ !$errors->has('mata_pelajaran_id')?:'is-invalid' }}">
                        @error('mata_pelajaran_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3" style="display: none;">
                        <label for="siswa_id">Siswa ID</label>
                        <input type="text" name="siswa_id" id="siswa_id" value="{{ Request::get('siswa_id') }}" class="form-control {{ !$errors->has('siswa_id')?:'is-invalid' }}">
                        @error('siswa_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nilai">Nilai</label>
                        <input type="number" name="nilai" id="nilai" value="{{ Request::get('nilai') }}" class="form-control {{ !$errors->has('nilai')?:'is-invalid' }}">
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
