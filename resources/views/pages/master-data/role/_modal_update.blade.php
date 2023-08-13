<div class="modal fade" id="updateModal-{{ $role->id }}" tabindex="-1" aria-labelledby="updateModalLabel-{{ $role->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel-{{ $role->id }}">Update Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('master-data.role.update', $role) }}">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nama Role</label>
                        <input type="text" class="form-control {{ !$errors->has('name')?:'is-invalid' }}" value="{{ $role->name }}" id="name" name="name" placeholder="Nama Role">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control {{ !$errors->has('description')?:'is-invalid' }}" value="{{ $role->description }}" name="description" id="description" placeholder="Deskripsi" cols="5" rows="2">{{ $role->description }}</textarea>
                        @error('description')
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
