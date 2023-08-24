<div class="tab-pane fade" id="ganti-password" role="tabpanel">
    <div class="card">
        <form method="post" action="{{ route('user.change-password', Auth::user()) }}">
            @csrf
            @method('patch')
            <div class="card-body">
                <h5 class="card-title mb-3">Ganti Password</h5>
                <div class="form-group mb-3">
                    <label for="current_password">Password Sekarang</label>
                    <input type="password" name="current_password" id="current_password" class="form-control {{ !$errors->has('current_password')?:'is-invalid' }}" placeholder="Password Sekarang">
                    @error('current_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="new_password">Password Baru</label>
                    <input type="password" name="new_password" id="new_password" class="form-control {{ !$errors->has('new_password')?:'is-invalid' }}" placeholder="Password Baru">
                    @error('new_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control {{ !$errors->has('new_password_confirmation')?:'is-invalid' }}" placeholder="Konfirmasi Password Baru">
                    @error('new_password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <button class="btn btn-success">Ganti</button>
            </div>
        </form>
        <!--end card-body-->
    </div>
    <!--end card-->
</div>
<!--end tab-pane-->
