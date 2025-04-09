@extends('index')

@push('style')
    <style>
        .col-form-label {
            font-size: 12px !important;
        }
    </style>
@endpush

@section('contents')
    <form id="formPasien">
        <div class="row gy-2">
            <div class="col-lg-6">
                <div class="row mb-1">
                    <label for="no_rkm_medis" class="col-sm-3 col-form-label">No. Rekam Medis</label>
                    <div class="col-sm-9">
                        <x-input class="form-control" id="no_rkm_medis" name="no_rkm_medis" />
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="nm_pasien" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <x-input class="form-control" id="nm_pasien" name="nm_pasien" />
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-4">
                        <select class="form-select" id="jk" name="jk">
                            <option value="-">-</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <label for="gol_darah" class="col-sm-2 col-form-label float-right">Golongan Darah</label>
                    <div class="col-sm-3">
                        <select class="form-select" id="gol_darah" name="gol_darah">
                            <option value="-">-</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="tmp_lahir" class="col-sm-3 col-form-label">Temp. Lahir</label>
                    <div class="col-sm-3">
                        <x-input class="form-control" id="tmp_lahir" name="tmp_lahir" />
                    </div>
                    <label for="tgl_lahir" class="col-sm-2 col-form-label">Tgl. Lahir</label>
                    <div class="col-sm-4">
                        <x-input-group class="input-group-sm">
                            <x-input class="form-control" id="tgl_lahir" name="tgl_lahir" autocomplete="off" />
                            <button class="btn btn-secondary" type="button" id="resetTglLahir" name="resetTglLahir"><i class="bi bi-arrow-clockwise"></i></button>
                        </x-input-group>
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="umur" class="col-sm-3 col-form-label">Umur</label>
                    <div class="col-sm-4">
                        <x-input-group class="input-group-sm">
                            <x-input class="form-control" name="umurTahun" id="umurTahun"></x-input>
                            <x-input-group-text>Th</x-input-group-text>
                            <x-input class="form-control" name="umurBulan" id="umurBulan"></x-input>
                            <x-input-group-text>Bln</x-input-group-text>
                            <x-input class="form-control" name="umurHari" id="umurHari"></x-input>
                            <x-input-group-text>Hr</x-input-group-text>
                        </x-input-group>
                    </div>
                    <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan</label>
                    <div class="col-sm-3">
                        <select name="pendidikan" id="pendidikan" class="form-select">
                            <option value="-">-</option>
                            <option value="TS">TS</option>
                            <option value="TK">TK</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="SMA">SLTA/SEDERAJAT</option>
                            <option value="D1">D1</option>
                            <option value="D2">D2</option>
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="nm_ibu" class="col-sm-3 col-form-label">Nama Ibu</label>
                    <div class="col-sm-9">
                        <x-input class="form-control" id="nm_ibu" name="nm_ibu" />
                    </div>
                </div>

                <fieldset class="row mb-1">
                    <legend class="col-form-label col-sm-3 pt-0">Penanggung Jawab</legend>
                    <div class="col-sm-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                            <label class="form-check-label" for="gridRadios1">
                                Ayah
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                            <label class="form-check-label" for="gridRadios2">
                                Suami
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                            <label class="form-check-label" for="gridRadios1">
                                Ibu
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                            <label class="form-check-label" for="gridRadios2">
                                Saudara
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                            <label class="form-check-label" for="gridRadios1">
                                Istri
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                            <label class="form-check-label" for="gridRadios2">
                                Anak
                            </label>
                        </div>
                    </div>
                </fieldset>
                <div class="row mb-1">
                    <label for="p_jawab" class="col-sm-3 col-form-label">Nama Png. Jawab</label>
                    <div class="col-sm-9">
                        <x-input class="form-control" id="p_jawab" name="p_jawab" />
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="pekerjaan_pj" class="col-sm-3 col-form-label">Nama Png. Jawab</label>
                    <div class="col-sm-9">
                        <x-input class="form-control" id="p_jawab" name="p_jawab" />
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="suku_bangsa" class="col-sm-3 col-form-label">Suku Bangsa</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="suku_bangsa" name="suku_bangsa">
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="bahasa_pasien" class="col-sm-3 col-form-label">Bahasa Pasien</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="bahasa_pasien" name="bahasa_pasien">
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="cacat_fisik" class="col-sm-3 col-form-label">Cacat Fisik</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="cacat_fisik" name="cacat_fisik">
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row mb-1">
                    <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="agama" name="agama">
                            <option value="-">-</option>
                            <option value="ISLAM">ISLAM</option>
                            <option value="KATOLIK">KATOLIK</option>
                            <option value="KRISTEN">KRISTEN</option>
                            <option value="HINDU">HINDU</option>
                            <option value="BUDHA">BUDHA</option>
                            <option value="KONG HU CHU">KONG HU CHU</option>
                        </select>
                    </div>
                    <label for="stts_nikah" class="col-sm-2 col-form-label float-right">Stts. Menikah</label>
                    <div class="col-sm-4">

                        <select class="form-select" id="stts_nikah" name="stts_nikah">
                            <option value="-">-</option>
                            <option value="MENIKAH">MENIKAH</option>
                            <option value="BELUM MENIKAH">BELUM MENIKAH</option>
                            <option value="JANDA">JANDA</option>
                            <option value="DUDHA">DUDHA</option>
                            <option value="JOMBLO">JOMBLO</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="kd_pj" class="col-sm-2 col-form-label">Askes/Asuransi</label>
                    <div class="col-sm-10">
                        <select name="kd_pj" id="kd_pj" class="form-select">
                            <option value="{{ $pasien->kd_pj }}">{{ $pasien->penjab->png_jawab }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="no_peserta" class="col-sm-2 col-form-label">No. Peserta</label>
                    <div class="col-sm-4">
                        <x-input class="form-control" id="no_peserta" name="no_peserta" />
                    </div>
                    <label for="email" class="col-sm-2 col-form-label float-right">Email</label>
                    <div class="col-sm-4">
                        <x-input class="form-control" id="email" name="email" />
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="no_tlp" class="col-sm-2 col-form-label">No. Telp</label>
                    <div class="col-sm-4">
                        <x-input class="form-control" id="no_tlp" name="no_tlp" />
                    </div>
                    <label for="tgl_daftar" class="col-sm-2 col-form-label float-right">Tgl. Daftar</label>
                    <div class="col-sm-4">
                        <x-input class="form-control" id="tgl_daftar" name="tgl_daftar" />
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                    <div class="col-sm-4">
                        <x-input class="form-control" id="pekerjaan" name="pekerjaan" />
                    </div>
                    <label for="no_ktp" class="col-sm-2 col-form-label float-right">No. KTP</label>
                    <div class="col-sm-4">
                        <x-input class="form-control" id="no_ktp" name="no_ktp" />
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <x-input class="form-control" id="alamat" name="alamat" />
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="kd_kel" class="col-sm-2 col-form-label">Kelurahan</label>
                    <div class="col-sm-4">
                        <select class="form-select" id="kd_kel" name="kd_kel">
                            <option value="{{ $pasien->kd_kel }}">{{ $pasien->kel->nm_kel }}</option>
                        </select>
                    </div>
                    <label for="kd_kec" class="col-sm-2 col-form-label">Kecamatan</label>
                    <div class="col-sm-4">
                        <select class="form-select" id="kd_kec" name="kd_kec">
                            <option value="{{ $pasien->kd_kec }}">{{ $pasien->kec->nm_kec }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="kd_kab" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                    <div class="col-sm-4">
                        <select class="form-select" id="kd_kab" name="kd_kab">
                            <option value="{{ $pasien->kd_kab }}">{{ $pasien->kab->nm_kab }}</option>
                        </select>
                    </div>
                    <label for="kd_prop" class="col-sm-2 col-form-label">Propinsi</label>
                    <div class="col-sm-4">
                        <select class="form-select" id="kd_prop" name="kd_prop">
                            <option value="{{ $pasien->kd_prop }}">{{ $pasien->prop->nm_prop }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat PJ</label>
                    <div class="col-sm-10">
                        <x-input-group class="input-group-sm">
                            <x-input class="form-control" id="alamatpj" name="alamatpj" value="{{ $pasien->alamatpj }}" />
                            <x-input-group-text>
                                <input class="form-check-input" type="checkbox" id="checkAlamatPj" name="checkAlamatPj" value="Car">
                            </x-input-group-text>
                        </x-input-group>
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="kelurahanpj" class="col-sm-2 col-form-label">Kelurahan</label>
                    <div class="col-sm-4">
                        <select class="form-select" id="kelurahanpj" name="kelurahanpj">
                            <option value="{{ $pasien->kelurahanpj }}">{{ $pasien->kelurahanpj }}</option>
                        </select>
                    </div>
                    <label for="kecamatanpj" class="col-sm-2 col-form-label">Kecamatan</label>
                    <div class="col-sm-4">
                        <select class="form-select" id="kecamatanpj" name="kecamatanpj">
                            <option value="{{ $pasien->kecamatanpj }}">{{ $pasien->kecamatanpj }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="kabupatenpj" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                    <div class="col-sm-4">
                        <select class="form-select" id="kabupatenpj" name="kabupatenpj">
                            <option value="{{ $pasien->kabupatenpj }}">{{ $pasien->kabupatenpj }}</option>
                        </select>
                    </div>
                    <label for="propinsipj" class="col-sm-2 col-form-label">Propinsi</label>
                    <div class="col-sm-4">
                        <select class="form-select" id="propinsipj" name="propinsipj">
                            <option value="{{ $pasien->propinsipj }}">{{ $pasien->propinsipj }}</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <label for="instansi" class="col-sm-2 col-form-label">Instansi</label>
                    <div class="col-sm-4">
                        <select class="form-select" id="instansi" name="instansi"></select>
                    </div>
                    <label for="nip" class="col-sm-2 col-form-label float-right">NIP/NRP</label>
                    <div class="col-sm-4">
                        <x-input class="form-control" id="nip" name="nip" />
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>
@endsection

@push('script')
    <script>
        const formPasien = $('#formPasien')
        const inputTglLahir = formPasien.find(`input[name=tgl_lahir]`);
        const inputTglDaftar = formPasien.find(`input[name=tgl_daftar]`);
        const inputAlamatPj = formPasien.find(`input[name=alamatpj]`);
        let tglLahir = "{{ $pasien->tgl_lahir }}"
        const selectGolDarah = formPasien.find(`select[name=gol_darah]`);
        const selectJk = formPasien.find(`select[name=jk]`);
        const selectPendidikan = formPasien.find(`select[name=pendidikan]`);
        const selectSukuBangsa = formPasien.find(`select[name=suku_bangsa]`);
        const selectBahasa = formPasien.find(`select[name=bahasa_pasien]`);
        const selectCacat = formPasien.find(`select[name=cacat_fisik]`);
        const selectAgama = formPasien.find(`select[name=agama]`);
        const selectSttsNikah = formPasien.find(`select[name=stts_nikah]`);
        const selectPenjab = formPasien.find(`select[name=kd_pj]`);
        const selectKel = formPasien.find(`select[name=kd_kel]`);
        const selectKec = formPasien.find(`select[name=kd_kec]`);
        const selectKab = formPasien.find(`select[name=kd_kab]`);
        const selectProp = formPasien.find(`select[name=kd_prop]`);
        const selectKelPj = formPasien.find(`select[name=kelurahanpj]`);
        const selectKecPj = formPasien.find(`select[name=kecamatanpj]`);
        const selectKabPj = formPasien.find(`select[name=kabupatenpj]`);
        const selectPropPj = formPasien.find(`select[name=propinsipj]`);
        const selectInstansi = formPasien.find(`select[name=instansi]`);
        const checkAlamatPj = formPasien.find(`input[name=checkAlamatPj]`);
        selectSukuBangsa.select2({
            placeholder: 'Pilih Suku Bangsa',
            ajax: {
                url: `${url}/pasien/suku-bangsa`,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        nama: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nama_suku_bangsa,
                                id: item.id
                            }
                        })
                    };
                }
            },
            width: '100%',


        })
        selectBahasa.select2({
            placeholder: 'Pilih Bahasa Pasien',
            ajax: {
                url: `${url}/pasien/bahasa`,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        nama: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nama_bahasa,
                                id: item.id
                            }
                        })
                    };
                }
            },
            width: '100%',


        })
        selectCacat.select2({
            placeholder: 'Pilih Bahasa Pasien',
            ajax: {
                url: `${url}/pasien/cacat`,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        nama: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nama_cacat,
                                id: item.id
                            }
                        })
                    };
                }
            },
            width: '100%',


        })
        selectPenjab.select2({
            placeholder: 'Pilih Askes/Asuransi',
            ajax: {
                url: `${url}/pasien/penjab`,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        nama: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.png_jawab,
                                id: item.kd_pj
                            }
                        })
                    };
                }
            },
            width: '100%',


        })
        selectKel.select2({
            placeholder: 'Pilih Kelurahan Pasien',
            ajax: {
                url: `${url}/pasien/kelurahan`,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        nama: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nm_kel,
                                id: item.kd_kel
                            }
                        })
                    };
                }
            },
            width: '100%',


        })
        selectKec.select2({
            placeholder: 'Pilih Kecamatan Pasien',
            ajax: {
                url: `${url}/pasien/kecamatan`,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        nama: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nm_kec,
                                id: item.kd_kec
                            }
                        })
                    };
                }
            },
            width: '100%',


        })

        selectKab.select2({
            placeholder: 'Pilih Kabupaten Pasien',
            ajax: {
                url: `${url}/pasien/kabupaten`,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        nama: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nm_kab,
                                id: item.kd_kab
                            }
                        })
                    };
                }
            },
            width: '100%',


        })
        selectProp.select2({
            placeholder: 'Pilih Propinsi Pasien',
            ajax: {
                url: `${url}/pasien/propinsi`,
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        nama: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nm_prop,
                                id: item.kd_prop
                            }
                        })
                    };
                }
            },
            width: '100%',


        })

        $(document).ready(function() {
            const no_rkm_medis = '{{ $pasien->no_rkm_medis }}';
            $.get(`${url}/pasien/ambil/${no_rkm_medis}`, function(data) {
                setFormData(data);
                inputTglLahir.datepicker('setDate', splitTanggal(data.tgl_lahir));
                inputTglDaftar.datepicker('setDate', splitTanggal(data.tgl_daftar));
                selectGolDarah.select2();
                selectJk.select2();
                selectPendidikan.select2();
                selectAgama.select2();
                selectSttsNikah.select2();

                const optionSukuBangsa = new Option(data.suku_bangsa.nama_suku_bangsa, data.suku_bangsa.id, true, true)
                selectSukuBangsa.append(optionSukuBangsa).trigger('change');
                const optionBahasa = new Option(data.bahasa.nama_bahasa, data.bahasa.id, true, true)
                selectBahasa.append(optionBahasa).trigger('change');
                const optionCacat = new Option(data.cacat.nama_cacat, data.cacat.id, true, true)
                selectCacat.append(optionCacat).trigger('change');

                console.log(data);


                const usiaTahun = hitungUmur(data.tgl_lahir).split(' ')[0];
                const usiaBulan = hitungUmur(data.tgl_lahir).split(' ')[2];
                const usiaHari = hitungUmur(data.tgl_lahir).split(' ')[4];

                $('#umurTahun').val(usiaTahun)
                $('#umurBulan').val(usiaBulan)
                $('#umurHari').val(usiaHari)

            });

        });

        inputTglLahir.datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            orientation: 'bottom',
        })

        inputTglDaftar.datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            orientation: 'bottom',
        })

        $('#resetTglLahir').on('click', () => {
            inputTglLahir.val(splitTanggal(tglLahir))
        })

        checkAlamatPj.on('change', () => {
            if (checkAlamatPj.is(':checked')) {
                inputAlamatPj.prop('disabled', true);
                const alamat = formPasien.find('input[name=alamat]').val();
                inputAlamatPj.val(alamat);
            } else {
                inputAlamatPj.prop('disabled', false);
            }

        })
    </script>
@endpush
