<div class="modal fade" id="updateModal-{{ $tahun_ajaran->id }}" tabindex="-1" aria-labelledby="updateModalLabel-{{ $tahun_ajaran->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel-{{ $tahun_ajaran->id }}">Update Tahun Ajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('master-data.tahun-ajaran.update', $tahun_ajaran) }}">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group mb-3 col-6">
                            <label for="tahun_mulai">Tahun Mulai <small class="text-danger">*</small></label>
                            <input type="number" name="tahun_mulai" id="tahun_mulai" value="{{ $tahun_ajaran->tahun_mulai }}" class="form-control {{ !$errors->has('tahun_mulai')?:'is-invalid' }}" placeholder="Tahun Mulai" required>
                            @error('tahun_mulai')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3 col-6">
                            <label for="tahun_berakhir">Tahun Berakhir <small class="text-danger">*</small></label>
                            <input type="number" name="tahun_berakhir" id="tahun_berakhir" value="{{ $tahun_ajaran->tahun_berakhir }}" class="form-control {{ !$errors->has('tahun_berakhir')?:'is-invalid' }}" placeholder="Tahun Berakhir" required>
                            @error('tahun_berakhir')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="jumlah_semester">Jumlah Semester <small class="text-danger">*</small></label>
                        <input type="number" name="jumlah_semester" id="jumlah_semester" value="{{ $tahun_ajaran->jumlah_semester }}" class="form-control {{ !$errors->has('jumlah_semester')?:'is-invalid' }}" placeholder="Jumlah Semester">
                        @error('jumlah_semester')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="col-lg-12">
                        <label for="status_field">Status <small class="text-danger">*</small></label>
                        <select id="status_field" name="status" class="form-select mb-3" required>
                            <option selected>Pilih status</option>
                            <option value="active" {{ $tahun_ajaran->status === 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="deactive" {{ $tahun_ajaran->status === 'deactive' ? 'selected' : '' }}>Non-aktif</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ route('master-data.tahun-ajaran.index') }}" class="btn btn-link link-success fw-medium"><i class="ri-close-line me-1 align-middle"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
