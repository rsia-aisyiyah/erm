<div class="modal fade" id="modalObatRacik" aria-labelledby="modalObatRacik" aria-hidden="true"
    style="background-color: #00000062!important;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="">Pilih Obat</h2>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary" style="padding:10px;border-radius:0px;font-size:12px"
                    role="alert">
                    Anda dapat menghapus / menambah daftar obat yang tercantum
                </div>
                <div class="row">
                    <form action="" id="formTabelRacikan">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="no_resep" style="font-size:12px">Nomor Resep</label>
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm no_resep mb-1" name="no_resep" readonly />
                                </div>
                                <div class="col-md-2">
                                    <label for="nm_racik" style="font-size:12px">Nama Racikan</label>
                                    <input type="search" autocomplete="off"
                                        class="form-control form-control-sm nm_racik mb-1" name="nm_racik" />
                                </div>
                                <div class="col-md-2">
                                    <label for="metode" style="font-size:12px">Metode</label>
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm metode mb-1" name="metode" readonly />
                                </div>
                                <div class="col-md-2">
                                    <label for="jml_dr" style="font-size:12px">Jumlah Racik</label>
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm jml_dr mb-1" name="jml_dr" readonly />
                                </div>
                                <div class="col-md-3">
                                    <label for="jml" style="font-size:12px">Aturan Pakai</label>
                                    <input type="search" autocomplete="off" onkeyup="cariAturan(this)"
                                        class="form-control form-control-sm aturan_pakai mb-1" name="aturan_pakai" id="aturan_pakai" />
                                    <input type="hidden" class="nomor">
                                    <input type="hidden" value="" name="no_racik" class="no_racik" />
                                    <div class="list_aturan" style="display: none;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="container table-responsive">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <table class="table table-racikan table-borderless">
                                        <thead>
                                            <tr>
                                                <th width="35%">Nama Obat</th>
                                                <th>Sediaan</th>
                                                <th width="7%">P1</th>
                                                <th width="3%"></th>
                                                <th width="7%">P2</th>
                                                <th width="8%">Dosis</th>
                                                <th></th>
                                                <th>Jumlah</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

                                    <button type="button" class="btn btn-success btn-sm"
                                        onclick="tambahDaftarRacik()"><i class="bi bi-plus-circle"></i> Tambah
                                        Obat</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
