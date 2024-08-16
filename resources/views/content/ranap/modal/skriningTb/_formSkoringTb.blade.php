<form action="" id="formSkoringTb">
    <div class="row gy-2">
        <div class="col-lg-4"><label for="" class="form-label">Kontak TB</label></div>
        <div class="col-lg-6">
            <select name="ket_kontak" id="ket_kontak" class="form-select" onchange="setNilaiSkrining(this)" data-target="kontak">
                <option value="-">-</option>
                <option value="0">Tidak Jelas</option>
                <option value="2">Laporan Keluarha, BTA(-)/BTA Tidak jelas / Tidak Tahu</option>
                <option value="4">BTA (+)</option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="kontak" id="kontak" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-4"><label for="ket_mantoux" class="form-label">Uji Tuberkolin (Test Mantoux) Negatif</label></div>
        <div class="col-lg-6">
            <select name="ket_mantoux" id="ket_mantoux" class="form-select" onchange="setNilaiSkrining(this)" data-target="mantoux">
                <option value="-">-</option>
                <option value="0">Negatif</option>
                <option value="3">Positif (>= 10mm atau >= 5mm pada imonukompomais)</option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="mantoux" id="mantoux" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-4"><label for="ket_berat" class="form-label">Berat badan / Keadaan gizi</label></div>
        <div class="col-lg-6">
            <select name="ket_berat" id="ket_berat" class="form-select" onchange="setNilaiSkrining(this)" data-target="berat">
                <option value="0">-</option>
                <option value="1">BB/TB < 90% atau BB /u < 80% </option>
                <option value="2">Klinis Gizi buruk atau BB/TB < 70& atau BB/U < 60% </option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="berat" id="berat" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-4"><label for="ket_demam" class="form-label">Demam yang tidak diketahui penyebabnya</label></div>
        <div class="col-lg-6">
            <select name="ket_demam" id="ket_demam" class="form-select" onchange="setNilaiSkrining(this)" data-target="demam">
                <option value="0">-</option>
                <option value="1"> >= 2 Minggu </option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="demam" id="demam" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-4"><label for="ket_batul" class="form-label">Batul Kronik</label></div>
        <div class="col-lg-6">
            <select name="ket_batul" id="ket_batul" class="form-select" onchange="setNilaiSkrining(this)" data-target="batul">
                <option value="0">-</option>
                <option value="1"> >= 3 Minggu </option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="batul" id="batul" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-4"><label for="ket_pembesaran" class="form-label">Pembesaran kelenjar limfe kolli, aksila, inguinal</label></div>
        <div class="col-lg-6">
            <select name="ket_pembesaran" id="ket_pembesaran" class="form-select" onchange="setNilaiSkrining(this)" data-target="pembesaran">
                <option value="0">-</option>
                <option value="1"> >= 1cm, lebih dari 1 KGB, tidak nyeri</option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="pembesaran" id="pembesaran" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-4"><label for="ket_pembengkakan" class="form-label">Pembengkakak tulang/sendi panggul, lutut, falang </label></div>
        <div class="col-lg-6">
            <select name="ket_pembengkakan" id="ket_pembengkakan" class="form-select" onchange="setNilaiSkrining(this)" data-target="pembengkakan">
                <option value="0">-</option>
                <option value="1"> Ada pembengkakan</option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="pembengkakan" id="pembengkakan" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-4"><label for="ket_thorax" class="form-label">Thorax Normal/Kelainan tidak jelas </label></div>
        <div class="col-lg-6">
            <select name="ket_thorax" id="ket_thorax" class="form-select" onchange="setNilaiSkrining(this)" data-target="thorax">
                <option value="-">-</option>
                <option value="0">Normal/Kelainan tidak jelas</option>
                <option value="1"> Gambaran sugestif (mendukung) TB</option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="thorax" id="thorax" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-10">
            <label for="" class="">Total Nilai Skrining</label>
        </div>
        <div class="d-flex col-lg-2 ms-auto">
            <input type="text"name="total_skrining" id="total_skrining" class="form-control" value="0" readonly />
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="id" id="id" />
        </div>
        <div class="d-flex col-lg-2 ms-auto">
            <button type="button" class="btn btn-primary btn-sm w-100" style="font-size: 12px" onclick="simpanSkoringTb()">
                <i class="bi bi-save">
                </i> Simpan
            </button>
        </div>
    </div>
</form>

