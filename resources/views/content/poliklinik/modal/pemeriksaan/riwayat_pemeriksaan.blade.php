<div class="row">
    <div class="col-md-12 col-sm-12 col-lg-2 mb-2">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a href="javascript:void(0)" class="nav-brand"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbarListRiwayatPemeriksaan" aria-controls="navbarListRiwayatPemeriksaan" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarListRiwayatPemeriksaan">
                    <ul class="navbar-nav nav flex-column me-auto mb-2 mb-lg-0 nav-tab-riwayat navTabRiwayatPemeriksaan" id="">

                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="col-md-12 col-sm-12 col-lg-10">
        <div class="card">
            <div class="card-body">
                <nav class="card-text">
                    <div class="nav nav-tabs" id="nav-tab-riwayat-pemeriksaan" role="tablist">
                        <button class="nav-link nav-pemeriksaan-tab active" id="" data-bs-toggle="tab" data-bs-target=".nav-pemeriksaan" type="button" role="tab" aria-controls=".nav-pemeriksaan" aria-selected="true">Pemeriksaan</button>
                        <button class="nav-link nav-resume-tab" id="" data-bs-toggle="tab" data-bs-target=".nav-resume" type="button" role="tab" aria-controls=".nav-resume" aria-selected="false">Resume Medis</button>
                        <button class="nav-link nav-penunjang-tab" id="" data-bs-toggle="tab" data-bs-target=".nav-penunjang" type="button" role="tab" aria-controls=".nav-penunjang" aria-selected="false">Penunjang</button>
                    </div>
                </nav>
                <div class="tab-content p-2 content-scrolled nav-tabContent" id="">
                    <div class="card mb-2 infoRegistrasi">
                        <div class="card-body" id="">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <th width="35%">Tgl. Registrasi</th>
                                                <td width="1%">:</td>
                                                <td class="tgl_registrasi">23 September 2025 14:52:36</td>
                                            </tr>
                                            <tr>
                                                <th>No Rawat</th>
                                                <td width="1%">:</td>
                                                <td class="no_rawat"></td>
                                            </tr>
                                            <tr>
                                                <th>Nama (No. RM)</th>
                                                <td width="1%">:</td>
                                                <td class="nm_pasien"></td>
                                            </tr>
                                            <tr>
                                                <th>Tgl. Lahir / Umur</th>
                                                <td width="1%">:</td>
                                                <td class="tgl_lahir"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <table class="table table-sm">
                                        <tbody>
                                            <tr>
                                                <th width="35%">Unit / Poliklinik</th>
                                                <td width="1%">:</td>
                                                <td class="poliklinik"></td>
                                            </tr>
                                            <tr>
                                                <th>Dokter</th>
                                                <td width="1%">:</td>
                                                <td class="dokter"></td>
                                            </tr>
                                            <tr>
                                                <th>Cara Bayar</th>
                                                <td width="1%">:</td>
                                                <td class="penjab"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade nav-pemeriksaan show active" id="" role="tabpanel" aria-labelledby="nav-pemeriksaan-tab" tabindex="0">
                        <div class="card-text">

                            <div class="dxpxPasien" id="">
                                <div class="card position-relative mt-2">
                                    <div class="card-header">
                                        <span>Diagnosa & Prosedur</span>
                                    </div>
                                    <div class="card-body" id="">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="card cardDiagnosaPasien" id="">
                                                    <div class="card-header">
                                                        Diagnosa
                                                    </div>
                                                    <div class="card-body bodyDiagnosaPasien">
                                                        <div class="card-text">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        Prosedur
                                                    </div>
                                                    <div class="card-body bodyProsedurPasien">
                                                        <div class="card-text">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="" id="laporanOperasi" style="display:none">
                                 <div class="card position-relative mt-2">
                                     <div class="card-header" aria-controls="collapseLaporanOperasi" data-bs-toggle="collapse" data-bs-target="#collapseLaporanOperasi">
                                         <span>Laporan Operasi</span>
                                         <a class="position-absolute top-0 end-0 me-2 mt-2" style="color:#000" data-bs-toggle="collapse" href="#collapseLaporanOperasi" role="button" aria-expanded="false" aria-controls="collapseLaporanOperasi"><i class="bi bi-x"></i></a>
                                     </div>
                                     <div class="card-body collapse show" id="collapseLaporanOperasi">

                                     </div>
                                 </div>
                             </div> --}}
                            <div class="periksaRawatJalan d-none" id="">
                                <div class="card mt-2">
                                    <div class="card-header">
                                        <span>Pemeriksaan Rawat Jalan</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row container-periksa">
                                            <div class="col-md-6 col-lg-5 col-sm-12 mb-1 template-periksa-fisik d-none">
                                                <div class="card">
                                                    <div class="card-header card-text">

                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table borderless table-sm table-responsive" cellpadding="5" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <th width="20%">Tinggi</th>
                                                                    <td>:</td>
                                                                    <td class="tinggi"></td>
                                                                    <th width="10%">Berat</th>
                                                                    <td>:</td>
                                                                    <td class="berat"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%">Suhu</th>
                                                                    <td>:</td>
                                                                    <td class="suhu_tubuh"></td>
                                                                    <th width="10%">Tensi</th>
                                                                    <td>:</td>
                                                                    <td class="tensi"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="10%">Kesadaran</th>
                                                                    <td>:</td>
                                                                    <td class="kesadaran"></td>
                                                                    <th width="10%">GCS</th>
                                                                    <td>:</td>
                                                                    <td class="gcs"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="10%">Respirasi</th>
                                                                    <td>:</td>
                                                                    <td class="respirasi"></td>
                                                                    <th width="10%">Nadi</th>
                                                                    <td>:</td>
                                                                    <td class="nadi"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="10%">SpO2</th>
                                                                    <td>:</td>
                                                                    <td class="spo2">100 %</td>
                                                                    <th width="10%">Alergi</th>
                                                                    <td>:</td>
                                                                    <td class="alergi">-</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-7 col-sm-12 mb-1 template-periksa-soap d-none">
                                                <div class="card">
                                                    <div class="card-header card-text">

                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-sm table-responsive borderless" cellpadding="5" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <th width="20%">Subyek</th>
                                                                    <td>:</td>
                                                                    <td class="keluhan"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%">Obyek</th>
                                                                    <td>:</td>
                                                                    <td class="pemeriksaan"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%">Asesmen</th>
                                                                    <td>:</td>
                                                                    <td class="penilaian"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%">Plan</th>
                                                                    <td>:</td>
                                                                    <td class="rtl"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%">Instruksi</th>
                                                                    <td>:</td>
                                                                    <td class="instruksi"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="periksaRawatInap d-none" id="">
                                <div class="card mt-2">
                                    <div class="card-header">
                                        <span>Pemeriksaan Rawat Inap</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row container-periksa-inap">
                                            <div class="col-md-6 col-lg-5 col-sm-12 mb-1 template-periksa-fisik d-none">
                                                <div class="card">
                                                    <div class="card-header card-text">

                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table borderless table-sm table-responsive" cellpadding="5" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <th width="20%">Tinggi</th>
                                                                    <td>:</td>
                                                                    <td class="tinggi"></td>
                                                                    <th width="10%">Berat</th>
                                                                    <td>:</td>
                                                                    <td class="berat"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%">Suhu</th>
                                                                    <td>:</td>
                                                                    <td class="suhu_tubuh"></td>
                                                                    <th width="10%">Tensi</th>
                                                                    <td>:</td>
                                                                    <td class="tensi"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="10%">Kesadaran</th>
                                                                    <td>:</td>
                                                                    <td class="kesadaran"></td>
                                                                    <th width="10%">GCS</th>
                                                                    <td>:</td>
                                                                    <td class="gcs"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="10%">Respirasi</th>
                                                                    <td>:</td>
                                                                    <td class="respirasi"></td>
                                                                    <th width="10%">Nadi</th>
                                                                    <td>:</td>
                                                                    <td class="nadi"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="10%">SpO2</th>
                                                                    <td>:</td>
                                                                    <td class="spo2">100 %</td>
                                                                    <th width="10%">Alergi</th>
                                                                    <td>:</td>
                                                                    <td class="alergi">-</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-7 col-sm-12 mb-1 template-periksa-soap d-none">
                                                <div class="card">
                                                    <div class="card-header card-text">

                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-sm table-responsive borderless" cellpadding="5" cellspacing="0">
                                                            <tbody>
                                                                <tr>
                                                                    <th width="20%">Subyek</th>
                                                                    <td>:</td>
                                                                    <td class="keluhan"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%">Obyek</th>
                                                                    <td>:</td>
                                                                    <td class="pemeriksaan"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%">Asesmen</th>
                                                                    <td>:</td>
                                                                    <td class="penilaian"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%">Plan</th>
                                                                    <td>:</td>
                                                                    <td class="rtl"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th width="20%">Instruksi</th>
                                                                    <td>:</td>
                                                                    <td class="instruksi"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="" id="obat" style="display:none">
                                 <div class="card position-relative mt-2">
                                     <div class="card-header" aria-controls="collapsePemberianObat" data-bs-toggle="collapse" data-bs-target="#collapsePemberianObat">
                                         <span>Pemberian Obat</span>
                                         <a class="position-absolute top-0 end-0 me-2 mt-2" style="color:#000" data-bs-toggle="collapse" href="#collapsePemberianObat" role="button" aria-expanded="false" aria-controls="collapsePemberianObat"><i class="bi bi-x"></i></a>
                                     </div>
                                     <div class="card-body collapse" id="collapsePemberianObat">

                                     </div>
                                 </div>
                             </div> --}}
                        </div>
                    </div>
                    <div class="tab-pane fade nav-resume" id="" role="tabpanel" aria-labelledby=".nav-resume-tab" tabindex="0">
                        <div class="card resumeMedis" id="" style="display: none">
                            <div class="card-header">
                                <small>Resume Medis</small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-text" id="resume-info-left">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 mt-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-text" id="resume-info-right">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 mt-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-text" id="resume-content">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade nav-penunjang" id="" role="tabpanel" aria-labelledby="nav-penunjang-tab" tabindex="0">
                        {{-- <div class="" id="berkasPenunjang">
                             @include('content.ranap.modal.riwayat._berkas')
                         </div>

                         <div class="" id="catatanPerawatan">
                             <div class="card position-relative mt-2">
                                 <div class="card-header" aria-controls="collapseCatatanPerawatan" data-bs-toggle="collapse" data-bs-target="#collapseCatatanPerawatan">
                                     <div class="card-text">
                                         <span>Catatan Keperawatan</span>
                                     </div>

                                 </div>
                                 <div class="card-body card-text collapse" id="collapseCatatanPerawatan">
                                     <div class="card">
                                         <div class="card-body">
                                             <div class="mt-2" id="contentCatatanPerawatan"></div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div> --}}
                        {{-- <div class="" id="hasilLab">
                             @include('content.ranap.modal.riwayat._lab')
                         </div>
                         <div class="" id="hasilRadiologi">
                             @include('content.ranap.modal.riwayat._radiologi')
                         </div>
                         <div class="" id="riwayatSkriningTb">
                             @include('content.ranap.modal.riwayat._skriningTB')
                         </div> --}}
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>



