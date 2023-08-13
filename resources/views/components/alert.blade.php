@if (Session::has('success'))
<div class="alert alert-success alert-top-border alert-dismissible fade show" role="alert">
    <i class="ri-notification-off-line me-3 align-middle fs-16 text-success"></i><strong>Success</strong> - {{ Session::get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif (Session::has('warning'))
<div class="alert alert-warning alert-top-border alert-dismissible fade show" role="alert">
    <i class="ri-alert-line me-3 align-middle fs-16 text-warning"></i><strong>Warning</strong> - {{ Session::get('warning') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>    
@elseif (Session::has('danger'))
<div class="alert alert-danger alert-top-border alert-dismissible fade show" role="alert">
    <i class="ri-error-warning-line me-3 align-middle fs-16 text-danger"></i><strong>Danger</strong> - {{ Session::get('danger') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
