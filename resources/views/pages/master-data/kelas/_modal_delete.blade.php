<div class="modal fade" id="deleteModal-{{ $kelas->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $kelas->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $kelas->id }}">Hapus Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Menghapus kelas ini akan menghapus seluruh data kelas pada database, anda yakin ingin menghapus kelas?</p>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>Tidak</a>
                <form method="post" action="{{ route('master-data.kelas.destroy', $kelas) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-primary ">Ya Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>