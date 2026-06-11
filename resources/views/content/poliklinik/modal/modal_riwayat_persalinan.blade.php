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
                            <x-input name="no_rkm_medis" type="hidden" />
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
                            <x-input name="usia_hamil" />
                        </div>

                        <div class="col-md-8">
                            <label for="penolong">Penolong</label>
                            <x-input name="penolong" />
                        </div>

                        <div class="col-md-4">
                            <label class="d-block mb-2">Jenis Kelamin</label>
                            <x-input-radio id="jenis_kelamin" name="jk" value="L" label="Laki-laki" checked />
                            <x-input-radio id="jenis_kelamin2" name="jk" value="P" label="Perempuan" />
                        </div>

                        <div class="col-md-8">
                            <label for="penyulit">Penyulit</label>
                            <x-input name="penyulit" />
                        </div>

                        <div class="col-md-4">
                            <label for="bbpb">BB / PB</label>
                            <x-input name="bbpb" placeholder="3200 gr / 49 cm" />
                        </div>

                        <div class="col-md-12">
                            <label for="keadaan">Keadaan Bayi</label>
                            <x-input name="keadaan" />
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" id="btnSimpanRiwayatPersalinan"
                        onclick="simpanRiwayatPersalinan()">Simpan</button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                </div>

            </form>

        </div>
    </div>
</div>
@push('script')
    <script>
        function showModalRiwayatPersalinan() {
            $('#modalRiwayatPersalinan').modal('show');
        }

        function renderTableRiwayatPersalinan(no_rkm_medis) {
            const table = $('.tbRiwayatPersalinanPasien tbody');
            table.empty();

            $.get(`/erm/riwayat/persalinan/get/${no_rkm_medis}`).done((response) => {
                // Cek apakah data ada dan memiliki isi
                if (response && response.length > 0) {
                    response.forEach((item, index) => {
                        table.append(`
                                                                                <tr>
                                                                                    <td>
                                                                                        <button class="btn btn-sm btn-danger" type="button" onclick="hapusRiwayatPersalinan('${item.no_rkm_medis}', '${item.tgl_thn}')">
                                                                                            <i class="bi bi-trash"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                    <td>${item.tgl_thn}</td>
                                                                                    <td>${item.tempat_persalinan}</td>
                                                                                    <td>${item.usia_hamil}</td>
                                                                                    <td>${item.jenis_persalinan}</td>
                                                                                    <td>${item.jk}</td>
                                                                                    <td>${item.penyulit}</td>
                                                                                    <td>${item.penolong}</td>
                                                                                    <td>${item.keadaan}</td>
                                                                                </tr>
                                                                            `);
                    });
                } else {
                    // Jika data kosong, tampilkan baris "Tidak Ada Data"
                    table.append(`
                                                                        <tr>
                                                                            <td colspan="8" class="text-center">Tidak Ada Data</td>
                                                                        </tr>
                                                                    `);
                }
            }).fail(() => {
                // Handling jika terjadi error pada saat pengambilan data
                table.append(`
                                                                <tr>
                                                                    <td colspan="3" class="text-center text-danger">Gagal memuat data</td>
                                                                </tr>
                                                            `);
            });
        }
        function simpanRiwayatPersalinan() {
            const data = getDataForm('#formRiwayatPersalinan', ['input', 'select']);
            $.post("{{ route('riwayat.persalinan.insert') }}", data).done((response) => {
                alertSuccessAjax();
                $('#modalRiwayatPersalinan').modal('hide');
                $('#formRiwayatPersalinan').trigger('reset');
                renderTableRiwayatPersalinan(data.no_rkm_medis);
            }).fail((request) => {
                if (request.status === 422) {
                    return handleValidationError(request)
                }
                alertErrorAjax($request);

            })
        }
    </script>
@endpush