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

<!-- Offcanvas Drawer Riwayat Kunjungan Pasien (SOAP) -->
<style>
    #offcanvasRiwayatSoap,
    #offcanvasRiwayatSoap *,
    #offcanvasRiwayatSoap .badge,
    #offcanvasRiwayatSoap .card,
    #offcanvasRiwayatSoap .card-body,
    #offcanvasRiwayatSoap .card-header,
    #offcanvasRiwayatSoap div,
    #offcanvasRiwayatSoap span,
    #offcanvasRiwayatSoap p,
    #offcanvasRiwayatSoap li,
    #offcanvasRiwayatSoap strong,
    #offcanvasRiwayatSoap h6 {
        -webkit-user-select: text !important;
        -moz-user-select: text !important;
        -ms-user-select: text !important;
        user-select: text !important;
    }
    #offcanvasRiwayatSoap .btn,
    #offcanvasRiwayatSoap .btn-close {
        -webkit-user-select: none !important;
        -moz-user-select: none !important;
        -ms-user-select: none !important;
        user-select: none !important;
    }
</style>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRiwayatSoap" data-bs-scroll="true" data-bs-backdrop="false" style="width: 440px; z-index: 1065; box-shadow: -6px 0 20px rgba(0,0,0,0.18); border-left: 2px solid #0d6efd; user-select: text !important; -webkit-user-select: text !important;">
    <div class="offcanvas-header bg-primary text-white py-2 px-3 align-items-center">
        <h6 class="offcanvas-title fw-bold mb-0 text-white" id="offcanvasRiwayatSoapLabel">
            <i class="bi bi-clock-history me-1"></i> Riwayat Kunjungan Pasien
        </h6>
        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close" onclick="closeSideRiwayatSoap()"></button>
    </div>
    <div class="offcanvas-body p-2 bg-light" id="bodyOffcanvasRiwayatSoap" style="overflow-y: auto; user-select: text !important; -webkit-user-select: text !important;">
        <div class="text-center py-5" id="loadingRiwayatSoap">
            <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
            <div class="small text-muted mt-2">Memuat riwayat kunjungan...</div>
        </div>
        <div id="contentRiwayatSoap" class="d-none" style="user-select: text !important; -webkit-user-select: text !important;"></div>
    </div>
</div>

