@extends('index')
@section('contents')
    <div class="row gy-2">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Pasien UGD
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <label for="tgl_registrasi" class="form-label" style="font-size: 12px;margin-bottom:0px">Periode</label>
                            <input type="text" class="form-control form-control-sm" id="tgl_awal" placeholder="" autocomplete="off">
                        </div>
                        {{-- <div class="col-md-4 col-lg-4 col-sm-6">
                            <input type="text" class="form-control form-control-sm" id="tgl_akhir" placeholder="" autocomplete="off">
                        </div> --}}
                        <div class="col-md-4 col-lg-4 col-sm-6">
                            <label for="" style="font-size: 12px;margin-bottom:0px">Pasien</label>
                            <input type="search" class="form-control form-control-sm" id="nm_pasien" placeholder="" autocomplete="off">
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-responsive text-sm table-sm" id="tb_ugd" width="100%">
                    <thead>
                        <tr role="row">
                            <th width="100px" style="text-align: center"></th>
                            <th>Pasien</th>
                            <th>Dokter DPJP</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
@include('content.ugd.modal.soap')


@push('script')
    <script>
        var tgl_awal = '';
        var tgl_akhir = '';
        var nm_pasien = '';
        var tableUdg = '';
        $(document).ready(() => {
            tbUgd();
            // $.contextMenu({
            //     selector: 'tr',
            //     callback: (key, option) => {
            //         console.log(key)
            //     }
            // })
        })

        function tbUgd() {
            tableUdg = $('#tb_ugd').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                stateSave: true,
                ordering: false,
                paging: false,
                info: false,
                searching: false,
                ajax: {
                    url: "/erm/ugd/get/table",
                    data: {
                        tgl_awal: tgl_awal,
                        tgl_akhir: tgl_akhir,
                        nm_pasien: nm_pasien,
                    },
                },
                initComplete: function() {
                    Swal.fire({
                        title: 'Menampilkan data rawat inap',
                        position: 'top-end',
                        toast: true,
                        icon: 'success',
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                columns: [{
                        data: '',
                        render: function(data, type, row, meta) {
                            list = '<li><a class="dropdown-item" href="#" onclick="modalSoapUgd(\'' + row.no_rawat + '\')">S.O.A.P</a></li>';
                            list += '<li><a class="dropdown-item" href="#" onclick="modalAmsedUgd(\'' + row.no_rawat + '\')">Asesmen Medis UGD</a></li>';
                            button = '<div class="dropdown-center"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:12px;width:80px;margin-left:15px">Aksi</button><ul class="dropdown-menu" style="font-size:12px">' + list + '</ul></div>'
                            return button;
                        }
                    },
                    {
                        data: 'pasien',
                        render: (data, type, row, meta) => {
                            // return row.no-rawatrow.pasien.nm_pasien;
                            let penjab = '';
                            if (row.penjab.kd_pj == 'A03') {
                                penjab = `<span class="text-danger"><b>${row.penjab.png_jawab}</b></span>`
                            } else if (row.penjab.kd_pj == 'A01' || row.penjab.kd_pj == 'A05') {
                                penjab = `<span class="text-success"><b>${row.penjab.png_jawab}</b></span>`
                            }
                            kamarInap = Object.keys(row.kamar_inap).length ? `<span class="badge text-bg-success">Pindah Kamar</span>` : '';
                            return `${row.no_rawat} <br/> <strong>${row.pasien.nm_pasien} (${row.umurdaftar} ${row.sttsumur})</strong> 
                            <br/> ${penjab} <br/> ${kamarInap}`
                        }
                    },
                    {
                        data: 'dokter',
                        render: (data, type, row, meta) => {
                            return row.dokter.nm_dokter;
                        }
                    },
                    {
                        data: 'kamar',
                        render: (data, type, row, meta) => {
                            if (Object.keys(row.kamar_inap).length > 0) {
                                return '<span class="text-danger">Rawat Inap</span>';
                            } else {
                                return '<span class="text-success">Rawat Jalan</span>';

                            }
                        }
                    }

                ],
                "language": {
                    "zeroRecords": "Tidak ada data pasien terdaftar",
                    "infoEmpty": "Tidak ada data pasien terdaftar",
                    "search": "Cari Nama Pasien",
                }
            })
        }

        function modalSoapUgd(noRawat) {

            getRegPeriksa(noRawat).done((response) => {
                $('#formSoapUgd input[name="no_rawat"]').val(response.no_rawat)
                $('#formSoapUgd input[name="nm_pasien"]').val(`${response.pasien.nm_pasien} (${hitungUmur(response.pasien.tgl_lahir)})`)
            })
            $('#formSoapUgd input[name="nik"]').val("{{ session()->get('pegawai')->nik }}")
            $('#formSoapUgd input[name="nama"]').val("{{ session()->get('pegawai')->nama }}")
            $('#modalSoapUgd').modal('show')
            $('#tbSoapUgd').DataTable().destroy();
            tbSoapUgd(noRawat);

        }

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
                ajax: {
                    url: '/erm/ugd/soap/table',
                    data: {
                        no_rawat: noRawat
                    },
                },
                columns: [{
                        data: null,
                        render: (data, type, row, meta) => {
                            button = `<button type="button" class="btn btn-primary btn-sm mb-2" onclick="ambilSoapRalan('${row.no_rawat}', '${row.tgl_perawatan}', '${row.jam_rawat}')"><i class="bi bi-pencil-square"></i></button>`;
                            button += `<br/><button type="button" class="btn btn-danger btn-sm" onclick="hapusSoapRalan('${row.no_rawat}', '${row.tgl_perawatan}', '${row.jam_rawat}')"><i class="bi bi-trash3-fill"></i></button>`;
                            return button;
                        },
                    },
                    {
                        data: null,
                        render: (data, type, row, meta) => {
                            list = '<li><strong>' + formatTanggal(row.tgl_perawatan) + ' ' + row.jam_rawat +
                                '</strong></li>';
                            list += '<li> Kesadaran : ' + row.kesadaran + '</li>';
                            $.map(row.grafik_harian, function(grafik) {
                                if (row.tgl_perawatan == grafik.tgl_perawatan && row.jam_rawat == grafik.jam_rawat) {
                                    list += '<li> O2 : ' + grafik.o2 + '</li>';
                                }
                            })
                            list += '<li> GCS : ' + row.gcs + '</li>';
                            list += '<li> Tensi : ' + row.tensi + ' mmHg</li>';
                            list += '<li> Nadi : ' + row.nadi + ' /mnt</li>';
                            list += '<li> SpO2 : ' + row.spo2 + ' %</li>';
                            list += '<li> Respirasi : ' + row.respirasi + ' /mnt</li>';
                            list += '<li> Suhu Tubuh : ' + row.suhu_tubuh + '  (<sup>o</sup>C)</li>';
                            list += '<li> Tinggi : ' + row.tinggi + ' Cm</li>';
                            list += '<li> Berat : ' + row.berat + ' Kg</li>';
                            list += '<li> Alergi : ' + row.alergi + '</li>';
                            html = '<ul>' + list + '</ul>';
                            return html;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            baris = '<tr><td width="5%">Petugas </td><td width="5%">:</td><td>' + row
                                .pegawai.nama + '</td></tr>'
                            baris += '<tr><td>Subjek </td><td>:</td><td>' + row.keluhan + '</td></tr>'
                            baris += '<tr><td>Objek </td><td>:</td><td>' + row.pemeriksaan + '</td></tr>'
                            baris += '<tr><td>Assesment</td><td>:</td><td>' + row.penilaian + '</td></tr>'
                            baris += '<tr><td>Plan</td><td>:</td><td>' + row.rtl + '</td></tr>'
                            baris += '<tr><td>Instruksi</td><td>:</td><td>' + row.instruksi + '</td></tr>'
                            // baris += '<tr><td>Evaluasi</td><td>:</td><td>' + row.evaluasi + '</td></tr>'
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
