<div class="modal fade" id="modalListResume" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color:#00000082">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <table class="table table-striped" id="tbListResume">
                    <thead>
                        <tr>
                            <th width="20%">TANGGAL</th>
                            <th width="10%">JAM</th>
                            <th class="parameter"></th>
                            <th width="25%" class="petugas">PETUGAS</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer" style="justify-content:flex-start">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <form action="" class="filterListPemeriksaam">
                        <input type="hidden" name="parameter" id="parameter">
                        <input type="hidden" id="no_rawat" name="no_rawat">
                        <div class="input-group">
                            <input type="search" class="form-control form-control-sm pemeriksaan" placeholder="" aria-label="" id="pemeriksaan" name="pemeriksaan" autocomplete="off">
                            <button class="btn btn-primary btn-sm" type="button" id="btn-pemeriksaan"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $('#modalListResume').on('hidden.bs.modal', () => {
            $('#tbListResume tbody').empty();
            $('#pemeriksaan').val('');
        })

        function cariPemeriksaanLab(noRawat, el) {
            $('#tbListResume tbody').empty();
            keyword = $('#modalListResume input[name=pemeriksaan]').val();
            getHasilLab(noRawat, keyword).done((response) => {
                no = 1;
                $.map(response, (lab) => {
                    row = `<tr class="${no}" onclick="setTextRiwayat('${parameter}', ${no} )" style="cursor:pointer">`
                    row += `<td>${formatTanggal(lab.tgl_periksa)}</td>`;
                    row += `<td>${lab.jam}</td>`;
                    row += `<td>${lab.template.Pemeriksaan} : ${lab.nilai} ${lab.template.satuan}</td>`;
                    row += `</tr>`
                    no++;
                    $('#tbListResume tbody').append(row);
                })
            })
        }

        function cariPemeriksaan(noRawat, parameter, el) {
            $('#tbListResume tbody').empty();
            keyword = $('#modalListResume input[name=pemeriksaan]').val();
            getPemeriksaanRanap(noRawat, parameter, keyword).done((response) => {
                no = 1;
                $.map(response, (pem) => {
                    row = `<tr class="${no}" onclick="setTextRiwayat('${parameter}', ${no} )" style="cursor:pointer">`
                    row += `<td>${formatTanggal(pem.tgl_perawatan)}</td>`;
                    row += `<td>${pem.jam_rawat}</td>`;
                    if (parameter == 'pemeriksaan') {
                        row += `<td>${pem[parameter]} \n Tanda Vital  : TD : ${pem.tensi} mmHG, Nadi : ${pem.nadi}/mnt, RR : ${pem.respirasi}/mnt, Suhu : ${pem.suhu_tubuh} C \nKesadaran : ${pem.kesadaran}, \nHasil Pemeriksaan : , </td>`;
                    } else {
                        row += `<td>${pem[parameter]}</td>`;
                    }
                    row += `</tr>`
                    no++;
                    $('#tbListResume tbody').append(row);
                })
            })
        }

        function cariPemberianObat(noRawat, el) {
            $('#tbListResume tbody').empty();
            keyword = $('#modalListResume input[name=pemeriksaan]').val();
            getPemberianObat(noRawat, keyword).done((response) => {
                no = 1;
                $.map(response, (obat) => {
                    row = `<tr class="${no}" onclick="setTextRiwayat('${parameter}', ${no} )" style="cursor:pointer">`
                    row += `<td>${formatTanggal(obat.tgl_perawatan)}</td>`;
                    row += `<td>${obat.jam}</td>`;
                    row += `<td>${obat.databarang.nama_brng} : ${obat.jml} ${obat.databarang.kode_satuan.satuan}</td>`;
                    row += `</tr>`
                    no++;
                    $('#tbListResume tbody').append(row);
                })
            })
        }
        $('#pemeriksaan').on('search', () => {
            const pemeriksaan = $('#pemeriksaan').val()
            const parameter = $('#modalListResume input[name=pemeriksaan]').val();
            const no_rawat = $('#modalListResume input[name=no_rawat]').val();
            if (pemeriksaan.length == 0) {
                listRiwayatPemeriksaan(no_rawat, parameter)
            }
        });
    </script>
@endpush
