<div class="modal fade" id="deleteModal-{{ $guru->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $guru->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $guru->id }}">Hapus Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Menghapus guru ini akan menghapus seluruh data guru pada database, anda yakin ingin menghapus guru?</p>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>Tidak</a>
                <form method="post" action="{{ route('master-data.guru.destroy', $guru) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-primary ">Ya Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>