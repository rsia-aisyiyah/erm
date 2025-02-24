<div class="modal fade" id="modalResepPulang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel"><i>RESEP OBAT PULANG</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="tbResepObatPulang" width="100%">
                        <thead>
                            <tr>
                                <th>Obat</th>
                                <th>Jumlah</th>
                                <th>Aturan Pakai</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        const modalResepPulang = $('#modalResepPulang');
        // searchPemberianObat.on('click', () => {
        //     const no_rawat = formEdukasiObatPulang.find('input[name=no_rawat]').val();
        //     modalResepPulang.modal('show')

        //     $.get(`${url}/resep-pulang`, {
        //         no_rawat: no_rawat
        //     }).done((response) => {
        //         const obat = response.map((item, index) => {
        //             return `<tr onclick="setObatPulang('${index}')" data-id="${index}">
    //                 <td>${item.kode_brng}</td>
    //                 <td>${item.obat.nama_brng}</td>
    //                 <td>${item.jml_barang}</td>
    //                 <td>${item.dosis}</td>
    //                 <td>${item.tanggal}</td>
    //                 <td>${item.jam}</td>
    //                 </tr>`
        //         })

        //         tbResepObatPulang.find('tbody').empty().html(obat)

        //     })
        // })

        function showModalResepPulang() {
            const no_rawat = formEdukasiObatPulang.find('input[name=no_rawat]').val();
            modalResepPulang.modal('show')

            $.get(`${url}/resep-pulang`, {
                no_rawat: no_rawat
            }).done((response) => {
                const obat = response.map((item, index) => {
                    return `<tr onclick="setObatPulang('${index}')" data-id="${index}">
                        <td>${item.kode_brng}</td>
                        <td>${item.obat.nama_brng}</td>
                        <td>${item.jml_barang}</td>
                        <td>${item.dosis}</td>
                        <td>${item.tanggal}</td>
                        <td>${item.jam}</td>
                        </tr>`
                })

                tbResepObatPulang.find('tbody').empty().html(obat)

            })
        }
    </script>
@endpush
