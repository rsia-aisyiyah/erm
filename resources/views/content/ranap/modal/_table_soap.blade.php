<div class="row">
    <div class="col">
        <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control tanggal tgl_pertama_soap">
            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
        </div>
    </div>
    <div class="col">
        <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control tanggal tgl_kedua_soap">
            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
        </div>
    </div>
    <div class="col">
        <div class="d-grid gap-2">
            <button type="button" class="btn btn-success btn-sm" style="border-radius:0px" id="cari"
                onclick="cariSoap()">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>
</div>
<div>
    <table width="80%" class="table table-striped nowrap" id="tbSoap">
        <thead>
            <tr>
                {{-- <td>No. Rawat</td>
                <td>Nama Pasien</td> --}}
                <td>Ubah</td>
                <td>Tanggal & Jam Rawat</td>
                <td>TTV</td>
                <td>Antropometri</td>
                <td>Nadi (/mnt)</td>
                <td>Respirasi (/mnt)</td>
                <td>Tinggi (cm)</td>
                <td>Berat (Kg)</td>
                <td>SpO2 (%)</td>
                <td>GCS (E,V,M)</td>
                <td>Kesadaran</td>
                <td>Alergi</td>
                <td widht="500px">Subjek</td>
                <td>Objek</td>
                <td>Asesmen</td>
                <td>Plan</td>
                <td>Instruksi</td>
                <td>Evaluasi</td>
                <td>Dokter/Paramedis</td>
            </tr>
        </thead>
    </table>
</div>

@push('script')
    <script>
        var no_rawat_soap = '';

        function editSoap(no, tgl, jam) {

        }

        function cariSoap() {
            tgl_pertama = splitTanggal($('.tgl_pertama_soap').val());
            tgl_kedua = splitTanggal($('.tgl_kedua_soap').val());
            $('#tbSoap').DataTable().destroy();
            tbSoapRanap(no_rawat_soap, tgl_pertama, tgl_kedua);
        }

        function tbSoapRanap(no_rawat = '', tgl_pertama = '', tgl_kedua = '') {
            no_rawat_soap = no_rawat;
            var tbSoapRanap = $('#tbSoap').DataTable({
                processing: true,
                scrollX: true,
                scrollY: 300,
                serverSide: true,
                stateSave: true,
                searching: false,
                lengthChange: false,
                ordering: false,
                paging: false,
                info: false,
                autoWidth: false,
                ajax: {
                    url: "soap",
                    data: {
                        'no_rawat': no_rawat,
                        'tgl_pertama': tgl_pertama,
                        'tgl_kedua': tgl_kedua,
                    },
                },
                fixedColumns: {
                    left: 1,
                },
                scrollCollapse: true,
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            console.log(row)
                            return '<button type="button" data-id="' + row.no_rawat +
                                '" data-tgl="' + row.tgl_perawatan +
                                '" data-jam="' + row.jam_rawat +
                                '" class="btn btn-primary btn-sm" data-bs-target="#formSoapRanap" aria-expanded="false" aria-controls="formSoapRanap" data-bs-toggle="collapse" onclick="editSoap(\'' +
                                row.no_rawat + '\',\'' + row.tgl_perawatan +
                                '\', \'' + row.jam_rawat +
                                '\')"><i class="bi bi-pencil-square"></i></button>';
                        },
                        name: 'tgl_perawatan',
                    },
                    {
                        data: 'tgl_perawatan',
                        render: function(data, type, row, meta) {
                            return formatTanggal(data) + ' ' + row.jam_rawat;
                        },
                        name: 'tgl_perawatan',
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {

                            list = '<li> Suhu Tubuh : ' + row.suhu_tubuh + '  (<sup>o</sup>C)</li>';
                            list += '<li> Tensi : ' + row.tensi + ' mmHg</li>';
                            list += '<li> Nadi : ' + row.nadi + ' /mnt</li>';
                            list += '<li> Respirasi : ' + row.respirasi + ' /mnt</li>';
                            list += '<li> Tinggi : ' + row.tinggi + ' Cm</li>';
                            list += '<li> Berat : ' + row.berat + ' Kg</li>';
                            list += '<li> SpO2 : ' + row.spo2 + ' %</li>';
                            list += '<li> GCS : ' + row.gcs + '</li>';
                            list += '<li> Kesadaran : ' + row.kesadaran + '</li>';
                            list += '<li> alergi : ' + row.alergi + '</li>';
                            html = '<ul>' + list + '</ul>';
                            return html;
                        },
                        name: 'ttv',
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            list = '<li> Tensi : ' + row.tinggi + ' Cm</li>';
                            list += '<li> Berat : ' + row.berat + ' Kg</li>';
                            html = '<ul>' + list + '</ul>';
                            return html;
                        },
                        name: 'antoprometri',
                    },
                    {
                        data: 'nadi',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'nadi',
                    },
                    {
                        data: 'respirasi',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'respirasi',
                    },
                    {
                        data: 'tinggi',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'tinggi',
                    },
                    {
                        data: 'berat',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'berat',
                    },
                    {
                        data: 'spo2',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'spo2',
                    },
                    {
                        data: 'gcs',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'gcs',
                    },
                    {
                        data: 'kesadaran',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'kesadaran',
                    },
                    {
                        data: 'alergi',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'alergi',
                    },
                    {
                        data: 'keluhan',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'keluhan',
                    },
                    {
                        data: 'pemeriksaan',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'pemeriksaan',
                    },
                    {
                        data: 'penilaian',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'penilaian',
                    },
                    {
                        data: 'rtl',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'rtl',
                    },
                    {
                        data: 'instruksi',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'instruksi',
                    },
                    {
                        data: 'evaluasi',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'evaluasi',
                    },
                    {
                        data: 'petugas',
                        render: function(data, type, row, meta) {
                            return data.nama;
                        },
                        name: 'petugas',
                    },
                ],
                "language": {
                    "zeroRecords": "Tidak ada data pasien terdaftar",
                    "infoEmpty": "Tidak ada data pasien terdaftar",
                }
            });
        }
    </script>
@endpush