@push('script')
    <script>
        const navTabRiwayatPemeriksaan = $('.navTabRiwayatPemeriksaan');

        const btnTabRiwayatPemeriksaan = $('button[data-bs-target="#tab-riwayat-pane"]');

        btnTabRiwayatPemeriksaan.on('shown.bs.tab', function(e, x, y) {
            const no_rkm_medis = formSoapPoli.find('input[name=no_rkm_medis]').val();
            setRiwayatPemeriksaan(no_rkm_medis)
            $('.btn-soap').addClass('d-none')
        })


        function setRiwayatPemeriksaan(no_rkm_medis) {
            getRiwayatPasien(no_rkm_medis, 'DESC').done((response) => {
                const regPeriksa = response.reg_periksa.map((item, index) => {
                    if (index == 0) {
                        active = 'active';
                        setDetailRiwayat(item.no_rawat, item.kd_poli)
                    } else {
                        active = '';
                    }
                    return `<li class="nav-item list">
                            <a class="nav-link link-riwayat ${active}" aria-current="page" href="#" onclick="setDetailRiwayat('${item.no_rawat}', '${item.kd_poli}', this)">
                                ${item.status_lanjut.toUpperCase() == 'RALAN' ? '<i class="bi bi-circle-fill text-warning"></i>' : '<i class="bi bi-circle-fill text-purple"></i>'} ${item.status_lanjut.toUpperCase() } : ${splitTanggal(item.tgl_registrasi)} 
                                <br><small class="text-muted">${item.poliklinik.nm_poli.length > 20 ? item.poliklinik.nm_poli.substring(0, 20) + '...' : item.poliklinik.nm_poli}</small>
                                </a>
                        </li>`;
                })
                navTabRiwayatPemeriksaan.html(regPeriksa)
            })
        }

        function setDetailRiwayat(no_rawat, kd_poli, e) {

            navTabRiwayatPemeriksaan.find('.link-riwayat').removeClass('active');
            if (e) $(e).addClass('active');
            const infoRegistrasi = $('.infoRegistrasi')

            getRegPeriksa(no_rawat).done((response) => {
                const hitung = hitungUmurDaftar(response.pasien?.tgl_lahir, response.tgl_registrasi);

                const umur = `${hitung.tahun} Thn ${hitung.bulan} Bln ${hitung.hari} Hr`

                infoRegistrasi.find('.tgl_registrasi').text(`${formatTanggal(response.tgl_registrasi)} ${response.jam_reg}` || '-')
                infoRegistrasi.find('.no_rawat').text(response.no_rawat || '-')
                infoRegistrasi.find('.nm_pasien').text(`${response.pasien?.nm_pasien || '-'} (${response.no_rkm_medis || '-'})`)
                infoRegistrasi.find('.tgl_lahir').text(`${formatTanggal(response.pasien?.tgl_lahir) || '-'} / ${ umur || '-'}`)
                infoRegistrasi.find('.poliklinik').text(response.poliklinik?.nm_poli || '-')
                infoRegistrasi.find('.dokter').text(response.dokter?.nm_dokter || '-')
                infoRegistrasi.find('.penjab').text(response.penjab?.png_jawab || '-')

            })

            setPemeriksaanRawatJalan(no_rawat, kd_poli)
            setICDPasien(no_rawat)
            setPemeriksaanRawatInap(no_rawat)

        }
        btnTabRiwayatPemeriksaan.on('hide.bs.tab', function(e, x, y) {
            navTabRiwayatPemeriksaan.empty()
        })

        function setPemeriksaanRawatJalan(no_rawat, kd_poli) {
            const periksaRawatJalan = $('.periksaRawatJalan')
            const container = $('.container-periksa')

            getPemeriksaanPoli(no_rawat, kd_poli).done((response) => {
                // bersihkan hasil sebelumnya (kecuali template)
                container.find('.col-md-6:not(.template-periksa-fisik):not(.template-periksa-soap)').remove()

                if (!response.length) {
                    periksaRawatJalan.addClass('d-none')
                    return
                }

                periksaRawatJalan.removeClass('d-none')

                response.forEach((item, index) => {
                    // clone fisik
                    const fisik = container.find('.template-periksa-fisik')
                        .clone()
                        .removeClass('template-periksa-fisik d-none')

                    fisik.find(".card-header").html(`${formatTanggal(item.tgl_perawatan) || '-'}`).addClass(`header-${index}`)

                    fisik.find(".tinggi").text(item.tinggi || "-")
                    fisik.find(".berat").text(item.berat || "-")
                    fisik.find(".suhu_tubuh").text(item.suhu_tubuh || "-")
                    fisik.find(".tensi").text(item.tensi || "-")
                    fisik.find(".kesadaran").text(item.kesadaran || "-")
                    fisik.find(".gcs").text(item.gcs || "-")
                    fisik.find(".respirasi").text(item.respirasi || "-")
                    fisik.find(".nadi").text(item.nadi || "-")
                    fisik.find(".spo2").text(item.spo2 || "-")
                    fisik.find(".alergi").text(item.alergi || "-")

                    // clone soap
                    const soap = container.find('.template-periksa-soap')
                        .clone()
                        .removeClass('template-periksa-soap d-none')

                    soap.find(".card-header").html(`<i class="bi bi-user"></i>${item.pegawai?.nama}`).addClass(`header-${index}`)

                    soap.find(".keluhan").text(item.keluhan || "-")
                    soap.find(".pemeriksaan").text(item.pemeriksaan || "-")
                    soap.find(".penilaian").text(item.penilaian || "-")
                    soap.find(".rtl").text(item.rtl || "-")
                    soap.find(".instruksi").text(item.instruksi || "-")

                    const headerClass = item.nip?.startsWith("1.") ? "bg-primary text-white" : "bg-warning text-dark";

                    fisik.find(`.header-${index}`).addClass(headerClass)
                    soap.find(`.header-${index}`).addClass(headerClass)

                    // append ke container
                    container.append(fisik).append(soap)
                })
            })
        }

        function setPemeriksaanRawatInap(no_rawat) {
            const periksaRawatInap = $('.periksaRawatInap')
            const container = $('.container-periksa-inap')

            getPemeriksaanRanap(no_rawat).done((response) => {
                // bersihkan hasil sebelumnya (kecuali template)
                container.find('.col-md-6:not(.template-periksa-fisik):not(.template-periksa-soap)').remove()

                if (!response.length) {
                    periksaRawatInap.addClass('d-none')
                    return
                }

                periksaRawatInap.removeClass('d-none')

                response.forEach((item, index) => {
                    // clone fisik
                    const fisik = container.find('.template-periksa-fisik')
                        .clone()
                        .removeClass('template-periksa-fisik d-none')

                    fisik.find(".card-header").html(`${formatTanggal(item.tgl_perawatan) || '-'}`).addClass(`header-${index}`)

                    fisik.find(".tinggi").text(item.tinggi || "-")
                    fisik.find(".berat").text(item.berat || "-")
                    fisik.find(".suhu_tubuh").text(item.suhu_tubuh || "-")
                    fisik.find(".tensi").text(item.tensi || "-")
                    fisik.find(".kesadaran").text(item.kesadaran || "-")
                    fisik.find(".gcs").text(item.gcs || "-")
                    fisik.find(".respirasi").text(item.respirasi || "-")
                    fisik.find(".nadi").text(item.nadi || "-")
                    fisik.find(".spo2").text(item.spo2 || "-")
                    fisik.find(".alergi").text(item.alergi || "-")

                    // clone soap
                    const soap = container.find('.template-periksa-soap')
                        .clone()
                        .removeClass('template-periksa-soap d-none')

                    soap.find(".card-header").html(`<i class="bi bi-user"></i>${item.pegawai?.nama}`).addClass(`header-${index}`)

                    soap.find(".keluhan").text(item.keluhan || "-")
                    soap.find(".pemeriksaan").text(item.pemeriksaan || "-")
                    soap.find(".penilaian").text(item.penilaian || "-")
                    soap.find(".rtl").text(item.rtl || "-")
                    soap.find(".instruksi").text(item.instruksi || "-")
                    const headerClass = item.nip?.startsWith("1.") ? "bg-warning text-dark" : "bg-primary text-white";


                    fisik.find(`.header-${index}`).addClass(headerClass)
                    soap.find(`.header-${index}`).addClass(headerClass)
                    // append ke container
                    container.append(fisik).append(soap)
                })
            })
        }




        function setICDPasien(no_rawat) {
            getDiagnosaPasien(no_rawat).done((response) => {
                const bodyDiagnosaPasien = $('.bodyDiagnosaPasien .card-text')
                bodyDiagnosaPasien.empty()
                if (!response.length) {
                    bodyDiagnosaPasien.html('<p class="text-center fw-bold text-danger">Tidak ada diagnosa</p>')
                    return
                }
                const listDiagnosa = response.map((item, index) => {
                    return `<p class="mb-1 ${item.prioritas ===1 ? 'fw-bold' : '' }">${item.prioritas}. ${item.kd_penyakit} - ${item.penyakit.nm_penyakit} ${ item.prioritas===1 ? '<span class="text-danger">*</span>' : ''  }</p>`;
                })
                bodyDiagnosaPasien.html(listDiagnosa)
            })

            getProsedurPasien(no_rawat).done((response) => {
                const bodyProsedurPasien = $('.bodyProsedurPasien .card-text')
                bodyProsedurPasien.empty()
                if (!response.length) {
                    bodyProsedurPasien.html('<p class="text-center fw-bold text-danger">Tidak ada prosedur</p>')
                    return
                }
                const listProsedur = response.map((item, index) => {
                    return `<p class="mb-1">${index + 1}. ${item.kode} - ${item.icd9.deskripsi_pendek}</p>`;
                })
                bodyProsedurPasien.html(listProsedur)
            })

        }
    </script>
@endpush