@push('script')
    <script>
        function simpanRacikan() {
            id_racik = $('.id_racik').val();
            template = ambilTemplateRacikan(null, null, id_racik);
            jml_dr = $('.jml_dr').val()
            aturan_pakai = $('.aturan_pakai').val()
            nama_racik = $('.nm_racik').val()

            if (nama_racik && aturan_pakai && jml_dr) {
                $.ajax({
                    url: '/erm/resep/racik/simpan',
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_resep: $('.no_resep').val(),
                        no_racik: $('.no_racik').val(),
                        nama_racik: nama_racik,
                        kd_racik: $('.kd_racik').find(":selected").val(),
                        jml_dr: jml_dr,
                        aturan_pakai: aturan_pakai,
                        keterangan: '-',

                    },
                    method: 'POST',
                    success: function(response) {
                        $.map(template.detail_racik, function(temp) {
                            if (Object.keys(temp).length > 0) {
                                simpanObatRacikanTemplate(temp.kode_brng)
                            }
                        })
                        cekResep($('#nomor_rawat').val())
                    },
                    error: function(response, message, detail) {
                        Swal.fire(
                            'Gagal !',
                            response.responseJSON.message,
                            'error'
                        );
                        hapusResep($('.no_resep').val())
                    }
                }).done(function() {
                    tulisPlan();
                    riwayatResep($('#no_rm').val());
                })
            } else {
                textObat = nama_racik ? '' : '<b class="text-danger" >Nama Racikan, </b>';
                textJml = jml_dr ? '' : '<b class="text-danger"> Jumlah, </b>';
                textAturan = aturan_pakai ? '' : '<b class="text-danger"> Aturan Pakai</b>';

                Swal.fire(
                    'Gagal !',
                    'Kolom ' + textObat + textJml + textAturan + ' tidak boleh kosong',
                    'error'
                )
            }

        }

        function hitungObatRacik(no) {

            kps = $('#kps' + no).val();
            p2 = $('#p2' + no).val();
            p1 = $('#p1' + no).val();
            jumlah = $('.jml_dr').val();

            if (p1 != 0 && p2 != 0) {
                kandungan = parseFloat(kps) * (parseFloat(p1) / parseFloat(p2));
                jml_obat = (parseFloat(kandungan) * parseFloat(jumlah)) / parseFloat(kps)
                $('#kandungan' + no).val(kandungan.toFixed(1));
                $('#jml_obat' + no).val(jml_obat.toFixed(1));
            }

        }


        function setNilaiPembagi(e) {
            pembagi = $(e).val();
            if (pembagi == '' || pembagi == 0) {
                $(e).val(1);
            }

        }

        function hitungDosis(no) {
            kandungan = $('#kandungan' + no).val();
            jumlah = $('.jml_dr').val();
            kps = $('#kps' + no).val();
            p1 = $('#p1' + no).val();
            p2 = $('#p2' + no).val();
            if (parseInt(kandungan) <= parseInt(kps)) {
                jml_obat = (parseFloat(kandungan) * parseFloat(jumlah)) / parseFloat(kps)
                $('#jml_obat' + no).val(jml_obat.toFixed(1));
                $('#p2' + no).val('1');
                $('#p1' + no).val('1');
            } else {
                $('#kandungan' + no).val(0);
                Swal.fire(
                    'Ada yang salah !',
                    'Dosis tidak boleh lebih besar dari kapasitas obat',
                    'warning'
                );
            }
        }

        function simpanDosisObat() {
            const form = $('#formTabelRacikan').serializeArray()
            $.ajax({
                url: '/erm/resep/racik/detail/ubah',
                data: form,
                method: 'POST',
                error: function(response) {
                    Swal.fire(
                        'Gagal !',
                        response.responseJSON.message,
                        'error'
                    );
                }
            }).done((response) => {
                $.ajax({
                    url: '/erm/resep/racik/ubah',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_resep: $('.no_resep').val(),
                        nama_racik: $('.nm_racik').val(),
                        no_racik: $('.no_racik').val(),
                        kd_racik: $('.kd_racik').val(),
                        aturan_pakai: $('.aturan_pakai').val(),
                    },
                    error: function(response) {
                        Swal.fire(
                            'Gagal !',
                            response.responseJSON.message,
                            'error'
                        );
                    }
                })
                $('#modalObatRacik').modal('hide');
                riwayatResep($('#no_rm').val())
                cekResep($('#nomor_rawat').val());
                tulisPlan();
            })


        }

        function tambahDaftarRacik() {
            no = $('.nomor').val();
            html = '<tr class="baris_' + no + '">'
            html +=
                '<td><input type="hidden" id="kode_brng' + no +
                '"/ name="kode_brng[]"><input type="text" onkeyup="cariObatRacikan(this, ' + no +
                ')" autocomplete="off" class="form-control form-control-sm nama_obat_' + no +
                ' form-underline" /><div class="list_obat_' +
                no + '"></div></td>'
            html +=
                '<td><input type="text" autocomplete="off" class="form-control form-control-sm form-underline" id="kps' +
                no + '" name="kps[]" readonly /></td>'
            html += '<td><input type="text" class="form-control form-control-sm form-underline" id="p1' + no + '" name="p1[]" onkeyup="hitungObatRacik(' + no + ')" onfocusout="setNilaiPembagi(this)" autocomplete="off"/></td>'
            html += '<td>/</td>'
            html += '<td><input type="text" class="form-control form-control-sm form-underline" id="p2' + no + '" name="p2[]" onkeyup="hitungObatRacik(' + no + ')" onfocusout="setNilaiPembagi(this)" autocomplete="off"/></td>'
            html += '<td><input type="text" onkeypress="return hanyaAngka(event)" class="form-control form-control-sm form-underline" id="kandungan' + no + '" name="kandungan[]" onkeyup="hitungDosis(' + no + ')" autocomplete="off"/></td>'
            html += '<td>mg</td>'
            html +=
                '<td><input type="text" class="form-control form-control-sm form-underline" id="jml_obat' +
                no +
                '" name="jml[]" readonly/></td>'
            html +=
                '<td><a href="#modal" data-no=' + no +
                ' type="button" class="btn btn-danger btn-sm x"  style="font-size:12px"><i class="bi bi-trash-fill"></i></a></td>'
            html += '</tr>'
            $('.table-racikan tbody').append(html);
            no = parseInt(no) + 1;
            $('.nomor').val(no)

        }


        $('.table-racikan tbody').on('click', '.x', function(e) {
            e.preventDefault();
            row = $(this).parents('td').parents('tr').remove();
            return false;
        })
        $('.p1').on('change', function() {
            kps = $('.kps').val();
            p2 = $('.p2').val();
            p1 = $('.p1').val();
            jumlah = $('.jml').val();
            kandungan = parseFloat(kps) * (parseFloat(p1) / parseFloat(p2));
            jml_obat = (parseFloat(kandungan) * parseFloat(jumlah)) / parseFloat(kps)
            $('.kandungan').val(jml_obat.toFixed(1));

            $('.jml_obat').val(jml_obat.toFixed(1));
        })
        $('.p2').on('change', function() {
            kps = $('.kps').val();
            jumlah = $('.jml').val();
            p2 = $('.p2').val();
            p1 = $('.p1').val();
            kandungan = parseFloat(kps) * (parseFloat(p1) / parseFloat(p2));
            jml_obat = (parseFloat(kandungan) * parseFloat(jumlah)) / parseFloat(kps)
            $('.kandungan').val(kandungan.toFixed(1));

            $('.jml_obat').val(jml_obat.toFixed(1));
        })
        $('.kandungan').on('change', function() {
            kandungan = $(this).val();
            jumlah = $('.jml').val();
            kps = $('.kps').val();
            jml_obat = (parseFloat(kandungan) * parseFloat(jumlah)) / parseFloat(kps)
            $('.jml_obat').val(jml_obat.toFixed(1));
            $('.p2').val('1');
            $('.p1').val('1');
        })

        function simpanObatRacikanTemplate(kode_obat) {
            no_racik = $('.no_racik').val();
            no_resep = $('.no_resep').val();
            $.ajax({
                url: '/erm/resep/racik/detail/simpan',
                method: 'POST',
                data: {

                    '_token': '{{ csrf_token() }}',
                    'no_resep': no_resep,
                    'no_racik': no_racik,
                    'kode_brng': kode_obat,
                    'kandungan': 0,
                    'p1': 1,
                    'p2': 1,
                    'jml': 0,
                },
                error: function(a, b, c) {
                    Swal.fire(
                        'Gagal !',
                        'Obat tidak tersimpan, pastikan tidak ada kolom kosong',
                        'error'
                    );
                    console.log(a, b, c)
                }
            })
        }

        function simpanObatRacikan() {
            no_racik = $('.no_racik').val();
            no_resep = $('.no_resep').val();
            kode_obat = $('.kode_obat').val();
            nama_obat = $('.nama_obat').val();
            kandungan = $('.kandungan').val();
            p1 = parseInt($('.p1').val());
            p2 = parseInt($('.p1').val());
            jml = parseFloat($('.jml_obat').val());

            $.ajax({
                url: '/erm/resep/racik/detail/simpan',
                method: 'POST',
                data: {

                    '_token': '{{ csrf_token() }}',
                    'no_resep': no_resep,
                    'no_racik': no_racik,
                    'kode_brng': kode_obat,
                    'kandungan': kandungan,
                    'p1': p1,
                    'p2': p2,
                    'jml': jml,
                },
                success: function(response) {
                    cekResep(id);
                    ambilObatRacikan();
                    $('.nama_obat').val('');
                    $('.kandungan').val('');
                    $('.kps').val('');
                    $('.p1').val('');
                    $('.p2').val('');
                    $('.jml_obat').val('');
                },
                error: function(a, b, c) {
                    Swal.fire(
                        'Gagal !',
                        'Obat tidak tersimpan, pastikan tidak ada kolom kosong',
                        'error'
                    );
                    console.log(a, b, c)
                }
            }).done(function() {
                tulisPlan();
            });
        }
    </script>
@endpush
