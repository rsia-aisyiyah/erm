@extends('index')

@section('contents')
    <div class="input-group mb-3 d-none">
        <select class="search form-control" name="keyword"></select>
    </div>
    <div class="row gy-2">
        <div class="col-12">
            <table class="table table-striped table-sm table-responsive nowrap" id="tablePasien" width="100%" style="font-size: 11px">

            </table>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header text-bg-warning">
                    Histori Kunjungan Rawat Jalan
                </div>
                <div class="card-body">
                    <table id="ralan" class="table table-responsive text-sm table-sm">
                        <thead>
                            <tr>
                                <th>No. Rawat</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header text-bg-danger">
                    Histori Kunjungan Rawat Inap
                </div>
                <div class="card-body">
                    <table id="ranap" class="table table-responsive text-sm table-sm">
                        <thead>
                            <tr>
                                <th>No. Rawat</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            @include('content.upload.inforegistrasi')
        </div>
        <div class="col-sm-12">
            @include('content.upload.resume')
            @include('content.poliklinik.modal.modal_riwayat')
            @include('content.ranap.modal.modal_riwayat')
        </div>
    </div>
@endsection

@push('script')
    <script>
        var btnName;
        const tablePasien = $('#tablePasien');
        $(document).ready(function() {
            loadTablePasien();
        })
        $('.search').select2({
            placeholder: 'Cari pasien',
            allowClear: true,
            ajax: {
                url: 'pasien/cari',
                dataType: 'json',
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.no_rkm_medis + ' - ' + item.nm_pasien,
                                id: item.no_rkm_medis
                            }
                        })
                    };
                },
                cache: true
            }
        });
        $(".search").on("select2:unselecting", function(e) {
            $('#button-form label').detach()
            $('#button-form input').detach()
        });

        $('.search').change(function() {
            $('#infoReg').css('visibility', 'hidden')
            $('#form-upload').css('visibility', 'hidden')
            showHistory();
        });



        $(document).ready(function() {
            if ($('.pip').length == 0) {
                $('#submit').hide()
            }
        })

        function confirmRiwayat(no_rkm_medis) {
            Swal.fire({
                title: 'Update',
                text: "Pnambahan tampilan riwayat baru, apakah lanjut ke tampilan riwayat baru ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Gunakan yang baru',
                cancelButtonText: 'Tidak, Tetap yang lama',
            }).then((result) => {
                if (result.isConfirmed) {
                    listRiwayatPasien(no_rkm_medis);
                } else {
                    modalRiwayat(no_rkm_medis);
                }
            })
        }

        function loadTablePasien() {
            tablePasien.DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                ajax: {
                    url: `pasien/table`,
                    data: function(d) {
                        d.no_rkm_medis = d.search.value;
                        d.nm_pasien = d.search.value;
                    }
                },
                columns: [{
                        data: 'no_rkm_medis',
                        name: 'no_rkm_medis',
                        title: '',
                        render: (data, type, row, meta) => {
                            const encRm = row.id;
                            return `<button class="btn btn-primary btn-sm" style="border-radius:20px" onclick="showHistory('${data}')"><i class="bi bi-eye"></i></button>
                            <button class="btn btn-info btn-sm" style="border-radius:20px" onclick="confirmRiwayat('${data}')"><i class="bi bi-info-circle"></i></button>
                            <a href="${url}/pasien/edit/${encRm}" class="btn btn-warning btn-sm" style="border-radius:20px"><i class="bi bi-pencil"></i></a>`
                        }
                    },
                    {
                        data: 'no_rkm_medis',
                        name: 'no_rkm_medis',
                        title: 'No. RM'
                    },
                    {
                        data: 'no_ktp',
                        name: 'no_ktp',
                        title: 'No. KTP/SIM'
                    },

                    {
                        data: 'no_peserta',
                        name: 'no_peserta',
                        title: 'No. Peserta'
                    },
                    {
                        data: 'nm_pasien',
                        name: 'nm_pasien',
                        title: 'Nama'
                    },
                    {
                        data: 'jk',
                        name: 'jk',
                        title: 'JK'
                    },
                    {
                        data: 'tmp_lahir',
                        name: 'tmp_lahir',
                        title: 'Temp. Lahir'
                    },
                    {
                        data: 'tgl_lahir',
                        name: 'tgl_lahir',
                        title: 'Tgl. Lahir',
                        render: (data, type, row, meta) => {
                            return moment(data).format('DD-MM-YYYY')
                        }
                    },
                    {
                        data: 'tgl_lahir',
                        name: 'tgl_lahir',
                        title: 'Umur',
                        render: (data, type, row, meta) => {
                            return hitungUmur(data)
                        }

                    },
                    {
                        data: 'nm_ibu',
                        name: 'nm_ibu',
                        title: 'Nm. Ibu'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat',
                        title: 'Alamat'
                    },
                    {
                        data: 'kel.nm_kel',
                        name: 'kel.nm_kel',
                        title: 'Kelurahan'
                    },
                    {
                        data: 'kec.nm_kec',
                        name: 'kec.nm_kec',
                        title: 'Kecamatan'
                    },
                    {
                        data: 'kab.nm_kab',
                        name: 'kab.nm_kab',
                        title: 'Kab/Kota'
                    },
                    {
                        data: 'no_tlp',
                        name: 'no_tlp',
                        title: 'Telp.'
                    },
                    {
                        data: 'gol_darah',
                        name: 'gol_darah',
                        title: 'G.D.'
                    },
                    {
                        data: 'pekerjaan',
                        name: 'pekerjaan',
                        title: 'Pekerjaan'
                    },
                    {
                        data: 'instansi.nama_perusahaan',
                        name: 'instansi.nama_perusahaan',
                        title: 'Instansi'
                    },
                    {
                        data: 'penjab.png_jawab',
                        name: 'penjab.png_jawab',
                        title: 'Asuransi'
                    },
                    {
                        data: 'tgl_daftar',
                        name: 'tgl_daftar',
                        title: 'Tgl. Daftar',
                        render: (data, type, row, meta) => {
                            return moment(data).format('DD-MM-YYYY')
                        }
                    }

                ]
            })
        }
    </script>
@endpush
