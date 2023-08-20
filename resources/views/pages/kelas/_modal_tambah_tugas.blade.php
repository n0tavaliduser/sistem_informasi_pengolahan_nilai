<div class="modal fade" id="modal-tambah-tugas" tabindex="-1" role="dialog" aria-labelledby="modal-tambah-tugasLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-tambah-tugasLabel">Tambah Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('tugas.store', $jadwal) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="judul">Judul Tugas <small class="text-danger">*</small></label>
                        <input type="text" name="judul" id="judul" class="form-control {{ !$errors->has('judul')?:'is-invalid' }}" placeholder="Judul Tugas">
                        @error('judul')
                            {{ $message }}
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi <small class="text-danger">*</small></label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control {{ !$errors->has('deskripsi')?:'is-invalid' }}" placeholder="Deskripsi Tugas"></textarea>
                        @error('deskripsi')
                            {{ $message }}
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="tanggal_deadline">Batas Waktu <small class="text-danger">*</small></label>
                        <input type="date" name="tanggal_deadline" id="tanggal_deadline" class="form-control {{ !$errors->has('tanggal_deadline')?:'is-invalid' }}">
                        @error('tanggal_deadline')
                            {{ $message }}
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="file">File <span class="text-muted">(jika ada)</span></label>
                        <input type="file" name="file" id="file" class="form-control {{ !$errors->has('file')?:'is-invalid' }}">
                        @error('file')
                            {{ $message }}
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="tipe">Tipe Tugas <small class="text-danger">*</small> <span class="text-muted">(contoh: Tugas Harian / Tugas Mingguan / dsb)</span></label>
                        <input type="text" name="tipe" id="tipe" class="form-control {{ !$errors->has('tipe')?:'is-invalid' }}" placeholder="Tipe Tugas">
                        @error('tipe')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary ">Tambah</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
