<div class="modal fade" id="modalListDiagnosa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color:#00000082">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">KODE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <table class="table table-striped" id="tbListDiagnosa">
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
                    getDiagnosaRanap(keyword).done((response) => {
                        let no = 1;
                        $.map(response, (dx) => {
                            console.log(dx);
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
                    console.log('xxxx');
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
        })
    </script>
@endpush
