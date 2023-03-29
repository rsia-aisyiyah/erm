<div class="modal fade" id="modalResepRacikan" tabindex="-1" aria-labelledby="modalResepUmum" aria-hidden="true"
    style="background-color: #00000062!important;">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">RESEP RACIKAN</h1>
            </div>
            <div class="modal-body modal-resep">

                <form id="resep-racikan">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 mb-1">
                            <label for="no_resep" style="font-size:12px">Nama Racikan</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 mb-1">
                            <input type="search" autocomplete="off" class="form-control form-control-sm nm_racik"
                                name="nm_racik" />
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 mb-1">
                            <label for="kd_racik" style="font-size:12px">Metode</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 mb-1">
                            <select name=kd_racik" id="" class="form-select form-select-sm kd_racik"
                                style="font-size:12px">
                                <option value="R01" selected>Puyer</option>
                                <option value="R02">Sirup</option>
                                <option value="R03">Salep</option>
                                <option value="R04">Kapsul</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 mb-1">
                            <label for="jml" class="" style="font-size:12px">Jumlah</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 mb-1">
                            <input type="search" autocomplete="off" class="form-control form-control-sm jml"
                                name="jml" onkeypress="return hanyaAngka(event)" />
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 mb-1">
                            <label for="aturan_pakai" style="font-size:12px">Aturan
                                Pakai</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 mb-1">
                            <input type="search" autocomplete="off" onkeyup="cariAturan(this)"
                                class="form-control form-control-sm aturan_pakai" name="aturan_pakai" />
                            <div class="list_aturan"></div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 mb-1">
                            <label for="keterangan" style="font-size:12px">Keterangan</label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 mb-1">
                            <input type="search" autocomplete="off" class="form-control form-control-sm keterangan"
                                name="keterangan" />
                        </div>
                        <input type="hidden" value="" class="no_racik" />
                        {{-- <input type="hidden" value="" class="kode_racik" /> --}}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanRacikan()"><i
                        class="bi bi-save"></i>
                    Simpan</i></button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalResepUmum" tabindex="-1" aria-labelledby="modalResepUmum" aria-hidden="true"
    style="background-color: #00000062!important;">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="">Pilih Obat</h2>
            </div>
            <div class="modal-body modal-resep">
                <form id="resep-umum">
                    <div class="row">
                        <label for="no_resep" class="col-lg-4 col-sm-12 col-form-label" style="font-size:12px">Pilih
                            Obat</label>
                        <div class="col-lg-8 col-sm-12 mb-1">
                            <input type="search" onkeyup="cariObat(this)" autocomplete="off"
                                class="form-control form-control-sm nama_obat" name="nama_obat" autofocus />
                            <div class="list_obat"></div>
                        </div>
                        <label for="no_resep" class="col-lg-4 col-sm-12 col-form-label"
                            style="font-size:12px">Jumlah</label>
                        <div class="col-lg-8 col-sm-12 mb-1">
                            <input type="search" onkeypress="return hanyaAngka(event)"
                                class="form-control form-control-sm jumlah" id="jumlah" name="jumlah"
                                autocomplete="off" />
                        </div>
                        <label for="aturan_pakai" class="col-lg-4 col-sm-12 col-form-label"
                            style="font-size:12px">Aturan
                            Pakai</label>
                        <div class="col-lg-8 col-sm-12 mb-1">
                            <input type="search" onkeyup="cariAturan(this)" autocomplete="off"
                                class="form-control form-control-sm aturan_pakai" name="aturan_pakai" />
                            <div class="list_aturan"></div>
                        </div>
                        <label for="keterangan" class="col-lg-4 col-sm-12 col-form-label"
                            style="font-size:12px">Keterangan</label>
                        <div class="col-lg-8 col-sm-12 mb-1">
                            <input type="search" autocomplete="off" class="form-control form-control-sm keterangan"
                                name="keterangan" />
                        </div>
                        <input type="hidden" value="" class="kode_obat" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="simpanObat"type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Tambah</button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalObat" tabindex="-1" aria-labelledby="modalObat" aria-hidden="true"
    style="background-color: #00000062!important;">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Obat</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="search" onkeyup="cariObat(this)" autocomplete="off"
                    class="form-control form-control-sm nama_obat" name="nama_obat" />
                <div class="list_obat"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalObatRacik" aria-labelledby="modalObatRacik" aria-hidden="true"
    style="background-color: #00000062!important;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="">Pilih Obat</h2>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="obat_racik">
                            <div class="row">
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <label for="no_resep" style="font-size:12px">Nomor Resep</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm no_resep mb-1" name="no_resep" readonly />
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm nm_racik mb-1" name="nm_racik" readonly />
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-12">
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm jml mb-1" name="jml" readonly />
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <label for="nama_obat" style="font-size:12px">Nama Obat</label>
                                </div>
                                <div class="col-lg-9 col-md-12 col-sm-12">
                                    <input type="hidden" class="kode_obat" />
                                    <input type="search" autocomplete="off" onkeypress="cariObat(this)"
                                        class="form-control form-control-sm nama_obat mb-1" name="nama_obat"
                                        autofocus />
                                    <div class="list_obat"></div>
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <label for="kps" style="font-size:12px">Kapasitas</label>
                                </div>
                                <div class="col-lg-9 col-md-12 col-sm-12 mb-1">
                                    <input type="text" autocomplete="off" class="form-control form-control-sm kps"
                                        name="kps" onkeypress="return hanyaAngka(event)" readonly />
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <label for="p1" class="" style="font-size:12px">P1</label>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 mt-1">
                                    <input type="text" autocomplete="off" class="form-control form-control-sm p1"
                                        name="p1" onkeypress="return hanyaAngka(event)" />
                                </div>

                                <div class="col-lg-1 col-md-3 col-sm-12">
                                    <label for="p2" class="" style="font-size:12px">P2</label>
                                </div>
                                <div class="col-lg-5 col-md-3 col-sm-12 mt-1">
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm p2 mb-1" name="p2"
                                        onkeypress="return hanyaAngka(event)" />
                                </div>

                                <div class="col-lg-3 col-md-12 col-sm-6">
                                    <label for="kandungan" style="font-size:12px">Kandungan</label>
                                </div>
                                <div class="col-lg-9 col-md-12 col-sm-12 mb-1">
                                    <input type="search" autocomplete="off"
                                        class="form-control form-control-sm kandungan mb-1" name="kandungan" />
                                </div>
                                <div class="col-lg-3 col-md-12 col-sm-6">
                                    <label for="jml_obat" class="" style="font-size:12px">Jml. Obat</label>
                                </div>
                                <div class="col-lg-9 col-md-12 col-sm-12 mb-1">
                                    <input type="search" autocomplete="off"
                                        class="form-control form-control-sm jml_obat mb-1" name="jml_obat"
                                        onkeypress="return hanyaAngka(event)" readonly />
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 mb-1">
                                    <button width="100%" type="button" class="btn btn-success btn-sm simpan-obat"
                                        style="font-size:12px;" onclick="simpanObatRacikan()"><i
                                            class="bi bi-save"></i> Simpan Obat</button> <button width="100%"
                                        type="button" class="btn btn-warning btn-sm ubah-obat"
                                        style="font-size:12px;display:none"><i class="bi bi-pen-fill"></i>
                                        Ubah Kandungan</button> <button width="100%" type="button"
                                        class="btn btn-danger btn-sm obat-baru" style="font-size:12px;display:none"
                                        onclick="resetObatRacikan()"><i class="bi bi-arrow-clockwise"></i> Obat
                                        Baru</button>
                                </div>
                                <input type="hidden" value="" class="no_racik" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <table class="table table-striped table-racikan">
                            <thead>
                                <tr>
                                    <th>Nama Obat</th>
                                    <th>Dosis</th>
                                    <th>Jumlah</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        function ambilTemplateRacik() {
            hasil = '';
            nama_racik = $('.nm_racik').val();
            $.ajax({
                async: false,
                url: '/erm/resep/racik/template/ambil',
                data: {
                    'nama_racik': nama_racik,
                },
                success: function(response) {
                    hasil = response;
                }
            })
            return hasil;
        }

        function simpanRacikan() {
            $.map(ambilTemplateRacik(), function(temp) {
                if (Object.keys(temp).length > 0) {
                    simpanObatRacikanTemplate(temp.kode_brng)
                }
            })
            $.ajax({
                url: '/erm/resep/racik/simpan',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_resep: $('.no_resep').val(),
                    no_racik: $('.no_racik').val(),
                    nama_racik: $('.nm_racik').val(),
                    kd_racik: $('.kd_racik').find(":selected").val(),
                    jml_dr: $('.jml').val(),
                    aturan_pakai: $('.aturan_pakai').val(),
                    keterangan: '-',

                },
                method: 'POST',
                success: function(response) {
                    cekResep($('#nomor_rawat').val())
                },
                error: function(response, message, detail) {
                    Swal.fire(
                        'Gagal !',
                        detail,
                        'error'
                    );
                    hapusResep($('.no_resep').val(), $('#nomor_rawat'))
                }
            }).done(function() {
                tulisPlan();
            })
        }


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
