<div class="modal fade" id="modalUpdate-{{ $tugas->id }}" tabindex="-1" aria-labelledby="modalUpdateLabel-{{ $tugas->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-judul" id="modalUpdateLabel-{{ $tugas->id }}">Update Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('tugas.update', $tugas) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" value="{{ $tugas->judul }}" class="form-control {{ !$errors->has('judul')?:'is-invalid' }}">
                        @error('judul')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control {{ !$errors->has('deskripsi')?:'is-invalid' }}" cols="30" rows="10" placeholder="Deskripsi Tugas">{{ $tugas->deskripsi }}</textarea>
                        @error('deskripsi')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="tanggal_deadline">Tenggat Waktu</label>
                        <input type="date" name="tanggal_deadline" id="tanggal_deadline" value="{{ \Carbon\Carbon::parse($tugas->tanggal_deadline)->format('Y-m-d') }}" class="form-control {{ !$errors->has('tanggal_deadline')?:'is-invalid' }}">
                        @error('tanggal_deadline')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="file">File</label>
                        <input type="file" name="file" id="file" class="form-control {{ !$errors->has('file')?:'is-invalid' }}">
                        @error('file')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="tipe">Tipe Tugas</label>
                        <input type="text" name="tipe" id="tipe" value="{{ $tugas->tipe }}" class="form-control {{ !$errors->has('tipe')?:'is-invalid' }}" placeholder="Tipe Tugas">
                        @error('tipe')
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
