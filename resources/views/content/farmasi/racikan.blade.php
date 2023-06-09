@extends('index')

@section('contents')
    <div class="row">
        <div class="col-lg-4 col-sm-12">
            <div class="card">
                <div class="card-header">
                    Featured
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-2">
                            <label for="dokter" class="form-label">Dokter</label>
                            <input type="search" class="form-control" id="dokter" aria-describedby="dokter" name="dokter"
                                onkeyup="cariDokter(this)">
                            <div class="list_dokter"></div>
                            <input type="hidden" class="form-control" id="kd_dokter" aria-describedby="kd_dokter"
                                name="kd_dokter" value="">
                        </div>
                        <div class="mb-2">
                            <label for="nm_racikan" class="form-label">Nama Racikan</label>
                            <input type="text" class="form-control" id="nm_racik" aria-describedby="nm_racik">
                        </div>
                        <button type="button" class="btn btn-primary" id="buatTemplate">Buat Template Racikan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="mb-6 col-lg-8 col-sm-12" id="template">
            <div class="card">
                <div class="card-header">
                    Daftar Racikan
                </div>
                <div class="overflow-auto">
                    <div class="card-body">
                        <table class="table tale-responsive table-stripped" id="tb_template">
                            <thead>
                                <tr>
                                    <th>Nama Racikan</th>
                                    <th>Obat</th>
                                    <th>Dokter</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalTemplate" aria-labelledby="modalTemplate" aria-hidden="true"
        style="background-color: #00000062!important;">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="border-radius:0px">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="">Pilih Obat</h2>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary" style="padding:10px;border-radius:0px;font-size:12px" role="alert">
                        Anda dapat menghapus / menambah daftar obat yang tercantum
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nm_racik" style="font-size:12px">Nama Racikan</label>
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm nm_racik mb-1 form-underline" name="nm_racik"
                                        readonly />
                                    <input type="hidden" class="id_racik">
                                </div>
                                <div class="col-md-6">
                                    <label for="nm_dokter" style="font-size:12px">Dokter</label>
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm nm_dokter mb-1 form-underline" name="nm_dokter"
                                        readonly />
                                    <input type="hidden" class="kd_dokter" name="kd_dokter" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="container">
                                    <table class="table table-racikan table-stripped">
                                        <thead>
                                            <tr>
                                                <th width="35%">Nama Obat</th>
                                                <th>Kapasitas</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-success btn-sm" onclick="tambahDetailObat()"><i
                                            class="bi bi-plus-circle"></i> Tambah
                                        Obat</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" onclick="simpanDetailTemplate()"><i
                            class="bi bi-save" data-bs-dismiss="modal"></i> Simpan</button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                            class="bi bi-x-circle"></i> Keluar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).click(function() {
            $('.list_dokter').fadeOut();
        })

        $(document).ready(function() {
            setTemplate()
        })

        function cariDokter(dokter) {
            nm_dokter = dokter.value
            $.ajax({
                url: '/erm/dokter/cari',
                data: {
                    'nm_dokter': nm_dokter,
                },
                success: function(response) {
                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;border-radius:0;font-size:12px">';
                    $.map(response, function(data) {
                        html += '<li>'
                        html += '<a data-id="' + data.kd_dokter +
                            '" class="dropdown-item" onclick="setDokter(this)">' + data
                            .nm_dokter +
                            '</a>'
                        html += '</li>'
                    })
                    html += '</ul>';
                    $('.list_dokter').fadeIn();
                    $('.list_dokter').html(html);
                }
            })
        }


        function setTemplate(kd_dokter = '', nm_racik = '') {


            $('#tb_template tbody').empty()

            template = ambilTemplateRacikan(kd_dokter, nm_racik);
            if (Object.keys(template).length >= 1) {
                $.map(template, function(data) {
                    html = '<tr>'
                    html += '<td>' + data.nm_racik + '</td>'
                    html += '<td>'
                    // if (Object.keys(data.detail_racik).length > 0) {
                    html += '<ul>'
                    $.map(data.detail_racik, function(detail) {

                        if (detail.data_barang) {
                            html += '<li>' + detail.data_barang.nama_brng + '</li>'
                        } else {
                            html += 'BELUM ADA OBAT <br/>';
                        }
                        // html += '<li>' + detail.data_barang.nama_brng + '</li>'
                        console.log(detail.data_barang)
                    })
                    html += '</ul>'

                    // } else {
                    // }
                    html += '</td>'
                    html += '<td>' + data.dokter.nm_dokter + '</td>'
                    html +=
                        '<td><button class="btn btn-warning btn-sm" style="font-size:12px" onclick="ubahTemplate(' +
                        data.id +
                        ')"><i class="bi bi-pencil"></i></button><button class="btn btn-danger btn-sm" style="font-size:12px"><i class="bi bi-trash3-fill"></i></button></td>'
                    html += '<td>'
                    $('#tb_template tbody').append(html)
                })

                $('#template').css('visibility', 'visible')
            }
        }

        function ubahTemplate(id) {
            $('#modalTemplate').modal('show')

            template = ambilTemplateRacikan(null, null, id);

            $('.kd_dokter').val(template.kd_dokter)
            $('.nm_dokter').val(template.dokter.nm_dokter)
            $('.nm_racik').val(template.nm_racik)
            $('.id_racik').val(template.id)

            no = 1;
            html = '';
            $.map(template.detail_racik, function(temp) {
                html += '<tr class="baris_' + no + '">'
                html += '<td>' + temp.data_barang.nama_brng + '</td>'
                html += '<td>' + temp.data_barang.kapasitas + ' mg</td>'
                html += '<td><button class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></button></td>'
                html += '</tr>'
                no++;
            })
            html += '<input type="hidden" class="nomor" value="' + no + '">'
            $('.table-racikan').append(html)
        }

        $('#modalTemplate').on('hidden.bs.modal', function() {
            $('.table-racikan tbody').empty();
        })

        function setDokter(param) {
            // $('#nm_dokter').val($(param).data('id'));
            kd_dokter = $(param).data('id')
            nm_dokter = $(param).text()
            $('#kd_dokter').val(kd_dokter);
            $('#dokter').val(nm_dokter);
            $('.list_dokter').fadeOut();

            setTemplate(kd_dokter)



        }

        function tambahDetailObat() {
            no = $('.nomor').val();

            html = '<tr class="baris_' + no + '">'
            html += '<td><input type="hidden" id="kode_brng' + no +
                '" /><input class="form-control form-control-sm form-underline nama_obat_' + no +
                '" type="search" onkeyup="cariObatRacikan(this, ' + no + ')" id="nama_brng_' + no +
                '" name="nama_brng"/><div class="list_obat_' + no + '"></div></td>'
            html += '<td><input type="text" readonly class="form-control form-control-sm form-underline" id="kps' + no +
                '"/></td>'
            html += '</tr>'


            $('.table-racikan tbody').append(html)
            no = parseInt(no) + 1;
            $('.nomor').val(no)
        }

        function simpanDetailTemplate() {
            let row = $('.table-racikan tbody tr').length

            console.log(row)

            arrInput = [];
            response = false;

            for (let no = 1; no <= row; no++) {
                $.ajax({
                    url: '/erm/resep/racik/template/detail/tambah',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_racik: $('.id_racik').val(),
                        kode_brng: $("#kode_brng" + no).val(),
                    },
                    success: function(response) {
                        console.log(response)
                    }
                })
            }
        }


        $('#buatTemplate').on('click', function() {
            nm_racik = $('#nm_racik').val();
            kd_dokter = $('#kd_dokter').val();


            ambil = ambilTemplateRacikan(kd_dokter, nm_racik)

            if (Object.keys(ambil).length == 0) {
                $.ajax({
                    url: '/erm/resep/racik/template/tambah',
                    data: {
                        _token: "{{ csrf_token() }}",
                        nm_racik: nm_racik,
                        kd_dokter: kd_dokter,
                    },
                    method: 'POST',
                    success: function(response) {
                        setTemplate();
                    }
                })
            } else {
                console.log("TIDAK MEENAMBAH")
            }

            // console.log(ambil)

        })
    </script>
@endpush