@push('script')
    <script>
        const formSkoringTb = $('#formSkoringTb');
        const formPasienSkoringTb = $('#formPasienSkoringTb');
        // const instanceFormTab = bootstrap.Tab.getInstance(formTab);
        // const instanceTableTab = new bootstrap.Tab(tableTab);
        const tabFormSkoringTb = document.getElementById('formSkoringTb-tab')
        const tabTableSkoringTb = document.getElementById('SkoringTb-tab')
        const instanceformSkoringTb = new bootstrap.Tab(tabFormSkoringTb);
        const instanceTableSkoringTb = new bootstrap.Tab(tabTableSkoringTb);

        function drawTbSkoringTb(no_rawat) {
            const table = $('#tbSkoringTb').DataTable({
                scrollX: true,
                searching: false,
                paging: false,
                info: false,
                destroy: true,
                ajax: {
                    url: '/erm/skoring/tb',
                    data: {
                        no_rawat: no_rawat,
                        dataTable: true,
                    }
                },
                columns: [{
                        data: 'id',
                        title: '',
                        render: (data, type, row, meta) => {
                            return `<button type="button" class="btn btn-sm btn-danger" onclick="hapusSkoringTb(${data})"><i class="bi bi-trash"></i></button>
                            <button type="button" class="btn btn-sm btn-warning" onclick="editSkoringTb(${data})"><i class="bi bi-pencil"></i></button>
                            <a href="{{ url('skoring/tb/print/${data}') }}" target="_blank" class="btn btn-sm btn-success" ><i class="bi bi-printer"></i></a>`;
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

        function skoringTb(no_rawat) {
            modalSkoringTb.modal('show')
            drawTbSkoringTb(no_rawat)
            drawTbSkriningTb(no_rawat)
            getRegPeriksa(no_rawat).done((response) => {
                const kamar = response.kamar_inap.map((item) => {
                    const valKamar = item.stts_pulang != 'Pindah Kamar' ? item.kamar.bangsal.nm_bangsal : '-';
                    return [valKamar, item.diagnosa_awal];
                }).join(',');
                formPasienSkoringTb.find('#no_rawat').val(no_rawat);
                formPasienSkoringTb.find('#nm_pasien').val(`${response.no_rkm_medis} - ${response.pasien.nm_pasien} / ${response.umurdaftar} ${response.sttsumur}`);
                formPasienSkoringTb.find('#dokter').val(response.dokter.nm_dokter);
                formPasienSkoringTb.find('#kd_dokter').val(response.kd_dokter);
                formPasienSkoringTb.find('#keluarga').val(`${response.p_jawab} (${response.hubunganpj})`);
                formPasienSkoringTb.find('#kamar').val(kamar.split(',')[0]);
                formPasienSkoringTb.find('#diagnosa').val(kamar.split(',')[1]);
            })
        }

        function simpanSkoringTb() {
            const data = getDataForm('#formSkoringTb', ['input', 'select']);
            formSkoringTb.find(`select`).each((index, element) => {
                const text = formSkoringTb.find(`select[name=${element.id}]`);
                const valueText = text.find('option:selected').text();
                const name = text.attr('name');
                data[name] = valueText;
            })
            data['no_rawat'] = formPasienSkoringTb.find('#no_rawat').val();
            data['kd_dokter'] = formPasienSkoringTb.find('#kd_dokter').val();
            $.post('/erm/skoring/tb', data).done((response) => {
                alertSuccessAjax().then(() => {
                    drawTbSkoringTb(data['no_rawat'])
                    formSkoringTb.find('input[name=id]').remove();
                    formSkoringTb.trigger('reset')
                    instanceTableSkoringTb.show()
                })
            })

        }

        function setNilaiSkrining(e) {
            const target = $(e).data('target')
            const val = $(e).find(':selected').val();
            const value = val === '-' ? 0 : val;

            const text = formSkoringTb.find(`input[type=text]`)
            let total = 0;
            formSkoringTb.find(`input[name=${target}]`).val(value);
            formSkoringTb.find(`input[type=text]`).each((index, element) => {
                if (element.id != 'total_skrining') {
                    total += parseInt(element.value);
                }

            });
            formSkoringTb.find('input[name=total_skrining]').val(total);
        }



        function hapusSkoringTb(id) {
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
                    $.post(`/erm/skoring/tb/delete`, {
                        id: id,
                        _token: "{{ csrf_token() }}",
                    }).done((response) => {
                        alertSuccessAjax().then(() => {
                            drawTbSkoringTb(response.no_rawat)
                            formSkoringTb.find('#id').remove();
                        })
                    })
                }
            })

        }

        function editSkoringTb(id) {
            $.get('/erm/skoring/tb', {
                id: id,
            }).done((response) => {
                formSkoringTb.append($('<input>', {
                    type: 'hidden',
                    value: id,
                    id: 'id',
                    name: 'id',
                }));

                $.each(response, (index, value) => {
                    const select = formSkoringTb.find(`select[name=${index}]`);
                    const input = formSkoringTb.find(`input[name=${index}]`);

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
                instanceformSkoringTb.show();
            })
        }
    </script>
@endpush
