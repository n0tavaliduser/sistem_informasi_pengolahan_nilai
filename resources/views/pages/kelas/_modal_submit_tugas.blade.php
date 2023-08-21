<div class="modal fade" id="modal-submit-tugas" tabindex="-1" role="dialog" aria-labelledby="modal-submit-tugasLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-submit-tugasLabel">Form Pengumpulan Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('pengumpulan-tugas.store', $tugas) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Judul Pengumpulan">
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}" cols="30" rows="10" placeholder="Deskripsi Pengumpulan"></textarea>
                        @if ($errors->has('deskripsi'))
                            <div class="invalid-feedback">{{ $errors->first('deskripsi') }}</div>
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <label for="file" class="form-label">File Pengumpulan</label>
                        <input type="file" name="file" id="file" class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}">
                        @if ($errors->has('file'))
                            <div class="invalid-feedback">{{ $errors->first('file') }}</div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
