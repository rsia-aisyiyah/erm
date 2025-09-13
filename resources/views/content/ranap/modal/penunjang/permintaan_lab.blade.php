<h5 class="text-center">PERMINTAAN LAB</h5>
<form action="" id="formPermintaanLab">
    <div class="row gy-2 mb-3">
        <div class="col-md-2">
            <label for="noorder" class="form-label">No. Permintaan</label>
            <input type="text" class="form-control" name="noorder" id="noorder" />
        </div>
        <div class="col-md-2">
            @csrf
            <label for="no_rawat" class="form-label">No. Rawat</label>
            <input type="text" class="form-control" name="no_rawat" id="no_rawat" readonly />
            <input type="hidden" name="kd_dokter" id="kd_dokter" />
            <input type="hidden" name="status" id="status" />
        </div>
        <div class="col-md-4">
            <label for="diagnosa_klinis" class="form-label">Indikasi/Klinis</label>
            <input type="text" class="form-control" name="diagnosa_klinis" id="diagnosa_klinis" value="-" onfocus="removeZero(this)" onblur="cekKosong(this)" />
        </div>
        <div class="col-md-4">
            <label for="informasi_tambahan" class="form-label">Informasi Tambahan</label>
            <input type="text" class="form-control" name="informasi_tambahan" id="informasi_tambahan" value="-" onfocus="removeZero(this)" onblur="cekKosong(this)" />
        </div>
        <div class="col-md-12">
            <label for="pemeriksaan" class="form-label">Pemeriksaan Lab</label>
            <select name="pemeriksaan" id="pemeriksaan" class="form-select" multiple data-dropdown-parent="#formPermintaanLab" style="width:100%"></select>
        </div>
    </div>
    <table class="table table-responsive table-bordered" id="tablePermintaanLab">
        <thead>
            <tr class="table-secondary">
                <th width="2%"><input type="checkbox" name="p" id="p" /></th>
                <th>Pemeriksaan</th>
                <th>Satuan</th>
                <th>Nilai Rujukan</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <button type="button" class="btn btn-sm btn-primary" id="btnKirimPermintaan"> <i class="bi bi-send me-2"></i>Kirim Permintaan</button>
    <button type="button" class="btn btn-sm btn-success" id="btnDataPermintaan"> <i class="bi bi-eye me-2"></i>History Permintaan</button>
    <table class="table table-responsive table-bordered table-striped d-none mt-2" id="tableHasilPermintaan">
        <thead>
            <tr class="table-secondary">
                <th width="2%"></th>
                <th>No. Order</th>
                <th>Tanggal & Jam</th>
                <th>Informasi Tambahan</th>
                <th>Diagnosa Klinis</th>
                <th>Tgl & Jam Sample</th>
                <th>Tgl & Jam Hasil</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</form>
