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
                    <div class="col-lg-2 col-sm-12 mb-2">
                        <input type="text" class="form-control form-control-sm no_resep" name="no_resep"
                            placeholder="" style="font-size:12px;min-height:12px;border-radius:0;" readonly="">
                    </div>
                    <label for="no_rawat" class="col-lg-1 col-sm-12 col-form-label" style="font-size:12px">No.
                        Rawat</label>
                    <div class="col-lg-2 col-sm-12 mb-2">
                        <input type="text" class="form-control form-control-sm no_rawat" name="nomor_rawat"
                            placeholder="" style="font-size:12px;min-height:12px;border-radius:0;" readonly="">
                    </div>
                    <div class="col-lg-4 col-sm-12 mb-2">
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
                <div class="row">
                    <label for="no_resep" class="col-lg-4 col-sm-12 col-form-label" style="font-size:12px">Pilih
                        Obat</label>
                    <div class="col-lg-8 col-sm-12 mb-2">
                        <input type="search" onkeyup="cariObat(this)" autocomplete="off"
                            class="form-control form-control-sm nama_obat" name="nama_obat" />
                        <div id="list_obat"></div>
                    </div>
                    <label for="no_resep" class="col-lg-4 col-sm-12 col-form-label"
                        style="font-size:12px">Jumlah</label>
                    <div class="col-lg-8 col-sm-12 mb-2">
                        <input type="search" onkeypress="return hanyaAngka(event)" class="form-control form-control-sm"
                            id="jumlah" name="jumlah" autocomplete="off" />
                    </div>
                    <label for="no_resep" class="col-lg-4 col-sm-12 col-form-label" style="font-size:12px">Aturan
                        Pakai</label>
                    <div class="col-lg-8 col-sm-12 mb-2">
                        <input type="search" onkeyup="cariAturan(this)" autocomplete="off"
                            class="form-control form-control-sm aturan_pakai" name="aturan_pakai" />
                        <div id="list_aturan"></div>
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
