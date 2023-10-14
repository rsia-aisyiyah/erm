<div class="modal fade" id="modalCatatan" tabindex="-1" aria-labelledby="modalCatatan" aria-hidden="true" style="background-color: #00000085;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="border-radius:0px;background-color: #ffd900;color:#000000">
                <h5 class="modal-title" style="font-size: 1em">Diagnosa, Prosedur & Catatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#diagnosa-pasien" type="button" role="tab" aria-controls="diagnosa-pasien" aria-selected="true">Diagnosa</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#prosedur-pasien" type="button" role="tab" aria-controls="prosedur-pasien" aria-selected="false">Prosedur</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#catatan-dokter" type="button" role="tab" aria-controls="catatan-dokter" aria-selected="false">Catatan Dokter</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="diagnosa-pasien" role="tabpanel" aria-labelledby="diagnosa-pasien" tabindex="0">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="" style="font-size: 12px">Diagnosa</label>
                                <input type="search" class="form-control form-control-sm" onkeyup="cariDiagnosaSoap(this)" name="diagnosa" id="diagnosa" style="font-size:12px;min-height:12px;border-radius:0" autocomplete="off">
                                <div class="list-diagnosa"></div>
                                <input type="hidden" class="no_diagnosa" value="" />
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                                <table class="table table-stripped table-diagnosa table-sm" style="margin-bottom: 30px;">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th width="25%">Kode ICD</th>
                                            <th width="60%">Deskripsi</th>
                                            <th width="15%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade p-3" id="prosedur-pasien" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <label for="" style="font-size: 12px">Prosedur</label>
                                <input type="search" class="form-control form-control-sm" onkeyup="cariProsedur(this)" name="prosedur" id="prosedur" style="font-size:12px;min-height:12px;border-radius:0" autocomplete="off">
                                <div class="list-prosedur"></div>
                                <input type="hidden" class="no_prosedur" value="" />
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
                                <table class="table table-stripped table-prosedur table-sm" style="margin-bottom: 30px;">
                                    <thead>
                                        <tr>
                                            <th width="10%">No</th>
                                            <th width="25%">Kode Prosedur</th>
                                            <th width="60%">Deskripsi</th>
                                            <th width="15%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade p-3" id="catatan-dokter" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                        <label for="">Tanggal & Jam</label>
                        <input type="text" class="form-control form-control-sm" id="jamCatatan" value="-" readonly />
                        <label for="">Dokter</label>
                        <input type="text" class="form-control form-control-sm mb-2" id="kdDokter" value="-" readonly />
                        <textarea class="form-control" name="catatan_dr" id="catatan_dr" cols="30" rows="11">
                        </textarea>
                        <button type="button" class="btn btn-sm btn-primary mt-2" style="font-size:12px" onclick="insertCatatanPerawatan()"><i class="bi bi-save"></i> Simpan Catatan</button>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        // var textCatatan = '';
        $('#modalCatatan').on('shown.bs.modal', () => {

            textCatatan = "HASIL PEMERIKSAAN USG KEHAMILAN";
            textCatatan += "\nTAMPAK : ";
            textCatatan += "\nLETAK : ";
            textCatatan += "\nDJJ : ";
            textCatatan += "\nJENIS KELAMIN : ";
            textCatatan += "\nBIOMETRI : ";
            textCatatan += "\nUMUR KEHAMILAN : ";
            textCatatan += "\nINSERSI PLASENTA : ";
            textCatatan += "\nICA : ";
            textCatatan += "\nKESAN : ";
            noRawat = $('#nomor_rawat').val();
            setCatatanPerawatan(noRawat)

        });

        function setCatatanPerawatan(no_rawat) {
            getCatatanPerawatan(textRawat(no_rawat, '-')).done((response) => {
                console.log(response);
                if (Object.keys(response).length != 0) {
                    $('textarea#catatan_dr').val(response.catatan)
                    $('#kdDokter').val(response.dokter.nm_dokter)
                    $('#jamCatatan').val(`${formatTanggal(response.tanggal)} ${response.jam}`)
                } else {
                    $('#kdDokter').val('-')
                    $('#jamCatatan').val('-')
                    $('textarea#catatan_dr').val(textCatatan);
                }
            })
        }

        function insertCatatanPerawatan() {
            catatan = $('#catatan_dr').val();
            data = {
                no_rawat: $('#nomor_rawat').val(),
                kd_dokter: $('#nik').val(),
                catatan: catatan,
                _token: "{{ csrf_token() }}",
            }
            $.ajax({
                url: '/erm/catatan/perawatan/create',
                data: data,
                method: 'POST',
                success: (response) => {
                    swal.fire('Berhasil', 'Catatan dibuat', 'success').then(() => {
                        setCatatanPerawatan(data.no_rawat)
                    })
                }
            })

        }

        function getCatatanPerawatan(noRawat) {
            let catatan = $.ajax({
                url: '/erm/catatan/perawatan/' + noRawat,
                dataType: 'JSON',
                error: (request) => {
                    if (request.status == 401) {
                        Swal.fire({
                            title: 'Sesi login berakhir !',
                            icon: 'info',
                            text: 'Silahkan login kembali ',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/erm';
                            }
                        })
                    }
                },
            });

            return catatan;
        }
    </script>
@endpush
