<div class="modal fade" id="updateModal-{{ $pengumpulan_tugas->id }}" tabindex="-1" aria-labelledby="updateModalLabel-{{ $pengumpulan_tugas->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel-{{ $pengumpulan_tugas->id }}">Update Pengumpulan Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('pengumpulan-tugas.update', $pengumpulan_tugas) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="title">Judul</label>
                        <input type="text" name="title" id="title" value="{{ $pengumpulan_tugas->title }}" class="form-control {{ !$errors->has('title')?:'is-invalid' }}">
                        @error('title')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control {{ !$errors->has('deskripsi')?:'is-invalid' }}" cols="30" rows="10" placeholder="Deskripsi Pengumpulan Tugas">{{ $pengumpulan_tugas->deskripsi }}</textarea>
                        @error('deskripsi')
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
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                    <button type="submit" class="btn btn-primary ">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
