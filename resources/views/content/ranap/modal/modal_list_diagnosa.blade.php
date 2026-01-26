<div class="modal fade" id="modalListDiagnosa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color:#00000082">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">KODE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="dxpx-tab" data-bs-toggle="tab" data-bs-target="#dxpx-tab-pane" type="button" role="tab" aria-controls="dxpx-tab-pane" aria-selected="true">Pilih Kode</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pemeriksaan-tab" data-bs-toggle="tab" data-bs-target="#pemeriksaan-tab-pane" type="button" role="tab" aria-controls="pemeriksaan-tab-pane" aria-selected="false">Asesmen/Penilaian</button>
                    </li>

                </ul>
                <div class="tab-content p-2" id="dxpxTabContent">
                    <div class="tab-pane fade show active" id="dxpx-tab-pane" role="tabpanel" aria-labelledby="dxpx-tab" tabindex="0">
                        <table class="table table-striped table-hover" id="tbListDiagnosa">
                            <thead>
                                <tr>
                                    <th class="dxpx">KODE</th>
                                    <th>NAMA</th>
                                    <th>KETERANGAN</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="pemeriksaan-tab-pane" role="tabpanel" aria-labelledby="pemeriksaan-tab" tabindex="0">
                        <table class="table table-striped table-hover" id="tbPemeriksaanSoap">
                            <thead>
                                <tr>
                                    <th>Tgl. Periksa</th>
                                    <th>Hasil Pemeriksaan</th>
                                    <th>Dokter</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer" style="justify-content:flex-start">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <form action="" class="filterListDiagnosa">
                        <input type="hidden" name="kode_diagnosa" id="kode_diagnosa">
                        <input type="hidden" id="nama_diagnosa" name="nama_diagnosa">
                        <input type="hidden" id="dxpx" name="dxpx">
                        <div class="input-group">
                            <input type="search" class="form-control form-control-sm txt-diagnosa" placeholder="" aria-label="" id="txt-diagnosa" name="txt-diagnosa" autocomplete="off">
                            <button class="btn btn-primary btn-sm" type="button" id="btn-diagnosa"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        function cariDiagnosa(el) {
            $('#tbListDiagnosa tbody').empty();
            const keyword = $('#modalListDiagnosa input[name=txt-diagnosa]').val();
            const dxpx = $('#modalListDiagnosa input[name=dxpx]').val();

            switch (dxpx) {
                case 'diagnosa':
                    getDiagnosa(keyword).done((response) => {
                        let no = 1;
                        $.map(response, (dx) => {
                            row = `<tr class="${no}" onclick="setTextRiwayat('${parameter}', ${no} )" style="cursor:pointer">`
                            row += `<td>${dx.kd_penyakit}</td>`
                            row += `<td>${dx.nm_penyakit}</td>`
                            row += `<td>${dx.keterangan}</td>`
                            row += `</tr>`
                            no++;
                            $('#tbListDiagnosa tbody').append(row);
                        })
                    });
                    break;
                case 'prosedur':
                    getProsedur(keyword).done((response) => {
                        let no = 1;
                        $.map(response, (px) => {
                            row = `<tr class="${no}" onclick="setTextRiwayat('${parameter}', ${no} )" style="cursor:pointer">`
                            row += `<td>${px.kode}</td>`
                            row += `<td>${px.deskripsi_pendek}</td>`
                            row += `<td>${px.deskripsi_panjang}</td>`
                            row += `</tr>`
                            no++;
                            $('#tbListDiagnosa tbody').append(row);
                        })
                    });
                    break;
                default:
                    break;
            }
        }
        $('#txt-diagnosa').on('search', () => {
            const diagnosa = $('#txt-diagnosa').val()
            const kode = $('#modalListDiagnosa input[name=kode_diagnosa]').val()
            const nama = $('#modalListDiagnosa input[name=nama_diagnosa]').val()
            const dxpx = $('#modalListDiagnosa input[name=dxpx]').val()
            if (diagnosa.length == 0) {
                $('#tbListDiagnosa tbody').empty();
            }
        });

        $('#modalListDiagnosa').on('hidden.bs.modal', () => {
            $('#tbListDiagnosa tbody').empty();
            $('#modalListDiagnosa input[name=kode_diagnosa]').val('')
            $('#modalListDiagnosa input[name=nama_diagnosa]').val('')
            $('#modalListDiagnosa input[name=dxpx]').val('')
            $('button[data-bs-target="#dxpx-tab-pane"]').trigger('click');
        })

        $('button[data-bs-target="#pemeriksaan-tab-pane"]').on('shown.bs.tab', function(e, x, y) {
            const no_rawat = $('#modalResumeRanap').find('input[name=no_rawat]').val()
            $('#tbPemeriksaanSoap tbody').empty();
            getPemeriksaanRanap(no_rawat).done((response) => {
                const pemeriksaan = response.filter(item => item.pegawai.dokter !== null).map((item, index) => {
                    const text = item.penilaian.replace(/\n/g, ' ');
                    return `` +
                        `<tr onclick="setDiagnosaResumeFromSoap('${text}')">` +
                        `<td>${item.tgl_perawatan}</td>` +
                        `<td>${item.penilaian}</td>` +
                        `<td>${item.pegawai.dokter.nm_dokter}</td>` +
                        `</tr>`;
                })
                $('#tbPemeriksaanSoap tbody').append(pemeriksaan.join(''))
                $('#tbPemeriksaanSoap tbody tr').each(function(i) {
                    $(this).addClass(i).css('cursor', 'pointer');
                })

            })

        })

        function setDiagnosaResumeFromSoap(penilaian) {

            const namaDxTarget = $('#modalListDiagnosa input[name=nama_diagnosa]').val();
            const kdDxTarget = $('#modalListDiagnosa input[name=kode_diagnosa]').val();

            // ubah enter menjadi space pada string namaDxTarget
            const dxTarget = penilaian.replace(/\n/g, ' ');

            $(`#modalResumeRanap input[name=${namaDxTarget}]`).val(dxTarget);
            $(`#modalResumeRanap input[name=${kdDxTarget}]`).val('-');

            $('#modalListDiagnosa').modal('hide');

        }
    </script>
@endpush
