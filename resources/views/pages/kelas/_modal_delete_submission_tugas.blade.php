<div class="modal fade" id="delete-submission-{{ $pengumpulan_tugas->id }}" tabindex="-1" role="dialog" aria-labelledby="delete-submission-{{ $pengumpulan_tugas->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <div class="mt-4">
                    <h4 class="mb-3">Hapus Pengumpulan Tugas</h4>
                    <p class="text-muted mb-4"> Anda yakin ingin menghapus pengumpulan tugas?</p>
                    <div class="hstack gap-2 justify-content-center">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tidak</button>
                        <form method="post" action="{{ route('pengumpulan-tugas.destroy', $pengumpulan_tugas) }}">    
                            @csrf
                            @method('delete')
                            <button href="javascript:void(0);" class="btn btn-primary">Ya, Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->