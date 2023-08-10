<div class="modal fade" id="modalAsmedRanapAnak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">ASESMEN MEDIS ANAK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="tab-form-anak-ranap" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-form-anak" data-bs-toggle="tab" data-bs-target="#tab-form-anak-pane" type="button" role="tab" aria-controls="tab-form-anak-pane" aria-selected="true">SOAP</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-tabel" data-bs-toggle="tab" data-bs-target="#tab-tabel-pane" type="button" role="tab" aria-controls="tab-tabel-pane" aria-selected="false">Data Pemeriksaan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-grafik" data-bs-toggle="tab" data-bs-target="#tab-grafik-pane" type="button" role="tab" aria-controls="tab-grafik-pane" aria-selected="false">Grafik Pasien</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-verifikasi" data-bs-toggle="tab" data-bs-target="#tab-verifikasi-pane" type="button" role="tab" aria-controls="tab-verifikasi-pane" aria-selected="false">Verifikasi SOAP</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-2" id="tab-form-anak-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        @include('content.ranap.modal.asmed.anak')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-tabel-pane" role="tabpanel" aria-labelledby="tab-tabel" tabindex="0">
                        {{-- @include('content.ranap.modal._table_soap') --}}
                    </div>
                    <div class="tab-pane fade" id="tab-grafik-pane" role="tabpanel" aria-labelledby="tab-grafik" tabindex="0">
                        <div>
                            <canvas id="grafik-suhu"></canvas>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px"><i class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary btn-sm btn-asmed-anak" onclick="" style="font-size: 12px"><i class="bi bi-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $('#modalAsmedRanapAnak').on('hidden.bs.modal', () => {
            $('#anak_no_rawat').val('-');
            $('#anak_pasien').val('-');
            $('#anak_tgl_lahir').val('-');
            $('#anak_kd_dokter').val('-');
            $('#anak_dokter').val('-');
            $('#anak_anamnesis').val('Normal').change();
            $('#anak_hubungan').val('-');
            $('#anak_keluhan_utama').val('-');
            $('#anak_rps').val('-');
            $('#anak_rpd').val('-');
            $('#anak_rpk').val('-');
            $('#anak_rpo').val('-');
            $('#anak_alergi').val('-');
            $('#anak_keadaan').val('Normal').change();
            $('#anak_gcs').val('-');
            $('#anak_kesadaran').val('Normal').change();
            $('#anak_td').val('-');
            $('#anak_nadi').val('-');
            $('#anak_rr').val('-');
            $('#anak_suhu').val('-');
            $('#anak_spo').val('-');
            $('#anak_bb').val('-');
            $('#anak_tb').val('-');
            $('#anak_kepala').val('Normal').change();
            $('#anak_mata').val('Normal').change();
            $('#anak_gigi').val('Normal').change();
            $('#anak_tht').val('Normal').change();
            $('#anak_mulut').val('Normal').change();
            $('#anak_jantung').val('Normal').change();
            $('#anak_paru').val('Normal').change();
            $('#anak_abdomen').val('Normal').change();
            $('#anak_genital').val('Normal').change();
            $('#anak_ekstremitas').val('Normal').change();
            $('#anak_kulit').val('Normal').change();
            $('#anak_ket_fisik').val('-');
            $('#anak_ket_lokalis').val('-');
            $('#anak_lab').val('-');
            $('#anak_rad').val('-');
            $('#anak_penunjang').val('-');
            $('#anak_diagnosis').val('-');
            $('#anak_tata').val('-');
            $('#anak_edukasi').val('-');
        });

        $('.btn-asmed-anak').on('click', () => {

        })
    </script>
@endpush
