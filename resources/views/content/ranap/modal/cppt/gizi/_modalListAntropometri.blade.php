<div class="modal fade" id="modalListAntropometri" tabindex="-1" aria-modal="true"
     aria-labelledby="modalListAntropometriLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalListAntropometriLabel">Daftar Pemeriksaan Fisik</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-striped table-responsive" id="tbListAntropometri">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Petugas</th>
                            <th>TB</th>
                            <th>BB</th>
                            <th>TD</th>
                            <th>Suhu</th>
                            <th>Respirasi</th>
                            <th>Kesadatan</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        const tbListAntropometri = $('#tbListAntropometri').find('tbody');
        const modalListAntropometri = $('#modalListAntropometri');

        modalListAntropometri.on('hidden.bs.modal', function (e) {
            tbListAntropometri.empty();
        })

        function getListCpptRanap(no_rawat, target) {
            $.get(`${url}/soap/get`, {
                'no_rawat': no_rawat
            }).done((response) => {

                if (!response.length) {
                    return Swal.fire({
                        icon: 'error',
                        title: 'Gagal !',
                        text: 'Data pemeriksaan tidak ditemukan',
                    }).then((e) => {
                        console.log('e', e);
                    });
                }
                const pemeriksaan = response.map((item, index) => {

                    return `<tr>
                            <td>${index + 1}</td>
                            <td><a href="javascript:void(0)" onclick="setAntropometriRanap('${target}', '${item.no_rawat}', '${item.tgl_perawatan}', '${item.jam_rawat}' )"><span class="badge bg-primary text-white">${formatTanggal(item.tgl_perawatan)} ${item.jam_rawat}</span></a></td>
                            <td>${item.petugas.nama}</td>
                            <td>${item.tinggi} Cm</td>
                            <td>${item.berat} Kg</td>
                            <td>${item.tensi} mmHg</td>
                            <td>${item.suhu_tubuh}</td>
                            <td>${item.respirasi} x/Menit</td>
                            <td>${item.kesadaran}</td>
                        </tr>`
                });
                tbListAntropometri.empty().append(pemeriksaan)
                $('#modalListAntropometri').modal('show')
            })
        }

        function setAntropometriRanap(target, ...params) {
            const targetElement = $(target);
            getDetailPemeriksaanRanap(params[0], params[1], params[2]).done((response) => {
                const berat = response.berat
                const tinggi = response.tinggi === '-' ? 0 : response.tinggi
                const imt = countIMT(berat, tinggi)
                const tensi = response.tensi
                const nadi = response.nadi
                const suhu = response.suhu_tubuh
                const pernapasan = response.respirasi

                targetElement.find('#antropometri_bb').addClass('is-valid').val(berat)
                targetElement.find('#antropometri_tb').addClass('is-valid').val(tinggi)
                targetElement.find('#antropometri_imt').addClass('is-valid').val(imt)
                targetElement.find('#fisik_klinis_td').addClass('is-valid').val(tensi)
                targetElement.find('#fisik_klinis_nadi').addClass('is-valid').val(nadi)
                targetElement.find('#fisik_klinis_suhu').addClass('is-valid').val(suhu)
                targetElement.find('#fisik_klinis_pernapasan').addClass('is-valid').val(pernapasan)

                modalListAntropometri.modal('hide')
            })
        }
    </script>
@endpush
