<div class="modal fade" id="updateModal-{{ $jurusan->id }}" tabindex="-1" aria-labelledby="updateModalLabel-{{ $jurusan->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel-{{ $jurusan->id }}">Update Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('master-data.jurusan.update', $jurusan) }}">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control {{ !$errors->has('nama_jurusan')?:'is-invalid' }}" value="{{ $jurusan->nama_jurusan }}" id="nama_jurusan" name="nama_jurusan" placeholder="Nama Jurusan">
                        @error('nama_jurusan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="singkatan" class="form-label">Singkatan Jurusan</label>
                        <input type="text" class="form-control {{ !$errors->has('singkatan')?:'is-invalid' }}" value="{{ $jurusan->singkatan }}" id="singkatan" name="singkatan" placeholder="Singkatan Jurusan">
                        @error('singkatan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control {{ !$errors->has('keterangan')?:'is-invalid' }}" value="{{ $jurusan->keterangan }}" name="keterangan" id="keterangan" placeholder="Keterangan" cols="30" rows="10">{{ $jurusan->keterangan }}</textarea>
                        @error('keterangan')
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
