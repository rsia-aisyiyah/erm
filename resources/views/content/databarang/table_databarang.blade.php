@extends('index')

@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-responsive" id="tbDataBarang" width="100%">
                    </table>

                </div>
            </div>

        </div>
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            renderDataBarang();
        })

        function renderDataBarang(...args) {
            $('#tbDataBarang').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: '/erm/obat/table',
                    data: [args],
                },
                columns: [{
                        data: 'kode_brng',
                        name: 'kode_brng',
                        title: 'Kode Barang',
                    },
                    {
                        data: 'nama_brng',
                        name: 'nama_brng',
                        title: 'Nama',
                    },
                    {
                        data: 'kapasitas',
                        name: 'kapasitas',
                        title: 'Kandungan'
                    },
                    {
                        data: 'ralan',
                        name: 'ralan',
                        title: 'Harga Ralan',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp. ')
                    },
                    {
                        data: 'letak_barang',
                        name: 'letak_barang',
                        title: 'Kandungan',

                    },
                    {
                        data: 'gudang_barang',
                        name: 'gudang_barang',
                        title: 'Stok Rajal',
                        render: (data, type, row, meta) => {
                            const stokRalan = data.reduce((acc, item) => item.kd_bangsal === 'RM7' ? acc + item.stok : acc, '');
                            return stokRalan > 0 ? stokRalan : `<span class="text-danger">Kosong</span>`
                        }
                    },
                    {
                        data: 'kode_satuan.satuan',
                        name: 'kode_satuan.satuan',
                        title: 'Jenis'
                    },
                    {
                        data: 'kategori.nama',
                        name: 'kategori.nama',
                        title: 'Kategori'
                    },
                    {
                        data: 'golongan.nama',
                        name: 'golongan.nama',
                        title: 'Golongan'
                    }
                ]
            });

        }
    </script>
@endpush
