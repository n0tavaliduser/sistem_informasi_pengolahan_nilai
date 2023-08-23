<div class="modal fade" id="modal-update-{{ $pengumpulan_tugas->id }}" tabindex="-1" aria-labelledby="modal-update-{{ $pengumpulan_tugas->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-judul" id="modal-update-{{ $pengumpulan_tugas->id }}Label">Update Penilaian Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('pengumpulan-tugas.update-nilai', $pengumpulan_tugas) }}">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nilai">Nilai</label>
                        <input type="number" name="nilai" id="nilai" value="{{ $pengumpulan_tugas->nilai }}"" class="form-control {{ !$errors->has('nilai')?:'is-invalid' }}">
                        @error('nilai')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
