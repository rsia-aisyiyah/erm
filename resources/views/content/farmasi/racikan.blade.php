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
                            <input type="search" class="form-control" id="dokter" aria-describedby="dokter" name="dokter" onkeyup="cariDokter(this)">
                            <div class="list_dokter"></div>
                            <input type="hidden" class="form-control" id="kd_dokter" aria-describedby="kd_dokter" name="kd_dokter" value="">
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
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius:0px">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="">Pilih Obat</h2>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary" style="padding:10px;border-radius:0px;font-size:12px"
                        role="alert">
                        Anda dapat menghapus / menambah daftar obat yang tercantum
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="nm_racik" style="font-size:12px">Nama Racikan</label>
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm nm_racik mb-1 form-underline" name="nm_racik" readonly />
                                </div>
                                <div class="col-md-6">
                                    <label for="nm_dokter" style="font-size:12px">Dokter</label>
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm nm_dokter mb-1 form-underline" name="nm_dokter" readonly />
                                    <input type="hidden" class="kd_dokter" name="kd_dokter" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="container">
                                    <table class="table table-racikan table-borderless">
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
                                    <button type="button" class="btn btn-success btn-sm"
                                        onclick="tambahObat()"><i class="bi bi-plus-circle"></i> Tambah
                                        Obat</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-sm" onclick="simpanDosisObat()"><i
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
                        html += '<a data-id="' + data.kd_dokter + '" class="dropdown-item" onclick="setDokter(this)">' + data
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
                console.log(template)
                $.map(template, function(data) {
                    html = '<tr>'
                    html += '<td>' + data.nm_racik + '</td>'
                    html += '<td>'
                    html += '<ul>'
                    $.map(data.detail_racik, function(detail) {
                        html += '<li>' + detail.data_barang.nama_brng + '</li>'
                    })
                    html += '</ul>'
                    html += '</td>'
                    html += '<td>' + data.dokter.nm_dokter + '</td>'
                    html += '<td><button class="btn btn-warning btn-sm" style="font-size:12px" onclick="ubahTemplate(' + data.id + ')"><i class="bi bi-pencil"></i></button><button class="btn btn-danger btn-sm" style="font-size:12px"><i class="bi bi-trash3-fill"></i></button></td>'
                    html += '<tr>'
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
            console.log(ambilTemplateRacikan(null, null, id))
        }

        function setDokter(param) {
            // $('#nm_dokter').val($(param).data('id'));
            kd_dokter = $(param).data('id')
            nm_dokter = $(param).text()
            $('#kd_dokter').val(kd_dokter);
            $('#dokter').val(nm_dokter);
            $('.list_dokter').fadeOut();

            setTemplate(kd_dokter)



        }

        function tambahObat() {

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
                        console.log(response)
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
