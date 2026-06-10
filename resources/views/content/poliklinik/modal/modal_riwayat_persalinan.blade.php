<div class="modal fade" id="modalRiwayatPersalinan" tabindex="-1" aria-hidden="true"
    aria-labelledby="modalRiwayatPersalinanLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Riwayat Persalinan Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="formRiwayatPersalinan">

                <div class="modal-body">
                    <div class="row g-2">

                        <div class="col-md-8">
                            <label for="tempat_persalinan">Tempat Persalinan</label>
                            <x-input name="tempat_persalinan" />
                        </div>

                        <div class="col-md-4">
                            <label for="tgl_thn">Tanggal / Tahun</label>
                            <x-input type="date" name="tgl_thn" />
                        </div>

                        <div class="col-md-8">
                            <label for="jenis_persalinan">Jenis Persalinan</label>
                            <x-input name="jenis_persalinan" />
                        </div>

                        <div class="col-md-4">
                            <label for="usia_hamil">Usia Hamil</label>
                            <x-input-group class="input-group-sm">
                                <x-input name="usia_hamil" />
                                <x-input-group-text>mgg</x-input-group-text>
                            </x-input-group>
                        </div>

                        <div class="col-md-8">
                            <label for="penolong">Penolong</label>
                            <x-input name="penolong" />
                        </div>

                        <div class="col-md-4">
                            <label class="d-block mb-2">Jenis Kelamin</label>
                            <x-input-radio id="jenis_kelamin" name="jenis_kelamin" value="Laki-laki" label="Laki-laki"
                                checked />
                            <x-input-radio id="jenis_kelamin2" name="jenis_kelamin" value="Perempuan"
                                label="Perempuan" />
                        </div>

                        <div class="col-md-8">
                            <label for="penyulit">Penyulit</label>
                            <x-input name="penyulit" />
                        </div>

                        <div class="col-md-4">
                            <label for="bb_pb">BB / PB</label>
                            <x-input name="bb_pb" placeholder="3200 gr / 49 cm" />
                        </div>

                        <div class="col-md-12">
                            <label for="keadaan">Keadaan Bayi</label>
                            <x-input name="keadaan" />
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                </div>

            </form>

        </div>
    </div>
</div>
@push('script')
    <script>

        function getRiwayatPersalinan(no_rkm_medis) {

        }
        function showModalRiwayatPersalinan() {
            $('#modalRiwayatPersalinan').modal('show');
        }
    </script>
@endpush