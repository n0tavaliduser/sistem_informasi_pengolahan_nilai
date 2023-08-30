<div class="modal fade" id="resetPasswordModal-{{ $guru->id }}" tabindex="-1" aria-labelledby="resetPasswordModal-{{ $guru->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel-{{ $guru->id }}">Reset Password Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Mereset password guru ini akan mengganti password authentikasi guru pada database, anda yakin ingin reset password guru?</p>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i>Tidak</a>
                <a href="{{ route('master-data.guru.reset-password', $guru) }}" class="btn btn-primary ">Ya, reset</a>
            </div>
        </div>
    </div>
</div>