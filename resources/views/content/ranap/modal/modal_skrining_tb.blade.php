<div class="modal fade" id="modalSkoringTb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Skoring & Skrining TB</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formPasienSkoringTb">
                    <div class="row gy-2">
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="no_rawat">No. Rawat</label>
                            <input type="text" class="form-control" id="no_rawat" name="no_rawat" readonly>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="nm_pasien">Pasien</label>
                            <input type="text" class="form-control" id="nm_pasien" name="nm_pasien" readonly>

                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="tgl_lahir">Tgl. Lahir/Umur</label>
                            <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" readonly>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="keluarga">Keluarga</label>
                            <input type="text" class="form-control" id="keluarga" name="keluarga" readonly>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="kamar">Kamar</label>
                            <input type="text" class="form-control" id="kamar" name="kamar" readonly>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="diagnosa">Diagnosa Awal</label>
                            <input type="text" class="form-control" id="diagnosa" name="diagnosa" readonly>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="dokter">DPJP</label>
                            <input type="text" class="form-control" id="dokter" name="dokter" readonly>
                            <input type="hidden" id="kd_dokter" name="kd_dokter" readonly>
                        </div>

                    </div>
                </form>

                <ul class="nav nav-tabs mt-3" id="tabsSkoringTb" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="formSkoringTb-tab" data-bs-toggle="tab" data-bs-target="#tabSkoringTb" type="button" role="tab" aria-controls="tabSkoringTb" aria-selected="true">Form Skoring</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="SkoringTb-tab" data-bs-toggle="tab" data-bs-target="#SkoringTb" type="button" role="tab" aria-controls="SkoringTb" aria-selected="true">Hasil Skoring</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="formSkriningTb-tab" data-bs-toggle="tab" data-bs-target="#tabSkriningTb" type="button" role="tab" aria-controls="tabSkiringTb" aria-selected="true">Form Skrining</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="skriningTb-tab" data-bs-toggle="tab" data-bs-target="#skriningTb" type="button" role="tab" aria-controls="skriningTb" aria-selected="true">Hasil Skrining</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="tabSkoringTb" role="tabpanel" aria-labelledby="formSkoringTb-tab">
                        @include('content.ranap.modal.skriningTb._formSkoringTb')
                    </div>
                    <div class="tab-pane fade p-3" id="SkoringTb" role="tabpanel" aria-labelledby="SkoringTb-tab">
                        <table class="table nowrap" id="tbSkoringTb" width="100%"></table>
                    </div>
                    <div class="tab-pane fade p-3" id="tabSkriningTb" role="tabpanel" aria-labelledby="formSkriningTb-tab">
                        @include('content.ranap.modal.skriningTb._formSkriningTb')
                    </div>
                    <div class="tab-pane fade p-3" id="skriningTb" role="tabpanel" aria-labelledby="skriningTb-tab">
                        <table class="table nowrap" id="tbSkriningTb" width="100%"></table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px">
                    <i class="bi bi-x-circle">
                    </i> Keluar
                </button>
            </div>
        </div>
    </div>
</div>
</div>
@push('script')
    <script>
        const modalSkoringTb = $('#modalSkoringTb');

        modalSkoringTb.on('hidden.bs.modal', () => {
            formSkoringTb.trigger('reset')
            formSkriningTb.trigger('reset')
        })

        function skoringTb(no_rawat) {
            modalSkoringTb.modal('show')
            getRegPeriksa(no_rawat).done((response) => {
                const kamar = response.kamar_inap.map((item) => {
                    const valKamar = item.stts_pulang != 'Pindah Kamar' ? item.kamar.bangsal.nm_bangsal : '-';
                    return [valKamar, item.diagnosa_awal];
                }).join(',');
                formPasienSkoringTb.find('#no_rawat').val(no_rawat);
                formPasienSkoringTb.find('#nm_pasien').val(`${response.no_rkm_medis} - ${response.pasien.nm_pasien} (${response.pasien.jk})`);
                formPasienSkoringTb.find('#dokter').val(response.dokter.nm_dokter);
                formPasienSkoringTb.find('#kd_dokter').val(response.kd_dokter);
                formPasienSkoringTb.find('#tgl_lahir').val(`${formatTanggal(response.pasien.tgl_lahir)} / ${response.umurdaftar} ${response.sttsumur}`);
                formPasienSkoringTb.find('#keluarga').val(`${response.p_jawab}`);
                formPasienSkoringTb.find('#kamar').val(kamar.split(',')[0]);
                formPasienSkoringTb.find('#diagnosa').val(kamar.split(',')[1]);
            })
            drawTbSkriningTb(no_rawat)
            drawTbSkoringTb(no_rawat)
        }
    </script>
@endpush
