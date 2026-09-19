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
            <label for="Pasien">Tgl. Lahir & Umur</label>
            <x-input-group>
                <x-input id="tgl_lahir" name="tgl_lahir" class="" readonly />
                <x-input id="umurdaftar" name="umurdaftar" class="w-25" readonly />
            </x-input-group>
        </div>

        <div class="col-lg-3 col-sm-12 mb-2">
            <label for="png_jawab">Pembiayaan</label>
            <x-input-group class="input-group-sm">
                <x-input id="png_jawab" name="png_jawab" readonly />
                <x-input id="no_peserta" name="no_peserta" readonly />
                <button type="button" class="btn btn-primary" id="btnInfoPeserta">
                    <i class="bi bi-eye"></i>
                </button>
            </x-input-group>

        </div>
        <div class="col-lg-2 col-sm-12 mb-2">
            <label for="p_jawab">Keluarga</label>
            <x-input id="p_jawab" name="p_jawab" readonly />
        </div>
        <div class="col-lg-2 col-sm-12 mb-2">
            <label for="alamat">Alamat</label>
            <x-input id="alamat" name="alamat" readonly />
        </div>
        <div class="col-lg-2 col-sm-12 mb-2">
            <label for="ket_pasien">Keterangan</label>
            <x-input id="ket_pasien" name="ket_pasien" />
        </div>
        <div class="col-lg-3 col-sm-12 mb-2 d-flex align-items-end">
            <button type="button" class="btn btn-sm btn-outline-primary fw-bold w-100 shadow-sm" id="btnToggleSideRiwayat" onclick="toggleSideRiwayatSoap()" style="height: 31px;">
                <i class="bi bi-clock-history me-1"></i> Riwayat Kunjungan Pasien
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2 col-sm-12">
            <input type="hidden" id="jam_rawat" name="jam_rawat">
            <input type="hidden" id="tgl_perawatan" name="tgl_perawatan">
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="lingkar_perut" name="lingkar_perut" value="-">
            <input type="hidden" id="evaluasi" name="evaluasi" value="-">
            <input type="hidden" name="no_diagnosa" class="no_diagnosa" value="1">

            <label for="nip" class="form-label"> Dokter:</label>
            <div class="d-flex gap-2">
                <x-input type="hidden" id="role" name="role" value="{{ session()->get('role') }}" />
                <select id="kd_dokter" name="kd_dokter" data-dropdown-parent="#formSoapPoli"
                    style="width: 100%"></select>
            </div>
        </div>
        <div class="col-lg-2 col-sm-12">
            <label for="nip_pegawai" class="form-label"> Perawat/Bidan:</label><br>
            <div class="d-flex gap-2">
                <select id="nip_pegawai" name="nip" data-dropdown-parent="#formSoapPoli" style="width: 100%"
                    class="selectNip"></select>
            </div>
        </div>
    </div>


    <div class="row gy-1">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="row gy-1">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="subjek" class="form-label">Subjek:</label>
                    <x-textarea name="keluhan" id="subjek" rows="4" onfocus="removeZero(this)"
                        onblur="cekKosong(this)" />
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="pemeriksaan" class="form-label">Objek:</label>
                    <x-textarea name="pemeriksaan" id="objek" rows="4" onfocus="removeZero(this)"
                        onblur="cekKosong(this)" />
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
                            <label for="respirasi" class="form-label">Resp. (/mnt) :</label>
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

                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="penilaian" class="form-label">Asesmen :</label>
                <x-textarea name="penilaian" id="asesmen" rows="4" onfocus="removeZero(this)"
                    onblur="cekKosong(this)" />
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <label for="instruksi" class="form-label">Instruksi :</label>
                <x-textarea name="instruksi" id="instruksi" rows="4" onfocus="removeZero(this)"
                    onblur="cekKosong(this)" />
            </div>

        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <label for="alergi" class="form-label">Alergi :</label>
            <x-input id="alergi" name="alergi" />
            <label for="rtl">Plan</label>
            <x-textarea rows="4" name="rtl" id="rtl"></x-textarea>
            <button class="btn btn-warning btn-sm mt-2" type="button" style="font-size: 12px"
                onclick="catatanPasien()"><i class="bi bi-pen"></i> Diagnosa & Catatan</button>

            @include('content.poliklinik.modal.pemeriksaan.resepRalan')

        </div>
    </div>