@push('script')
    <script>
        const modalSoapRalan = $('#modalSoapRalan');
        const formSoapPoli = $('#formSoapPoli');

        $(document).on('mousedown selectstart pointerdown', '#offcanvasRiwayatSoap', function(e) {
            e.stopPropagation();
        });


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
            $('button[data-bs-target="#tab-soap-pane"]').tab('show');

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
        let rawRiwayatSoapData = [];

        function cleanVal(v) {
            if (v === null || v === undefined) return '';
            const str = String(v).trim();
            if (str === '' || str === '-') return '';
            return str;
        }

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

                rawRiwayatSoapData = response.reg_periksa || [];
                renderSideRiwayatSoap();
            }).fail(function() {
                $('#loadingRiwayatSoap').addClass('d-none');
                $('#contentRiwayatSoap').removeClass('d-none').html(`
                    <div class="alert alert-danger text-center small my-3">
                        <i class="bi bi-exclamation-triangle me-1"></i> Gagal memuat data riwayat kunjungan.
                    </div>
                `);
            });
        }

        function renderSideRiwayatSoap() {
            const container = $('#contentRiwayatSoap');
            container.empty();

            if (!rawRiwayatSoapData || rawRiwayatSoapData.length === 0) {
                container.html(`
                    <div class="alert alert-warning text-center small my-3">
                        <i class="bi bi-info-circle me-1"></i> Belum ada data riwayat kunjungan medis untuk pasien ini.
                    </div>
                `);
                return;
            }

            const curKdDokter = $('#kd_dokter').val() || '';
            let filteredList = rawRiwayatSoapData;

            if (curKdDokter) {
                filteredList = rawRiwayatSoapData.filter(function(item) {
                    return String(item.kd_dokter).trim() === String(curKdDokter).trim();
                });
            }

            if (filteredList.length === 0) {
                container.html(`
                    <div class="alert alert-info text-center small my-3">
                        <i class="bi bi-info-circle me-1"></i> Belum ada riwayat kunjungan pemeriksaan khusus Dokter ini.
                    </div>
                `);
                return;
            }

            let html = '';

            filteredList.forEach(function(item) {
                const tgl = item.tgl_registrasi ? (typeof formatTanggal === 'function' ? formatTanggal(item.tgl_registrasi) : item.tgl_registrasi) : '-';
                const statusLanjut = item.status_lanjut || 'Ralan';
                const badgeClass = statusLanjut === 'Ranap' ? 'bg-danger' : 'bg-primary';
                const poli = item.poliklinik?.nm_poli || '-';
                const dokter = item.dokter?.nm_dokter || '-';

                // Extract Diagnosa
                let diagnosaHtml = '';
                if (item.diagnosa_pasien && item.diagnosa_pasien.length > 0) {
                    const diagList = item.diagnosa_pasien.map(d => `
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill me-1 mb-1 px-2 py-1" style="font-size: 10px; font-weight: 500;">
                            <strong>${d.kd_penyakit}</strong> - ${d.penyakit?.nm_penyakit || ''}
                        </span>
                    `).join('');
                    diagnosaHtml = `
                        <div class="mb-2">
                            <div class="text-muted fw-bold mb-1" style="font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;"><i class="bi bi-activity me-1"></i>Diagnosa:</div>
                            <div>${diagList}</div>
                        </div>
                    `;
                }

                // Extract Resep List & Pemberian Obat (Filter non-drug consumables & deduplicate)
                const nonDrugKeywords = /spuit|handscoon|glove|needle|hypafix|leukoplast|kassa|nasal|spalk|infuset|gelang|masker|o2|pot|cover glass|objek glass|tabung|cellpack|sulfolycer|lycer|flourocell|qc xnl|thermal|abocath|pipet|otsu water|wfi|mucus|suction|oneswab/i;

                let listObat = [];
                let setObat = new Set();

                if (item.resep_obat && item.resep_obat.length > 0) {
                    item.resep_obat.forEach(r => {
                        if (r.resep_dokter && r.resep_dokter.length > 0) {
                            r.resep_dokter.forEach(d => {
                                const nm = d.databarang?.nama_brng || d.kode_brng || '';
                                const jml = d.jml ? ` (${d.jml})` : '';
                                const aturan = d.aturan_pakai ? ` - ${d.aturan_pakai}` : '';
                                if (nm && !nonDrugKeywords.test(nm) && !setObat.has(nm.trim())) {
                                    setObat.add(nm.trim());
                                    listObat.push(`${nm}${jml}${aturan}`);
                                }
                            });
                        }
                        if (r.resep_racikan && r.resep_racikan.length > 0) {
                            r.resep_racikan.forEach(rc => {
                                const nm = rc.nama_racik ? `Racikan: ${rc.nama_racik}` : 'Racikan';
                                const jml = rc.jml_dr ? ` (${rc.jml_dr})` : '';
                                const aturan = rc.aturan_pakai ? ` - ${rc.aturan_pakai}` : '';
                                if (nm && !setObat.has(nm.trim())) {
                                    setObat.add(nm.trim());
                                    listObat.push(`${nm}${jml}${aturan}`);
                                }
                            });
                        }
                    });
                }

                if (item.detail_pemberian_obat && item.detail_pemberian_obat.length > 0) {
                    item.detail_pemberian_obat.forEach(d => {
                        const nm = d.data_barang?.nama_brng || d.kode_brng || '';
                        if (nm && !nonDrugKeywords.test(nm) && !setObat.has(nm.trim())) {
                            setObat.add(nm.trim());
                            const jml = d.jml ? ` (${d.jml})` : '';
                            const aturanStr = d.aturan_pakai?.aturan || (typeof d.aturan_pakai === 'string' ? d.aturan_pakai : '');
                            const aturan = aturanStr ? ` - ${aturanStr}` : '';
                            listObat.push(`${nm}${jml}${aturan}`);
                        }
                    });
                }

                let resepHtml = '';
                if (listObat.length > 0) {
                    const obatUl = listObat.map(o => `<li>${o}</li>`).join('');
                    resepHtml = `
                        <div class="mt-2 p-2 rounded-3 border border-success-subtle bg-success-subtle bg-opacity-10">
                            <div class="text-success fw-bold d-flex align-items-center mb-1" style="font-size: 11px;">
                                <i class="bi bi-capsule me-1"></i> Resep / Pemberian Obat:
                            </div>
                            <ul class="ps-3 mb-0 text-dark" style="font-size: 11px; line-height: 1.5;">${obatUl}</ul>
                        </div>
                    `;
                }

                // Extract Prosedur / Tindakan (ICD-9)
                let listTindakan = [];
                if (item.prosedur_pasien && item.prosedur_pasien.length > 0) {
                    item.prosedur_pasien.forEach(p => {
                        const desc = p.icd9?.deskripsi_panjang || p.icd9?.deskripsi_pendek || p.kode || '';
                        if (desc) listTindakan.push(desc);
                    });
                }

                // Extract SOAP (Ralan / Ranap)
                let sParts = [], oParts = [], aParts = [], pParts = [];

                let targetSoapList = [];
                if (item.pemeriksaan_ralan && item.pemeriksaan_ralan.length > 0) {
                    targetSoapList = item.pemeriksaan_ralan;
                } else if (item.pemeriksaan_ranap && item.pemeriksaan_ranap.length > 0) {
                    targetSoapList = item.pemeriksaan_ranap;
                }

                if (targetSoapList.length > 0) {
                    let docEntries = targetSoapList.filter(pr => pr.pegawai?.dokter || (curKdDokter && String(pr.nip) === String(curKdDokter)));
                    let entriesToProcess = docEntries.length > 0 ? docEntries : targetSoapList;

                    if (statusLanjut === 'Ranap' && entriesToProcess.length > 2) {
                        entriesToProcess = entriesToProcess.slice(-2);
                    }

                    entriesToProcess.forEach(pr => {
                        const kel = cleanVal(pr.keluhan);
                        if (kel && !sParts.includes(kel)) sParts.push(kel);

                        const prm = cleanVal(pr.pemeriksaan);
                        if (prm && !oParts.includes(prm)) oParts.push(prm);

                        let vitals = [];
                        if (cleanVal(pr.suhu_tubuh)) vitals.push(`Suhu: ${pr.suhu_tubuh}°C`);
                        if (cleanVal(pr.tensi)) vitals.push(`Tensi: ${pr.tensi}`);
                        if (cleanVal(pr.nadi)) vitals.push(`Nadi: ${pr.nadi}`);
                        if (cleanVal(pr.spo2)) vitals.push(`SpO2: ${pr.spo2}%`);
                        if (vitals.length > 0) {
                            const vStr = vitals.join(' | ');
                            if (!oParts.includes(vStr)) oParts.push(vStr);
                        }

                        const pen = cleanVal(pr.penilaian);
                        if (pen && !aParts.includes(pen)) aParts.push(pen);

                        const rtlVal = cleanVal(pr.rtl);
                        const instVal = cleanVal(pr.instruksi);
                        const evalVal = cleanVal(pr.evaluasi);
                        if (rtlVal && !pParts.includes(rtlVal)) pParts.push(rtlVal);
                        if (instVal && !pParts.includes(instVal)) pParts.push(instVal);
                        if (evalVal && !pParts.includes(evalVal)) pParts.push(evalVal);
                    });
                }

                const catVal = cleanVal(item.catatan_perawatan?.catatan);
                if (catVal && !pParts.includes(catVal)) pParts.push(catVal);

                // Fallback for A
                if (aParts.length === 0 && item.diagnosa_pasien && item.diagnosa_pasien.length > 0) {
                    const diagStr = item.diagnosa_pasien.map(d => `${d.kd_penyakit} - ${d.penyakit?.nm_penyakit || ''}`).join(', ');
                    if (diagStr) aParts.push(diagStr);
                }

                // Plan (P) value extraction
                let soapP = '-';
                if (pParts.length > 0) {
                    soapP = pParts.join('\n');
                } else if (listObat.length > 0) {
                    soapP = listObat.join('\n');
                } else if (listTindakan.length > 0) {
                    soapP = listTindakan.join('\n');
                }

                const soapS = sParts.length > 0 ? sParts.join(' | ') : '-';
                const soapO = oParts.length > 0 ? oParts.join(' | ') : '-';
                const soapA = aParts.length > 0 ? aParts.join(' | ') : '-';

                const jsonS = encodeURIComponent(soapS);
                const jsonO = encodeURIComponent(soapO);
                const jsonP = encodeURIComponent(soapP);

                const borderLeftColor = statusLanjut === 'Ranap' ? '#dc3545' : '#0d6efd';

                html += `
                    <div class="card mb-3 shadow-sm border-0 rounded-3 overflow-hidden" style="border-left: 4px solid ${borderLeftColor} !important; background: #ffffff; user-select: text !important; -webkit-user-select: text !important;">
                        <div class="card-header bg-light bg-gradient py-2 px-3 border-bottom d-flex justify-content-between align-items-center" style="user-select: text !important; -webkit-user-select: text !important;">
                            <div class="d-flex align-items-center gap-2" style="user-select: text !important; -webkit-user-select: text !important;">
                                <span class="badge ${badgeClass} rounded-pill px-2.5 py-1" style="font-size: 10px; font-weight: 600; user-select: text !important; -webkit-user-select: text !important;">${statusLanjut}</span>
                                <strong class="text-dark fw-bold" style="font-size: 12.5px; user-select: text !important; -webkit-user-select: text !important;"><i class="bi bi-calendar3 me-1 text-primary"></i>${tgl}</strong>
                            </div>
                            <span class="badge bg-white text-secondary border rounded-pill px-2 py-1 shadow-2xs" style="font-size: 10px; font-weight: 500; user-select: text !important; -webkit-user-select: text !important;"><i class="bi bi-hospital me-1 text-muted"></i>${poli}</span>
                        </div>
                        <div class="card-body p-2.5" style="font-size: 12px; user-select: text !important; -webkit-user-select: text !important;">
                            <div class="text-secondary small fw-semibold mb-2 d-flex align-items-center gap-1" style="user-select: text !important; -webkit-user-select: text !important;">
                                <i class="bi bi-person-badge text-primary"></i>
                                <span class="text-dark" style="user-select: text !important; -webkit-user-select: text !important;">${dokter}</span>
                            </div>
                            ${diagnosaHtml}
                            <div class="p-2.5 rounded-3 border mb-2" style="background-color: #f8fafc; border-color: #e2e8f0 !important; font-size: 11px; user-select: text !important; -webkit-user-select: text !important;">
                                <div class="mb-1.5 d-flex align-items-start gap-1" style="user-select: text !important; -webkit-user-select: text !important;">
                                    <span class="badge bg-primary text-white me-1 px-1.5 py-0.5 rounded fw-bold" style="font-size: 9px; min-width: 18px; text-align: center; user-select: text !important; -webkit-user-select: text !important;">S</span>
                                    <span class="text-dark" style="flex:1; user-select: text !important; -webkit-user-select: text !important;">${soapS}</span>
                                </div>
                                <div class="mb-1.5 d-flex align-items-start gap-1" style="user-select: text !important; -webkit-user-select: text !important;">
                                    <span class="badge bg-info text-white me-1 px-1.5 py-0.5 rounded fw-bold" style="font-size: 9px; min-width: 18px; text-align: center; user-select: text !important; -webkit-user-select: text !important;">O</span>
                                    <span class="text-dark" style="flex:1; user-select: text !important; -webkit-user-select: text !important;">${soapO}</span>
                                </div>
                                <div class="mb-1.5 d-flex align-items-start gap-1" style="user-select: text !important; -webkit-user-select: text !important;">
                                    <span class="badge bg-warning text-dark me-1 px-1.5 py-0.5 rounded fw-bold" style="font-size: 9px; min-width: 18px; text-align: center; user-select: text !important; -webkit-user-select: text !important;">A</span>
                                    <span class="text-dark" style="flex:1; user-select: text !important; -webkit-user-select: text !important;">${soapA}</span>
                                </div>
                                <div class="d-flex align-items-start gap-1" style="user-select: text !important; -webkit-user-select: text !important;">
                                    <span class="badge bg-success text-white me-1 px-1.5 py-0.5 rounded fw-bold" style="font-size: 9px; min-width: 18px; text-align: center; user-select: text !important; -webkit-user-select: text !important;">P</span>
                                    <span class="text-dark" style="flex:1; white-space: pre-line; user-select: text !important; -webkit-user-select: text !important;">${soapP}</span>
                                </div>
                            </div>
                            <div class="d-flex gap-1.5 flex-wrap mb-1" style="user-select: none !important;">
                                <button type="button" class="btn btn-xs btn-light border shadow-2xs rounded-pill py-0.5 px-2.5 text-secondary" style="font-size: 10px; font-weight: 500;" onclick="copySideToSoap('subjek', decodeURIComponent('${jsonS}'))"><i class="bi bi-clipboard-check text-primary me-1"></i>Copy S</button>
                                <button type="button" class="btn btn-xs btn-light border shadow-2xs rounded-pill py-0.5 px-2.5 text-secondary" style="font-size: 10px; font-weight: 500;" onclick="copySideToSoap('objek', decodeURIComponent('${jsonO}'))"><i class="bi bi-clipboard-check text-info me-1"></i>Copy O</button>
                                <button type="button" class="btn btn-xs btn-light border shadow-2xs rounded-pill py-0.5 px-2.5 text-secondary" style="font-size: 10px; font-weight: 500;" onclick="copySideToSoap('plan', decodeURIComponent('${jsonP}'))"><i class="bi bi-clipboard-check text-success me-1"></i>Copy P</button>
                            </div>
                            ${resepHtml}
                        </div>
                    </div>
                `;
            });

            container.html(html);
        }

        function copySideToSoap(field, text) {
            if (!text || text === '-') return;
            let target = null;
            if (field === 'subjek') target = $('#subjek');
            else if (field === 'objek') target = $('#objek');
            else if (field === 'plan') target = $('#rtl');

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

        $(document).ready(function() {
            $(document).on('mousedown selectstart pointerdown focusin', '#offcanvasRiwayatSoap', function(e) {
                e.stopPropagation();
            });
        });
    </script>
@endpush
