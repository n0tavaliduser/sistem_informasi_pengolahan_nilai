<div class="modal fade" id="deleteModal-{{ $tahun_ajaran->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $tahun_ajaran->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $tahun_ajaran->id }}">Hapus Tahun Ajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Menghapus tahun ajaran ini akan menghapus seluruh data tahun ajaran pada database, anda yakin ingin menghapus tahun ajaran?</p>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>Tidak</a>
                <form method="post" action="{{ route('master-data.tahun-ajaran.destroy', $tahun_ajaran) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-primary ">Ya Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>