@push('script')
    <script>
        const formPermintaanLab = $('#formPermintaanLab')
        const selectJenisPeriksaLab = formPermintaanLab.find('#pemeriksaan')
        const tablePermintaanLab = $('#tablePermintaanLab');
        const tableHasilPermintaan = $('#tableHasilPermintaan');
        const formSoapPoli = $('#formSoapPoli');

        $('button[id="permintaan-laborat-tab"]').on('shown.bs.tab', (e) => {
            tablePermintaanLab.find('tbody').empty();
            tablePermintaanLab.find('input[type=checkbox]').prop('checked', false)
            tableHasilPermintaan.addClass('d-none');
            getNomorPermintaan();
            let no_rawat = '';
            if (formSoapPoli.length) {
                no_rawat = formSoapPoli.find('#nomor_rawat').val();
                kd_dokter = formSoapPoli.find('#kd_dokter').val();
                formPermintaanLab.find('#no_rawat').val(no_rawat)
                formPermintaanLab.find('#kd_dokter').val(kd_dokter)
                formPermintaanLab.find('#status').val('Ralan')
            } else {
                no_rawat = formPermintaanLab.find('#no_rawat').val()
            }
        })

        $('#btnDataPermintaan').on('click', () => {
            const no_rawat = formSoapPoli.length ? formSoapPoli.find('#nomor_rawat').val() : formPermintaanLab.find('#no_rawat').val();
            tableHasilPermintaan.toggleClass('d-none');
            tableHasilPermintaan.find('tbody').empty();
            getPermintaanLab(no_rawat);
        })

        function getPermintaanLab(no_rawat) {
            $.get('/erm/lab/permintaan', {
                no_rawat: no_rawat
            }).done((response) => {
                let contentPermintaan = '';
                if (Object.values(response).length) {
                    const permintaan = response.map((item, index) => {
                        return `<tr>
                            <td>${index+1}</td>
                            <td>${item.noorder}</td>
                            <td>${splitTanggal(item.tgl_permintaan)} ${item.jam_permintaan}</td>
                            <td>${item.informasi_tambahan}</td>
                            <td>${item.diagnosa_klinis}</td>
                            <td>${splitTanggal(item.tgl_sampel)} ${item.jam_sampel}</td>
                            <td>${splitTanggal(item.tgl_hasil)} ${item.jam_hasil}</td>
                            </tr>${getPermintaanPeriksa(item.pemeriksaan)}`
                    }).join('');
                    contentPermintaan = permintaan;
                } else {
                    contentPermintaan = `<tr><td colspan=7 class="text-center text-danger">Tidak ada history permintaan </td></tr>`
                }
                tableHasilPermintaan.find('tbody').append(contentPermintaan)
            })
        }

        function getPermintaanPeriksa(data) {
            return data.map((item) => {
                return `<tr>
                        <td></td>
                        <td colspan=6><strong>${item.jenis.nm_perawatan}</strong> : ${getDetailPermintaan(item.detail)}</td>
                    </tr>`
            }).join('');
        }

        function getDetailPermintaan(data) {
            return data.map((val, index) => {
                return `<span class="text-danger">${val.item.Pemeriksaan}</span>`
            }).join(' | ');
        }

        function getNomorPermintaan() {
            return $.get(`/erm/lab/permintaan/nomor`).done((response) => {
                formPermintaanLab.find('#noorder').val(response)
            })
        }

        selectJenisPeriksaLab.select2({
            tags: false,
            ajax: {
                url: '/erm/lab/jenis/get',
                dataType: 'JSON',

                data: (params) => {
                    const query = {
                        nm_perawatan: params.term
                    }
                    return query
                },
                processResults: (data) => {
                    return {
                        results: data.map((item) => {
                            const items = {
                                id: item.kd_jenis_prw,
                                text: `${item.nm_perawatan}`,
                            }
                            return items;
                        })
                    }
                }

            },
        });

        selectJenisPeriksaLab.on('select2:select', (e) => {
            const data = selectJenisPeriksaLab.val();
            $.get(`/erm/lab/jenis/template/get`, {
                kode: data
            }).done((response) => {
                let subPemeriksaan = '';
                let pemeriksaan = '';

                response.forEach((item) => {
                    pemeriksaan = response.map((item) => {

                        return `<tr>
                        <td><input type="checkbox" class="form-check checkJenisPemeriksaan" name="${item.kd_jenis_prw}" id="${item.kd_jenis_prw}" onclick="checkJenisPemeriksaan(this)"/></td>
                        <td colspan=3><b>${item.nm_perawatan}</b></td>
                        </tr>${setTemplatePemeriksaan(item.template)}`
                    });
                })
                tablePermintaanLab.find('tbody').empty().append(pemeriksaan).append(subPemeriksaan)
                if ($('#p').prop('checked')) {
                    $('input[type=checkbox]').each((index, e) => {
                        $(e).prop('checked', true);
                    })
                }
            })
        })

        selectJenisPeriksaLab.on('select2:unselect', (e) => {
            const data = selectJenisPeriksaLab.val();
            if (data.length) {
                $.get(`/erm/lab/jenis/template/get`, {
                    kode: data
                }).done((response) => {
                    let subPemeriksaan = '';
                    let pemeriksaan = '';

                    response.forEach((item) => {
                        pemeriksaan = response.map((item) => {
                            return `<tr>
                            <td><input type="checkbox" class="form-check checkJenisPemeriksaan" name="${item.kd_jenis_prw}" id="${item.kd_jenis_prw}" /></td>
                            <td colspan=3><b>${item.nm_perawatan}</b></td>
                            </tr>${setTemplatePemeriksaan(item.template)}`
                        });
                    })

                    tablePermintaanLab.find('tbody').empty().append(pemeriksaan).append(subPemeriksaan)
                    if ($('#p').prop('checked')) {
                        $('input[type=checkbox]').each((index, e) => {
                            $(e).prop('checked', true);
                        })
                    }
                })
            } else {
                tablePermintaanLab.find('tbody').empty()
            }
        })

        function setTemplatePemeriksaan(data) {
            return data.map((i) => {
                if (i.Pemeriksaan.length) {
                    return `<tr>
                        <td><input class="form-checkbox item" type="checkbox" name="${i.id_template}" id="${i.id_template}" data-parent="${i.kd_jenis_prw}" /></td>
                        <td><span class="ms-4">${i.Pemeriksaan}</span></td>
                        <td>${i.satuan}</td>
                        <td><b>LD</b> : ${i.nilai_rujukan_ld} ${i.satuan}, <b>LA</b> : ${i.nilai_rujukan_la} ${i.satuan}, <b>PD</b> : ${i.nilai_rujukan_pd} ${i.satuan}, <b>PA</b> : ${i.nilai_rujukan_pa} ${i.satuan} </td>
                    </tr>`

                }
            })
        }

        $('#p').on('click', (e) => {
            const isCheck = $(e.currentTarget).prop('checked')
            tablePermintaanLab.find('input[type=checkbox]').each((index, el) => {
                if (isCheck) {
                    $(el).prop('checked', true)
                } else {
                    $(el).prop('checked', false)
                }
            })
        })

        function checkJenisPemeriksaan(el) {
            const isCheck = $(el).prop('checked');
            tablePermintaanLab.find('input[type=checkbox]').each((index, e) => {
                if (e.dataset.parent == el.id) {
                    if (isCheck) {
                        $(e).prop('checked', true)
                    } else {
                        $(e).prop('checked', false)
                    }
                }
            })
        }

        $('#btnKirimPermintaan').on('click', () => {
            const data = getDataForm('#formPermintaanLab', ['input']);
            const dataPermintaan = [];
            const dataPemeriksaan = [];
            $('.item').each((index, e) => {
                if ($(e).prop('checked')) {
                    dataPermintaan.push({
                        noorder: data.noorder,
                        id_template: $(e).attr('id'),
                        kd_jenis_prw: $(e).attr('data-parent'),
                        stts_bayar: 'Belum',
                    })
                }
            });
            $('.checkJenisPemeriksaan').each((index, e) => {
                if ($(e).prop('checked')) {
                    dataPemeriksaan.push({
                        noorder: data.noorder,
                        kd_jenis_prw: $(e).attr('id'),
                        stts_bayar: 'Belum',
                    })
                }
            });


            if (dataPermintaan.length) {
                $.post('/erm/lab/permintaan', data).done((response) => {
                    $.post('/erm/lab/permintaan/pemeriksaan', {
                        _token: "{{ csrf_token() }}",
                        data: dataPemeriksaan,
                    }).done((response) => {
                        $.post('/erm/lab/permintaan/detail', {
                            _token: "{{ csrf_token() }}",
                            data: dataPermintaan,
                            noorder: data.noorder,
                        }).done((response) => {
                            alertSuccessAjax('Berhasil membuat permintaan lab')
                            tablePermintaanLab.find('tbody').empty();
                            tablePermintaanLab.find('input[type=checkbox]').prop('checked', false)
                            formPermintaanLab.trigger('reset');
                            formPermintaanLab.find('#no_rawat').val(data.no_rawat);
                            selectJenisPeriksaLab.val("").trigger('change');
                            getNomorPermintaan();
                        }).fail((error) => {
                            Swal.fire({
                                icon: 'error',
                                title: `Terjadi Kesalahan pada Permintaan Pemeriksaan`,
                                html: `${error.status} : ${error.statusText} <br/>${error.responseJSON.map((item) => item).join(', ')}`,
                            })
                        })
                    }).fail((error) => {
                        Swal.fire({
                            icon: 'error',
                            title: `Terjadi Kesalahan pada Detail Permintaan`,
                            html: `${error.status} : ${error.statusText} <br/>${error.responseJSON.map((item) => item).join(', ')}`,
                        })
                    })

                }).fail((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: `Terjadi Kesalahan pada Detail Permintaan`,
                        html: `${error.status} : ${error.statusText} <br/>${error.responseJSON.map((item) => item).join(', ')}`,
                    })
                })
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: `Ooppss...`,
                    html: `Anda belum memilih item pemeriksaan, Pilih salah satu atau lebih item pemeriksaan`,
                })
            }
        })
    </script>
@endpush
