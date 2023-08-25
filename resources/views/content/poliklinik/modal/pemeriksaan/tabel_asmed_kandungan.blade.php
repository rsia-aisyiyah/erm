<table class="tb-asmed table table-striped table-bordered" width="100%">
    <thead>

        <tr>
            <th>Tanggal</th>
            {{-- <th>No Rawa</th>
            <th>Tgl. Asesmen</th>
            <th>Riwayat Kesehatan</th>
            <th>Pemeriksaan Fisik/TTV</th>
            <th>Status Obstetri</th>
            <th>Penunjang</th>
            <th>Diagnosis</th>
            <th>Tata Laksana</th>
            <th>Konsul/Rujuk</th> --}}
        </tr>
    </thead>
    <tbody class="r_persalinan">

    </tbody>
</table>
@push('script')
    <script>
        function tbAsmedKandungan(no_rkm_medis) {
            $('.tb-asmed').DataTable({
                ajax: {
                    url: '/erm/poliklinik/asmed/kandungan/riwayat/' + no_rkm_medis,
                    "language": {
                        "emptyTable": "data asesmen kosong",
                    }
                },
                columns: [{
                        data: null,
                        render: (data, type, row) => {
                            console.log(row)
                            return 'aaaa';
                        },
                        name: 'no_rawat'
                    },

                ]
            })
        }
    </script>
@endpush
