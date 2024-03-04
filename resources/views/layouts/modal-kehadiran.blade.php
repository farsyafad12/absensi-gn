<div class="modal fade" id="modal-kehadiran" tabindex="-1" aria-labelledby="status-kehadiran" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('kirim_kehadiran') }}" method="post">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_siswa" id="id_siswa" value="" required>
                <input type="hidden" name="id_kelas" id="id_kelas" value="" required>
                <input type="hidden" name="tanggal" id="tanggal" value="" required>
                {{-- <input type="hidden" name="nama_siswa" id="nama_siswa" value="" required> --}}



                <div class="modal-header" style="border-bottom: 1px solid rgba(0, 0, 0, 0.2);">
                    <h1 class="modal-title fs-6" id="status-kehadiran">Ubah Status Kehadiran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex gap-2 flex-column">
                    <div class="card-status-kehadiran">
                        <h6>Status Kehadiran :</h6>
                        <div class="pt-1 pb-2 ps-2">
                            @foreach ($kehadiran as $k)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="id_kehadiran"
                                        id="{{ $k->id_kehadiran }}" value="{{ $k->id_kehadiran }}" required>
                                    <label class="form-check-label" for="{{ $k->id_kehadiran }}">
                                        {{ $k->kehadiran }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="jam_masuk">Jam Masuk : </label>
                            <input class="form-control" id="jam_masuk" type="time" name="jam_masuk"/>
                        </div>
                        <div class="col-6">
                            <label for="jam_keluar">Jam Keluar : </label>
                            <input class="form-control" id="jam_keluar" type="time" name="jam_keluar"/>
                        </div>
                    </div>
                    <div class="card-keterangan">
                        <label for="keterangan">Keterangan : </label>
                        <textarea id="keterangan" name="keterangan" class="form-control" style="resize: none;height: 80px;"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
