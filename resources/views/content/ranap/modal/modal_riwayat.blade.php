<div class="modal fade" id="modalRiwayatV2" tabindex="-1" aria-labelledby="modalRiwayat" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">RIWAYAT PASIEN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-riwayat ">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-2 mb-2">
                        <nav class="navbar navbar-expand-lg bg-light">
                            <div class="container-fluid">
                                <a href="javascript:void(0)" class="nav-brand"></a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav nav flex-column me-auto mb-2 mb-lg-0 nav-tab-riwayat" id="navTabRiwayat">

                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-10">
                        <div class="card">
                            <div class="card-header header-riwayat">
                                <h6></h6>
                            </div>

                            <div class="card-body">
                                <nav class="card-text">
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-pemeriksaan-tab" data-bs-toggle="tab" data-bs-target="#nav-pemeriksaan" type="button" role="tab" aria-controls="nav-pemeriksaan" aria-selected="true">Pemeriksaan</button>
                                        <button class="nav-link" id="nav-resume-tab" data-bs-toggle="tab" data-bs-target="#nav-resume" type="button" role="tab" aria-controls="nav-resume" aria-selected="false">Resume Medis</button>
                                        <button class="nav-link" id="nav-asmed-tab" data-bs-toggle="tab" data-bs-target="#nav-asmed" type="button" role="tab" aria-controls="nav-asmed" aria-selected="false">Asesmen Medis</button>
                                        <button class="nav-link" id="nav-askep-tab" data-bs-toggle="tab" data-bs-target="#nav-askep" type="button" role="tab" aria-controls="nav-askep" aria-selected="false">Asesmen Keperawatan</button>
                                    </div>
                                </nav>
                                <div class="tab-content p-2 content-scrolled" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-pemeriksaan" role="tabpanel" aria-labelledby="nav-pemeriksaan-tab" tabindex="0">
                                        <div class="card-text">
                                            <div class="content-riwayat" id="info"></div>
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
                                            <div class="" id="hasilLab" style="display:none">
                                                <div class="card position-relative mt-2">
                                                    <div class="card-header" aria-controls="collapseHasilLab" data-bs-toggle="collapse" data-bs-target="#collapseHasilLab">
                                                        <span>Hasil Laborat</span>
                                                        <a class="position-absolute top-0 end-0 me-2 mt-2" style="color:#000" data-bs-toggle="collapse" href="#collapseHasilLab" role="button" aria-expanded="false" aria-controls="collapseHasilLab"><i class="bi bi-x"></i></a>
                                                    </div>
                                                    <div class="card-body collapse" id="collapseHasilLab">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="" id="radiologi" style="display:none">
                                                <div class="card position-relative mt-2">
                                                    <div class="card-header">
                                                        <span>Hasil Radiologi</span>
                                                        <a class="position-absolute top-0 end-0 me-2 mt-2" style="color:#000" data-bs-toggle="collapse" href="#collapseHasilRadiologi" role="button" aria-expanded="false" aria-controls="collapseHasilRadiologi"><i class="bi bi-x"></i></a>
                                                    </div>
                                                    <div class="card-body collapse" id="collapseHasilRadiologi">

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
                                    <div class="tab-pane fade" id="nav-asmed" role="tabpanel" aria-labelledby="nav-asmed-tab" tabindex="0">
                                        <div class="card position-relative mt-2" id="riwayatAsmedAnak">
                                            <div class="card-header" data-bs-toggle="collapse" href="#collapseAsmedAnak" role="button" aria-expanded="false" aria-controls="collapseAsmedAnak">
                                                <div class="card-text">
                                                    <span>Asesmen Awal Medis Anak</span>
                                                </div>
                                            </div>
                                            <div class="card-body collapse" id="collapseAsmedAnak">
                                                <div class="card-text">
                                                    <div class="card mb-2">
                                                        <div class="card-body p-2">
                                                            <div class="card-text" id="infoAsmedAnak">

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-text" id="contenAsmedAnak">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card position-relative mt-2" id="riwayatAsmedKandungan">
                                            <div class="card-header" data-bs-toggle="collapse" href="#collapseAsmedKandungan" role="button" aria-expanded="false" aria-controls="collapseAsmedKandungan">
                                                <div class="card-text">
                                                    <span>Asesmen Awal Medis Kandungan</span>
                                                </div>
                                            </div>
                                            <div class="card-body collapse" id="collapseAsmedKandungan">
                                                <div class="card-text">
                                                    <div class="card mb-2">
                                                        <div class="card-body p-2">
                                                            <div class="card-text" id="infoAsmedKandungan">

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-text" id="contenAsmedKandungan">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card position-relative mt-2" id="riwayatAsmedUgd">
                                            <div class="card-header" data-bs-toggle="collapse" href="#collapseAsmedUgd" role="button" aria-expanded="false" aria-controls="collapseAsmedUgd">
                                                <div class="card-text">
                                                    <span>Asesmen Awal Medis UGD</span>
                                                </div>
                                            </div>
                                            <div class="card-body collapse" id="collapseAsmedUgd">


                                                <div class="card-text">
                                                    <div class="card mb-2">
                                                        <div class="card-body p-2">
                                                            <div class="card-text" id="infoAsmedUgd">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card mb-2" id="riwayatTriase">

                                                    </div>

                                                    <div class="card-text" id="contentAsmedUgd">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="nav-askep" role="tabpanel" aria-labelledby="nav-askep-tab" tabindex="0">
                                        @include('content.ranap.riwayat._askepAnakRalan')
                                        <div class="card position-relative mt-2" id="riwayatAskepAnak">
                                            <div class="card-header" data-bs-toggle="collapse" href="#collapseAskepAnak" role="button" aria-expanded="false" aria-controls="collapseAskepAnak">
                                                <div class="card-text">
                                                    <span>Asesmen Awal Keperawatan Anak</span>
                                                </div>
                                            </div>
                                            <div class="card-body collapse" id="collapseAskepAnak">
                                                <div class="card-text">
                                                    <div class="card mb-2">
                                                        <div class="card-body p-2">
                                                            <div class="card-text" id="infoAskepAnak">

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-text" id="contenAskepAnak">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card position-relative mt-2" id="riwayatAskepUgd">
                                            <div class="card-header" data-bs-toggle="collapse" href="#collapseAskepUgd" role="button" aria-expanded="false" aria-controls="collapseAskepUgd">
                                                <div class="card-text">
                                                    <span>Asesmen Awal Keperawatan UGD</span>
                                                </div>
                                            </div>
                                            <div class="card-body collapse" id="collapseAskepUgd">
                                                <div class="card-text">
                                                    <div class="card mb-2">
                                                        <div class="card-body p-2">
                                                            <div class="card-text" id="infoAskepUgd">

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-text" id="contentAskepUgd">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" style="font-size:12px" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>
