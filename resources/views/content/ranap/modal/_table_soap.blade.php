<div>
    <table width="100%" class="table table-striped" id="tbSoap">
        <thead>
            <tr>
                {{-- <td>No. Rawat</td>
                <td>Nama Pasien</td> --}}
                <td>Tanggal & Jam Rawat</td>
                <td>Suhu (<sup>o</sup>C)</td>
                <td>Tensi</td>
                <td>Nadi (/mnt)</td>
                <td>Respirasi (/mnt)</td>
                <td>Tinggi (cm)</td>
                <td>Berat (Kg)</td>
                <td>SpO2 (%)</td>
                <td>GCS (E,V,M)</td>
                <td>Kesadaran</td>
                <td>Alergi</td>
                <td widht="200px">Subjek</td>
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
        function tbSoapRanap(no_rawat = '') {
            var tbSoapRanap = $('#tbSoap').DataTable({
                processing: true,
                scrollX: true,
                scrollY: 200,
                serverSide: true,
                stateSave: true,
                searching: false,
                lengthChange: false,
                ordering: false,
                paging: false,
                paging: false,
                info: false,
                autoWidth: false,
                ajax: {
                    url: "soap",
                    data: {
                        'no_rawat': no_rawat,
                    },
                },
                columnDefs: [{
                        width: 500,
                        targets: 11,
                    },
                    {
                        width: 500,
                        targets: 12,
                    },
                    {
                        width: 500,
                        targets: 13,
                    },
                    {
                        width: 500,
                        targets: 14,
                    },
                ],
                // fixedColumns: true,
                scrollCollapse: true,
                columns: [
                    // {
                    //     data: 'no_rawat',
                    //     name: 'no_rawat',
                    // },
                    // {
                    //     data: 'reg_periksa',
                    //     render: function(data) {
                    //         return data.pasien.nm_pasien + '(' + data.no_rkm_medis + ')';
                    //     },
                    //     name: 'pasien',
                    // },
                    {
                        data: 'tgl_perawatan',
                        render: function(data, type, row, meta) {
                            return formatTanggal(data) + ' ' + row.jam_rawat;
                        },
                        name: 'tgl_perawatan',
                    },
                    {
                        data: 'suhu_tubuh',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'suhu_tubuh',
                    },
                    {
                        data: 'tensi',
                        render: function(data, type, row, meta) {
                            return data;
                        },
                        name: 'tensi',
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
                            console.log(row)
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
