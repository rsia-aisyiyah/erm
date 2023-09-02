@extends('index')

@section('contents')
    <div class="row">
        <div class="mb-12 col-lg-12 col-sm-12" id="template">
            <div class="card">
                <div class="card-header">
                    Daftar Racikan
                </div>
                <div class="overflow-auto">
                    <div class="card-body">
                        <form>
                            <div class="mb-2">
                                <label for="dokter" class="form-label">Dokter</label>
                                <input type="search" class="form-control form-control-sm" id="dokter" aria-describedby="dokter" name="dokter"
                                    onkeyup="cariDokter(this)">
                                <div class="list_dokter"></div>
                                <input type="hidden" class="form-control" id="kd_dokter" aria-describedby="kd_dokter"
                                    name="kd_dokter" value="">
                            </div>
                            <div class="mb-2">
                                <label for="nm_racikan" class="form-label">Nama Racikan</label>
                                <input type="text" class="form-control form-control-sm" id="nm_racik" aria-describedby="nm_racik">
                            </div>
                            <button type="button" class="btn btn-primary btn-sm" style="font-size: 12px" id="buatTemplate">Buat Template Racikan</button>
                        </form>
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table tale-responsive table-stripped table-" id="tb_template">
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
    </div>


    <div class="modal fade" id="modalTemplate" aria-labelledby="modalTemplate" aria-hidden="true"
        style="background-color: #00000062!important;">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
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
                                    <table class="table table-racikan table-borderless">
                                        <thead>
                                            <tr>
                                                <th width="35%">Nama Obat</th>
                                                <th>Kapasitas</th>
                                                <th>Stok Obat</th>
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

            var bidang = "{{ session()->get('pegawai')->bidang }}"
            var nik = "{{ session()->get('pegawai')->nik }}"
            var nama = "{{ session()->get('pegawai')->nama }}"
            if (bidang == 'Spesialis' || "{{ session()->get('pegawai')->departemen }}" == "DM7") {
                setTemplate(nik)
                $('#kd_dokter').val(nik)
                $('#dokter').val(nama)
            } else {
                setTemplate();
            }
        })

        function cariDokter(dokter) {
            getDokter(dokter.value).done(function(response) {
                html = '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                $.map(response, function(data) {
                    html += '<li>'
                    html += '<a data-id="' + data.kd_dokter + '" class="dropdown-item" onclick="setDokter(this)">' + data.nm_dokter + '</a>'
                    html += '</li>'
                })
                html += '</ul>';
                $('.list_dokter').fadeIn();
                $('.list_dokter').html(html);
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
                    html += '<ul>'
                    $.map(data.detail_racik, function(detail) {
                        if (detail.data_barang) {
                            html += '<li>' + detail.data_barang.nama_brng + '</li>'
                        } else {
                            html += 'BELUM ADA OBAT <br/>';
                        }
                    })
                    html += '</ul>'
                    html += '</td>'
                    html += '<td>' + data.dokter.nm_dokter + '</td>'
                    html +=
                        '<td><button class="btn btn-warning btn-sm edit" data-id="' + data.id + '" style="font-size:12px" onclick="ubahTemplate(' +
                        data.id +
                        ')"><i class="bi bi-pencil"></i></button><button class="btn btn-danger btn-sm" style="font-size:12px" onclick="hapusTemplateRacikan(' + data.id + ')"><i class="bi bi-trash3-fill"></i></button></td>'
                    html += '<td>'
                    $('#tb_template tbody').append(html)
                })

                $('#template').css('visibility', 'visible')
            }
        }

        $('tbody').on('click', '.edit', function() {
            id = $(this).data('id');
            $('#modalTemplate').modal('show')
            ubahTemplate(id)
        })

        // $('.edit').on('click', function() {
        // })


        function ubahTemplate(id) {
            $('.table-racikan tbody').empty();

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
                $.map(temp.data_barang.gudang_barang, function(gudang) {
                    if (gudang.kd_bangsal == 'RM7') {
                        if (gudang.stok == 0) {
                            html += '<td class="text-danger">KOSONG </td>'
                        } else {
                            html += '<td class="text-red">' + gudang.stok + '</td>'
                        }
                    }
                })
                html += '<td><button class="btn btn-danger btn-sm" onclick="hapusDetailTemplate(' + temp.id + ', ' + id + ')"><i class="bi bi-trash3-fill"></i></button></td>'
                html += '</tr>'
                no++;
            })
            html += '<input type="hidden" class="nomor" value="' + no + '">'
            $('.table-racikan').append(html)
        }

        function hapusTemplateRacikan(id) {
            Swal.fire({
                title: 'Anda yakin ?',
                text: "Data yang dihapus tidak bisa dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yakin, hapus !',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/erm/resep/racik/template/hapus',
                        method: 'delete',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                        },
                        success: function(reponse) {
                            Swal.fire(
                                'Dihapus!',
                                'Template resep berhasil dihapus',
                                'success'
                            )

                            setTemplate($("#kd_dokter").val());
                        }
                    })
                }
            })

        }

        function hapusDetailTemplate(id, id_racik) {
            $.ajax({
                url: '/erm/resep/racik/template/detail/hapus',
                method: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function(response) {
                    // alert(response);
                    setTemplate($("#kd_dokter").val());
                    ubahTemplate(id_racik)
                }
            })
        }

        function setDokter(param) {
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
                '" name="kode_brng[]"/><input class="form-control form-control-sm form-underline nama_obat_' + no +
                '" type="search" onkeyup="cariObatRacikan(this, ' + no + ')" id="nama_brng_' + no +
                '" name="nama_brng[]" autocomplete="off"/><div class="list_obat_' + no + '"></div></td>'
            html += '<td><input type="text" readonly class="form-control form-control-sm form-underline" id="kps' + no +
                '"/></td>'
            html += '<td><input type="text" readonly class="form-control form-control-sm form-underline" id="stok' + no +
                '"/></td>';
            html += '<td><button class="btn btn-danger btn-sm hapus"><i class="bi bi-trash3-fill"></i></button></td>';
            html += '</tr>'


            $('.table-racikan tbody').append(html)
            no = parseInt(no) + 1;
            $('.nomor').val(no)
        }


        $('.table-racikan tbody').on('click', '.hapus', function() {
            row = $(this).parents('td').parents('tr').remove();
            return false;
        })

        function simpanDetailTemplate() {
            let row = $('.table-racikan tbody tr').length

            arrInput = [];
            response = false;
            for (let no = 1; no <= row; no++) {
                kode_brng = $("#kode_brng" + no).val();
                if (kode_brng) {
                    $.ajax({
                        url: '/erm/resep/racik/template/detail/tambah',
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_racik: $('.id_racik').val(),
                            kode_brng: $("#kode_brng" + no).val(),
                        },
                        success: function(response) {
                            $('#modalTemplate').modal('hide')
                            setTemplate($("#kd_dokter").val());
                        },
                        error: function(a, b, c) {
                            Swal.fire(
                                'Gagal !',
                                'Obat tidak tersimpan, pastikan tidak ada kolom kosong',
                                'error'
                            );
                        }
                    })
                }
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
                        setTemplate($("#kd_dokter").val());
                        $('#nm_racik').val('');
                        // ubahTemplate(response.id)
                    }
                })
            } else {
                Swal.fire(
                    'Gagal !',
                    'Template racikan sudah ada',
                    'error'
                );
            }

            // console.log(ambil)

        })
    </script>
@endpush
