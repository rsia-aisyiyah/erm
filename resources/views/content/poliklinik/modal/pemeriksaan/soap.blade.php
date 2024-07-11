<form action="" method="POST" id="formSoapPoli">
    <div class="row gy-2">
        <div class="col-lg-2 col-md-6 col-sm-12">
            <label for="no_rawat" class="form-label mb-0">No.Rawat</label>
            <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat" placeholder="" readonly>
            <input type="hidden" id="status_bayar" name="status_bayar">
        </div>
        <div class="col-lg-1 col-sm-12 mb-2">
            <label for="no_rkm_medis" class="form-label mb-0">No. RM</label>
            <input type="text" class="form-control form-control-sm" id="no_rkm_medis" name="no_rkm_medis" placeholder="" readonly>
        </div>
        <div class="col-lg-3 col-sm-12 mb-2">
            <label for="nm_pasien" class="form-label mb-0">Pasien</label>
            <input type="text" class="form-control form-control-sm" id="nm_pasien" name="nm_pasien" placeholder="" readonly>
        </div>
        <div class="col-lg-2 col-sm-12 mb-2">
            <label for="png_jawab" class="form-label mb-0">Pembiayaan</label>
            <input type="text" class="form-control form-control-sm" id="png_jawab" name="png_jawab" placeholder="" readonly>
        </div>
        <div class="col-lg-2 col-sm-12 mb-2">
            <label for="p_jawab" class="form-label mb-0">Penanggung Jawab</label>
            <input type="text" class="form-control form-control-sm" id="p_jawab" name="p_jawab" placeholder="" readonly>
        </div>
        <div class="col-lg-2 col-sm-12 mb-2">
            <label for="ket_pasien" class="form-label mb-0">Keterangan</label>
            <input type="text" class="form-control form-control-sm" id="ket_pasien" name="ket_pasien" placeholder="Keterangan">
        </div>
    </div>
    <div class="row gy-2 mt-1 p-2" style="background-color:whitesmoke;border-radius:10px">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="row gy-2 p-2">
                <div class="col-lg-12 col-md-12 col-sm-12 py-2">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="dokter">Dokter</label>
                            <select name="dokter" class="form-select2" id="dokter" data-dropdown-parent="#modalSoap" disabled></select>
                            <input type="hidden" id="tgl_perawatan" name="tgl_perawatan" value="{{ date('Y-m-d') }}" readonly>
                            <input type="hidden" id="jam_rawat" name="jam_rawat" value="{{ date('H:i:s') }}" readonly>
                            <input type="hidden" id="evaluasi" name="evaluasi" value="-" readonly>
                            <input type="hidden" id="no_resep" name="no_resep" value="" readonly>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="petugas">Asisten</label>
                            <select name="petugas" class="form-select2" id="petugas" data-dropdown-parent="#modalSoap"></select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="keluhan" class="form-label mb-0">Subjek</label>
                        <x-cppt.textarea id="keluhan" name="keluhan" />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="pemeriksaan" class="form-label mb-0">Objek</label>
                        <x-cppt.textarea id="pemeriksaan" name="pemeriksaan" />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row gy-2">
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <label for="suhu_tubuh" class="form-label mb-0">Suhu</label>
                                <x-cppt.input-group id="suhu_tubuh" name="suhu_tubuh" placeholder="Suhu" align="text-end" label="°C" style="border-right: none !important;" />
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <label for="tinggi" class="form-label mb-0">Tinggi</label>
                                <x-cppt.input-group id="tinggi" name="tinggi" placeholder="Tinggi" align="text-end" label="Cm" style="border-right: none !important;" />
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <label for="berat" class="form-label mb-0">Berat</label>
                                <x-cppt.input-group id="berat" name="berat" placeholder="Berat" align="text-end" label="Kg" style="border-right: none !important;" />
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="tensi" class="form-label mb-0">Tensi</label>
                                <x-cppt.input-group id="tensi" name="tensi" placeholder="Tensi" align="text-end" label="mmHg" style="border-right: none !important;" />
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="respirasi" class="form-label mb-0">Respirasi</label>
                                <x-cppt.input-group id="respirasi" name="respirasi" placeholder="Respirasi" align="text-end" label="x/mnt" style="border-right: none !important;" />

                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <label for="nadi" class="form-label mb-0">Nadi</label>
                                <x-cppt.input-group id="nadi" name="nadi" placeholder="Nadi" align="text-end" label="x/mnt" style="border-right: none !important;" />
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <label for="spo2" class="form-label mb-0">SpO²</label>
                                <x-cppt.input-group id="spo2" name="spo2" placeholder="SpO²" align="text-end" label="x/mnt" style="border-right: none !important;" />
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <label for="GCS" class="form-label mb-0">GCS</label>
                                <x-cppt.input-group id="gcs" name="gcs" placeholder="GCS" align="text-end" label="E,V,M" style="border-right: none !important;" />
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="kesadaran" class="form-label mb-0">Kesadaran</label>
                                <select class="form-select" name="kesadaran" id="kesadaran">
                                    <option value="Compos Mentis">Compos Mentis</option>
                                    <option value="Apatis">Apatis</option>
                                    <option value="Somnolence">Somnolence</option>
                                    <option value="Sopor">Sopor</option>
                                    <option value="Coma">Coma</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="alergi" class="form-label mb-0">Alergi</label>
                                <x-cppt.input id="alergi" name="alergi" />
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="penilaian" class="form-label mb-0">Asesmen</label>
                        <x-cppt.textarea id="penilaian" name="penilaian" />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="instruksi" class="form-label mb-0">Instruksi</label>
                        <x-cppt.textarea id="instruksi" name="instruksi" />
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">

            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="row gy-2">
                <div class="col-lg-12 col-md-12 col-sm-12 py-3">
                    <label for="rtl" class="form-label mb-0">Plan</label>
                    <x-cppt.textarea id="rtl" name="rtl" rows=7 />
                    <button class="btn btn-warning btn-sm mt-3" type="button" style="font-size: 12px" id="btnCatatanPasien" onclick="catatanPasien()"><i class="bi bi-pen"></i> Diagnosa & Catatan</button>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    @include('content.poliklinik.resep')
                </div>
            </div>
        </div>
    </div>
