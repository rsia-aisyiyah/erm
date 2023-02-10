@extends('index')

@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2">
                        <div class="row gy-2">
                            <div class="col-lg-2 col-md-12 col-sm-12">
                                <div class="input-group">
                                    <div class="row gy-2">
                                        <div class="col col-sm-12">
                                            <div class="form-radio form-radio-inline mt-2">
                                                <input class="form-radio-input" type="radio" id="belum"
                                                    name="stts_pulang" value="Belum Pulang">
                                                <label class="form-radio-label" for="belum">Belum
                                                    Pulang</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="input-group">
                                    <div class="row gy-2">
                                        <div class="col col-sm-4">
                                            <div class="form-radio form-radio-inline mt-2">
                                                <input class="form-radio-input" type="radio" id="pulang"
                                                    name="stts_pulang" value="pulang">
                                                <label class="form-radio-label" for="pulang">Pulang</label>
                                            </div>
                                        </div>
                                        <div class="col col-sm-4" style="padding-left: 0px;padding-right: 4px;">
                                            <input type="text" class="form-control form-control-sm tanggal tgl_pulang"
                                                id="tgl_pulang_awal" name="tgl_pulang_awal" autocomplete="off"
                                                style="border-radius:0px;font-size:12px" disabled>
                                        </div>
                                        <div class="col col-sm-4" style="padding-left: 4px;padding-right: 0px;">
                                            <input type="text" class="form-control form-control-sm tanggal tgl_pulang"
                                                id="tgl_pulang_akhir" name="tgl_pulang_akhir" autocomplete="off"
                                                style="border-radius:0px;font-size:12px" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="input-group">
                                    <div class="row gy-2">
                                        <div class="col col-sm-4">
                                            <div class="form-radio form-radio-inline mt-2">
                                                <input class="form-radio-input" type="radio" id="masuk"
                                                    name="stts_pulang" value="masuk">
                                                <label class="form-radio-label" for="masuk">Masuk</label>
                                            </div>
                                        </div>
                                        <div class="col col-sm-4" style="padding-left: 0px;padding-right: 4px;">
                                            <input type="text" class="form-control form-control-sm tanggal tgl_masuk"
                                                id="tgl_masuk_awal" name="tgl_masuk_awal" autocomplete="off"
                                                style="border-radius:0px;font-size:12px" disabled>
                                        </div>
                                        <div class="col col-sm-4" style="padding-left: 4px;padding-right: 0px;">
                                            <input type="text" class="form-control form-control-sm tanggal tgl_masuk"
                                                id="tgl_masuk_akhir" name="tgl_masuk_akhir" autocomplete="off"
                                                style="border-radius:0px;font-size:12px" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-12 col-sm-12">
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-success btn-sm" style="border-radius:0px"
                                        id="cari">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>

                        </div>

                    </div>
                    <table class="table table-striped table-responsive text-sm table-sm" id="tb_ranap" width="100%">
                        <thead>
                            <tr role="row">
                                <th width="100px"></th>
                                <th width="25%">No.Rawat</th>
                                <th>Kamar</th>
                                <th>Lama</th>
                                <th>Dokter</th>
                                <th>Diagnosa Awal</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    @include('content.ranap.modal.modal_lab')
    @include('content.ranap.modal.modal_soap')
