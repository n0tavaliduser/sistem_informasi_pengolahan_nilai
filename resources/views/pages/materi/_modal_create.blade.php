<div class="modal fade" id="modal-tambah-materi" tabindex="-1" role="dialog" aria-labelledby="modal-tambah-materiLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-tambah-materiLabel">Tambah Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ route('materi.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="judul">Judul Materi <small class="text-danger">*</small></label>
                        <input type="text" name="judul" id="judul" class="form-control {{ !$errors->has('judul')?:'is-invalid' }}" placeholder="Judul materi">
                        @error('judul')
                            {{ $message }}
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="judul">Jadwal Pelajaran <small class="text-danger">*</small></label>
                        <select name="jadwal_pelajaran_id" id="jadwal_pelajaran_id" class="form-control {{ !$errors->has('jadwal_pelajaran_id')?:'is-invalid' }}">
                            <option value="">Pilih jadwal pelajaran</option>
                            @foreach ($semua_jadwal_pelajaran as $jadwal_pelajaran)
                                <option value="{{ $jadwal_pelajaran->id }}">{{ $jadwal_pelajaran->mata_pelajaran?->nama }} | {{ \Carbon\Carbon::parse($jadwal_pelajaran->jam_mulai)->format('H:i') }} | {{ $jadwal_pelajaran->hari }} | {{ $jadwal_pelajaran->kelas?->nama_kelas }}</option>                                
                            @endforeach
                        </select>
                        @error('jadwal_pelajaran_id')
                            {{ $message }}
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="tanggal">Tanggal <small class="text-danger">*</small></label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control {{ !$errors->has('tanggal')?:'is-invalid' }}">
                        @error('tanggal')
                            {{ $message }}
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="file">File Materi <small class="text-danger">*</small></label>
                        <input type="file" name="file" id="file" class="form-control {{ !$errors->has('file')?:'is-invalid' }}">
                        @error('file')
                            {{ $message }}
                        @enderror
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control {{ !$errors->has('deskripsi')?:'is-invalid' }}" cols="30" rows="10" placeholder="Deskripsi Materi (jika ada)"></textarea>
                        @error('deskripsi')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary ">Tambah</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
