<div class="tindakanPemeriksaanRalan p-2">
    <form action="" class="formTindakanRalanDokter">
        <div class="row">
            <div class="col-md-6">
                <div class="row gy-2">
                    <div class="col-lg-3 col-md-6 col-md-12">
                        <label for="no_rawat" class="form-label">No. Rawat</label>
                        <input class="form-control" id="no_rawat" name="no_rawat" readonly />
                    </div>
                    <div class="col-lg-5 col-md-6 col-md-12">
                        <label for="nm_pasien" class="form-label">Pasien</label>
                        <div class="input-group">
                            <input class="form-control" id="no_rkm_medis" name="no_rkm_medis" readonly />
                            <input class="form-control w-50" id="nm_pasien" name="nm_pasien" readonly />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-md-12">
                        <label for="nm_pasien" class="form-label">Tgl. Lahir/Umur</label>
                        <div class="input-group">
                            <input class="form-control" id="tgl_lahir" name="tgl_lahir" readonly />
                            <input class="form-control w-50" id="umur" name="umur" readonly />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-md-12">
                        <label for="nm_dokter" class="form-label">Dokter</label>
                        <input class="form-control" id="kd_dokter" name="kd_dokter" readonly type="hidden" />
                        <input class="form-control" id="nm_dokter" name="nm_dokter" readonly />
                    </div>
                    <div class="col-lg-12 col-md-12 mt-2">

                        <div class="table-responsive">
                            <table class="table table-sm table-bordered tabelTindakanRalanDokter" id="">

                            </table>
                        </div>
                        <button class="btn btn-success" type="button" onclick="createTindakanRalanDokter()">
                            <i class="bi bi-send"></i>
                            Kirim
                        </button>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tindakan Dilakukan</div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered" id="tabelTindakanDilakukanDokterRalan">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Tgl. Perawatan</th>
                                    <th>Jam</th>
                                    <th>Perawatan</th>
                                    <th>Dokter</th>
                                    <th>Biaya</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <button type="button" class="btn btn-danger" onclick="deleteTindakanRalanDilakukanDokter()">
                            <i class="bi bi-trash"></i>Hapus
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@push('script')
    <script>
        $('#tab-tindakan-ralan').on('shown.bs.tab', function(e) {
            const no_rawat = $('input[name="no_rawat"]').val()
            const formTindakanRalanDokter = $('.formTindakanRalanDokter')
            getRegPeriksa(no_rawat).done((response) => {
                console.log('RESPONSE REGISTRASI ===', response);
                formTindakanRalanDokter.find('input[name="no_rawat"]').val(no_rawat)
                formTindakanRalanDokter.find('input[name="no_rkm_medis"]').val(response.no_rkm_medis)
                formTindakanRalanDokter.find('input[name="nm_pasien"]').val(`${response.pasien.nm_pasien} (${response.pasien.jk})`)
                formTindakanRalanDokter.find('input[name="kd_dokter"]').val(response.kd_dokter)
                formTindakanRalanDokter.find('input[name="nm_dokter"]').val(response.dokter.nm_dokter)

            })

        })
    </script>
@endpush