@endsection
@push('script')
    <script>
        var stts_pulang = '-';
        var tgl_awal = '';
        var tgl_akhir = '';
        $(document).ready(function() {
            date = new Date()
            hari = ('0' + (date.getDate())).slice(-2);
            bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;
            $('.tanggal').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
            });
            $('.tanggal').datepicker('setDate', dateStart)
            tb_ranap();
        })

        $('#pulang').on('click', function() {
            stts_pulang = 'Pulang';
            if ($('#pulang').is(':checked')) {
                $('.tgl_pulang').prop('disabled', false)
                $('.tgl_masuk').prop('disabled', true)
            } else {
                $('.tgl_pulang').prop('disabled', true)
                $('.tgl_masuk').prop('disabled', false)
            }
        })
        $('#masuk').on('click', function() {
            stts_pulang = 'Masuk';
            if ($('#masuk').is(':checked')) {
                $('.tgl_pulang').prop('disabled', true)
                $('.tgl_masuk').prop('disabled', false)
            } else {
                $('.tgl_pulang').prop('disabled', false)
                $('.tgl_masuk').prop('disabled', true)
            }
        })

        function splitTanggal(tanggal) {
            let arrTgl = tanggal.split('-');
            let txtTanggal = arrTgl[2] + '-' + arrTgl[1] + '-' + arrTgl[0];
            return txtTanggal;
        }
        $('#belum').on('click', function() {
            stts_pulang = '-';
            $('.tgl_pulang').prop('disabled', true)
            $('.tgl_masuk').prop('disabled', true)
        });

        $('#cari').on('click', function() {
            let a = '';
            let b = '';
            if (stts_pulang == 'Pulang') {
                a = $('#tgl_pulang_awal').val();
                b = $('#tgl_pulang_akhir').val();
            } else if (stts_pulang == 'Masuk') {
                a = $('#tgl_masuk_awal').val();
                b = $('#tgl_masuk_akhir').val();
            }

            tgl_awal = splitTanggal(a)
            tgl_akhir = splitTanggal(b)

            $('#tb_ranap').DataTable().destroy();
            tb_ranap();
        })

        function tb_ranap() {
            var tb_ranap = $('#tb_ranap').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                stateSave: true,
                ordering: false,
                paging: false,
                info: false,
                ajax: {
                    url: "/erm/ranap/pasien",
                    data: {
                        'stts_pulang': stts_pulang,
                        'tgl_pertama': tgl_awal,
                        'tgl_kedua': tgl_akhir,
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
                    })
                },
                columns: [{
                        data: 'reg_periksa',
                        render: function(data) {

                            list =
                                '<li><a class="dropdown-item" href="#" onclick="modalLabRanap()">Laborat</a></li>';
                            list +=
                                '<li><a class="dropdown-item" href="#" onclick="modalSoapRanap(\'' + data
                                .no_rawat + '\')">S.O.A.P</a></li>';
                            list += '<li><a class="dropdown-item" href="#">EWS</a></li>';
                            list += '<li><a class="dropdown-item" href="#">Pemeriksaan Penunjang</a></li>';
                            list += '<li><a class="dropdown-item" href="#">Diagnosis ICD</a></li>';
                            button =
                                '<div class="dropdown-center"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" width="100px">Aksi</button><ul class="dropdown-menu">' +
                                list + '</ul></div>'
                            return button;
                        }
                    },
                    {
                        data: 'reg_periksa',
                        render: function(data) {
                            return data.no_rawat + '<br/><strong>' +
                                data.pasien.nm_pasien +
                                '</strong><br/> (' + data.no_rkm_medis +
                                ')';
                        },
                        name: 'reg_periksa',
                    },
                    {
                        data: 'kamar',
                        render: function(data) {
                            return data.bangsal.nm_bangsal;
                        },
                        name: 'kamar',
                    },
                    {
                        data: 'lama',
                        render: function(data) {
                            return data + ' Hari';
                        },
                        name: 'lama',
                    },
                    {
                        data: 'reg_periksa',
                        render: function(data) {
                            return data.dokter.nm_dokter;
                        },
                        name: 'dokter'
                    },
                    {
                        data: 'diagnosa_awal',
                        name: 'diagnosa'
                    },


                ],
                "language": {
                    "zeroRecords": "Tidak ada data pasien terdaftar",
                    "infoEmpty": "Tidak ada data pasien terdaftar",
                }
            })
        }

        function modalLabRanap() {
            $('#modalLabRanap').modal('show')
        }

        function modalSoapRanap(no_rawat) {
            $('#modalSoapRanap').modal('show')
            tbSoapRanap(no_rawat);
        }
        $('#modalSoapRanap').on('hidden.bs.modal', function() {
            $('#tbSoap').DataTable().destroy();
        });
    </script>
@endpush
