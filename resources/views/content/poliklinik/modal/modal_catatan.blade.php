<div class="modal fade" id="modalCatatan" tabindex="-1" aria-labelledby="modalCatatan" aria-hidden="true" style="background-color: #00000085;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #ffd900;color:#000000">
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
                <div class="tab-content" id="myTabContent" style="max-height:65vh;height: 60vh;overflow: auto">
                    <div class="tab-pane fade show active p-3" id="diagnosa-pasien" role="tabpanel" aria-labelledby="diagnosa-pasien" tabindex="0">
                        @include('content.poliklinik.modal.catatan.diagnosaPasien')
                    </div>
                    <div class="tab-pane fade p-3" id="prosedur-pasien" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        @include('content.poliklinik.modal.catatan.prosedurPasien')
                    </div>
                    <div class="tab-pane fade p-3" id="catatan-dokter" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                        <div class="row">
                            <div class="col-xl-4 col-md-12 col-sm-12">
                                <label for="">Tanggal & Jam</label>
                                <input type="text" class="form-control form-control-sm" id="jamCatatan" value="-" readonly />
                            </div>
                            <div class="col-xl-8 col-md-12 col-sm-12">
                                <label for="">Dokter</label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control form-control-sm" id="kdDokter" value="-" readonly />
                                    <input type="text" class="form-control form-control-sm w-75" id="nmDokter" value="-" readonly />
                                </div>
                            </div>
                            <div class="col-xl-12 col-md-12 col-sm-12">
                                <label for="catatanPerawatan">Catatan</label>
                                <textarea class="form-control" name="catatanPerawatan" id="catatanPerawatan" cols="30" rows="11">
                                </textarea>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary mt-2" onclick="insertCatatanPerawatan()"><i class="bi bi-save"></i> Simpan</button>
                        <button type="button" class="btn btn-sm btn-danger mt-2 d-none" id="btnDeleteCatatan"><i class="bi bi-trash"></i> Hapus</button>
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
        const modalCatatan = $('#modalCatatan');
        const catatanPerawatan = $('#catatanPerawatan')
        const btnDeleteCatatan = $('#btnDeleteCatatan')
        const templateCatatan = `HASIL PEMERIKSAAN USG KEHAMILAN
TAMPAK :
LETAK :  
DJJ :
JENIS KELAMIN : 
BIOMETRI :
UMUR KEHAMILAN : 
TBJ : 
INSERSI PLACENTA : `;
        $('#modalCatatan').on('shown.bs.modal', () => {
            selectDiagnosaPasien.select2({
                ajax: {
                    url: `${url}/penyakit/cari`,
                    dataType: 'JSON',
                    data: (params) => {
                        return {
                            kd_penyakit: params.term
                        };
                    },
                    processResults: (data) => {
                        return {
                            results: data.map((item) => {
                                return {
                                    id: item.kd_penyakit,
                                    text: `${item.kd_penyakit} - ${item.nm_penyakit}`
                                };
                            })
                        };
                    }
                }
            }).on('select2:select', (e) => {
                const kd_penyakit = e.params.data.id;
                createDiagnosaPasien(kd_penyakit)
                selectDiagnosaPasien.empty()

            });

            selectProsedurPasien.select2({
                ajax: {
                    url: `${url}/prosedur/cari`,
                    dataType: 'JSON',
                    data: (params) => {
                        return {
                            kode: params.term
                        };
                    },
                    processResults: (data) => {
                        return {
                            results: data.map((item) => {
                                return {
                                    id: item.kode,
                                    text: `${item.kode} - ${item.deskripsi_pendek}`
                                };
                            })
                        };
                    }
                }
            }).on('select2:select', (e) => {
                const prosedur = e.params.data.id;
                createProsedurPasien(prosedur)
                selectProsedurPasien.empty()

            });

        });

        function catatanPasien(no_rawat) {
            setDiagnosaPasien(no_rawat)
            setProsedurPasien(no_rawat)
            setCatatanPerawatan(no_rawat)

            const kdDokter = formSoapPoli.find('#dokter').val()
            const nmDokter = formSoapPoli.find('#dokter').find('option:selected').text()
            $('#kdDokter').val(kdDokter)
            $('#nmDokter').val(nmDokter)

            modalCatatan.modal('show');
        }

        function getCatatanPerawatan(no_rawat) {
            return $.ajax({
                url: `${url}/catatan/perawatan`,
                dataType: 'JSON',
                data: {
                    no_rawat: no_rawat,
                }
            });
        }

        function setCatatanPerawatan(no_rawat) {
            getCatatanPerawatan(no_rawat).done((response) => {
                if (Object.values(response).length) {
                    $('textarea#catatanPerawatan').val(response.catatan)
                    $('#jamCatatan').val(`${formatTanggal(response.tanggal)} ${response.jam}`)
                    btnDeleteCatatan.attr('onclick', `deleteCatatanPerawatan('${no_rawat}')`).removeClass('d-none')
                } else {
                    $('#jamCatatan').val('-')
                    btnDeleteCatatan.addClass('d-none')
                    $('textarea#catatanPerawatan').val(templateCatatan)
                }
            })
        }

        function deleteCatatanPerawatan(no_rawat) {
            Swal.fire({
                title: 'Apakah anda yakin ?',
                text: 'Data ini akan di hapus !',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${url}/catatan/perawatan/delete`,
                        method: 'POST',
                        data: {
                            no_rawat: no_rawat,
                            _token: "{{ csrf_token() }}"
                        }
                    }).done((response) => {
                        toastReload(response.message, 2000)
                        setCatatanPerawatan(no_rawat)
                    })
                }
            })
        }

        function insertCatatanPerawatan() {
            const catatan = $('textarea#catatanPerawatan').val();
            const no_rawat = formSoapPoli.find('input[name=no_rawat]').val();
            const kd_dokter = formSoapPoli.find('input[name=dokter]').val();
            $.ajax({
                url: `${url}/catatan/perawatan/create`,
                data: {
                    no_rawat: no_rawat,
                    kd_dokter: kd_dokter,
                    catatan: catatan,
                    _token: "{{ csrf_token() }}",
                },
                method: 'POST',
                success: (response) => {
                    toastReload(response.message, 2000)
                    setCatatanPerawatan(no_rawat)
                }
            })

        }
    </script>
@endpush
