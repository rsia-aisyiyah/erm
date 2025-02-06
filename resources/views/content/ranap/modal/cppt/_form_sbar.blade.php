<form action="" class="" id="formSbarRanap">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <div class="row gy-2">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-lg-2 col-md-12">
                    <label for="tgl_pemeriksaan">Tgl & Jam Pemeriksaan</label>
                    <x-input-group class="input-group-sm">
                        <x-input-group-text>
                            <i class="bi bi-calendar3"></i>
                        </x-input-group-text>
                        <x-input id="tgl_perawatan" name="tgl_perawatan" class="datetimepicker" />
                    </x-input-group>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <label for="petugas">Petugas</label>
                    <x-input-group class="input-group-sm">
                        <x-input-group-text>
                            <i class="bi bi-person-fill"></i>
                        </x-input-group-text>
                        <x-input name="petugas" id="petugas" readonly />
                        <x-input name="nm_petugas" id="nm_petugas" class="w-25" readonly />
                    </x-input-group>
                </div>
                <div class="col-lg-6 col-md-12">
                    <label for="dokter">Dokter</label>
                    <select class="search form-select" placeholder="Dokter" name="kd_dokter" id="kd_dokter" style="width: 100%"></select>
                </div>
            </div>
        </div>
        <div class="row gy-2">

            <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="subjek">Situation</label>
                <x-textarea cols="30" rows="8" name="keluhan" id="keluhan">-</x-textarea>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="penilaian">Assesment</label>
                <x-textarea cols="30" rows="8" name="penilaian" id="penilaian">-</x-textarea>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="background">Background</label>
                <x-textarea cols="30" rows="8" name="pemeriksaan" id="pemeriksaan">-</x-textarea>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="rtl">Recomendation</label>
                <x-textarea cols="30" rows="8" name="rtl" id="rtl">-</x-textarea>
            </div>
        </div>

        <div class="row justify-content-end my-2">
            <div class="col-6">
                <button type="button" class="btn btn-sm btn-primary" id="btnSimpanSbar"><i class="bi bi-save me-1"></i> Simpan</button>
                <button type="button" class="btn btn-sm btn-warning d-none" id="btnUbahSbar"><i class="bi bi-pencil me-1"></i> Ubah</button>
                <button type="button" class="btn btn-sm btn-danger d-none" id="btnBatalSbar"><i class="bi bi-x me-1"></i> Batal</button>
                <x-input type="hidden" name="tgl_perawatan_awal" id="tgl_perawatan_awal" value="" />
                <x-input type="hidden" name="jam_rawat_awal" id="jam_rawat_awal" value="" />
            </div>
        </div>
    </div>
</form>

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
            $.post(`${url}/ranap/sbar`, data).done((response) => {
                alertSuccessAjax('Data SBAR berhasil diubah')
                tbSoapRanap(data['no_rawat']);
                getInstance.show()
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
                $('#tbSoap').DataTable().destroy();
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
