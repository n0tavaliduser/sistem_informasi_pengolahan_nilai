<div class="modal fade" id="deleteModal-{{ $siswa->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $siswa->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $siswa->id }}">Hapus Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Menghapus siswa ini akan mengubah banyak data pada database, anda yakin ingin menghapus siswa?</p>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>Tidak</a>
                <form method="post" action="{{ route('master-data.siswa.destroy', $siswa) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-primary ">Ya Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>