</form>
@push('script')
    <script>
        function cekAlergi(no_rkm_medis) {
            $.ajax({
                url: '/erm/registrasi/riwayat',
                data: {
                    no_rkm_medis: no_rkm_medis,
                    sortir: 'ASC',
                },
                success: function(response) {
                    alergi = '-'
                    $.map(response.reg_periksa, function(val) {
                        if (val.pemeriksaan_ralan.length) {
                            $.map(val.pemeriksaan_ralan, (pem) => {
                                if (pem.alergi != '-' || pem.alergi != '' || pem.alergi) {
                                    alergi = pem.alergi
                                }
                            })
                        }
                    })
                    $('#alergi').val(alergi)
                }
            })
            return false;
        }

        function createSoapRalan() {
            const data = getDataForm('#formSoapPoli', ['input', 'textarea', 'select'], ['nm_pasien', 'png_jawab', 'user', 'nama_user'])
            data['_token'] = '{{ csrf_token() }}';

            console.log('ROKE ===', role);
            if (role === 'dokter') {
                data['nip'] = data['dokter'];
            } else {
                data['nip'] = data['petugas'];
            }
            $.post(`${url}/pemeriksaan/simpan`, data).done((response) => {
                if (data.ket_pasien) {
                    $.post('/erm/pasien/keterangan', {
                        no_rkm_medis: data.no_rkm_medis,
                        ket_pasien: data.ket_pasien,
                        _token: "{{ csrf_token() }}"
                    })
                }
                alertSuccessAjax('Data SOAP berhasil disimpan').then(() => {
                    hitungPanggilan();
                    reloadTabelPoli();
                    $('#modalSoap').modal('hide');

                })
            }).fail((request) => {
                alertErrorAjax(request)
            })
        }


        function resep(no_rawat) {
            $.ajax({
                url: '/erm/registrasi/ambil',
                data: {
                    no_rawat: no_rawat,
                },
                method: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    $('.no_rawat').val(response.no_rawat);
                    $('.nm_pasien').val(response.no_rkm_medis + ' / ' + response.pasien.nm_pasien + ' / ' +
                        response.umurdaftar + ' ' + response.sttsumur)
                }
            })
            $('#modalResep').modal('show');
        }

        $('#formSoapPoli #dokter').select2({
            delay: 2,
            scrollAfterSelect: true,
            ajax: {
                url: '/erm/dokter/cari',
                dataType: 'JSON',

                data: (params) => {
                    const query = {
                        nm_dokter: params.term
                    }
                    return query
                },
                processResults: (data) => {
                    return {
                        results: data.map((item) => {
                            const items = {
                                id: item.kd_dokter,
                                text: item.nm_dokter
                            }
                            return items;
                        })
                    }
                },
            },
            cache: true,
        })
        $('#formSoapPoli #petugas').select2({
            delay: 2,
            scrollAfterSelect: true,
            ajax: {
                url: '/erm/petugas/cari',
                dataType: 'JSON',

                data: (params) => {
                    const query = {
                        q: params.term
                    }
                    return query
                },
                processResults: (data) => {
                    console.log(data);
                    return {
                        results: data.map((item) => {
                            const items = {
                                id: item.nip,
                                text: item.nama
                            }
                            return items;
                        })
                    }
                },
            },
            cache: true,
        })
    </script>
@endpush
