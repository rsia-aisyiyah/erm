<div class="modal fade" id="modalSkriningTb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Skrining TB</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formPasienSkriningTb">
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

                <ul class="nav nav-tabs mt-3" id="tabsSkriningTb" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="formSkriningTb-tab" data-bs-toggle="tab" data-bs-target="#tabSkriningTb" type="button" role="tab" aria-controls="tabSkriningTb" aria-selected="true">Form Skrining</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="skriningTb-tab" data-bs-toggle="tab" data-bs-target="#skriningTb" type="button" role="tab" aria-controls="skriningTb" aria-selected="true">Hasil Skrining</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="tabSkriningTb" role="tabpanel" aria-labelledby="formSkriningTb-tab">
                        @include('content.ranap.modal.skriningTb._formSkriningTb')
                    </div>
                    <div class="tab-pane fade p-3" id="skriningTb" role="tabpanel" aria-labelledby="skriningTb-tab">
                        <table class="table nowrap" id="tbSkriningTb" width="100%"></table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 12px" onclick="simpanSkriningTb()">
                    <i class="bi bi-save">
                    </i> Simpan
                </button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px">
                    <i class="bi bi-x-circle">
                    </i> Keluar
                </button>
            </div>
        </div>
    </div>
</div>
</div>
@push('script')
    <script>
        var modalSkriningTb = $('#modalSkriningTb');
        var formSkriningTb = $('#formSkriningTb');
        var formPasienSkriningTb = $('#formPasienSkriningTb');
        var formTab = '';
        var tableTab = '';
        var instanceFormTab = '';
        var instanceTableTab = '';

        modalSkriningTb.on('shown.bs.modal', () => {
            formTab = document.getElementById('formSkriningTb-tab')
            tableTab = document.getElementById('skriningTb-tab')
            instanceFormTab = bootstrap.Tab.getInstance(formTab);
            instanceTableTab = new bootstrap.Tab(tableTab);
        })

        function skriningTb(no_rawat) {
            modalSkriningTb.modal('show')
            drawTbSkriningTb(no_rawat)
            getRegPeriksa(no_rawat).done((response) => {
                const kamar = response.kamar_inap.map((item) => {
                    const valKamar = item.stts_pulang != 'Pindah Kamar' ? item.kamar.bangsal.nm_bangsal : '-';
                    return [valKamar, item.diagnosa_awal];
                }).join(',');
                formPasienSkriningTb.find('#no_rawat').val(no_rawat);
                formPasienSkriningTb.find('#nm_pasien').val(`${response.no_rkm_medis} - ${response.pasien.nm_pasien} / ${response.umurdaftar} ${response.sttsumur}`);
                formPasienSkriningTb.find('#dokter').val(response.dokter.nm_dokter);
                formPasienSkriningTb.find('#kd_dokter').val(response.kd_dokter);
                formPasienSkriningTb.find('#keluarga').val(`${response.p_jawab} (${response.hubunganpj})`);
                formPasienSkriningTb.find('#kamar').val(kamar.split(',')[0]);
                formPasienSkriningTb.find('#diagnosa').val(kamar.split(',')[1]);
            })
        }

        function simpanSkriningTb() {
            const data = getDataForm('#formSkriningTb', ['input', 'select']);
            formSkriningTb.find(`select`).each((index, element) => {
                const text = $(`select[name=${element.id}]`);
                const value = text.find('option:selected').text();
                const name = text.attr('name');
                data[name] = value;

            })
            data['no_rawat'] = formPasienSkriningTb.find('#no_rawat').val();
            data['kd_dokter'] = formPasienSkriningTb.find('#kd_dokter').val();

            $.post('/erm/skrining/tb', data).done((response) => {
                alertSuccessAjax().then(() => {
                    drawTbSkriningTb(data['no_rawat'])
                    formSkriningTb.find('input[name=id]').remove();
                    formSkriningTb.trigger('reset')
                    instanceTableTab.show()
                })
            })

        }

        function setNilaiSkrining(e) {
            const target = $(e).data('target')
            const value = $(e).find(':selected').val();
            const text = formSkriningTb.find(`input[type=text]`)
            formSkriningTb.find(`input[name=${target}]`).val(value);
            let total = 0;
            formSkriningTb.find(`input[type=text]`).each((index, element) => {
                if (element.id != 'total_skrining') {
                    total += parseInt(element.value);
                }
            });
            formSkriningTb.find('input[name=total_skrining]').val(total);
        }

        function drawTbSkriningTb(no_rawat) {
            const table = $('#tbSkriningTb').DataTable({
                scrollX: true,
                searching: false,
                paging: false,
                info: false,
                destroy: true,
                ajax: {
                    url: '/erm/skrining/tb',
                    data: {
                        no_rawat: no_rawat,
                        dataTable: true,
                    }
                },
                columns: [{
                        data: 'id',
                        title: '',
                        render: (data, type, row, meta) => {
                            return `<button type="button" class="btn btn-sm btn-danger" onclick="hapusSkriningTb(${data})"><i class="bi bi-trash"></i></button>
                            <button type="button" class="btn btn-sm btn-warning" onclick="editSkriningTb(${data})"><i class="bi bi-pencil"></i></button>
                            <a href="{{ url('skrining/tb/print/${data}') }}" target="_blank" class="btn btn-sm btn-success" ><i class="bi bi-printer"></i></a>`;
                        }
                    },
                    {
                        data: 'tgl_skrining',
                        title: 'Tanggal',
                        render: (data, type, row, meta) => {
                            return splitTanggal(data);
                        }
                    },

                    {
                        data: 'jam_skrining',
                        title: 'Jam',
                        render: (data, type, row, meta) => {
                            return data;
                        }
                    },
                    {
                        data: 'ket_kontak',
                        title: 'Kontak',
                        render: (data, type, row, meta) => {
                            return `( ${row.kontak} ) ${data}`;
                        }
                    },

                    {
                        data: 'ket_mantoux',
                        title: 'Test Mantoux',
                        render: (data, type, row, meta) => {
                            return `( ${row.mantoux} ) ${data}`;
                        }
                    },
                    {
                        data: 'ket_berat',
                        title: 'Penurunan BB',
                        render: (data, type, row, meta) => {
                            return `( ${row.berat} ) ${data}`;
                        }
                    },
                    {
                        data: 'ket_demam',
                        title: 'Demam',
                        render: (data, type, row, meta) => {
                            return `( ${row.demam} ) ${data}`;
                        }
                    },
                    {
                        data: 'ket_batul',
                        title: 'Batul Kronis',
                        render: (data, type, row, meta) => {
                            return `( ${row.batul} ) ${data}`;
                        }
                    },
                    {
                        data: 'ket_pembesaran',
                        title: 'Pembesaran Limfa, dll',
                        render: (data, type, row, meta) => {
                            return `( ${row.pembesaran} ) ${data}`;
                        }
                    },
                    {
                        data: 'ket_pembengkakan',
                        title: 'Pembengkakan Tulang, Dll.',
                        render: (data, type, row, meta) => {
                            return `( ${row.pembengkakan} ) ${data}`;
                        }
                    },
                    {
                        data: 'ket_thorax',
                        title: 'Thorax',
                        render: (data, type, row, meta) => {
                            return `( ${row.thorax} ) ${data}`;
                        }
                    },
                    {
                        data: 'total_skrining',
                        title: 'Nilai Total',
                        render: (data, type, row, meta) => {
                            return data;
                        }
                    },

                ],
            });
        }

        function hapusSkriningTb(id) {
            Swal.fire({
                title: 'Anda yakin ?',
                text: "Data yang dihapus tidak bisa dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yakin, hapus !',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`/erm/skrining/tb/delete`, {
                        id: id,
                        _token: "{{ csrf_token() }}",
                    }).done((response) => {
                        alertSuccessAjax().then(() => {
                            drawTbSkriningTb(response.no_rawat)
                            formSkriningTb.find('#id').remove();
                        })
                    })
                }
            })

        }

        function editSkriningTb(id) {
            $.get('/erm/skrining/tb', {
                id: id,
            }).done((response) => {
                formSkriningTb.append($('<input>', {
                    type: 'hidden',
                    value: id,
                    id: 'id',
                    name: 'id',
                }));

                $.each(response, (index, value) => {
                    const select = formSkriningTb.find(`select[name=${index}]`);
                    const input = formSkriningTb.find(`input[name=${index}]`);

                    if (select.length) {
                        isSelected = select.find('option[class="appended"]');
                        if (isSelected.length) {
                            isSelected.remove();
                        }
                        select.prepend($('<option>', {
                            'value': index,
                            text: value,
                            selected: true,
                            disabled: true,
                            class: 'appended',
                        }))
                    }

                    if (input.length) {
                        input.val(value);
                    }
                })
                instanceFormTab.show();
            })
        }
    </script>
@endpush
