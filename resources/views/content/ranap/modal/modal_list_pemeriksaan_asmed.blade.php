<div class="modal fade" id="modalListRiwayatTtv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color:#00000082">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <table class="table table-striped" id="tblistRiwayatTtv">
                    <thead>
                        <tr>
                            <th width="20%">TANGGAL</th>
                            <th width="10%">JAM</th>
                            <th class="">Kesadaran</th>
                            <th class="">GCS</th>
                            <th class="">TB</th>
                            <th class="">BB</th>
                            <th class="">TD</th>
                            <th class="">Nadi</th>
                            <th class="">RR</th>
                            <th class="">Suhu</th>
                            <th class="">SpO2</th>
                            <th width="25%" class="petugas">PETUGAS</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $('#modalListRiwayatTtv').on('hidden.bs.modal', () => {
            $('#tbListResume tbody').empty();
            $('#pemeriksaan').val('');
        })

        function listRiwayatTtv(no_rawat, parameter, sps) {
            $('#tblistRiwayatTtv').DataTable({
                destroy: true,
                processing: true,
                ordering: true,
                paging: false,
                scrollY: true,
                info: false,
                ajax: {
                    url: "/erm/soap/get/table",
                    data: {
                        'no_rawat': no_rawat,
                        'parameter': parameter,
                    },

                },
                createdRow: function(row, data, dataIndex) {
                    $(row).attr('class', 'row-' + dataIndex);
                    $(row).attr('onclick', `setTtvAsmed('${sps}', ${dataIndex})`);
                },

                columns: [{
                        data: '',
                        render: function(data, type, row, meta) {
                            return splitTanggal(row.tgl_perawatan)
                        }
                    },
                    {
                        data: '',
                        render: function(data, type, row, meta) {
                            return row.jam_rawat
                        }
                    },
                    {
                        data: 'kesadaran',
                        render: function(data, type, row, meta) {
                            return data
                        }
                    },
                    {
                        data: 'gcs',
                        render: function(data, type, row, meta) {
                            return data
                        }
                    },
                    {
                        data: 'tinggi',
                        render: function(data, type, row, meta) {
                            return data
                        }
                    },
                    {
                        data: 'berat',
                        render: function(data, type, row, meta) {
                            return data
                        }
                    },
                    {
                        data: 'tensi',
                        render: function(data, type, row, meta) {
                            return data
                        }
                    },
                    {
                        data: 'nadi',
                        render: function(data, type, row, meta) {
                            return data
                        }
                    },
                    {
                        data: 'respirasi',
                        render: function(data, type, row, meta) {
                            return data
                        }
                    },
                    {
                        data: 'suhu_tubuh',
                        render: function(data, type, row, meta) {
                            return data
                        }
                    },
                    {
                        data: 'spo2',
                        render: function(data, type, row, meta) {
                            return data
                        }
                    },
                    {
                        data: '',
                        render: function(data, type, row, meta) {
                            return row.petugas.nama
                        }
                    },

                ],
                "language": {
                    "zeroRecords": "Tidak ada data pemeriksaan",
                    "infoEmpty": "Tidak ada data pemeriksaan",
                    "search": "Cari",
                }
            })


            $('.parameter').text(`${parameter.toUpperCase()}`)
            $('#modalListRiwayatTtv .modal-title').text(`RIWAYAT ${parameter.toUpperCase()}`)
            $('#tblistRiwayatTtv .petugas').css('display', '')
            $('#modalListRiwayatTtv').modal('show')
        }

        function setTtvAsmed(sps, index) {
            kesadaran = $('#tblistRiwayatTtv tbody .row-' + index).find("td").eq(2).html();
            gcs = $('#tblistRiwayatTtv tbody .row-' + index).find("td").eq(3).html();
            tb = $('#tblistRiwayatTtv tbody .row-' + index).find("td").eq(4).html();
            bb = $('#tblistRiwayatTtv tbody .row-' + index).find("td").eq(5).html();
            td = $('#tblistRiwayatTtv tbody .row-' + index).find("td").eq(6).html();
            nadi = $('#tblistRiwayatTtv tbody .row-' + index).find("td").eq(7).html();
            rr = $('#tblistRiwayatTtv tbody .row-' + index).find("td").eq(8).html();
            suhu = $('#tblistRiwayatTtv tbody .row-' + index).find("td").eq(9).html();
            spo = $('#tblistRiwayatTtv tbody .row-' + index).find("td").eq(10).html();

            $('#' + sps + ' select[name=kesadaran]').val(kesadaran);
            $('#' + sps + ' input[name=gcs]').val(gcs);
            $('#' + sps + ' input[name=tb]').val(tb);
            $('#' + sps + ' input[name=bb]').val(bb);
            $('#' + sps + ' input[name=td]').val(td);
            $('#' + sps + ' input[name=nadi]').val(nadi);
            $('#' + sps + ' input[name=rr]').val(rr);
            $('#' + sps + ' input[name=suhu]').val(suhu);
            $('#' + sps + ' input[name=spo]').val(spo);
            $('#modalListRiwayatTtv').modal('hide')
        }
    </script>
@endpush
