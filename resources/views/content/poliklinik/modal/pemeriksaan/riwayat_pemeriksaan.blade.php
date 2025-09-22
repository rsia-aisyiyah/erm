 <div class="row">
     <div class="col-md-12 col-sm-12 col-lg-2 mb-2">
         <nav class="navbar navbar-expand-lg bg-light">
             <div class="container-fluid">
                 <a href="javascript:void(0)" class="nav-brand"></a>
                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarListRiwayatPemeriksaan" aria-controls="navbarListRiwayatPemeriksaan" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                 </button>
                 <div class="collapse navbar-collapse" id="navbarListRiwayatPemeriksaan">
                     <ul class="navbar-nav nav flex-column me-auto mb-2 mb-lg-0 nav-tab-riwayat" id="navTabRiwayatPemeriksaan">

                     </ul>
                 </div>
             </div>
         </nav>
     </div>
     <div class="col-md-12 col-sm-12 col-lg-10">
         <div class="card">
             {{-- <div class="card-header header-riwayat">
                 <h6 class="card-title m-0"></h6>
             </div> --}}

             <div class="card-body">
                 <nav class="card-text">
                     <div class="nav nav-tabs" id="nav-tab-riwayat-pemeriksaan" role="tablist">
                         <button class="nav-link active" id="nav-pemeriksaan-tab" data-bs-toggle="tab" data-bs-target="#nav-pemeriksaan" type="button" role="tab" aria-controls="nav-pemeriksaan" aria-selected="true">Pemeriksaan</button>
                         <button class="nav-link" id="nav-resume-tab" data-bs-toggle="tab" data-bs-target="#nav-resume" type="button" role="tab" aria-controls="nav-resume" aria-selected="false">Resume Medis</button>
                         <button class="nav-link" id="nav-penunjang-tab" data-bs-toggle="tab" data-bs-target="#nav-penunjang" type="button" role="tab" aria-controls="nav-penunjang" aria-selected="false">Penunjang</button>
                     </div>
                 </nav>
                 <div class="tab-content p-2 content-scrolled" id="nav-tabContent">
                     <div class="content-riwayat" id="info"></div>
                     <div class="tab-pane fade show active" id="nav-pemeriksaan" role="tabpanel" aria-labelledby="nav-pemeriksaan-tab" tabindex="0">
                         <div class="card-text">

                             <div class="" id="dxpxPasien" style="display: none">
                                 <div class="card position-relative mt-2">
                                     <div class="card-header" aria-controls="collapseDiagnosaPasien" data-bs-toggle="collapse" data-bs-target="#collapseDiagnosaPasien">
                                         <span>Diagnosa & Prosedur</span>
                                         <a class="position-absolute top-0 end-0 me-2 mt-2" style="color:#000" data-bs-toggle="collapse" href="#collapseDiagnosaPasien" role="button" aria-expanded="false" aria-controls="collapseDiagnosaPasien"><i class="bi bi-x"></i></a>
                                     </div>
                                     <div class="card-body collapse show" id="collapseDiagnosaPasien">
                                         <div class="row">
                                             <div class="col-sm-12 col-md-6 col-lg-6">
                                                 <div class="card" id="cardDiagnosaPasien">
                                                     <div class="card-header">
                                                         Diagnosa
                                                     </div>
                                                     <div class="card-body" id="bodyDiagnosaPasien">
                                                         <div class="card-text">

                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-sm-12 col-md-6 col-lg-6">
                                                 <div class="card" id="cardProsedurPasien">
                                                     <div class="card-header">
                                                         Prosedur
                                                     </div>
                                                     <div class="card-body" id="bodyProsedurPasien">
                                                         <div class="card-text">

                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="" id="laporanOperasi" style="display:none">
                                 <div class="card position-relative mt-2">
                                     <div class="card-header" aria-controls="collapseLaporanOperasi" data-bs-toggle="collapse" data-bs-target="#collapseLaporanOperasi">
                                         <span>Laporan Operasi</span>
                                         <a class="position-absolute top-0 end-0 me-2 mt-2" style="color:#000" data-bs-toggle="collapse" href="#collapseLaporanOperasi" role="button" aria-expanded="false" aria-controls="collapseLaporanOperasi"><i class="bi bi-x"></i></a>
                                     </div>
                                     <div class="card-body collapse show" id="collapseLaporanOperasi">

                                     </div>
                                 </div>
                             </div>
                             <div class="" id="periksaRawatJalan" style="display:none">
                                 <div class="card position-relative mt-2">
                                     <div class="card-header" aria-controls="collapsePemeriksaanRajal" data-bs-toggle="collapse" data-bs-target="#collapsePemeriksaanRajal">
                                         <span>Pemeriksaan Rawat Jalan</span>
                                         <a class="position-absolute top-0 end-0 me-2 mt-2" style="color:#000" data-bs-toggle="collapse" href="#collapsePemeriksaanRajal" role="button" aria-expanded="false" aria-controls="collapsePemeriksaanRajal"><i class="bi bi-x"></i></a>
                                     </div>
                                     <div class="card-body collapse show" id="collapsePemeriksaanRajal">

                                     </div>
                                 </div>
                             </div>

                             <div class="" id="periksaRawatInap" style="display:none">
                                 <div class="card position-relative mt-2">
                                     <div class="card-header" aria-controls="collapsePemeriksaanRanap" data-bs-toggle="collapse" data-bs-target="#collapsePemeriksaanRanap">
                                         <span>Pemeriksaan Rawat Inap</span>
                                         <a class="position-absolute top-0 end-0 me-2 mt-2" style="color:#000" data-bs-toggle="collapse" href="#collapsePemeriksaanRanap" role="button" aria-expanded="false" aria-controls="collapsePemeriksaanRanap"><i class="bi bi-x"></i></a>
                                     </div>
                                     <div class="card-body collapse show" id="collapsePemeriksaanRanap">

                                     </div>
                                 </div>
                             </div>
                             <div class="" id="obat" style="display:none">
                                 <div class="card position-relative mt-2">
                                     <div class="card-header" aria-controls="collapsePemberianObat" data-bs-toggle="collapse" data-bs-target="#collapsePemberianObat">
                                         <span>Pemberian Obat</span>
                                         <a class="position-absolute top-0 end-0 me-2 mt-2" style="color:#000" data-bs-toggle="collapse" href="#collapsePemberianObat" role="button" aria-expanded="false" aria-controls="collapsePemberianObat"><i class="bi bi-x"></i></a>
                                     </div>
                                     <div class="card-body collapse" id="collapsePemberianObat">

                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="tab-pane fade" id="nav-resume" role="tabpanel" aria-labelledby="nav-resume-tab" tabindex="0">
                         <div class="card" id="resumeMedis" style="display: none">
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
                     <div class="tab-pane fade" id="nav-penunjang" role="tabpanel" aria-labelledby="nav-penunjang-tab" tabindex="0">
                         <div class="" id="berkasPenunjang">
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
                         </div>
                         <div class="" id="hasilLab">
                             @include('content.ranap.modal.riwayat._lab')
                         </div>
                         <div class="" id="hasilRadiologi">
                             @include('content.ranap.modal.riwayat._radiologi')
                         </div>
                         {{-- <div class="" id="riwayatSkriningTb">
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
         const navTabRiwayatPemeriksaan = $('#navTabRiwayatPemeriksaan');

         const btnTabRiwayatPemeriksaan = $('button[data-bs-target="#tab-riwayat-pane"]');

         //  btnTabRiwayatPemeriksaan.on('shown.bs.tab', function(e, x, y) {
         //      const no_rkm_medis = formSoapPoli.find('input[name=no_rkm_medis]').val();

         //  })

         function setRiwayatPemeriksaan(no_rkm_medis) {
             getRiwayatPasien(no_rkm_medis, 'DESC').done((response) => {
                 const regPeriksa = response.reg_periksa.map((item, index) => {
                     if (index == 0) {
                         active = 'active';
                         collapse = 'show active';
                         setDetailRawat(item.no_rawat)
                     } else {
                         active = '';
                         collapse = '';
                     }
                     return `<li class="nav-item list">
                                <a class="nav-link link-riwayat ${active}" aria-current="page" href="#" onclick="setDetailRawat('${item.no_rawat}', this)">
                                    ${item.status_lanjut.toUpperCase() == 'RALAN' ? '<i class="bi bi-circle-fill text-warning"></i>' : '<i class="bi bi-circle-fill text-purple"></i>'} ${item.status_lanjut.toUpperCase() } : ${splitTanggal(item.tgl_registrasi)} 
                                    <br><small class="text-muted">${item.poliklinik.nm_poli.length > 20 ? item.poliklinik.nm_poli.substring(0, 20) + '...' : item.poliklinik.nm_poli}</small>
                                    </a>
                            </li>`;
                 })
                 navTabRiwayatPemeriksaan.html(regPeriksa)
             })
         }
         //  btnTabRiwayatPemeriksaan.on('hide.bs.tab', function(e, x, y) {
         //      navTabRiwayatPemeriksaan.empty()
         //  })
     </script>
 @endpush
