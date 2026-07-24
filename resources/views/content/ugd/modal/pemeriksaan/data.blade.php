<table class="table table-striped table-bordered table-responsive text-sm table-sm" id="tbSoapUgd" width="100%">
    <thead>
        <tr role="row">
            <th width="5%">Aksi</th>
            <th width="15%">TTV & Fisik</th>
            <th width="80%">CPPT</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('script')
    <script>
        const tabPemeriksaanRanap = $('button[data-bs-target="#tabPemeriksaanUgd-pane"]')

        tabPemeriksaanRanap.on('shown.bs.tab', function () {
            const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
            tbSoapUgd(no_rawat);

            console.log(tabPemeriksaanRanap);

        })

        function tbSoapUgd(noRawat) {
            $('#tbSoapUgd').DataTable({
                processing: true,
                scrollX: false,
                serverSide: true,
                stateSave: true,
                ordering: false,
                paging: false,
                info: false,
                searching: false,
                destroy: true,
                ajax: {
                    url: '/erm/ugd/soap/table',
                    data: {
                        no_rawat: noRawat
                    },
                    error: (request) => {
                        if (request.status == 401) {
                            Swal.fire({
                                title: 'Sesi login berakhir !',
                                icon: 'info',
                                text: 'Silahkan login kembali ',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/erm';
                                }
                            })
                        }
                    },
                },
                columns: [{
                    data: null,
                    render: (data, type, row, meta) => {
                        button = `<button type="button" class="btn btn-primary btn-sm mb-2" onclick="ambilSoapRalan('${row.no_rawat}', '${row.tgl_perawatan}', '${row.jam_rawat}')"><i class="bi bi-pencil-square"></i></button>`;
                        if (row.nip == "{{ session()->get('pegawai')->nik }}") {
                            button += `<br/><button type="button" class="btn btn-danger btn-sm" onclick="hapusSoapRalan('${row.no_rawat}', '${row.tgl_perawatan}', '${row.jam_rawat}')"><i class="bi bi-trash3-fill"></i></button>`;
                        }


                        return button;
                    },
                },
                {
                    data: null,
                    render: (data, type, row, meta) => {
                        list = '<li><strong>' + formatTanggal(row.tgl_perawatan) + ' ' + row.jam_rawat +
                            '</strong></li>';
                        list += '<li> Kesadaran : ' + row.kesadaran + '</li>';
                        $.map(row.grafik_harian, function (grafik) {
                            if (row.tgl_perawatan == grafik.tgl_perawatan && row.jam_rawat == grafik.jam_rawat) {
                                list += '<li> O2 : ' + grafik.o2 + '</li>';
                            }
                        })
                        list += '<li> GCS : ' + row.gcs + '</li>';
                        list += '<li> Tensi : ' + row.tensi + ' mmHg</li>';
                        list += '<li> Nadi : ' + row.nadi + ' /mnt</li>';
                        list += '<li> SpO2 : ' + row.spo2 + ' %</li>';
                        list += '<li> Respirasi : ' + row.respirasi + ' /mnt</li>';

                        $.map(row.grafik, (grafik) => {
                            if (row.tgl_perawatan == grafik.tgl_perawatan && row.jam_rawat == grafik.jam_rawat) {
                                list += '<li> Oksigen : ' + grafik.o2 + ' /mnt</li>';
                            }
                        })
                        list += '<li> Suhu Tubuh : ' + row.suhu_tubuh + '  (<sup>o</sup>C)</li>';
                        list += '<li> Tinggi : ' + row.tinggi + ' Cm</li>';
                        list += '<li> Berat : ' + row.berat + ' Kg</li>';
                        list += '<li> Alergi : ' + row.alergi + '</li>';
                        html = '<ul>' + list + '</ul>';

                        $.map(row.log, function (log) {
                            if (row.tgl_perawatan === log.tgl_perawatan && row.jam_rawat === log.jam_rawat) {
                                html += `<div class="alert alert-info" role="alert" style="padding:5px;font-size:10px"><i>Di${log.aksi.toLowerCase()} oleh : <b>${log.pegawai?.nama}</b>
                                                                                                                                                                                                , ${formatTanggal(log.waktu)}
                                                                                                                                                                                                    </i></div>`
                            }
                        })

                        return html;
                    }
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        baris = '<tr><td width="5%">Petugas </td><td width="5%">:</td><td>' + row
                            .pegawai.nama + '</td></tr>'
                        baris += '<tr><td>Subjek </td><td>:</td><td>' + stringPemeriksaan(row.keluhan) + '</td></tr>'
                        baris += '<tr><td>Objek </td><td>:</td><td>' + stringPemeriksaan(row.pemeriksaan) + '</td></tr>'
                        baris += '<tr><td>Assesment</td><td>:</td><td>' + stringPemeriksaan(row.penilaian) + '</td></tr>'
                        baris += '<tr><td>Plan</td><td>:</td><td>' + stringPemeriksaan(row.rtl) + '</td></tr>'
                        baris += '<tr><td>Instruksi</td><td>:</td><td>' + stringPemeriksaan(row.instruksi) + '</td></tr>'
                        html = '<table class="table table-striped">' + baris + '</table>'
                        return html;
                    },
                    name: 'soap',
                }

                ]
            });
        }
    </script>
@endpush