<div class="modal fade" id="updateModal-{{ $mata_pelajaran->id }}" tabindex="-1" aria-labelledby="updateModalLabel-{{ $mata_pelajaran->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel-{{ $mata_pelajaran->id }}">Update Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('master-data.mata-pelajaran.update', $mata_pelajaran) }}">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nama" class="form-label">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control {{ !$errors->has('nama')?:'is-invalid' }}" value="{{ $mata_pelajaran->nama }}" id="nama" name="nama" placeholder="Nama Mata Pelajaran">
                        @error('nama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="keterangan" class="form-label">Deskripsi</label>
                        <textarea class="form-control {{ !$errors->has('keterangan')?:'is-invalid' }}" value="{{ $mata_pelajaran->keterangan }}" name="keterangan" id="keterangan" placeholder="Keterangan" cols="5" rows="2">{{ $mata_pelajaran->keterangan }}</textarea>
                        @error('keterangan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="jurusan_id" class="form-label">Jurusan</label>
                        <select name="jurusan_id" id="" class="form-control {{ !$errors->has('jurusan_id')?:'is-invalid' }}">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($semua_jurusan as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ $jurusan->id === $mata_pelajaran->jurusan_id ? 'selected' : '' }}>{{ $jurusan->nama_jurusan }}</option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
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
