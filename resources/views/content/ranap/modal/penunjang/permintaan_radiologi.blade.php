<h5 class="text-center mt-4">PERMINTAAN RADIOLOGI</h5>
<form action="" id="formPermintaanRadiologi">
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
            <label for="pemeriksaan_radiologi" class="form-label">Pemeriksaan Lab</label>
            <select name="pemeriksaan_radiologi" id="pemeriksaan_radiologi" class="form-select" multiple data-dropdown-parent="#formPermintaanRadiologi" style="width:100%"></select>
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-primary" id="btnKirimPermintaanRadiologi"> <i class="bi bi-send me-2"></i>Kirim Permintaan</button>
    <button type="button" class="btn btn-sm btn-success" id="btnDataPermintaanRadiologi"> <i class="bi bi-eye me-2"></i>History Permintaan</button>
    <table class="table table-responsive table-bordered table-striped d-none mt-2" id="tableHasilPermintaanRadiologi">
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
        const btnKirimPermintaanRadiologi = $('#btnKirimPermintaanRadiologi')
        const btnDataPermintaanRadiologi = $('#btnDataPermintaanRadiologi')
        const tableHasilPermintaanRadiologi = $('#tableHasilPermintaanRadiologi')
        const tablePermintaanRadiologi = $('#tablePermintaanRadiologi')
        const formPermintaanRadiologi = $('#formPermintaanRadiologi')

        const selectPermintaanRadiologi = formPermintaanRadiologi.find('#pemeriksaan_radiologi');

        $('button[id="permintaan-radiologi-tab"]').on('shown.bs.tab', (e) => {
            tablePermintaanRadiologi.find('tbody').empty();
            tableHasilPermintaan.addClass('d-none');
            getNoPermintaanRadiologi()
            let no_rawat = '';
            if (formSoapPoli.length) {
                no_rawat = formSoapPoli.find('#nomor_rawat').val();
                kd_dokter = formSoapPoli.find('#kd_dokter').val();
                formPermintaanRadiologi.find('#no_rawat').val(no_rawat)
                formPermintaanRadiologi.find('#kd_dokter').val(kd_dokter)
                formPermintaanRadiologi.find('#status').val('Ralan')
            } else {
                no_rawat = formPermintaanRadiologi.find('#no_rawat').val()
            }
        })

        function getNoPermintaanRadiologi() {
            return $.get(`/erm/radiologi/permintaan/nomor`).done((response) => {
                formPermintaanRadiologi.find('#noorder').val(response)
            })
        }

        selectPermintaanRadiologi.select2({
            tags: false,
            ajax: {
                url: '/erm/radiologi/jenis/get',
                dataType: 'JSON',
                data: (params) => {
                    const query = {
                        key: params.term
                    }
                    return query
                },
                processResults: (data) => {
                    return {
                        results: data.map((item) => {
                            const items = {
                                id: item.kd_jenis_prw,
                                text: `${item.kd_jenis_prw} - ${item.nm_perawatan}`,
                            }
                            return items;
                        })
                    }
                }

            },

        });

        $('#btnKirimPermintaanRadiologi').on('click', () => {
            const data = getDataForm('#formPermintaanRadiologi', ['input', 'select']);
            if (!data.pemeriksaan_radiologi.length) {
                return Swal.fire({
                    icon: 'warning',
                    title: `Ooppss...`,
                    html: `Anda belum memilih item pemeriksaan, Pilih salah satu atau lebih item pemeriksaan`,
                })
            }

            $.post(`/erm/radiologi/permintaan`, data).done((response) => {
                if (response === 'SUKSES') {
                    data.pemeriksaan_radiologi.forEach((item) => {
                        $.post(`/erm/radiologi/permintaan/periksa`, {
                            _token: "{{ csrf_token() }}",
                            kd_jenis_prw: item,
                            noorder: data.noorder
                        }).done((response) => {
                            alertSuccessAjax('Berhasil mengirim permintaan')
                            tableHasilPermintaanRadiologi.addClass('d-none');
                            formPermintaanRadiologi.trigger('reset');
                            formPermintaanRadiologi.find('#no_rawat').val(data.no_rawat);
                            selectPermintaanRadiologi.val("").trigger('change');
                            getNoPermintaanRadiologi()
                        }).fail((error) => {
                            alertErrorAjax(error);
                        })
                    })
                }
            }).fail((error) => {
                Swal.fire({
                    icon: 'error',
                    title: `Terjadi Kesalahan`,
                    html: `${error.status} : ${error.statusText} <br/>${error.responseJSON.map((item) => item).join(', ')}`,
                })
            })
        })

        $('#btnDataPermintaanRadiologi').on('click', (e) => {
            tableHasilPermintaanRadiologi.toggleClass('d-none');
            $.get(`/erm/radiologi/permintaan`, {
                no_rawat: formPermintaanRadiologi.find('#no_rawat').val()
            }).done((response) => {
                const permintaaan = response.map((item, index) => {
                    return `<tr>
                            <td>${index+1}</td>
                            <td>${item.noorder}</td>
                            <td>${splitTanggal(item.tgl_permintaan)} ${item.jam_permintaan}</td>
                            <td>${item.informasi_tambahan}</td>
                            <td>${item.diagnosa_klinis}</td>
                            <td>${splitTanggal(item.tgl_sampel)} ${item.jam_sampel}</td>
                            <td>${splitTanggal(item.tgl_hasil)} ${item.jam_hasil}</td>
                            </tr>
                        <tr>
                            <td></td>
                            <td colspan=6>${renderJenisPermintaanRadiologi(item.permintaan_pemeriksaan)}</td>
                        </tr>`
                })

                tableHasilPermintaanRadiologi.find('tbody').empty().append(permintaaan);
            })
        })

        function renderJenisPermintaanRadiologi(data) {
            return data.map((item, index) => {
                return `<span class="text-danger">${item.jns_pemeriksaan.nm_perawatan}</span>`;
            }).join(' | ')

        }
    </script>
@endpush
