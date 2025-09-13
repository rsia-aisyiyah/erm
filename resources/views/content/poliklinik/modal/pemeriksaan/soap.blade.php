<form action="" method="POST" id="formSoapPoli">
    <div class="row border p-2 mb-3 bg-light">

        <div class="col-lg-2 col-sm-12 mb-2">
            <label for="no_rawat">No. Rawat</label>
            <x-input id="nomor_rawat" name="no_rawat" readonly />

        </div>
        <div class="col-lg-3 col-sm-12 mb-2">
            <label for="Pasien">Pasien</label>
            <x-input-group>
                <x-input id="no_rm" name="no_rkm_medis" class="" readonly />
                <x-input id="nama_pasien" name="nm_pasien" class="w-50" readonly />
            </x-input-group>
        </div>

        <div class="col-lg-2 col-sm-12 mb-2">
            <label for="png_jawab">Pembiayaan</label>
            <x-input id="png_jawab" name="png_jawab" readonly />

        </div>
        <div class="col-lg-2 col-sm-12 mb-2">
            <label for="p_jawab">Keluarga</label>
            <x-input id="p_jawab" name="p_jawab" readonly />
        </div>
        <div class="col-lg-2 col-sm-12 mb-2">
            <label for="ket_pasien">Keterangan</label>
            <x-input id="ket_pasien" name="ket_pasien" readonly />
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2 col-sm-12">
            <input type="hidden" id="jam_rawat" name="jam_rawat">
            <input type="hidden" id="tgl_perawatan" name="tgl_perawatan">
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="lingkar_perut" name="lingkar_perut" value="-">
            <input type="hidden" id="evaluasi" name="evaluasi" value="-">
            <label for="nip" class="form-label"> Dokter:</label>
            <div class="d-flex gap-2">
                <x-input type="hidden" id="role" name="role" value="{{ session()->get('role') }}" />
                <select id="kd_dokter" name="kd_dokter" data-dropdown-parent="#formSoapPoli" style="width: 100%"></select>
            </div>
        </div>
        <div class="col-lg-2 col-sm-12">
            <label for="nip" class="form-label"> Perawat/Bidan:</label><br>
            <div class="d-flex gap-2">
                <select id="nip" name="nip" data-dropdown-parent="#formSoapPoli" style="width: 100%"></select>
            </div>
        </div>
    </div>


    <div class="row gy-1">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="row gy-1">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="subjek" class="form-label">Subjek:</label>
                    <x-textarea name="keluhan" id="subjek" rows="4" onfocus="removeZero(this)" onblur="cekKosong(this)" />
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="pemeriksaan" class="form-label">Objek:</label>
                    <x-textarea name="pemeriksaan" id="objek" rows="4" onfocus="removeZero(this)" onblur="cekKosong(this)" />
                </div>
                <div class="col-12">
                    <div class="row gy-1">
                        <div class="col-lg-2 col-sm-12">
                            <label for="suhu" class="form-label">Suhu (<sup>0</sup>C) :</label>
                            <x-input id="suhu" name="suhu_tubuh" />
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <label for="tinggi" class="form-label">Tinggi (cm) :</label>
                            <x-input id="tinggi" name="tinggi" />
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <label for="berat" class="form-label">Berat (Kg) :</label>
                            <x-input id="berat" name="berat" />
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <label for="tensi" class="form-label">Tensi (mmHG) :</label>
                            <x-input id="tensi" name="tensi" />
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <label for="respirasi" class="form-label">Respirasi (/mnt) :</label>
                            <x-input id="respirasi" name="respirasi" />
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <label for="nadi" class="form-label">Nadi (/mnt) :</label>
                            <x-input id="nadi" name="nadi" />
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <label for="gcs" class="form-label">GCS (E,V,M) :</label>
                            <x-input id="gcs" name="gcs" />
                        </div>
                        <div class="col-lg-2 col-sm-12">
                            <label for="spo2" class="form-label">SpO<sub>2</sub> (%) :</label>
                            <x-input id="spo2" name="spo2" />
                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <label for="kesadaran" class="form-label">Kesadaran :</label>
                            <select class="form-select" name="kesadaran" id="kesadaran">
                                <option value="Compos Mentis" selected>Compos Mentis</option>
                                <option value="Apatis">Apatis</option>
                                <option value="Somnolence">Somnolence</option>
                                <option value="Sopor">Sopor</option>
                                <option value="Coma">Coma</option>
                            </select>

                        </div>
                        <div class="col-lg-3 col-sm-12">
                            <label for="alergi" class="form-label">Alergi :</label>
                            <x-input id="alergi" name="alergi" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="penilaian" class="form-label">Penilaian :</label>
                <x-textarea name="penilaian" id="asesmen" rows="4" onfocus="removeZero(this)" onblur="cekKosong(this)" />
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="instruksi" class="form-label">Instruksi :</label>
                <x-textarea name="instruksi" id="instruksi" rows="4" onfocus="removeZero(this)" onblur="cekKosong(this)" />
            </div>

        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <label for="rtl">Plan</label>
            <x-textarea rows="4" name="rtl" id="rtl"></x-textarea>
            <button class="btn btn-warning btn-sm mt-2" type="button" style="font-size: 12px" onclick="catatanPasien()"><i class="bi bi-pen"></i> Diagnosa & Catatan</button>

            @include('content.poliklinik.modal.pemeriksaan.resepRalan')

        </div>
    </div>
