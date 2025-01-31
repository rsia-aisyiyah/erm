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
                        <x-input id="tgl_pemeriksaan" name="tgl_pemeriksaan" class="datetimepicker" />
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
                    <x-input-group class="input-group-sm">
                        <x-input-group-text>
                            <i class="bi bi-person-fill"></i>
                        </x-input-group-text>
                        <x-input name="dokter" id="dokter" readonly />
                        <x-input name="nm_dokter" id="nm_dokter" class="w-25" readonly />
                    </x-input-group>
                </div>
            </div>
        </div>
        <div class="row gy-2">

            <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="subjek">Subjek</label>
                <x-textarea cols="30" rows="8" name="keluhan" id="keluhan">-</x-textarea>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="background">Background</label>
                <x-textarea cols="30" rows="8" name="pemeriksaan" id="pemeriksaan">-</x-textarea>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="penilaian">Assesment</label>
                <x-textarea cols="30" rows="8" name="penilaian" id="penilaian">-</x-textarea>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <label for="rtl">Recomendation</label>
                <x-textarea cols="30" rows="8" name="rtl" id="rtl">-</x-textarea>
            </div>
        </div>

        <div class="row justify-content-end my-2">
            <div class="col-6">
                <button type="button" class="btn btn-sm btn-primary" id="btnSimpanSbar"><i class="bi bi-save me-2"></i> Simpan</button>
            </div>
        </div>
    </div>
</form>

@push('script')
    <script>
        const btnSimpanSbar = $('#btnSimpanSbar')
        const tabSbar = $('#tabSbar')
        const formSbarRanap = $('#formSbarRanap')

        btnSimpanSbar.on('click', () => {
            const data = getDataForm('#formSbarRanap', ['input', 'textarea'])
            data['nip'] = data['petugas'];
            data['no_rawat'] = formInfoPasien.find('input[name=no_rawat]').val();
            data['sumber'] = 'SBAR';
            $.post(`${url}/soap/simpan`, data).done((response) => {
                alertSuccessAjax('Data SBAR berhasil disimpan')
                formSbarRanap.trigger('reset')
                $('#tbSoap').DataTable().destroy();
                tbSoapRanap(data['no_rawat']);
                getInstance.show()
            }).fail((error) => {
                alertErrorAjax(error)
            })

        })

        tabSbar.on('click', () => {
            const kd_dokter = formInfoPasien.find('input[name=kd_dokter_dpjp]').val()
            const nm_dokter = formInfoPasien.find('input[name=dokter_dpjp]').val()
            formSbarRanap.find('input[name=tgl_pemeriksaan]').val(moment().format('DD-MM-YYYY HH:mm:ss'))
            formSbarRanap.find('input[name=petugas]').val('{{ session()->get('pegawai')->nik }}')
            formSbarRanap.find('input[name=nm_petugas]').val('{{ session()->get('pegawai')->nama }}')
            formSbarRanap.find('input[name=dokter]').val(kd_dokter)
            formSbarRanap.find('input[name=nm_dokter]').val(nm_dokter)
        })
    </script>
@endpush
