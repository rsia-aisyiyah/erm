<div class="modal fade" id="modalDetailResep" tabindex="-1" aria-labelledby="modalDetailResep" aria-hidden="true" style="background-color: #00000085;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size: 1em">Detail Isi Resep Racikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabelDetailResep">
                        <thead>
                            <tr>
                                <th>Nama Obat</th>
                                <th style="text-align:center">Kandungan</th>
                                <th style="text-align:center">Dosis</th>
                                <th style="text-align:center">Jumlah Obat</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        function showDetailRacikan(no_resep, no_racik) {
            $.get('/erm/resep/racik/detail/ambil', {
                no_resep: no_resep,
                no_racik: no_racik
            }).done((response) => {
                $('#tabelDetailResep tbody').empty()
                if (response.length) {
                    response.map((resep, index) => {
                        console.log(resep);
                        const row = `<tr>
                            <td>${resep.data_barang.nama_brng} </td>
                            <td style="text-align:right">${resep.data_barang.kapasitas} gr</td>
                            <td style="text-align:right">${resep.kandungan} gr</td>
                            <td style="text-align:right">${resep.jml} ${resep.data_barang.kode_satuan.satuan}</td>
                        </tr>`
                        $('#tabelDetailResep tbody').append(row)
                    })
                    $('#modalDetailResep').modal('show')
                }
                console.log('RESEP RACIKAN ===', response);
            })
        }
    </script>
@endpush