</form>
@push('script')
    <script>
        const modalSoapRalan = $('#modalSoapRalan');
        const formSoapPoli = $('#formSoapPoli');
        const bodyResepObatUmum = $('#tb-resep').find('tbody')

        function showSoapRalan(no_rawat) {
            formSoapPoli.find('input[name="no_rawat"]').val(no_rawat);
            formSoapPoli.find('textarea').text('-');
            btnTambahObatUmum.removeClass('d-none');

            if (role == 'dokter') {
                panggil(textRawat(no_rawat));
            }

            getRegPeriksa(no_rawat).done((response) => {
                // Swal.fire({
                //     icon: 'question',
                //     title: 'Lihat Icare ?',
                //     text: 'Tampilkan riwayat perawatan dengan ICARE',
                //     showCancelButton: true,
                //     confirmButtonColor: '#3085d6',
                //     cancelButtonColor: '#d33',
                //     confirmButtonText: 'Ya',
                //     cancelButtonText: 'Tidak'
                // }).then((result) => {
                //     if (result.isConfirmed) {
                //         riwayatIcare(response.pasien.no_peserta, response.dokter.mapping_dokter.kd_dokter_bpjs)
                //     }
                // })
                // riwayatIcare(response.pasien.no_peserta, response.dokter.mapping_dokter.kd_dokter_bpjs)
                if (response.pasien.ket_pasien) {
                    formSoapPoli.find('input[name=ket_pasien]').val(response.pasien.ket_pasien.keterangan)
                }
                const dokter = new Option(response.dokter.nm_dokter, response.kd_dokter, true, true)
                formSoapPoli.find('select[name=kd_dokter]').append(dokter).trigger('change').prop('disabled', true)
                const pegawai = new Option("{{ session()->get('pegawai')->nama }}", "{{ session()->get('pegawai')->nik }}", true, true)
                formSoapPoli.find('select[name=nip]').append(pegawai).trigger('change').trigger('change')

                formSoapPoli.find('input[name=no_rkm_medis]').val(response.no_rkm_medis)
                formSoapPoli.find('input[name=nm_pasien]').val(`${response.pasien.nm_pasien} (${response.pasien.jk}) / ${hitungUmur(response.pasien.tgl_lahir)}`)
                formSoapPoli.find('input[name=p_jawab]').val(response.p_jawab)
                formSoapPoli.find('input[name=png_jawab]').val(`${response.penjab.png_jawab}`)
                formSoapPoli.find('[name=nip]').attr('disabled', false)

                // set identitas asmed rajal anak
                formAsmedAnak.find('input[name=no_rawat]').val(no_rawat);
                formAsmedAnak.find('input[name=pasien]').val(`${response.no_rkm_medis} - ${response.pasien.nm_pasien}`);
                formAsmedAnak.find('input[name=tgl_lahir]').val(`${formatTanggal(response.pasien.tgl_lahir)} / ${response.umurdaftar} ${response.sttsumur}`);
                formAsmedAnak.find('input[name=kd_dokter]').val(`${response.kd_dokter}`);
                formAsmedAnak.find('input[name=kd_dokter]').val(`${response.kd_dokter}`);
                formAsmedAnak.find('input[name=nm_dokter]').val(`${response.dokter.nm_dokter}`);

                //set identitas asmed ranap rajal anak
                formAsmedRanapAnak.find('input[name=no_rawat]').val(no_rawat);
                formAsmedRanapAnak.find('input[name=pasien]').val(`${response.no_rkm_medis} - ${response.pasien.nm_pasien}`);
                formAsmedRanapAnak.find('input[name=tgl_lahir]').val(`${formatTanggal(response.pasien.tgl_lahir)} / ${response.umurdaftar} ${response.sttsumur}`);
                formAsmedRanapAnak.find('input[name=kd_dokter]').val(`${response.kd_dokter}`);
                formAsmedRanapAnak.find('input[name=kd_dokter]').val(`${response.kd_dokter}`);
                formAsmedRanapAnak.find('input[name=nm_dokter]').val(`${response.dokter.nm_dokter}`);

                // set identitas asmed rajal kandungan
                formAsmedRajalKandungan.find('input[name=no_rawat]').val(no_rawat);
                formAsmedRajalKandungan.find('input[name=pasien]').val(`${response.no_rkm_medis} - ${response.pasien.nm_pasien}`);
                formAsmedRajalKandungan.find('input[name=tgl_lahir]').val(`${formatTanggal(response.pasien.tgl_lahir)} / ${response.umurdaftar} ${response.sttsumur}`);
                formAsmedRajalKandungan.find('input[name=kd_dokter]').val(`${response.kd_dokter}`);
                formAsmedRajalKandungan.find('input[name=kd_dokter]').val(`${response.kd_dokter}`);
                formAsmedRajalKandungan.find('input[name=nm_dokter]').val(`${response.dokter.nm_dokter}`);
                //    set identitas asmed ranap kandungan
                formAsmedRanapKandungan.find('input[name=no_rawat]').val(no_rawat);
                formAsmedRanapKandungan.find('input[name=pasien]').val(`${response.no_rkm_medis} - ${response.pasien.nm_pasien}`);
                formAsmedRanapKandungan.find('input[name=tgl_lahir]').val(`${formatTanggal(response.pasien.tgl_lahir)} / ${response.umurdaftar} ${response.sttsumur}`);
                formAsmedRanapKandungan.find('input[name=kd_dokter]').val(`${response.kd_dokter}`);
                formAsmedRanapKandungan.find('input[name=kd_dokter]').val(`${response.kd_dokter}`);
                formAsmedRanapKandungan.find('input[name=nm_dokter]').val(`${response.dokter.nm_dokter}`);

                riwayatResep(response.no_rkm_medis)
                setPemeriksaanPoli(no_rawat, response.kd_poli)
                getResepObat(no_rawat)
                setTabMenuAsesmen(no_rawat, response.dokter.kd_sps);

            })
            modalSoapRalan.modal('show');
        }

        function setTabMenuAsesmen(no_rawat, kd_sps) {
            if (kd_sps == 'S0003') {
                $('#li-asmed-ana').css('display', 'inline');
                $('#li-asmed-ranap-ana').css('display', 'inline');
                $('#li-data-anak').css('display', 'inline');
                $('#li-asmed-obg').css('display', 'none');
                $('#li-asmed-ranap-obg').css('display', 'none');
                $('#li-data-obg').css('display', 'none');
                $('.btn-asmed-ranap').attr('onclick', 'simpanAsmedRanapAnak()')
                $('.btn-asmed').attr('onclick', 'simpanAsmedRajalAnak()')
                form = '.form-asmed-anak';
                setAsmedAnak(no_rawat);
                setAsmedRanapAnak(no_rawat)

            } else if (kd_sps == 'S0001') {
                $('#li-asmed-ana').css('display', 'none');
                $('#li-asmed-ranap-ana').css('display', 'none');
                $('#li-data-anak').css('display', 'none');
                $('#li-asmed-obg').css('display', 'inline');
                $('#li-asmed-ranap-obg').css('display', 'inline');
                $('#li-data-obg').css('display', 'inline');
                $('.btn-asmed-ranap').attr('onclick', 'simpanAsmedRanapKandungan()')
                $('.btn-asmed').attr('onclick', 'simpanAsmedRajalKandungan()')
                form = '.form-asmed-kandungan';

                setAsmedRajalKandungan(no_rawat);
                setAsmedRanapKandungan(no_rawat)
            }
        }

        modalSoapRalan.on('hidden.bs.modal', function() {
            $('.no_resep').val('')
            $('.noResepText').text('')
            $('.labelTglResep').text(``);

            formSoapPoli.find('input').val('-');
            formSoapPoli.find('textarea').text('-');

            bodyResepObatUmum.empty();
            bodyResepRacikan.empty();

        })

        function setPemeriksaanPoli(no_rawat, kd_poli) {
            $.get(`/erm/pemeriksaan`, {
                no_rawat: no_rawat,
                kd_poli: kd_poli
            }).done((response) => {

                if (response.length == 0) {
                    formSoapPoli.find('input[name=jam_rawat]').val("{{ date('H:i:s') }}");
                    formSoapPoli.find('input[name=tgl_perawatan]').val("{{ date('Y-m-d') }}");
                    return false;
                }

                const filterByDokter = response.filter((pemeriksaan) => {
                    return pemeriksaan.pegawai.dokter
                })
                const filterByPerawat = response.filter((pemeriksaan) => {
                    return !pemeriksaan.pegawai.dokter
                })
                pemeriksaanByDokter = Object.assign({}, ...filterByDokter)
                pemeriksaanByPerawat = Object.assign({}, ...filterByPerawat)

                const perawat = new Option(pemeriksaanByPerawat.pegawai.nama, pemeriksaanByDokter.nip ? pemeriksaanByDokter.nip : pemeriksaanByPerawat.nip, true, true)
                formSoapPoli.find('select[name=nip]').append(perawat).trigger('change').prop('disabled', true)

                const keluhan = pemeriksaanByDokter.keluhan ? pemeriksaanByDokter.keluhan : pemeriksaanByPerawat.keluhan
                formSoapPoli.find('textarea[name=keluhan]').text(keluhan.length ? keluhan : '-')

                console.log(keluhan, pemeriksaanByPerawat);


                const pemeriksaan = pemeriksaanByDokter.pemeriksaan ? pemeriksaanByDokter.pemeriksaan : pemeriksaanByPerawat.pemeriksaan
                formSoapPoli.find('textarea[name=pemeriksaan]').text(pemeriksaan.length ? pemeriksaan : '-')
                const penilaian = pemeriksaanByDokter.penilaian ? pemeriksaanByDokter.penilaian : pemeriksaanByPerawat.penilaian
                formSoapPoli.find('textarea[name=penilaian]').text(penilaian.length ? penilaian : '-')
                const rtl = pemeriksaanByDokter.rtl ? pemeriksaanByDokter.rtl : pemeriksaanByPerawat.rtl
                formSoapPoli.find('textarea[name=rtl]').text(rtl.length ? rtl : '-')
                const instruksi = pemeriksaanByDokter.instruksi ? pemeriksaanByDokter.instruksi : pemeriksaanByPerawat.instruksi
                formSoapPoli.find('textarea[name=instruksi]').text(instruksi.length ? instruksi : '-')
                const suhu_tubuh = pemeriksaanByPerawat.suhu_tubuh
                formSoapPoli.find('input[name=suhu_tubuh]').val(suhu_tubuh)
                const nadi = pemeriksaanByPerawat.nadi
                formSoapPoli.find('input[name=nadi]').val(nadi)
                const tinggi = pemeriksaanByPerawat.tinggi
                formSoapPoli.find('input[name=tinggi]').val(tinggi)
                const berat = pemeriksaanByPerawat.berat
                formSoapPoli.find('input[name=berat]').val(berat)
                const respirasi = pemeriksaanByPerawat.respirasi
                formSoapPoli.find('input[name=respirasi]').val(respirasi)
                const tensi = pemeriksaanByPerawat.tensi
                formSoapPoli.find('input[name=tensi]').val(tensi)
                const spo2 = pemeriksaanByPerawat.spo2
                formSoapPoli.find('input[name=spo2]').val(spo2)
                const o2 = pemeriksaanByPerawat.o2
                formSoapPoli.find('input[name=o2]').val(o2)
                const gcs = pemeriksaanByPerawat.gcs
                formSoapPoli.find('input[name=gcs]').val(gcs)
                const kesadaran = pemeriksaanByPerawat.kesadaran
                formSoapPoli.find('select[name=kesadaran]').val(kesadaran)
                const alergi = pemeriksaanByPerawat.alergi
                formSoapPoli.find('input[name=alergi]').val(alergi)
                const tgl_perawatan = pemeriksaanByDokter.tgl_perawatan ? pemeriksaanByDokter.tgl_perawatan : pemeriksaanByPerawat.tgl_perawatan
                formSoapPoli.find('input[name=tgl_perawatan]').val(tgl_perawatan).trigger('change')
                const jam_rawat = pemeriksaanByDokter.jam_rawat ? pemeriksaanByDokter.jam_rawat : pemeriksaanByPerawat.jam_rawat
                formSoapPoli.find('input[name=jam_rawat]').val(jam_rawat).trigger('change')
            })
        }

        formSoapPoli.find('select[name=nip]').select2({
            ajax: {
                url: '/erm/petugas/cari',
                dataType: 'json',
                processResults: (data) => {
                    return {
                        results: data.map((pegawai) => {
                            return {
                                id: pegawai.nip,
                                text: pegawai.nama
                            }
                        })
                    }
                }
            }
        })
        formSoapPoli.find('select[name=kd_dokter]').select2({
            ajax: {
                url: '/erm/dokter/cari',
                dataType: 'json',
                processResults: (data) => {
                    return {
                        results: data.map((dokter) => {
                            console.log('DATA _DOKTER,', dokter);

                            return {
                                id: dokter.kd_dokter,
                                text: dokter.nm_dokter
                            }
                        })
                    }
                }
            }
        })


        function simpanSoapRalan() {
            const data = getDataForm('#formSoapPoli', ['input', 'textarea', 'select'], ['nm_pasien', 'png_jawab', 'user', 'nama_user'])
            data['_token'] = "{{ csrf_token() }}";
            $.post('/erm/pemeriksaan/simpan', data).done((response) => {
                if (data.ket_pasien) {
                    $.post('/erm/pasien/keterangan', {
                        no_rkm_medis: data.no_rkm_medis,
                        ket_pasien: data.ket_pasien,
                        _token: "{{ csrf_token() }}"
                    })
                }

                swalToast('Data SOAP berhasil disimpan', 'success')
                hitungPanggilan();
                reloadTabelPoli();

                formSoapPoli.find('input').val('-')
                formSoapPoli.find('textarea').text('-')

                $('#modalSoapRalan').modal('hide');
            }).fail((request) => {
                Swal.fire({
                    icon: 'error',
                    title: `${request.status} : ${request.statusText ? request.statusText : 'Terjadi Kesalahan'}`,
                    html: request.responseJSON?.message ?? 'Data SOAP gagal disimpan',
                })

            })
        }
    </script>
@endpush