</form>
@push('script')
    <script>
        const modalSoapRalan = $('#modalSoapRalan');
        const formSoapPoli = $('#formSoapPoli');


        function showSoapRalan(no_rawat) {
            formSoapPoli.find('input[name="no_rawat"]').val(no_rawat);
            const formInfoPasienResep = $('#formInfoPasienResep')

            const nip = formSoapPoli.find('select[name="nip"]')

            console.log('BIP ===', nip);



            btnTambahObatUmum.removeClass('d-none');

            if (role == 'dokter') {
                panggil(textRawat(no_rawat));
            }

            modalSoapRalan.modal('show');
            btnTabRiwayatPemeriksaan.trigger('click')

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
                setRiwayatPemeriksaan(response.no_rkm_medis)
                $('#btnInfoPeserta').attr('onclick', `getPesertaDetail('${response.pasien.no_peserta}')`)

                if (response.pasien.ket_pasien) {
                    formSoapPoli.find('input[name=ket_pasien]').val(response.pasien.ket_pasien.keterangan)
                }
                const dokter = new Option(response.dokter.nm_dokter, response.kd_dokter, true, true)
                formSoapPoli.find('select[name=kd_dokter]').append(dokter).trigger('change').prop('disabled', true)
                const pegawai = new Option("{{ session()->get('pegawai')->nama }}", "{{ session()->get('pegawai')->nik }}", true, true)
                formSoapPoli.find('select[name=nip]').append(pegawai).trigger('change')

                formSoapPoli.find('input[name=no_rkm_medis]').val(response.no_rkm_medis)
                formSoapPoli.find('input[name=no_peserta]').val(response.pasien.no_peserta)
                formSoapPoli.find('input[name=nm_pasien]').val(`${response.pasien.nm_pasien} (${response.pasien.jk})`)
                formSoapPoli.find('input[name=tgl_lahir]').val(`${formatTanggal(response.pasien.tgl_lahir)}`)
                const objUmur = hitungUmurDaftar(response.pasien.tgl_lahir, response.tgl_registrasi)
                const umurdaftar = `${objUmur.tahun} Th ${objUmur.bulan} Bln ${objUmur.hari} Hr`

                formSoapPoli.find('input[name=umurdaftar]').val(`${umurdaftar}`)
                formSoapPoli.find('input[name=alamat]').val(response.pasien.alamat)
                formSoapPoli.find('input[name=png_jawab]').val(`${response.penjab.png_jawab}`)
                formSoapPoli.find('input[name=p_jawab]').val(`${response.p_jawab} (${response.hubunganpj})`)



                formInfoPasienResep.find('input[name=no_rawat]').val(no_rawat);
                formInfoPasienResep.find('input[name=no_rkm_medis]').val(response.no_rkm_medis);
                formInfoPasienResep.find('input[name=kd_dokter]').val(response.kd_dokter);
                formInfoPasienResep.find('input[name=status_lanjut]').val(response.status_lanjut?.toLowerCase());
                formInfoPasienResep.find('input[name=kelasHarga]').val('ralan');

                riwayatResep(response.no_rkm_medis)

                if (response.penjab?.png_jawab?.includes('BPJS')) {
                    formSoapPoli.find('input[name=no_peserta]').removeClass('text-bg-danger').addClass('text-bg-success')
                    formSoapPoli.find('input[name=png_jawab]').removeClass('text-bg-danger').addClass('text-bg-success')
                    $('#btnInfoPeserta').removeClass('btn-danger').addClass('btn-success')
                } else {
                    formSoapPoli.find('input[name=no_peserta]').addClass('text-bg-danger').removeClass('text-bg-success')
                    formSoapPoli.find('input[name=png_jawab]').addClass('text-bg-danger').removeClass('text-bg-success')
                    $('#btnInfoPeserta').addClass('btn-danger').removeClass('btn-success')
                }

                formSoapPoli.find('input[name=role]').val("{{ session()->get('role') }}")
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


                setPemeriksaanPoli(no_rawat, response.kd_poli)
                getResepObat(no_rawat)
                setTabMenuAsesmen(no_rawat, response.dokter.kd_sps);

                $('button[data-bs-target="#tab-soap-pane"]').tab('show')

            })


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
            } else {
                $('#li-asmed-ana').css('display', 'none');
                $('#li-asmed-ranap-ana').css('display', 'none');
                $('#li-data-anak').css('display', 'none');
                $('#li-asmed-obg').css('display', 'none');
                $('#li-asmed-ranap-obg').css('display', 'none');
                $('#li-data-obg').css('display', 'none');
            }
        }

        modalSoapRalan.on('hidden.bs.modal', function() {
            $('.no_resep').val('')
            $('.noResepText').text('')
            $('.labelTglResep').text(``);

            $('.tambah_racik').removeClass('d-none')
            $('.tambah_umum').removeClass('d-none')


            formSoapPoli.find('input').val('-');
            formSoapPoli.find('textarea').val('-');

            bodyResepObatUmum.empty();
            bodyResepRacikan.empty();

            navTabRiwayatPemeriksaan.empty();
            $('#formAskepAwalObgyn').trigger('reset');
            reloadTabelPoli();

        })



        function setPemeriksaanPoli(no_rawat, kd_poli) {
            $.get(`/erm/pemeriksaan`, {
                no_rawat: no_rawat,
                kd_poli: kd_poli
            }).done((response) => {

                if (response.length == 0) {
                    formSoapPoli.find('input[name=jam_rawat]').val("{{ date('H:i:s') }}");
                    formSoapPoli.find('input[name=tgl_perawatan]').val("{{ date('Y-m-d') }}");
                    formSoapPoli.find('textarea').val("-");
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

                const perawat = new Option(pemeriksaanByPerawat.pegawai?.nama, pemeriksaanByDokter.nip ? pemeriksaanByDokter.nip : pemeriksaanByPerawat?.nip, true, true)
                formSoapPoli.find('select[name=nip]').append(perawat).trigger('change').prop('disabled', true)

                const keluhan = pemeriksaanByDokter.keluhan ? pemeriksaanByDokter.keluhan : pemeriksaanByPerawat.keluhan
                formSoapPoli.find('textarea[name=keluhan]').val(keluhan.length ? keluhan : '-')

                const pemeriksaan = pemeriksaanByDokter.pemeriksaan ? pemeriksaanByDokter.pemeriksaan : pemeriksaanByPerawat.pemeriksaan
                formSoapPoli.find('textarea[name=pemeriksaan]').val(pemeriksaan.length ? pemeriksaan : '-')
                const penilaian = pemeriksaanByDokter.penilaian ? pemeriksaanByDokter.penilaian : pemeriksaanByPerawat.penilaian
                formSoapPoli.find('textarea[name=penilaian]').val(penilaian.length ? penilaian : '-')
                const rtl = pemeriksaanByDokter.rtl ? pemeriksaanByDokter.rtl : pemeriksaanByPerawat.rtl
                formSoapPoli.find('textarea[name=rtl]').val(rtl.length ? rtl : '-')
                const instruksi = pemeriksaanByDokter.instruksi ? pemeriksaanByDokter.instruksi : pemeriksaanByPerawat.instruksi
                formSoapPoli.find('textarea[name=instruksi]').val(instruksi.length ? instruksi : '-')

                const suhu_tubuh = pemeriksaanByDokter.suhu_tubuh ? pemeriksaanByDokter.suhu_tubuh : pemeriksaanByPerawat.suhu_tubuh
                formSoapPoli.find('input[name=suhu_tubuh]').val(suhu_tubuh.length ? suhu_tubuh : '-')

                const nadi = pemeriksaanByDokter.nadi ? pemeriksaanByDokter.nadi : pemeriksaanByPerawat.nadi
                formSoapPoli.find('input[name=nadi]').val(nadi.length ? nadi : '-')

                const tinggi = pemeriksaanByDokter.tinggi ? pemeriksaanByDokter.tinggi : pemeriksaanByPerawat.tinggi
                formSoapPoli.find('input[name=tinggi]').val(tinggi.length ? tinggi : '-')

                const berat = pemeriksaanByDokter.berat ? pemeriksaanByDokter.berat : pemeriksaanByPerawat.berat
                formSoapPoli.find('input[name=berat]').val(berat.length ? berat : '-')

                const respirasi = pemeriksaanByDokter.respirasi ? pemeriksaanByDokter.respirasi : pemeriksaanByPerawat.respirasi
                formSoapPoli.find('input[name=respirasi]').val(respirasi.length ? respirasi : '-')

                const tensi = pemeriksaanByDokter.tensi ? pemeriksaanByDokter.tensi : pemeriksaanByPerawat.tensi
                formSoapPoli.find('input[name=tensi]').val(tensi.length ? tensi : '-')

                const spo2 = pemeriksaanByDokter.spo2 ? pemeriksaanByDokter.spo2 : pemeriksaanByPerawat.spo2
                formSoapPoli.find('input[name=spo2]').val(spo2.length ? spo2 : '-')

                // const o2 = pemeriksaanByDokter.o2 ? pemeriksaanByDokter.o2:  pemeriksaanByPerawat.o2
                //
                // console.log(o2)
                // formSoapPoli.find('input[name=o2]').val(o2.length ? o2: '-')



                const gcs = pemeriksaanByDokter.gcs ? pemeriksaanByDokter.gcs : pemeriksaanByPerawat.gcs
                formSoapPoli.find('input[name=gcs]').val(gcs.length ? gcs : '-')

                const kesadaran = pemeriksaanByDokter.kesadaran ? pemeriksaanByDokter.kesadaran : pemeriksaanByPerawat.kesadaran
                formSoapPoli.find('select[name=kesadaran]').val(kesadaran.length ? kesadaran : '-')

                const alergi = pemeriksaanByDokter.alergi ? pemeriksaanByDokter.alergi : pemeriksaanByPerawat.alergi
                formSoapPoli.find('input[name=alergi]').val(alergi.length ? alergi : '-')


                const tgl_perawatan = pemeriksaanByDokter.tgl_perawatan ? pemeriksaanByDokter.tgl_perawatan : pemeriksaanByPerawat.tgl_perawatan
                formSoapPoli.find('input[name=tgl_perawatan]').val(tgl_perawatan).trigger('change')
                const jam_rawat = pemeriksaanByDokter.jam_rawat ? pemeriksaanByDokter.jam_rawat : pemeriksaanByPerawat.jam_rawat
                formSoapPoli.find('input[name=jam_rawat]').val(jam_rawat).trigger('change')
            })
        }

        formSoapPoli.find('#nip_pegawai ').select2({
            placeholder: 'Pilih Petugas',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#modalSoapRalan'), // sesuaikan jika di dalam modal
            ajax: {
                url: '/erm/petugas/cari',
                dataType: 'json',
                delay: 250,
                cache: true,
                data: function(params) {
                    return {
                        q: params.term // keyword pencarian
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(function(pegawai) {
                            return {
                                id: pegawai.nip,
                                text: pegawai.nama
                            };
                        })
                    };
                }
            }
        });
        formSoapPoli.find('select[name=kd_dokter]').select2({
            ajax: {
                url: '/erm/dokter/cari',
                dataType: 'json',
                processResults: (data) => {
                    return {
                        results: data.map((dokter) => {
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
                console.log('DATA ===', data);

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
                formSoapPoli.find('textarea').val('-').trigger('change');
                formSoapPoli.find('input[name=role]').val("{{ session()->get('role') }}")
                closeSideRiwayatSoap();
                $('#modalSoapRalan').modal('hide');
            }).fail((request) => {
                Swal.fire({
                    icon: 'error',
                    title: `${request.status} : ${request.statusText ? request.statusText : 'Terjadi Kesalahan'}`,
                    html: request.responseJSON?.message ?? 'Data SOAP gagal disimpan',
                })

            })
        }

        let bsOffcanvasRiwayatSoap = null;

        function toggleSideRiwayatSoap() {
            const el = document.getElementById('offcanvasRiwayatSoap');
            if (!el) return;

            if (!bsOffcanvasRiwayatSoap) {
                bsOffcanvasRiwayatSoap = new bootstrap.Offcanvas(el);
            }

            if (el.classList.contains('show')) {
                bsOffcanvasRiwayatSoap.hide();
            } else {
                const noRm = $('#no_rm').val() || $('#no_rkm_medis').val() || '';
                if (!noRm) {
                    Swal.fire('Peringatan', 'Nomor Rekam Medis tidak ditemukan', 'warning');
                    return;
                }
                bsOffcanvasRiwayatSoap.show();
                loadSideRiwayatSoap(noRm);
            }
        }

        function closeSideRiwayatSoap() {
            const el = document.getElementById('offcanvasRiwayatSoap');
            if (el && bsOffcanvasRiwayatSoap && el.classList.contains('show')) {
                bsOffcanvasRiwayatSoap.hide();
            }
        }

        function loadSideRiwayatSoap(noRm) {
            $('#loadingRiwayatSoap').removeClass('d-none');
            $('#contentRiwayatSoap').addClass('d-none').empty();

            $.get('/erm/registrasi/riwayat', { no_rkm_medis: noRm }).done(function(response) {
                $('#loadingRiwayatSoap').addClass('d-none');
                $('#contentRiwayatSoap').removeClass('d-none');

                const regList = response.reg_periksa || [];
                if (!regList || regList.length === 0) {
                    $('#contentRiwayatSoap').html(`
                        <div class="alert alert-warning text-center small my-3">
                            <i class="bi bi-info-circle me-1"></i> Belum ada data riwayat kunjungan medis untuk pasien ini.
                        </div>
                    `);
                    return;
                }

                let html = '';
                regList.forEach(function(item) {
                    const tgl = item.tgl_registrasi ? (typeof formatTanggal === 'function' ? formatTanggal(item.tgl_registrasi) : item.tgl_registrasi) : '-';
                    const statusLanjut = item.status_lanjut || 'Ralan';
                    const badgeClass = statusLanjut === 'Ranap' ? 'bg-danger' : 'bg-primary';
                    const poli = item.poliklinik?.nm_poli || '-';
                    const dokter = item.dokter?.nm_dokter || '-';

                    // Extract Diagnosa
                    let diagnosaHtml = '';
                    if (item.diagnosa_pasien && item.diagnosa_pasien.length > 0) {
                        const diagList = item.diagnosa_pasien.map(d => `<span class="badge bg-secondary me-1 mb-1" style="font-size:10px;">${d.kd_penyakit} - ${d.penyakit?.nm_penyakit || ''}</span>`).join('');
                        diagnosaHtml = `<div class="mb-2"><strong class="small">Diagnosa:</strong><br>${diagList}</div>`;
                    }

                    // Extract SOAP (Ralan / Ranap)
                    let soapS = '-', soapO = '-', soapA = '-', soapP = '-';

                    if (item.pemeriksaan_ralan && item.pemeriksaan_ralan.length > 0) {
                        const pr = item.pemeriksaan_ralan[0];
                        soapS = pr.keluhan || '-';
                        soapO = pr.pemeriksaan || '-';
                        if (pr.suhu_tubuh && pr.suhu_tubuh !== '-') soapO += ` | Suhu: ${pr.suhu_tubuh}°C`;
                        if (pr.tensi && pr.tensi !== '-') soapO += ` | Tensi: ${pr.tensi}`;
                        if (pr.nadi && pr.nadi !== '-') soapO += ` | Nadi: ${pr.nadi}`;
                        if (pr.spo2 && pr.spo2 !== '-') soapO += ` | SpO2: ${pr.spo2}%`;
                        soapA = pr.penilaian || '-';
                        soapP = pr.instruksi || pr.rtl || '-';
                    } else if (item.pemeriksaan_ranap && item.pemeriksaan_ranap.length > 0) {
                        const pr = item.pemeriksaan_ranap[0];
                        soapS = pr.keluhan || '-';
                        soapO = pr.pemeriksaan || '-';
                        soapA = pr.penilaian || '-';
                        soapP = pr.instruksi || pr.rtl || '-';
                    }

                    // Extract Resep
                    let resepHtml = '';
                    if (item.resep_obat && item.resep_obat.length > 0) {
                        let listObat = [];
                        item.resep_obat.forEach(r => {
                            if (r.resep_dokter && r.resep_dokter.length > 0) {
                                r.resep_dokter.forEach(d => {
                                    const nm = d.databarang?.nama_brng || d.kode_brng || '';
                                    const jml = d.jml || '';
                                    const aturan = d.aturan_pakai || '';
                                    listObat.push(`<li><strong>${nm}</strong> (${jml}) - <em>${aturan}</em></li>`);
                                });
                            }
                        });
                        if (listObat.length > 0) {
                            resepHtml = `
                                <div class="mt-2 pt-2 border-top">
                                    <strong class="text-success small"><i class="bi bi-capsule me-1"></i> Resep Obat:</strong>
                                    <ul class="ps-3 mb-1 small text-dark" style="font-size:11px;">${listObat.join('')}</ul>
                                </div>
                            `;
                        }
                    }

                    const jsonS = encodeURIComponent(soapS);
                    const jsonO = encodeURIComponent(soapO);
                    const jsonP = encodeURIComponent(soapP);

                    html += `
                        <div class="card mb-2 shadow-sm border-0">
                            <div class="card-header bg-white py-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge ${badgeClass} me-1" style="font-size:10px;">${statusLanjut}</span>
                                    <strong class="small text-dark">${tgl}</strong>
                                </div>
                                <span class="small text-muted" style="font-size: 11px;">${poli}</span>
                            </div>
                            <div class="card-body p-2" style="font-size: 12px;">
                                <div class="text-muted small mb-2"><i class="bi bi-person-doctor me-1"></i>${dokter}</div>
                                ${diagnosaHtml}
                                <div class="bg-white p-2 rounded border mb-2" style="font-size:11px;">
                                    <div class="mb-1"><strong>S:</strong> ${soapS}</div>
                                    <div class="mb-1"><strong>O:</strong> ${soapO}</div>
                                    <div class="mb-1"><strong>A:</strong> ${soapA}</div>
                                    <div><strong>P:</strong> ${soapP}</div>
                                </div>
                                <div class="d-flex gap-1 flex-wrap mb-1">
                                    <button type="button" class="btn btn-xs btn-outline-secondary py-0 px-2" style="font-size: 10px;" onclick="copySideToSoap('subjek', decodeURIComponent('${jsonS}'))"><i class="bi bi-clipboard me-1"></i>Copy S</button>
                                    <button type="button" class="btn btn-xs btn-outline-secondary py-0 px-2" style="font-size: 10px;" onclick="copySideToSoap('objek', decodeURIComponent('${jsonO}'))"><i class="bi bi-clipboard me-1"></i>Copy O</button>
                                    <button type="button" class="btn btn-xs btn-outline-secondary py-0 px-2" style="font-size: 10px;" onclick="copySideToSoap('plan', decodeURIComponent('${jsonP}'))"><i class="bi bi-clipboard me-1"></i>Copy P</button>
                                </div>
                                ${resepHtml}
                            </div>
                        </div>
                    `;
                });

                $('#contentRiwayatSoap').html(html);
            }).fail(function() {
                $('#loadingRiwayatSoap').addClass('d-none');
                $('#contentRiwayatSoap').removeClass('d-none').html(`
                    <div class="alert alert-danger text-center small my-3">
                        <i class="bi bi-exclamation-triangle me-1"></i> Gagal memuat data riwayat kunjungan.
                    </div>
                `);
            });
        }

        function copySideToSoap(field, text) {
            if (!text || text === '-') return;
            let target = null;
            if (field === 'subjek') target = $('#subjek');
            else if (field === 'objek') target = $('#objek');
            else if (field === 'plan') target = $('#plan');

            if (target && target.length > 0) {
                const cur = target.val();
                if (!cur || cur === '-') {
                    target.val(text);
                } else {
                    target.val(cur + '\n' + text);
                }
                if (typeof swalToast === 'function') {
                    swalToast(`Teks ${field.toUpperCase()} berhasil disalin`, 'success');
                }
            }
        }
    </script>

    <!-- Offcanvas Drawer Riwayat Kunjungan Pasien (SOAP) -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRiwayatSoap" data-bs-scroll="true" data-bs-backdrop="false" style="width: 440px; z-index: 1065; box-shadow: -6px 0 20px rgba(0,0,0,0.18); border-left: 2px solid #0d6efd;">
        <div class="offcanvas-header bg-primary text-white py-2 px-3 align-items-center">
            <h6 class="offcanvas-title fw-bold mb-0 text-white" id="offcanvasRiwayatSoapLabel">
                <i class="bi bi-clock-history me-1"></i> Riwayat Kunjungan Pasien
            </h6>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close" onclick="closeSideRiwayatSoap()"></button>
        </div>
        <div class="offcanvas-body p-2 bg-light" id="bodyOffcanvasRiwayatSoap" style="overflow-y: auto;">
            <div class="text-center py-5" id="loadingRiwayatSoap">
                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                <div class="small text-muted mt-2">Memuat riwayat kunjungan...</div>
            </div>
            <div id="contentRiwayatSoap" class="d-none"></div>
        </div>
    </div>
@endpush
