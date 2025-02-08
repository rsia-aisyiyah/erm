{{-- <ul class="nav nav-underline" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="formSbar" data-bs-toggle="tab" data-bs-target="#formSbar-pane" type="button" role="tab" aria-controls="formSbar-pane" aria-selected="true">Home</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="tableSbar" data-bs-toggle="tab" data-bs-target="#tableSbar-pane" type="button" role="tab" aria-controls="tableSbar-pane" aria-selected="false">Profile</button>
    </li>
</ul>
<div class="tab-content p-2" id="tabContentSbar">
    <div class="tab-pane fade show active" id="formSbar-pane" role="tabpanel" aria-labelledby="formSbar" tabindex="0">
        @include('content.ranap.modal.cppt._form_sbar')
    </div>
    <div class="tab-pane fade" id="tableSbar-pane" role="tabpanel" aria-labelledby="tableSbar" tabindex="0">
        @include('content.ranap.modal.cppt._table_sbar')
    </div>
</div> --}}

@include('content.ranap.modal.cppt._form_sbar')

@push('script')
    <script>
        const btnSimpanSbar = $('#btnSimpanSbar')
        const btnTabSbar = $('#tabSbar')
        const formSbarRanap = $('#formSbarRanap')
        const dokterSbar = formSbarRanap.find('select[name=kd_dokter]')
        const tabSbar = '';
        const btnUbahSbar = $('#btnUbahSbar')
        const btnBatalSbar = $('#btnBatalSbar')


        btnBatalSbar.on('click', () => {
            formSbarRanap.trigger('reset');
            btnTabSbar.trigger('click');
        })

        btnUbahSbar.on('click', () => {
            const data = getDataForm('#formSbarRanap', ['input', 'textarea', 'select']);
            data['no_rawat'] = formInfoPasien.find('input[name=no_rawat]').val();
            data['jam_rawat'] = data['tgl_perawatan'].split(' ')[1];
            data['tgl_perawatan'] = splitTanggal(data['tgl_perawatan'].split(' ')[0]);
            data['sumber'] = 'SBAR';
            // data['jam_rawat'] = .val();
            $.post(`${url}/ranap/sbar/update`, data).done((response) => {
                alertSuccessAjax('Data SBAR berhasil diubah')
                alertSuccessAjax('Data SBAR berhasil disimpan')
                formSbarRanap.trigger('reset')
                tbSoapRanap(data['no_rawat']);
                getInstance.show()
                btnSimpanSbar.removeClass('d-none');
                btnUbahSbar.addClass('d-none');
                btnBatalSbar.addClass('d-none');
            })
        })

        btnSimpanSbar.on('click', () => {
            const data = getDataForm('#formSbarRanap', ['input', 'textarea', 'select'])
            data['nip'] = data['petugas'];
            data['no_rawat'] = formInfoPasien.find('input[name=no_rawat]').val();
            data['sumber'] = 'SBAR';
            data['jam_rawat'] = data['tgl_perawatan'].split(' ')[1];
            data['tgl_perawatan'] = splitTanggal(data['tgl_perawatan'].split(' ')[0]);
            $.post(`${url}/soap/simpan`, data).done((response) => {
                alertSuccessAjax('Data SBAR berhasil disimpan')
                formSbarRanap.trigger('reset')
                tbSoapRanap(data['no_rawat']);
                getInstance.show()
                btnSimpanSbar.removeClass('d-none');
                btnUbahSbar.addClass('d-none');
                btnBatalSbar.addClass('d-none');
            }).fail((error) => {
                alertErrorAjax(error)
            })

        })

        btnTabSbar.on('click', () => {
            btnSimpanSbar.removeClass('d-none');
            btnUbahSbar.addClass('d-none');
            btnBatalSbar.addClass('d-none');
            const kd_dokter = formInfoPasien.find('input[name=kd_dokter_dpjp]').val()
            const nm_dokter = formInfoPasien.find('input[name=dokter_dpjp]').val()
            formSbarRanap.find('input[name=tgl_perawatan]').val(moment().format('DD-MM-YYYY HH:mm:ss'))
            formSbarRanap.find('input[name=petugas]').val('{{ session()->get('pegawai')->nik }}')
            formSbarRanap.find('input[name=nm_petugas]').val('{{ session()->get('pegawai')->nama }}')
            formSbarRanap.find('input[name=dokter]').val(kd_dokter)
            formSbarRanap.find('input[name=nm_dokter]').val(nm_dokter)
            const option = new Option(nm_dokter, kd_dokter, true, true)
            dokterSbar.append(option).trigger('change')
        })

        dokterSbar.select2({
            dropdownParent: formSbarRanap,
            allowClear: false,
            delay: 0,
            scrollAfterSelect: false,
            initSelection: function(element, callback) {},
            ajax: {
                url: 'dokter/cari',
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
    </script>
@endpush
