<div class="modal fade" id="modalResepRacikan" tabindex="-1" aria-labelledby="modalResepUmum" aria-hidden="true"
    style="background-color: #00000062!important;">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">RESEP RACIKAN</h1>
            </div>
            <div class="modal-body modal-resep">

                <form id="resep-racikan">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 mb-1">
                            <label for="no_resep" style="font-size:12px">Nama Racikan</label>
                            <input type="search" autocomplete="off" class="form-control form-control-sm nm_racik"
                                name="nm_racik" />
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 mb-1">
                            <label for="metode_racik" style="font-size:12px">Metode
                                Racik</label>
                            <select name="metode_racik" id="" class="form-select form-select-sm metode_racik"
                                style="font-size:12px">
                                <option value="R01" selected>Puyer</option>
                                <option value="R02">Sirup</option>
                                <option value="R03">Salep</option>
                                <option value="R04">Kapsul</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 mb-1">
                            <label for="jml" class="" style="font-size:12px">Jumlah</label>
                            <input type="search" autocomplete="off" class="form-control form-control-sm jml"
                                name="jml" onkeypress="return hanyaAngka(event)" />
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 mb-1">
                            <label for="aturan_pakai" style="font-size:12px">Aturan
                                Pakai</label>
                            <input type="search" autocomplete="off" class="form-control form-control-sm aturan_pakai"
                                name="aturan_pakai" />
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 mb-1">
                            <label for="keterangan" style="font-size:12px">Keterangan</label>
                            <input type="search" autocomplete="off" class="form-control form-control-sm keterangan"
                                name="keterangan" />
                        </div>
                        <input type="hidden" value="" class="no_racik" />
                        {{-- <input type="hidden" value="" class="kode_racik" /> --}}
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" onclick="simpanRacikan()"><i
                            class="bi bi-save"></i>
                        Simpan</i></button>
                </form>
                <div class="obat_racik">

                </div>
            </div>
            <div class="modal-footer">
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
                                class="form-control form-control-sm nama_obat" name="nama_obat" />
                            <div id="list_obat"></div>
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
                            <div id="list_aturan"></div>
                        </div>
                        <label for="no_resep" class="col-lg-4 col-sm-12 col-form-label"
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
@push('script')
    <script>
        function simpanRacikan() {
            simpanResepObat();
        }

        function cekResepRacikan() {
            $.ajax({
                url: '/erm/resep/racik/ambil',
                data: {
                    no_resep: $('.no_resep').val()
                },
                success: function(response) {
                    no_racik = '';
                    if (Object.keys(response).length > 0) {
                        no_racik = response.no_racik + 1;
                    } else {
                        no_racik = 1;
                    }
                    $('.no_racik').val(String(no_racik));
                }
            })
        }
    </script>
@endpush
