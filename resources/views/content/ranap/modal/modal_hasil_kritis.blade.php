<div class="modal fade" id="modalHasilKritis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="background-color: rgb(0 0 0 / 49%)">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Hasil Kritis</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="min-height: 550px">
                <form action="" id="formPasienKritis">
                    <div class="row gy-2">
                        <div class="col-lg-2">
                            <label for="no_rawat">No. Rawat</label>
                            <input type="text" class="form-control" id="no_rawat" name="no_rawat" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="nm_pasien">Pasien</label>
                            <input type="text" class="form-control" id="nm_pasien" name="nm_pasien" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="tgl_lahir">Tgl. Lahir/Umur</label>
                            <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="keluarga">Keluarga</label>
                            <input type="text" class="form-control" id="keluarga" name="keluarga" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="kamar">Kamar</label>
                            <input type="text" class="form-control" id="kamar" name="kamar" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="diagnosa">Diagnosa Awal</label>
                            <input type="text" class="form-control" id="diagnosa" name="diagnosa" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="dokter">DPJP</label>
                            <input type="text" class="form-control" id="dokter" name="dokter" readonly>
                            <input type="hidden" id="kd_dokter" name="kd_dokter" readonly>
                        </div>

                    </div>
                </form>
                <hr />
                <h1 class="h4 text-center">FORM HASIL KRITIS</h1>
                <form action="" id="formHasilKritis" class="mb-3">
                    <div class="row gy-2">
                        <div class="col-lg-7">
                            <label for="" class="form-label">Hasil Kritis <a href="javascript:void(0)"
                                    class="text-primary" id="showHasilPenunjang"
                                    title="Hasil Penunjang Lab & Radiologi"><i class="fa fa-search"></i></a></label>
                            <textarea class="form-control" id="hasil" cols="30" rows="10" name="hasil"></textarea>
                        </div>
                        <div class="col-lg-5">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label for="" class="form-label">Petugas Lab/Radiologi</label>
                                    <select class="form-select" id="selectPetugasLab" style="width: 100%"
                                        name="petugas"></select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="" class="form-label">Tanggal & Jam</label>
                                    <input type='text' id='tgl' class="form-control form-control-sm datetimepicker"
                                        name="tgl" value="{{ date('d-m-Y H:i:s') }}" />
                                </div>
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Petugas Ruangan</label>
                                    <select class="form-select" id="selectPetugasRuang" style="width: 100%"
                                        name="petugas_ruang"></select>
                                </div>

                                <div class="col-lg-12">
                                    <label for="" class="form-label">Dokter</label>
                                    <select class="form-select" id="selectDokterKritis" style="width: 100%"
                                        name="dokter"></select>
                                    <input type='hidden' id='id' name="id" />
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                <table class="table nowrap" id="tbHasilKritis" width="100%"></table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 12px"
                    onclick="simpanHasilKritis()">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px">
                    <i class="bi bi-x-circle"> </i> Keluar
                </button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        var modalHasilKritis = $('#modalHasilKritis')
        var formPasienKritis = $('#formPasienKritis')
        var tbHasilKritis = $('#tbHasilKritis')
        var selectPetugasLab = $('#selectPetugasLab')
        var selectDokter = $('#selectDokterKritis')
        var selectPetugasRuang = $('#selectPetugasRuang')
        const showHasilPenunjang = $('#showHasilPenunjang')
        const formHasilKritis = $('#formHasilKritis')

        function selectPetugasKritis(params) {
            const select = params.select2({
                dropdownParent: modalHasilKritis,
                delay: 0,
                scrollAfterSelect: false,
                initSelection: function (element, callback) { },
                ajax: {
                    url: `${url}/petugas/cari`,
                    dataType: 'json',
                    data: (params) => {
                        const query = {
                            q: params.term
                        }
                        return query
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.nip,
                                    text: item.nama,
                                    departemen: item.departemen
                                }
                            })
                        };
                    },
                    cache: false
                },
                templateResult: function (item) {
                    if (!item.id) {
                        return item.text;
                    }

                    return $(`
                    <div>
                        <div>${item.text}</div>
                        <small class="text-muted">${item.departemen ?? '-'}</small>
                    </div>
                `);
                },

                templateSelection: function (item) {
                    return item.text || item.nama;
                },

                escapeMarkup: function (markup) {
                    return markup;
                }


            });

            return select;

        }



        function resetFormHasilKritis() {
            formPasienKritis.trigger('reset')
            formHasilKritis.trigger('reset')
        }

        function selectDokterKritis(params) {
            const select = params.select2({
                dropdownParent: modalHasilKritis,
                delay: 0,
                scrollAfterSelect: false,
                initSelection: function (element, callback) { },
                ajax: {
                    url: `${url}/dokter/cari`,
                    dataType: 'json',
                    data: (params) => {
                        const query = {
                            nm_dokter: params.term
                        }
                        return query
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.nm_dokter,
                                    id: item.kd_dokter
                                }
                            })
                        };
                    },
                    cache: false
                }
            });

            return select;

        }


        modalHasilKritis.on('show.bs.modal', () => {
            selectPetugasKritis(selectPetugasLab);
            selectPetugasKritis(selectPetugasRuang);
            selectDokterKritis(selectDokter);
            const optPetugas = new Option("{{ session()->get('pegawai')->nik }}", "{{ session()->get('pegawai')->nama }}", true, true);
            selectPetugasLab.append(optPetugas).trigger('change')
            formPasienKritis.find('#hasil').val('')
        })

        function setInfoPasienKritis(no_rawat) {
            console.log(formPasienKritis);

            resetFormHasilKritis()

            getRegPeriksa(no_rawat).done((response) => {
                const pasien = response.pasien
                formPasienKritis.find('#no_rawat').val(no_rawat)
                formPasienKritis.find('#nm_pasien').val(`${response.no_rkm_medis} - ${pasien.nm_pasien}`)
                formPasienKritis.find('#keluarga').val(response.p_jawab)
                formPasienKritis.find('#tgl_lahir').val(`${formatTanggal(response.pasien.tgl_lahir)} / ${response.umurdaftar} ${response.sttsumur}`)
                const kamarInap = response.kamar_inap.map((item) => {
                    const valKamar = item.stts_pulang != 'Pindah Kamar' ? item.kamar.bangsal.nm_bangsal : '-';
                    return [
                        valKamar,
                        item.diagnosa_awal,
                        item.tgl_masuk,
                    ];
                }).join(',')

                formPasienKritis.find('#kamar').val(`${kamarInap.split(',')[0]} / ${hitungLamaHari(kamarInap.split(',')[2])} Hari`);
                formPasienKritis.find('#diagnosa').val(kamarInap.split(',')[1]);
                formPasienKritis.find('#dokter').val(response.dokter.nm_dokter);
                formHasilKritis.find('#tgl').val(moment().format('DD-MM-YYYY HH:mm:ss'))
                showHasilPenunjang.attr('onclick', `modalPemeriksaanPenunjang('${no_rawat}')`)
            })
        }
        function hasilKritis(no_rawat) {
            setInfoPasienKritis(no_rawat)
            drawHasilKritis(no_rawat)
            modalHasilKritis.modal('show')
        }

        function simpanHasilKritis() {
            const data = getDataForm('#formHasilKritis', ['textarea', 'input', 'select']);

            data.no_rawat = formPasienKritis.find('#no_rawat').val();

            $.post(`${url}/hasil/kritis`, data)
                .done((response) => {
                    alertSuccessAjax().then(() => {
                        setInfoPasienKritis(data.no_rawat)
                        drawHasilKritis(data.no_rawat);
                    });

                })
                .fail((xhr) => {
                    console.log(xhr);

                    // Laravel Validation Error
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON?.errors || {};

                        Swal.fire({
                            icon: 'error',
                            title: `${xhr.responseJSON?.message || 'Validation Error'}`,
                            html: `
                                                                                                                                                                                                                                                                                                                                                                            <ul style=" padding-left:20px; list-style-type:none" class="text-danger">
                                                                                                                                                                                                                                                                                                                                                                                ${Object.values(errors)
                                    .flat()
                                    .map(item => `<li>${item}</li>`)
                                    .join('')}
                                                                                                                                                                                                                                                                                                                                                                            </ul>
                                                                                                                                                                                                                                                                                                                                                                        `
                        });

                        return;
                    }

                    // Error lainnya
                    alertErrorAjax(xhr);
                });
        }

        function drawHasilKritis(no_rawat) {
            const table = tbHasilKritis.DataTable({
                scrollX: false,
                searching: false,
                paging: false,
                info: false,
                destroy: true,
                ajax: {
                    url: `${url}/hasil/kritis`,
                    data: {
                        no_rawat: no_rawat,
                    }
                },
                columns: [{
                    data: 'id',
                    title: '',
                    render: (data, type, row, meta) => {
                        return `<button type="button" class="btn btn-sm btn-danger" onclick="hapusHasilKritis(${data})"><i class="bi bi-trash"></i></button>
                                                                                                                                                <button type="button" class="btn btn-sm btn-warning" onclick="setHasilKritis(${data})"><i class="bi bi-pencil"></i></button>`;
                    }
                },
                {
                    data: 'hasil',
                    title: 'Hasil',
                    render: (data, type, row, meta) => {
                        return `${stringPemeriksaan(data)}`;
                    }
                },
                {
                    data: 'petugas.nama',
                    title: 'Petugas Lab/Radiologi',
                    render: (data, type, row, meta) => {

                        const petugas = data || '-';

                        const jamPetugas =
                            row.tgl != null
                                ? `${formatTanggal(row.tgl)}`
                                : '-';

                        return `
                                                                                                                                                    ${petugas}
                                                                                                                                                    <br/>
                                                                                                                                                    <span class="text-muted" style="font-size:11px">
                                                                                                                                                        ${jamPetugas}
                                                                                                                                                    </span>
                                                                                                                                                `;


                    }
                },

                {
                    data: 'petugas_ruang',
                    title: 'Petugas Ruangan',
                    render: (data, type, row, meta) => {
                        const petugasRuang = data ? data.nama : '-';
                        const isMyVerifikasi = data.nip === "{{ session()->get('pegawai')->nik }}" ? true : false;

                        const buttonVerif = isMyVerifikasi ? `<button class="btn btn-primary btn-sm" type="button" onclick="verifikasiHasilKritis(${row.id}, 'petugas_ruang')">
                                                                                                                                                            <i class="bi bi-check-circle"></i>
                                                                                                                                                                Konfirmasi
                                                                                                                                                                </button>` : '<span class="badge text-bg-danger">Belum dikonfirmasi</span>';
                        console.log(row.tgl_ruang);

                        const jamPetugas =
                            row.tgl_ruang != null
                                ? `${formatTanggal(row.tgl_ruang)}`
                                : buttonVerif;
                        const content = `
                                                                                                                                                    ${petugasRuang}
                                                                                                                                                    <br/>
                                                                                                                                                    <span class="text-muted" style="font-size:11px">
                                                                                                                                                        ${jamPetugas}
                                                                                                                                                    </span>
                                                                                                                                                `;
                        return renderTextWithStempel(
                            content,
                            row.tgl_ruang != null
                        );
                    }
                },
                {
                    data: 'dokter',
                    title: 'Dokter',
                    render: (data, type, row, meta) => {

                        const dokter = data ? data.nm_dokter : '-';
                        const isMyVerifikasi = data.kd_dokter === "{{ session()->get('pegawai')->nik }}" ? true : false;
                        const buttonVerif = isMyVerifikasi ? `
                                                                                                                                                <button class="btn btn-primary btn-sm" type="button" onclick="verifikasiHasilKritis(${row.id}, 'dokter')">
                                                                                                                                                    <i class="bi bi-check-circle"></i>
                                                                                                                                                        Konfirmasi
                                                                                                                                                        </button>` : '<span class="badge text-bg-danger">Belum dikonfirmasi</span>';
                        const jamDokter =
                            row.tgl_dokter != null
                                ? `${formatTanggal(row.tgl_dokter)}`
                                : buttonVerif;

                        const content = `
                                                                                                                                                    ${dokter}
                                                                                                                                                    <br/>
                                                                                                                                                    <span class="text-muted" style="font-size:11px">
                                                                                                                                                        ${jamDokter}
                                                                                                                                                    </span>
                                                                                                                                                `;

                        return renderTextWithStempel(
                            content,
                            row.tgl_dokter != null
                        );
                    }
                }



                ],
            });
        }

        function hapusHasilKritis(id) {
            const no_rawat = formPasienKritis.find('#no_rawat').val();

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Data akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`${url}/hasil/kritis/delete/${id}`).done((response) => {
                        alertSuccessAjax().then(() => {
                            setInfoPasienKritis(no_rawat)
                            drawHasilKritis(no_rawat);

                        })
                    }).fail((error) => {
                        alertErrorAjax(error)
                    })
                }
            })

        }

        function setHasilKritis(id) {
            const no_rawat = formPasienKritis.find('#no_rawat').val();
            $.get(`${url}/hasil/kritis/${id}`).done((response) => {
                $('#formHasilKritis').find('#hasil').val(response.hasil)
                $('#formHasilKritis').find('#tgl').val(`${splitTanggal(response.tgl)}`)

                $('#formHasilKritis').find('#id').val(id)

                const tugas = new Option(`${response.petugas.nama}`, `${response.petugas.nip}`, true, true);
                const ruang = new Option(`${response.petugas_ruang ? response.petugas_ruang.nama : ''}`, `${response.petugas_ruang ? response.petugas_ruang.nip : ''}`, true, true);
                const dokter = new Option(`${response.dokter ? response.dokter.nm_dokter : ''}`, `${response.dokter ? response.dokter.kd_dokter : ''}`, true, true);
                selectDokter.append(dokter).trigger('change')
                selectPetugasRuang.append(ruang).trigger('change')
                selectPetugasLab.append(tugas).trigger('change')
            }).fail((error) => {
                alertErrorAjax(error)
            })
        }
        function verifikasiHasilKritis(id, role) {

            $('.modal').modal('hide');
            const no_rawat = formPasienKritis.find('#no_rawat').val();

            setTimeout(() => {

                Swal.fire({
                    title: 'Verifikasi Hasil Kritis',
                    text: 'Masukkan password user anda sebagai verifikator/tulbakon',
                    input: 'password',
                    inputPlaceholder: 'Masukkan password',
                    showCancelButton: true,
                    confirmButtonText: 'Verifikasi',
                    cancelButtonText: 'Batal',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !Swal.isLoading(),
                    preConfirm: async (password) => {
                        if (!password) {
                            Swal.showValidationMessage(
                                'Password wajib diisi'
                            );
                            return false;
                        }

                        try {

                            const response = await $.ajax({
                                url: `/erm/hasil/kritis/verifikasi/${id}`,
                                type: 'POST',

                                data: {
                                    password: password,
                                    role: role
                                }
                            });

                            return response;

                        } catch (error) {

                            Swal.showValidationMessage(
                                error.responseJSON?.message ??
                                'Password salah'
                            );

                            return false;
                        }
                    }

                }).then((result) => {

                    if (result.isConfirmed) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: result.value.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            hasilKritis(no_rawat)

                        });

                        table.ajax.reload();
                    }

                });

            }, 300);
        }

    </script>
@endpush