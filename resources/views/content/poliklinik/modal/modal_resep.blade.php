<div class="modal fade" id="modalResep" tabindex="-1" aria-labelledby="modalResp" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">RESEP</h1>
            </div>
            {{-- <div class="modal-body modal-resep">
                <div class="row">
                    <label for="no_resep" class="col-lg-1 col-sm-12 col-form-label" style="font-size:12px">No.
                        Resep</label>
                    <div class="col-lg-2 col-sm-12 mb-1">
                        <input type="text" class="form-control form-control-sm no_resep" name="no_resep"
                            placeholder="" style="font-size:12px;min-height:12px;border-radius:0;" readonly="">
                    </div>
                    <label for="no_rawat" class="col-lg-1 col-sm-12 col-form-label" style="font-size:12px">No.
                        Rawat</label>
                    <div class="col-lg-2 col-sm-12 mb-1">
                        <input type="text" class="form-control form-control-sm no_rawat" name="nomor_rawat"
                            placeholder="" style="font-size:12px;min-height:12px;border-radius:0;" readonly="">
                    </div>
                    <div class="col-lg-4 col-sm-12 mb-1">
                        <input type="text" class="form-control form-control-sm nm_pasien" name="nm_pasien"
                            placeholder="" style="font-size:12px;min-height:12px;border-radius:0;" readonly="">
                    </div>
                </div>
                <ul class="nav nav-tabs" id="myTab">
                    <li class="nav-item">
                        <a href="#umum" class="nav-link active" data-bs-toggle="tab">UMUM</a>
                    </li>
                    <li class="nav-item">
                        <a href="#racikan" class="nav-link" data-bs-toggle="tab">RACIKAN</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="umum">
                        <table class="table table-stripped table-responsive" id="tb-resep-racikan" width="100%">
                            <thead>
                                <tr>
                                    <th>Jumlah</th>
                                    <th>Nama Obat</th>
                                    <th>Aturan Pakai</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm" onclick="tambahUmum()">Tambah Resep</button>
                    </div>
                    <div class="tab-pane fade" id="racikan">
                        <table class="table table-stripped table-responsive" id="tb-resep-racikan" width="100%">
                            <thead>
                                <tr>
                                    <th>Nama Racikan</th>
                                    <th>Metode Racikan</th>
                                    <th>Jumlah Racik</th>
                                    <th>Aturan Pakai</th>
                                    <th>Keterangan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm" onclick="tambahRacikan()">Tambah Racikan</button>
                    </div>
                </div>

            </div> --}}
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
                        <label for="no_resep" class="col-lg-4 col-sm-12 col-form-label" style="font-size:12px">Aturan
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
                <button id="tempSimpan"type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Tambah</button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        var resepObj = [];
        $('#tempSimpan').on('click', function() {
            resep = {
                'no_resep': $('.no_resep').val(),
                'kode_brng': $('.kode_obat').val(),
                'nama_obat': $('.nama_obat').val(),
                'jml': $('.jumlah').val(),
                'aturan_pakai': $('.aturan_pakai').val(),
            }
            resepObj.push(resep);

            $('.nama_obat').val('')
            $('.jumlah').val('')
            $('.aturan_pakai').val('')
            $('.keterangan').val('')
            no = 1;
            id = 0;
            $.map(resepObj, function(resep) {
                html = '<tr>';
                html += '<td>' + no + '</td>'
                html += '<td>' + resep.nama_obat + '</td>'
                html += '<td>' + resep.jml + '</td>'
                html += '<td>' + resep.aturan_pakai + '</td>'
                html += '<td>' + resep.keterangan + '</td>'
                html +=
                    '<td><button type="button" class="btn btn-danger btn-sm remove" style="font-size:12px" data-id="' +
                    id + '">x</button></td>';
                html += '</tr>';
                id++;
                no++;
            })

            if (Object.keys(resepObj).length == 0) {
                $('.btn_simpan_resep').css('visibility', 'hidden')
            } else {
                $('.btn_simpan_resep').css('visibility', 'visible')
            }

            $('#body_umum').append(html)

        });

        $('tbody').on('click', '.remove', function() {
            no = 1;
            let id = $(this).attr('data-id');
            $(this).closest("tr").remove();
            idObject = 0;
            resepObj.splice(id, 1)
            html = '';
            $.map(resepObj, function(resep) {
                html += '<tr>';
                html += '<td>' + no + '</td>'
                html += '<td>' + resep.nama_obat + '</td>'
                html += '<td>' + resep.jml + '</td>'
                html += '<td>' + resep.aturan_pakai + '</td>'
                html += '<td>' + resep.keterangan + '</td>'
                html +=
                    '<td><button type="button" class="btn btn-danger btn-sm remove" style="font-size:12px" data-id="' +
                    idObject + '">x</button></td>';
                html += '</tr>';
                idObject++;
                no++;
            })

            $('#body_umum').empty();
            $('#body_umum').append(html);

            if (Object.keys(resepObj).length == 0) {
                $('.btn_simpan_resep').css('visibility', 'hidden')
            } else {
                $('.btn_simpan_resep').css('visibility', 'visible')
            }

            return false;
        })

        $('.btn_simpan_resep').on('click', function() {
            data = resepObj;
            $.ajax({
                url: '/erm/resep/obat/simpan',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: {
                        kd_dokter: "{{ Request::get('dokter') }}",
                        no_rawat: $('#nomor_rawat').val(),
                        no_resep: $('.no_resep').val(),
                    },
                },
                method: 'POST',
                beforeSend: function() {
                    console.log('wkwkwkwk')
                },
                success: function(response) {
                    simpanResep();
                    console.log(response)
                }
            });
            // console.log(data)
        })

        function simpanResep() {
            $.ajax({
                url: '/erm/resep/umum/simpan',
                data: {
                    data: resepObj,
                    _token: "{{ csrf_token() }}",
                },
                method: 'POST',
                success: function(response) {
                    console.log(response)
                    textPlan = '';
                    no = 1;
                    $.map(resepObj, function(resep) {
                        textPlan += no + '. ';
                        textPlan += resep.nama_obat + ' ';
                        textPlan += resep.jml + ' ';
                        textPlan += resep.aturan_pakai + '\r\n';
                        no++;
                    })
                    $('#plan').val(textPlan);
                    $('#body_umum').empty();
                    $('.btn_simpan_resep').css('visibility', 'hidden')
                    resepObj = [];

                }
            });
        }

        // function tambahUmum() {
        //     $('#modalResepUmum').modal('show');
        //     html = '<tr>';
        //     html += '<td>';
        //     html +=
        //         '<input type="text" class="form-control form-control-sm id="nama_racik" name="nama_racik[]"/>';
        //     html += '</td>';
        //     html += '<td>';
        //     html +=
        //         '<select class="form-select" name="kd_racik[]" style="font-size:12px;min-height:12px;border-radius:0;">';
        //     html += '<option value="R01">Puyer</option>'
        //     html += '<option value="R02">Sirup</option>'
        //     html += '<option value="R03">Salep</option>'
        //     html += '<option value="R04">Kapsul</option>'
        //     html += '<option value="R05">TABLET/KAPSUL/KAPLET</option>'
        //     html += '<option value="R06">Sachet</option>'
        //     html += '<option value="R07">Tablet</option>'
        //     html += '<option value="R08">Injeksi</option>'
        //     html +=
        //         '</select>';
        //     html += '</td>';
        //     html += '<td>';
        //     html += '<input type="number" class="form-control form-control-sm" name="jml_dr[]"/>';
        //     html += '</td>';
        //     html += '<td>';
        //     html += '<input type="text" class="form-control form-control-sm" name="aturan[]"/>';
        //     html += '</td>';
        //     html += '<td>';
        //     html += '<input type="text" class="form-control form-control-sm" name="keterangan[]"/>';
        //     html += '</td>';
        //     html += '<td>';
        //     html += '<button class="btn btn-danger btn-sm" style="font-size:12px">x</button>';
        //     html += '</td>';
        //     html += '</tr>';
        // }

        // function tambahRacikan() {
        //     html = '<tr>';
        //     html += '<td onclick="aktifTeks(this)">';
        //     html +=
        //         '<input type="text" class="form-control form-control-sm id="nama_racik" name="nama_racik[]"/>';
        //     html += '</td>';
        //     html += '<td>';
        //     html +=
        //         '<select class="form-select" name="kd_racik[]" style="font-size:12px;min-height:12px;border-radius:0;">';
        //     html += '<option value="R01">Puyer</option>'
        //     html += '<option value="R02">Sirup</option>'
        //     html += '<option value="R03">Salep</option>'
        //     html += '<option value="R04">Kapsul</option>'
        //     html += '<option value="R05">TABLET/KAPSUL/KAPLET</option>'
        //     html += '<option value="R06">Sachet</option>'
        //     html += '<option value="R07">Tablet</option>'
        //     html += '<option value="R08">Injeksi</option>'
        //     html +=
        //         '</select>';
        //     html += '</td>';
        //     html += '<td>';
        //     html += '<input type="number" class="form-control form-control-sm" name="jml_dr[]"/>';
        //     html += '</td>';
        //     html += '<td>';
        //     html += '<input type="text" class="form-control form-control-sm" name="aturan[]"/>';
        //     html += '</td>';
        //     html += '<td>';
        //     html += '<input type="text" class="form-control form-control-sm" name="keterangan[]"/>';
        //     html += '</td>';
        //     html += '<td>';
        //     html += '<button class="btn btn-danger btn-sm" style="font-size:12px">x</button>';
        //     html += '</td>';
        //     html += '</tr>';
        //     $('#tb-resep-racikan').append(html);
        // }

        // function setNoResep() {
        //     let tanggal = "{{ date('Y-m-d') }}";
        //     $.ajax({
        //         url: '/erm/resep/obat/akhir',
        //         method: 'GET',
        //         dataType: 'JSON',
        //         data: {
        //             'tgl_peresepan': tanggal
        //         },
        //         success: function(response) {
        //             if (Object.keys(response).length > 0) {
        //                 nomor = parseInt(response.no_resep) + 1
        //             } else {
        //                 nomor = "{{ date('Ymd') }}" + '0001';
        //             }
        //             $('.no_resep').val(nomor)
        //         }
        //     })

        // }
        // $('#modalResep').on('shown.bs.modal', function() {
        //     isShowModal = true;
        //     setNoResep();
        // })
    </script>
@endpush
