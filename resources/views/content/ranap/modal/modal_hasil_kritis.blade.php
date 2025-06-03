<div class="modal fade" id="modalHasilKritis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgb(0 0 0 / 49%)">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Hasil Kritis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formPasienKritis">
                    <div class="row gy-2">
                        <div class="col-lg-4">
                            <div class="input-group">
                                <label for="no_rawat" class="form-label">No. Rawat</label>
                                <input type="text" class="form-control br-full" id="no_rawat" name="no_rawat" readonly>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <label for="nm_pasien">Pasien</label>
                                <input type="text" class="form-control br-full" id="nm_pasien" name="nm_pasien" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <label for="keluarga">Keluarga</label>
                                <input type="text" class="form-control br-full" id="keluarga" name="keluarga" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <label for="kamar">Kamar</label>
                                <input type="text" class="form-control br-full" id="kamar" name="kamar" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <label for="diagnosa">Diagnosa Awal</label>
                                <input type="text" class="form-control br-full" id="diagnosa" name="diagnosa" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <label for="dokter">DPJP</label>
                                <input type="text" class="form-control br-full" id="dokter" name="dokter" readonly>
                                <input type="hidden" id="kd_dokter" name="kd_dokter" readonly>
                            </div>
                        </div>

                    </div>
                </form>
                <ul class="nav nav-tabs mt-3" id="tabsHasilKritis" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="formPasienKritis-tab" data-bs-toggle="tab" data-bs-target="#tabHasilKritis" type="button" role="tab" aria-controls="tabHasilKritis" aria-selected="true">Form Hasil Kritis</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="hasilKritis-tab" data-bs-toggle="tab" data-bs-target="#hasilKritis" type="button" role="tab" aria-controls="hasilKritis" aria-selected="true">Daftar Hasil</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="tabHasilKritis" role="tabpanel" aria-labelledby="formPasienKritis-tab">
                        <form action="" id="formHasilKritis">
                            <div class="row gy-2">
                                <div class="col-lg-6">
                                    <label for="" class="form-label">Hasil Kritis <a href="javascript:void(0)" class="text-primary" id="showHasilPenunjang" title="Hasil Penunjang Lab & Radiologi"><i class="fa fa-search"></i></a></label>
                                    <textarea class="form-control" id="hasil" cols="30" rows="10" name="hasil"></textarea>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <label for="" class="form-label">Petugas Lab/Radiologi</label>
                                            <select class="form-select" id="selectPetugas" style="width: 100%" name="petugas"></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="" class="form-label">Tanggal & Jam</label>
                                            <input type='text' id='tgl' class="form-control form-control-sm datetimepicker" name="tgl" />
                                        </div>
                                        <div class="col-lg-8">
                                            <label for="" class="form-label">Petugas Ruangan</label>
                                            <select class="form-select" id="selectPetugasRuang" style="width: 100%" name="petugas_ruang"></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="" class="form-label">Tanggal & Jam</label>
                                            <input type='text' id='tgl_ruang' class="form-control form-control-sm datetimepicker" name="tgl_ruang" />
                                        </div>
                                        <div class="col-lg-8">
                                            <label for="" class="form-label">Dokter</label>
                                            <select class="form-select" id="selectDokterKritis" style="width: 100%" name="dokter"></select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="" class="form-label">Tanggal & Jam</label>
                                            <input type='text' id='tgl_dokter' class="form-control form-control-sm datetimepicker" name="tgl_dokter" />
                                            <input type='hidden' id='_token' name="_token" value="{{ csrf_token() }}" />
                                            <input type='hidden' id='id' name="id" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade p-3" id="hasilKritis" role="tabpanel" aria-labelledby="hasilKritis-tab">
                        <table class="table nowrap" id="tbHasilKritis" width="100%"></table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 12px" onclick="simpanHasilKritis()">
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
        var petugas = $('#selectPetugas')
        var selectDokter = $('#selectDokterKritis')
        var selectPetugasRuang = $('#selectPetugasRuang')
        const showHasilPenunjang = $('#showHasilPenunjang')

        function selectPetugasKritis(params) {
            const select = params.select2({
                dropdownParent: modalHasilKritis,
                delay: 0,
                scrollAfterSelect: false,
                initSelection: function(element, callback) {},
                ajax: {
                    url: `${url}/petugas/cari`,
                    dataType: 'json',
                    data: (params) => {
                        const query = {
                            q: params.term
                        }
                        return query
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nama,
                                    id: item.nip
                                }
                            })
                        };
                    },
                    cache: false
                }
            });

            return select;

        }

        function selectDokterKritis(params) {
            const select = params.select2({
                dropdownParent: modalHasilKritis,
                delay: 0,
                scrollAfterSelect: false,
                initSelection: function(element, callback) {},
                ajax: {
                    url: `${url}/dokter/cari`,
                    dataType: 'json',
                    data: (params) => {
                        const query = {
                            nm_dokter: params.term
                        }
                        return query
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
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

            selectPetugasKritis(petugas)
            selectPetugasKritis(selectPetugasRuang)
            selectDokterKritis(selectDokter)

            formTabKritis = document.getElementById('formPasienKritis-tab')
            hasilTabKritis = document.getElementById('hasilKritis-tab')
            formPasienKritis.find('#hasil').val('')



            instanceFormTabKritis = bootstrap.Tab.getInstance(formTabKritis);
            instansceHasilTabKritis = new bootstrap.Tab(hasilTabKritis);
        })

        function hasilKritis(no_rawat) {
            getRegPeriksa(no_rawat).done((response) => {
                const pasien = response.pasien
                formPasienKritis.find('#no_rawat').val(no_rawat)
                formPasienKritis.find('#nm_pasien').val(`${pasien.nm_pasien} (${response.umurdaftar} ${response.sttsumur}) / ${splitTanggal(pasien.tgl_lahir)}`)
                formPasienKritis.find('#keluarga').val(response.p_jawab)
                const kamarInap = response.kamar_inap.map((item) => {
                    const valKamar = item.stts_pulang != 'Pindah Kamar' ? item.kamar.bangsal.nm_bangsal : '-';
                    return [
                        valKamar,
                        item.diagnosa_awal
                    ];
                }).join(',')

                formPasienKritis.find('#kamar').val(kamarInap.split(',')[0]);
                formPasienKritis.find('#diagnosa').val(kamarInap.split(',')[1]);
                formPasienKritis.find('#dokter').val(response.dokter.nm_dokter);
                showHasilPenunjang.attr('onclick', `modalPemeriksaanPenunjang('${no_rawat}')`)
            })
            drawHasilKritis(no_rawat)
            modalHasilKritis.modal('show')
        }

        function simpanHasilKritis() {
            const data = getDataForm('#formHasilKritis', ['textarea', 'input', 'select'])
            data['no_rawat'] = formPasienKritis.find('#no_rawat').val();
            $.post(`${url}/hasil/kritis`, data).done((response) => {
                alertSuccessAjax()
                drawHasilKritis(data['no_rawat']);
                $('#formHasilKritis').trigger('reset')
                instansceHasilTabKritis.show()
            }).fail((error) => {
                alertErrorAjax(error)
            })
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
                            return `${data}`;
                        }
                    },
                    {
                        data: 'petugas.nama',
                        title: 'Petugas Lab',
                        render: (data, type, row, meta) => {
                            const petugas = data ? data : '-';
                            const jamPetugas = row.tgl != '0000-00-00 00:00:00' ? `${formatTanggal(row.tgl)} ${row.tgl.split(' ')[1]}` : '';
                            return `${petugas} <br/> <span class="text-muted" style="font-size:11px">${jamPetugas}</span>`
                        }
                    },
                    {
                        data: 'petugas_ruang',
                        title: 'Petugas Ruangan',
                        render: (data, type, row, meta) => {
                            const petugasRuang = data ? data.nama : '-';
                            const jamRuangan = row.tgl_ruang != '0000-00-00 00:00:00' ? `${formatTanggal(row.tgl_ruang)} ${row.tgl_ruang.split(' ')[1]}` : '';
                            return `${petugasRuang} <br/> <span class="text-muted" style="font-size:11px">${jamRuangan}</span>`
                        }


                    },
                    {
                        data: 'dokter',
                        title: 'Dokter',
                        render: (data, type, row, meta) => {
                            const dokter = data ? data.nm_dokter : '-';
                            const jamDokter = row.tgl_dokter != '0000-00-00 00:00:00' ? `${formatTanggal(row.tgl_dokter)} ${row.tgl_dokter.split(' ')[1]}` : '';
                            return `${dokter} <br/> <span class="text-muted" style="font-size:11px">${jamDokter}</span>`

                        }
                    },



                ],
            });
        }

        function hapusHasilKritis(id) {
            const no_rawat = formPasienKritis.find('#no_rawat').val();
            const _token = $('#formHasilKritis').find('#_token').val();
            $.post(`${url}/hasil/kritis/delete/${id}`, {
                _token: _token,
            }).done((response) => {
                alertSuccessAjax().then(() => {
                    drawHasilKritis(no_rawat);
                })
            }).fail((error) => {
                alertErrorAjax(error)
            })
        }

        function setHasilKritis(id) {
            const no_rawat = formPasienKritis.find('#no_rawat').val();
            $.get(`${url}/hasil/kritis/${id}`).done((response) => {
                $('#formHasilKritis').find('#hasil').val(response.hasil)
                $('#formHasilKritis').find('#tgl').val(`${splitTanggal(response.tgl.split(' ')[0])} ${response.tgl.split(' ')[1]}`)
                $('#formHasilKritis').find('#tgl_ruang').val(`${splitTanggal(response.tgl_ruang.split(' ')[0])} ${response.tgl_ruang.split(' ')[1]}`)
                $('#formHasilKritis').find('#tgl_dokter').val(`${splitTanggal(response.tgl_dokter.split(' ')[0])} ${response.tgl_dokter.split(' ')[1]}`)
                $('#formHasilKritis').find('#id').val(id)

                const tugas = new Option(`${response.petugas.nama}`, `${response.petugas.nip}`, true, true);
                const ruang = new Option(`${response.petugas_ruang ? response.petugas_ruang.nama : '' }`, `${response.petugas_ruang ? response.petugas_ruang.nip : ''}`, true, true);
                const dokter = new Option(`${response.dokter ? response.dokter.nm_dokter : ''}`, `${ response.dokter ? response.dokter.kd_dokter : ''}`, true, true);
                selectDokter.append(dokter).trigger('change')
                selectPetugasRuang.append(ruang).trigger('change')
                petugas.append(tugas).trigger('change')



                instanceFormTabKritis.show()
            }).fail((error) => {
                alertErrorAjax(error)
            })
        }
    </script>
@endpush
