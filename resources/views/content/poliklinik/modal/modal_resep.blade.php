<div class="modal fade" id="modalObatRacik" aria-labelledby="modalObatRacik" aria-hidden="true"
    style="background-color: #00000062!important;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="">Detail Racikan</h2>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary" style="padding:10px;border-radius:0px;font-size:12px"
                    role="alert">
                    Anda dapat menghapus / menambah daftar obat yang tercantum
                </div>
                <div class="row">
                    <form action="" id="formTabelRacikan">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                            <div class="row mb-2">
                                <div class="col-md-2">
                                    <label for="no_resep" class="form-label mb-0">Nomor Resep</label>
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm no_resep mb-1" name="no_resep" readonly />
                                </div>
                                <div class="col-md-2">
                                    <label for="nama_racik" class="form-label mb-0">Nama Racikan</label>
                                    <input type="search" autocomplete="off"
                                        class="form-control form-control-sm nama_racik mb-1" name="nama_racik" />
                                </div>
                                <div class="col-md-2">
                                    <label for="metode" class="form-label mb-0">Metode</label>
                                    <select name="metode" id="metode" class="form-select form-select-sm">
                                        <option value="R01">Puyer</option>
                                        <option value="R02">Sirup</option>
                                        <option value="R03">Salep</option>
                                        <option value="R04">Kapsul</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="jml_dr" class="form-label mb-0">Jumlah Racik</label>
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm jml_dr mb-1" name="jml_dr" readonly />
                                </div>
                                <div class="col-md-3">
                                    <label for="jml" class="form-label mb-0">Aturan Pakai</label>
                                    <input type="search" autocomplete="off" onkeyup="cariAturan(this, event)"
                                        class="form-control form-control-sm aturan_pakai mb-1" name="aturan_pakai" id="aturan_pakai" />
                                    <input type="hidden" class="nomor" name="nomorObat">
                                    <input type="hidden" value="" name="no_racik" class="no_racik" />
                                    <div class="list_aturan" style="display: none;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="container table-responsive">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <table class="table table-racikan table-bordered" id="tableDetailRacikan">
                                        <thead>
                                            <tr>
                                                <th>Nama Obat</th>
                                                <th width="10%">Sediaan</th>
                                                <th width="15%">P1/P2</th>
                                                <th width="10%">Dosis</th>
                                                <th width="7%">Harga</th>
                                                <th width="7%">Jumlah</th>
                                                <th width="7%">Subtotal</th>
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
            subtotalRacikan(no)

        }

        function subtotalRacikan(no) {
            const hargaBarang = $('#labelHargaBarang' + no).data('number');

            const jml_obat = $('#jml_obat' + no).val();
            console.log(jml_obat, hargaBarang);

            const total = jml_obat * hargaBarang;
            $('#labelSubTotalBarang' + no).text(formatCurrency(total)).data('number', total);
            // ubah nilai labelTotalBarangRacikan
            totalDetailRacikan()
        }

        function totalDetailRacikan() {
            let totalBarangRacikan = 0;
            $('.labelSubTotalBarang').each(function(index) {
                totalBarangRacikan += parseFloat($(this).text().replace(/[^0-9]/g, ''));
            });


            $('#labelTotalBarangRacikan').empty().text(toRupiah(totalBarangRacikan));
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

            if (kandungan === '') {
                return false;
            }

            jml_obat = (parseFloat(kandungan) * parseFloat(jumlah)) / parseFloat(kps)
            $('#jml_obat' + no).val(jml_obat.toFixed(1));
            $('#p2' + no).val('1');
            $('#p1' + no).val('1');


            if (parseInt(kandungan) >= parseInt(kps)) {
                Swal.fire({
                    title: 'Peringatan !',
                    html: 'Masukkan dosis melebihi sediaan obat, yakin melanjutkan ?',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (!result.isConfirmed) {
                        $('#kandungan' + no).val(0);
                    }

                })
            }
            subtotalRacikan(no)
        }

        function hitungByJumlah(no) {
            jumlah = $('.jml_dr').val();
            const jml = $('#jml_obat' + no).val();
            const kps = $('#kps' + no).val();
            const p1 = $('#p1' + no).val();
            const p2 = $('#p2' + no).val();
            kandungan = parseFloat(jml) / parseFloat(jumlah) * parseFloat(kps);
            if (parseInt(jml) > parseInt(jumlah)) {
                Swal.fire({
                    title: 'Peringatan !',
                    html: 'Masukkan jumlah obat melebihi jumlah racikan obat, yakin melanjutkan ?',
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (!result.isConfirmed) {
                        $('#jml_obat' + no).val(jumlah);
                        $('#kps' + no).val(kps);
                        subtotalRacikan(no)
                    }

                })
            }
            $('#kandungan' + no).val(kandungan.toFixed(2));
            subtotalRacikan(no)
        }

        function simpanDosisObat() {
            const form = $('#formTabelRacikan').serializeArray()
            const no_resep = $('#formTabelRacikan').find('.no_resep').val();
            const nama_racik = $('#formTabelRacikan').find('.nama_racik').val();
            const no_racik = $('#formTabelRacikan').find('.no_racik').val();
            const kd_racik = $('#formTabelRacikan').find('.kd_racik').val();
            const aturan_pakai = $('#formTabelRacikan').find('.aturan_pakai').val();

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
                        no_resep: no_resep,
                        nama_racik: nama_racik,
                        no_racik: no_racik,
                        kd_racik: kd_racik,
                        aturan_pakai: aturan_pakai,
                    },
                    error: function(response) {
                        Swal.fire(
                            'Gagal !',
                            response.responseJSON.message,
                            'error'
                        );
                    }
                }).done((response) => {
                    console.log('no_resep', no_resep);

                    $('#modalObatRacik').modal('hide');
                    riwayatResep($('#no_rm').val())
                    // cekResep($('#nomor_rawat').val());
                    getResepRacikan(no_resep)
                    tulisPlan();
                })
            })


        }

        function tambahDaftarRacik() {
            no = $('.nomor').val();
            let html = `
                <tr class="baris_${no}">
                    <td>
                        <input type="hidden" id="kode_brng${no}" name="kode_brng[]"/>
                        <input type="text" 
                            onkeyup="cariObatRacikan(this, ${no}, event)" 
                            autocomplete="off" 
                            class="form-control form-control-sm nama_obat_${no} form-underline" />
                        <div class="list_obat_${no}"></div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between">
                        <input type="text" 
                            autocomplete="off" 
                            class="form-control form-control-sm form-underline" 
                            id="kps${no}" 
                            name="kps[]" 
                            readonly />
                            <span class="mt-2">mg</span>
                        </div>
                    </td>
                    <td>
                        <x-input-group class="input-group-sm">
                        <input type="text" 
                            class="form-control form-control-sm form-underline" 
                            id="p1${no}" 
                            name="p1[]" 
                            onkeyup="hitungObatRacik(${no})" 
                            onfocusout="setNilaiPembagi(this)" 
                            autocomplete="off"/>
                        <x-input-group-text>/</x-input-group-text>
                        <input type="text" 
                            class="form-control form-control-sm form-underline" 
                            id="p2${no}" 
                            name="p2[]" 
                            onkeyup="hitungObatRacik(${no})" 
                            onfocusout="setNilaiPembagi(this)" 
                            autocomplete="off"/>
                        </x-input-group>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <input type="text" 
                                onkeypress="return hanyaAngka(event)" 
                                class="form-control form-control-sm form-underline" 
                                id="kandungan${no}" 
                                name="kandungan[]" 
                                onkeyup="hitungDosis(${no})" 
                                autocomplete="off"/>
                            <span class="mt-2">mg</span>
                        </div>
                    </td>
                    <td id="labelHargaBarang${no}" data-number="">
                       
                    </td>
                    <td>
                        <input type="text" 
                            class="form-control form-control-sm form-underline" 
                            id="jml_obat${no}" 
                            name="jml[]" 
                            readonly/>
                    </td>
                    <td class="labelSubTotalBarang" id="labelSubTotalBarang${no}"> 
                        
                    </td>
                    <td>
                        <a href="javascript:void(0)" 
                        data-no="${no}" 
                        type="button" 
                        class="btn btn-danger btn-sm x form-label mb-0">
                        <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
                `;

            $('.table-racikan tbody').append(html);
            no = parseInt(no) + 1;
            $('.nomor').val(no)

            // ubah posisi rowTotalBarangRacikan di akhir
            $('#rowTotalBarangRacikan').detach().appendTo('.table-racikan tbody');


        }


        $('.table-racikan tbody').on('click', '.x', function(e) {
            e.preventDefault();
            row = $(this).parents('td').parents('tr').remove();
            totalDetailRacikan()
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
