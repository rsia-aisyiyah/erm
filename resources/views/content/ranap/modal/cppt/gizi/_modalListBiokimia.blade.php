<div class="modal fade" id="modalListBiokimia" tabindex="-1" aria-modal="true" aria-labelledby="modalListBiokimiaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalListBiokimiaLabel">Daftar Pemeriksaan Laboratorium</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-striped table-responsive" id="tbListBiokimia">
                    <thead>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Hasil</th>
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
        const tbListBiokimia = $('#tbListBiokimia').find('tbody');
        const modalListBiokimia = $('#modalListBiokimia');

        modalListBiokimia.on('hidden.bs.modal', function(e) {
            tbListBiokimia.empty();
        })

        function getListBiokimia(no_rawat) {
            $.get(`${url}/lab/ambil`, {
                'no_rawat': no_rawat
            }).done((response) => {
                console.log('BIOKIMIA ===', response);

                if (!response.length) {
                    return Swal.fire({
                        icon: 'error',
                        title: 'Gagal !',
                        text: 'Data pemeriksaan biokimia tidak ditemukan',
                    }).then((e) => {
                        console.log('e', e);
                    });
                }
                const lab = response.map((item, index) => {
                    const {
                        detail
                    } = item;

                    const pemeriksaan = detail.map(items => `${items.template.Pemeriksaan} ${items.nilai} ${items.template.satuan}`).join('; ')

                    return `<tr>
                        <td>${index+1}</td>
                        <td><a href="javascript:void(0)" onclick="setBiokimia('${pemeriksaan}')"><span class="badge bg-primary text-white">${formatTanggal(item.tgl_periksa)} ${item.jam}</span></a></td>
                        <td>${item.petugas.nama}</td>
                        <td>${pemeriksaan}</td>
                    </tr>`
                });
                tbListBiokimia.empty().append(lab)
                $('#modalListBiokimia').modal('show')
            })
        }

        function setBiokimia(value) {
            const textBiokima = biokimiaGizi.val() !== '-' ? `${biokimiaGizi.val()}; ${value}` : value;
            biokimiaGizi.val(textBiokima)

        }
    </script>
@endpush
