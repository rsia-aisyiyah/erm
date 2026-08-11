<div class="modal fade" id="modalCatatanEdukasiPasien" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style="background-color: rgb(0 0 0 / 49%)">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white py-2">
                <h5 class="modal-title fs-6 fw-bold" id="exampleModalLabel"><i class="bi bi-journal-bookmark me-1"></i> Catatan Pelaksanaan Edukasi Pasien (RM 23 &amp; RM 24)</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3">
                <!-- IDENTITAS PASIEN -->
                <form action="" id="formPasienCatatanEdukasi">
                    <div class="row gy-2 bg-light p-2 rounded border mb-2">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="no_rawat" label="No. Rawat"></x-input-group-text>
                                <x-input id="no_rawat" name="no_rawat" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="nm_pasien" label="Pasien"></x-input-group-text>
                                <x-input id="nm_pasien" name="nm_pasien" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="tgl_lahir" label="Tgl. Lahir"></x-input-group-text>
                                <x-input id="tgl_lahir" name="tgl_lahir" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="p_jawab" label="Keluarga"></x-input-group-text>
                                <x-input id="p_jawab" name="p_jawab" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="kamar" label="Kamar"></x-input-group-text>
                                <x-input id="kamar" name="kamar" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="diagnosa_awal" label="Diagnosa"></x-input-group-text>
                                <x-input id="diagnosa_awal" name="diagnosa_awal" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="dokter" label="Dokter"></x-input-group-text>
                                <x-input id="dokter" name="dokter" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="lama" label="Lama"></x-input-group-text>
                                <x-input id="lama" name="lama" readonly />
                            </x-input-group>
                        </div>
                    </div>
                </form>

                <!-- NAV TABS RM 23 & RM 24 -->
                <ul class="nav nav-pills mb-2" id="tabEdukasi" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold py-1 px-3" id="tab-rm23-tab" data-bs-toggle="pill" data-bs-target="#tab-rm23" type="button" role="tab" onclick="switchFormJenis('RM 23')">
                            <i class="bi bi-people-fill me-1"></i> Form RM 23 (Edukasi Multidisiplin PPA)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold py-1 px-3" id="tab-rm24-tab" data-bs-toggle="pill" data-bs-target="#tab-rm24" type="button" role="tab" onclick="switchFormJenis('RM 24')">
                            <i class="bi bi-card-text me-1"></i> Form RM 24 (Edukasi Pasien Terbuka)
                        </button>
                    </li>
                </ul>

                <!-- FORM CATATAN EDUKASI -->
                <form id="formCatatanEdukasiPasien" class="border p-3 rounded bg-white shadow-sm mb-3">
                    <input type="hidden" name="jenis_form" id="jenis_form" value="RM 23" />
                    <input type="hidden" name="ttd_pasien" id="edukasi_ttd_pasien" value="" />

                    <!-- BARIS 1: TANGGAL, DURASI, PETUGAS -->
                    <div class="row gy-2 mb-2">
                        <div class="col-lg-3 col-md-6">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="tanggal" label="Tanggal / Jam"></x-input-group-text>
                                <x-input id="tanggal" name="tanggal" class="datetimepicker" />
                            </x-input-group>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="durasi" label="Durasi"></x-input-group-text>
                                <input type="text" class="form-control" name="durasi" id="durasi" placeholder="misal: 10 Menit" value="10 Menit" />
                            </x-input-group>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="nip" label="Edukator (PPA)" />
                                <x-input id="nip" name="nip" readonly />
                                <x-input id="nama" name="nama" class="w-50" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="nama_penerima" label="Penerima" />
                                <input type="text" class="form-control" name="nama_penerima" id="nama_penerima" placeholder="Nama Pasien / Keluarga" />
                            </x-input-group>
                        </div>
                    </div>

                    <!-- AREA KONTEN MATERI (DINAMIS UNTUK RM 23 vs RM 24) -->
                    <div id="sectionRm23" class="mb-3 p-2 bg-light rounded border">
                        <label class="form-label fw-bold text-primary mb-1"><i class="bi bi-diagram-3 me-1"></i> Pilih Disiplin Profesi (PPA) :</label>
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <input type="radio" class="btn-check" name="disiplin" id="disiplin_dpjp" value="DPJP" autocomplete="off" checked onchange="renderChecklistMateri()">
                            <label class="btn btn-outline-primary btn-sm" for="disiplin_dpjp"><i class="bi bi-person-badge"></i> DPJP (Dokter)</label>

                            <input type="radio" class="btn-check" name="disiplin" id="disiplin_farmasi" value="Farmasi" autocomplete="off" onchange="renderChecklistMateri()">
                            <label class="btn btn-outline-primary btn-sm" for="disiplin_farmasi"><i class="bi bi-capsule"></i> Farmasi</label>

                            <input type="radio" class="btn-check" name="disiplin" id="disiplin_perawat" value="Perawat/Bidan" autocomplete="off" onchange="renderChecklistMateri()">
                            <label class="btn btn-outline-primary btn-sm" for="disiplin_perawat"><i class="bi bi-heart-pulse"></i> Perawat / Bidan</label>

                            <input type="radio" class="btn-check" name="disiplin" id="disiplin_nutrisionis" value="Nutrisionis" autocomplete="off" onchange="renderChecklistMateri()">
                            <label class="btn btn-outline-primary btn-sm" for="disiplin_nutrisionis"><i class="bi bi-egg-fried"></i> Nutrisionis (Gizi)</label>

                            <input type="radio" class="btn-check" name="disiplin" id="disiplin_nyeri" value="Manajemen Nyeri" autocomplete="off" onchange="renderChecklistMateri()">
                            <label class="btn btn-outline-primary btn-sm" for="disiplin_nyeri"><i class="bi bi-shield-plus"></i> Manajemen Nyeri</label>
                        </div>

                        <!-- CHECKLIST MATERI PER DISIPLIN -->
                        <div class="p-2 border rounded bg-white mb-2" id="containerChecklistMateri">
                            <!-- Injected by JS -->
                        </div>
                    </div>

                    <!-- TEXTAREA MATERI / KETIKAN BEBAS (UNTUK RM 24 & CATATAN TAMBAHAN RM 23) -->
                    <div class="mb-2">
                        <label for="materi" class="form-label fw-bold text-secondary mb-1">
                            <span id="labelMateri">Materi Edukasi Tambahan / Keterangan Khusus :</span>
                        </label>
                        <textarea class="form-control" name="materi" id="materi" rows="2" placeholder="Ketik rincian atau materi edukasi yang disampaikan..."></textarea>
                    </div>

                    <!-- METODE -->
                    <div class="mb-2 p-2 bg-light rounded border">
                        <label class="form-label fw-bold d-block mb-1 text-primary"><i class="bi bi-chat-dots me-1"></i> Metode Pembelajaran (Dapat Dipilih Lebih Dari 1) :</label>
                        <div class="d-flex flex-wrap gap-3">
                            <div class="form-check">
                                <input class="form-check-input check-metode" type="checkbox" name="metode[]" id="metode_diskusi" value="Diskusi / Wawancara" checked>
                                <label class="form-check-label fw-semibold" for="metode_diskusi">a. Diskusi / Wawancara</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input check-metode" type="checkbox" name="metode[]" id="metode_simulasi" value="Simulasi (S)">
                                <label class="form-check-label" for="metode_simulasi">b. Simulasi (S)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input check-metode" type="checkbox" name="metode[]" id="metode_demo" value="Demonstrasi (Demo)">
                                <label class="form-check-label" for="metode_demo">c. Demonstrasi (Demo)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input check-metode" type="checkbox" name="metode[]" id="metode_ceramah" value="Ceramah">
                                <label class="form-check-label" for="metode_ceramah">d. Ceramah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input check-metode" type="checkbox" name="metode[]" id="metode_observasi" value="Observasi (O)">
                                <label class="form-check-label" for="metode_observasi">e. Observasi (O)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input check-metode" type="checkbox" name="metode[]" id="metode_pl" value="Praktek Langsung (PL)">
                                <label class="form-check-label" for="metode_pl">f. Praktek Langsung (PL)</label>
                            </div>
                        </div>
                    </div>

                    <!-- HAMBATAN & INTERVENSI -->
                    <div class="row gy-2 mb-2">
                        <div class="col-lg-6 col-md-12">
                            <div class="p-2 border rounded bg-light h-100">
                                <label class="form-label fw-bold mb-1 text-danger"><i class="bi bi-exclamation-triangle me-1"></i> Hambatan (Dapat Dipilih Lebih Dari 1) :</label>
                                <div class="row g-1">
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_tidak_ada" value="Tidak Ada" checked>
                                            <label class="form-check-label small fw-bold" for="hambatan_tidak_ada">Tidak Ada</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_bahasa" value="Bahasa">
                                            <label class="form-check-label small" for="hambatan_bahasa">Bahasa</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_harapan" value="Kehilangan Harapan">
                                            <label class="form-check-label small" for="hambatan_harapan">Kehilangan Harapan</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_keuangan" value="Masalah Keuangan">
                                            <label class="form-check-label small" for="hambatan_keuangan">Masalah Keuangan</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_kesalahan" value="Kesalahan">
                                            <label class="form-check-label small" for="hambatan_kesalahan">Kesalahan</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_budaya" value="Faktor Budaya">
                                            <label class="form-check-label small" for="hambatan_budaya">Faktor Budaya</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_sensori" value="Kelemahan Sensori">
                                            <label class="form-check-label small" for="hambatan_sensori">Kelemahan Sensori</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_pede" value="Tidak Percaya Diri">
                                            <label class="form-check-label small" for="hambatan_pede">Tidak Percaya Diri</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_menyangkal" value="Menyangkal">
                                            <label class="form-check-label small" for="hambatan_menyangkal">Menyangkal</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_cemas" value="Kecemasan/ketakutan">
                                            <label class="form-check-label small" for="hambatan_cemas">Kecemasan/ketakutan</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_kognitif" value="Kelemahan Kognitif">
                                            <label class="form-check-label small" for="hambatan_kognitif">Kelemahan Kognitif</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_tertarik" value="Tidak tertarik/tidak berminat">
                                            <label class="form-check-label small" for="hambatan_tertarik">Tidak Tertarik</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center gap-2 mt-1">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input check-hambatan" type="checkbox" name="hambatan[]" id="hambatan_lain_chk" value="Lain-lain">
                                                <label class="form-check-label small" for="hambatan_lain_chk">Lain-lain</label>
                                            </div>
                                            <input type="text" id="hambatan_lain" name="hambatan_lain" class="form-control form-control-sm py-0" placeholder="Sebutkan hambatan lain..." disabled style="height: 28px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="p-2 border rounded bg-light h-100">
                                <label class="form-label fw-bold mb-1 text-success"><i class="bi bi-tools me-1"></i> Intervensi Mengatasi Hambatan (Dapat Dipilih Lebih Dari 1) :</label>
                                <div class="row g-1">
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-intervensi" type="checkbox" name="intervensi[]" id="intervensi_tidak_ada" value="Tidak Ada" checked>
                                            <label class="form-check-label small fw-bold" for="intervensi_tidak_ada">Tidak Ada</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-intervensi" type="checkbox" name="intervensi[]" id="intervensi_penerjemah" value="Menyediakan Penerjemah">
                                            <label class="form-check-label small" for="intervensi_penerjemah">Menyediakan Penerjemah</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-intervensi" type="checkbox" name="intervensi[]" id="intervensi_budaya" value="Melakukan pendekatan secara budaya/agama">
                                            <label class="form-check-label small" for="intervensi_budaya">Pendekatan Budaya/Agama</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-intervensi" type="checkbox" name="intervensi[]" id="intervensi_ulangi" value="Mengulangi materi">
                                            <label class="form-check-label small" for="intervensi_ulangi">Mengulangi Materi</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-intervensi" type="checkbox" name="intervensi[]" id="intervensi_keluarga" value="Melibatkan keluarga terdekat">
                                            <label class="form-check-label small" for="intervensi_keluarga">Melibatkan Keluarga</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input check-intervensi" type="checkbox" name="intervensi[]" id="intervensi_rolemodel" value="Melakukan pendekatan dengan cara memakai role model untuk merubah perilaku">
                                            <label class="form-check-label small" for="intervensi_rolemodel">Memakai Role Model</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center gap-2 mt-1">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input check-intervensi" type="checkbox" name="intervensi[]" id="intervensi_lain_chk" value="Lain-lain">
                                                <label class="form-check-label small" for="intervensi_lain_chk">Lain-lain</label>
                                            </div>
                                            <input type="text" id="intervensi_lain" name="intervensi_lain" class="form-control form-control-sm py-0" placeholder="Sebutkan intervensi lain..." disabled style="height: 28px;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- EVALUASI & TANDA TANGAN PASIEN -->
                    <div class="row gy-2">
                        <div class="col-lg-6 col-md-12">
                            <div class="p-2 border rounded bg-light h-100">
                                <label class="form-label fw-bold mb-1 text-primary"><i class="bi bi-check2-circle me-1"></i> Evaluasi Pemahaman Pasien / Keluarga :</label>
                                <x-input-group>
                                    <x-radio-group name="evaluasi"
                                        :radios="[
                                            'evaluasi1' => ['value' => 'Tidak mengerti', 'label' => 'Tidak Mengerti'],
                                            'evaluasi2' => ['value' => 'Mengerti, tidak mampu menjelaskan/melakukan', 'label' => 'Mengerti, Tidak Mampu Menjelaskan'],
                                            'evaluasi3' => ['value' => 'Mengerti, mampu menjelaskan/melakukan', 'label' => 'Mengerti & Mampu Menjelaskan/Melakukan', 'checked' => true],
                                        ]" />
                                </x-input-group>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="p-2 border rounded bg-light h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <label class="form-label fw-bold mb-1"><i class="bi bi-pen me-1"></i> Bukti Tanda Tangan Pasien / Keluarga :</label>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="openSignatureModalEdukasi()">
                                            <i class="bi bi-pencil-square"></i> Bubuhkan Tanda Tangan
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm" id="btnHapusTtdEdukasi" onclick="clearSignatureEdukasi()" style="display: none;">
                                            <i class="bi bi-trash"></i> Hapus TTD
                                        </button>
                                    </div>
                                </div>
                                <div id="previewTtdEdukasiWrapper" class="mt-2 text-center border p-1 rounded bg-white" style="display: none;">
                                    <span class="text-muted d-block small mb-1">Preview Tanda Tangan Tersimpan:</span>
                                    <img id="previewTtdEdukasiImg" src="" height="50" style="max-width: 120px;" />
                                </div>
                            </div>
                        </div>
                    </div>
                    @csrf
                </form>

                <!-- TABEL RIWAYAT EDUKASI -->
                <div class="d-flex justify-content-between align-items-center mb-1 mt-2">
                    <span class="fw-bold fs-6 text-dark"><i class="bi bi-table me-1"></i> Riwayat Pelaksanaan Edukasi Pasien :</span>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-primary active" id="filterTableSemua" onclick="filterTableCatatan('Semua')">Semua</button>
                        <button type="button" class="btn btn-outline-primary" id="filterTableRm23" onclick="filterTableCatatan('RM 23')">RM 23</button>
                        <button type="button" class="btn btn-outline-primary" id="filterTableRm24" onclick="filterTableCatatan('RM 24')">RM 24</button>
                    </div>
                </div>

                <div class="table-responsive" style="max-height: 220px; overflow-y: auto;">
                    <table class="table table-striped table-hover table-bordered table-sm" id="tableCatatanEdukasiPasien" style="font-size: 11.5px;">
                        <thead class="table-dark sticky-top">
                            <tr>
                                <th width="3%">#</th>
                                <th width="8%">Form</th>
                                <th width="12%">Disiplin</th>
                                <th>Materi Edukasi</th>
                                <th width="13%">Tgl &amp; Durasi</th>
                                <th width="11%">Metode</th>
                                <th width="14%">Hambatan &amp; Intervensi</th>
                                <th width="12%">Evaluasi</th>
                                <th width="8%">TTD Pasien</th>
                                <th width="10%">Edukator</th>
                                <th width="5%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loaded via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- MODAL FOOTER DENGAN TOMBOL CETAK RM 23 & RM 24 -->
            <div class="modal-footer d-flex justify-content-between">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-warning btn-sm fw-bold" onclick="cetakCatatanEdukasi('rm23')">
                        <i class="bi bi-printer-fill me-1"></i> Cetak RM 23 (Multidisiplin)
                    </button>
                    <button type="button" class="btn btn-info btn-sm text-white fw-bold" onclick="cetakCatatanEdukasi('rm24')">
                        <i class="bi bi-printer-fill me-1"></i> Cetak RM 24 (Edukasi Pasien)
                    </button>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary btn-sm fw-bold" onclick="simpanCatatanEdukasi()">
                        <i class="bi bi-save me-1"></i> Simpan Catatan Edukasi
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Keluar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SUB-MODAL CANVAS TANDA TANGAN PASIEN/KELUARGA -->
<div class="modal fade" id="modalSignatureEdukasi" tabindex="-1" aria-hidden="true" style="background-color: rgba(0,0,0,0.6); z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-dark text-white py-2">
                <h6 class="modal-title mb-0"><i class="bi bi-pen me-1"></i> Tanda Tangan Pasien / Keluarga (Edukasi)</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-3">
                <p class="text-muted small mb-2">Silakan bubuhkan tanda tangan pasien/keluarga pada area kotak di bawah ini:</p>
                <div style="border: 2px dashed #0d6efd; border-radius: 8px; display: inline-block; background-color: #fafafa;">
                    <canvas id="canvasSignatureEdukasi" width="400" height="200" style="touch-action: none; cursor: crosshair;"></canvas>
                </div>
            </div>
            <div class="modal-footer py-1 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="resetCanvasEdukasi()"><i class="bi bi-arrow-counterclockwise"></i> Reset Garis</button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="applySignatureEdukasi()"><i class="bi bi-check2"></i> Gunakan Tanda Tangan</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        const modalCatatanEdukasiPasien = $('#modalCatatanEdukasiPasien');
        const formCatatanEdukasiPasien = $('#formCatatanEdukasiPasien');
        const formPasienCatatanEdukasi = $('#formPasienCatatanEdukasi');
        const tableCatatanEdukasiPasien = $('#tableCatatanEdukasiPasien');
        const modalSignatureEdukasi = $('#modalSignatureEdukasi');

        let rawCatatanEdukasiList = [];
        let activeFilterJenis = 'Semua';

        // Master Checklist RM 23 Berdasarkan Disiplin
        const masterChecklistRm23 = {
            'DPJP': [
                'Kondisi Pasien',
                'Usulan Pengobatan',
                'Nama individu yang memberikan pengobatan',
                'Potensi manfaat dan kekurangannya',
                'Kemungkinan alternatif',
                'Kemungkinan keberhasilan',
                'Kemungkinan timbulnya masalah selama masa pemulihan',
                'Kemungkinan yang terjadi apabila tidak diobat',
                'Lain-lain (Catatan Tambahan)'
            ],
            'Farmasi': [
                'Obat-obatan yang di dapat pasien',
                'Aturan pemakaian dan dosis obat',
                'Efek samping obat',
                'Kontra Indikasi obat',
                'Interaksi obat',
                'Lain-lain (Catatan Tambahan)'
            ],
            'Perawat/Bidan': [
                'Penggunaan peralatan medis yg aman',
                'Pencegahan & pengendalian infeksi (Cuci tangan / Lainnya)',
                'Pendidikan kesehatan berkelanjutan',
                'Orientasi Ruangan',
                'Hak dan Kewajiban pasien',
                'Lain-lain (Catatan Tambahan)'
            ],
            'Nutrisionis': [
                'Status gizi & pelayanan makanan RS',
                'Diet selama perawatan',
                'Diet untuk di rumah',
                'Penyimpanan makanan / cegah kontaminasi',
                'Lain-lain (Catatan Tambahan)'
            ],
            'Manajemen Nyeri': [
                'a. Farmakologi',
                'b. Non farmakologi (Relaksasi / Distraksi / Massage / Kompres)',
                'Lain-lain (Catatan Tambahan)'
            ]
        };

        // Inisialisasi Canvas TTD
        let canvasEdukasi = document.getElementById('canvasSignatureEdukasi');
        let ctxEdukasi = canvasEdukasi.getContext('2d');
        let isDrawingEdukasi = false;
        let isCanvasEmptyEdukasi = true;

        function getCanvasMousePos(canvas, evt) {
            let rect = canvas.getBoundingClientRect();
            return {
                x: (evt.clientX - rect.left) * (canvas.width / rect.width),
                y: (evt.clientY - rect.top) * (canvas.height / rect.height)
            };
        }

        function getCanvasTouchPos(canvas, evt) {
            let rect = canvas.getBoundingClientRect();
            let touch = evt.touches[0];
            return {
                x: (touch.clientX - rect.left) * (canvas.width / rect.width),
                y: (touch.clientY - rect.top) * (canvas.height / rect.height)
            };
        }

        canvasEdukasi.addEventListener('mousedown', function(e) {
            isDrawingEdukasi = true;
            isCanvasEmptyEdukasi = false;
            let pos = getCanvasMousePos(canvasEdukasi, e);
            ctxEdukasi.beginPath();
            ctxEdukasi.moveTo(pos.x, pos.y);
        });

        canvasEdukasi.addEventListener('mousemove', function(e) {
            if (!isDrawingEdukasi) return;
            let pos = getCanvasMousePos(canvasEdukasi, e);
            ctxEdukasi.lineWidth = 2.5;
            ctxEdukasi.lineCap = 'round';
            ctxEdukasi.strokeStyle = '#000';
            ctxEdukasi.lineTo(pos.x, pos.y);
            ctxEdukasi.stroke();
        });

        window.addEventListener('mouseup', function() {
            isDrawingEdukasi = false;
        });

        canvasEdukasi.addEventListener('touchstart', function(e) {
            e.preventDefault();
            isDrawingEdukasi = true;
            isCanvasEmptyEdukasi = false;
            let pos = getCanvasTouchPos(canvasEdukasi, e);
            ctxEdukasi.beginPath();
            ctxEdukasi.moveTo(pos.x, pos.y);
        }, { passive: false });

        canvasEdukasi.addEventListener('touchmove', function(e) {
            e.preventDefault();
            if (!isDrawingEdukasi) return;
            let pos = getCanvasTouchPos(canvasEdukasi, e);
            ctxEdukasi.lineWidth = 2.5;
            ctxEdukasi.lineCap = 'round';
            ctxEdukasi.strokeStyle = '#000';
            ctxEdukasi.lineTo(pos.x, pos.y);
            ctxEdukasi.stroke();
        }, { passive: false });

        canvasEdukasi.addEventListener('touchend', function(e) {
            e.preventDefault();
            isDrawingEdukasi = false;
        }, { passive: false });

        function resetCanvasEdukasi() {
            ctxEdukasi.clearRect(0, 0, canvasEdukasi.width, canvasEdukasi.height);
            isCanvasEmptyEdukasi = true;
        }

        function openSignatureModalEdukasi() {
            resetCanvasEdukasi();
            modalSignatureEdukasi.modal('show');
        }

        function applySignatureEdukasi() {
            if (isCanvasEmptyEdukasi) {
                Swal.fire('Peringatan', 'Kanvas tanda tangan masih kosong', 'warning');
                return;
            }
            let dataUrl = canvasEdukasi.toDataURL('image/png');
            $('#edukasi_ttd_pasien').val(dataUrl);
            $('#previewTtdEdukasiImg').attr('src', dataUrl);
            $('#previewTtdEdukasiWrapper').show();
            $('#btnHapusTtdEdukasi').show();
            modalSignatureEdukasi.modal('hide');
        }

        function clearSignatureEdukasi() {
            $('#edukasi_ttd_pasien').val('');
            $('#previewTtdEdukasiImg').attr('src', '');
            $('#previewTtdEdukasiWrapper').hide();
            $('#btnHapusTtdEdukasi').hide();
        }

        function switchFormJenis(jenis) {
            $('#jenis_form').val(jenis);
            if (jenis === 'RM 23') {
                $('#sectionRm23').show();
                $('#labelMateri').text('Materi Edukasi Tambahan / Keterangan Khusus :');
                $('#materi').attr('placeholder', 'Ketik catatan materi tambahan jika diperlukan...');
                renderChecklistMateri();
            } else {
                $('#sectionRm23').hide();
                $('#labelMateri').text('Materi Edukasi (RM 24) :');
                $('#materi').attr('placeholder', 'Ketik materi edukasi yang disampaikan ke pasien (contoh: Edukasi penanganan demam)...');
            }
        }

        function renderChecklistMateri(selectedItems = []) {
            let disiplin = $('input[name="disiplin"]:checked').val() || 'DPJP';
            let items = masterChecklistRm23[disiplin] || [];
            let container = $('#containerChecklistMateri');
            container.empty();

            let html = `
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label fw-bold small text-muted mb-0">Checklist Poin Materi Standar (${disiplin}) :</label>
                    <div class="form-check form-check-inline m-0">
                        <input class="form-check-input" type="checkbox" id="checkAllMateri" style="cursor: pointer;">
                        <label class="form-check-label small fw-bold text-primary" for="checkAllMateri" style="cursor: pointer;">
                            <i class="bi bi-check-all"></i> Centang Semua
                        </label>
                    </div>
                </div>
                <div class="row gy-1">`;
            items.forEach((item, idx) => {
                let isChecked = selectedItems.includes(item) ? 'checked' : '';
                html += `
                    <div class="col-md-6 col-sm-12">
                        <div class="form-check form-check-sm">
                            <input class="form-check-input check-materi-item" type="checkbox" value="${item}" id="chk_materi_${idx}" ${isChecked}>
                            <label class="form-check-label small" for="chk_materi_${idx}">${item}</label>
                        </div>
                    </div>
                `;
            });
            html += `</div>`;
            container.html(html);

            let allChecked = items.length > 0 && selectedItems.length === items.length;
            $('#checkAllMateri').prop('checked', allChecked);
        }

        $(document).on('change', '#checkAllMateri', function() {
            let isChecked = $(this).is(':checked');
            $('.check-materi-item').prop('checked', isChecked);
        });

        $(document).on('change', '.check-materi-item', function() {
            let total = $('.check-materi-item').length;
            let checked = $('.check-materi-item:checked').length;
            $('#checkAllMateri').prop('checked', total > 0 && total === checked);

            if ($(this).val() === 'Lain-lain (Catatan Tambahan)' && $(this).is(':checked')) {
                $('#materi').focus();
            }
        });

        // Event handler checkbox hambatan (eksklusif Tidak Ada vs opsi lain)
        $(document).on('change', '.check-hambatan', function() {
            let val = $(this).val();
            let isChecked = $(this).is(':checked');

            if (val === 'Tidak Ada' && isChecked) {
                $('.check-hambatan').not('#hambatan_tidak_ada').prop('checked', false);
                $('#hambatan_lain').attr('disabled', 'disabled').val('');
            } else if (val !== 'Tidak Ada' && isChecked) {
                $('#hambatan_tidak_ada').prop('checked', false);
            }

            if ($('#hambatan_lain_chk').is(':checked')) {
                $('#hambatan_lain').removeAttr('disabled').focus();
            } else {
                $('#hambatan_lain').attr('disabled', 'disabled').val('');
            }

            if (!$('.check-hambatan:checked').length) {
                $('#hambatan_tidak_ada').prop('checked', true);
            }
        });

        // Event handler checkbox intervensi (eksklusif Tidak Ada vs opsi lain)
        $(document).on('change', '.check-intervensi', function() {
            let val = $(this).val();
            let isChecked = $(this).is(':checked');

            if (val === 'Tidak Ada' && isChecked) {
                $('.check-intervensi').not('#intervensi_tidak_ada').prop('checked', false);
                $('#intervensi_lain').attr('disabled', 'disabled').val('');
            } else if (val !== 'Tidak Ada' && isChecked) {
                $('#intervensi_tidak_ada').prop('checked', false);
            }

            if ($('#intervensi_lain_chk').is(':checked')) {
                $('#intervensi_lain').removeAttr('disabled').focus();
            } else {
                $('#intervensi_lain').attr('disabled', 'disabled').val('');
            }

            if (!$('.check-intervensi:checked').length) {
                $('#intervensi_tidak_ada').prop('checked', true);
            }
        });

        function catatanEdukasiPasien(no_rawat) {
            modalCatatanEdukasiPasien.modal('show');
            const nip = "{{ session()->get('pegawai')->nik }}";
            const nm_petugas = "{{ session()->get('pegawai')->nama }}";
            const tanggal = moment().format('DD-MM-YYYY HH:mm:ss');

            formCatatanEdukasiPasien.find('input[name=nip]').val(nip);
            formCatatanEdukasiPasien.find('input[name=nama]').val(nm_petugas);
            formCatatanEdukasiPasien.find('input[name=tanggal]').val(tanggal);
            formCatatanEdukasiPasien.find('input[name=durasi]').val('10 Menit');
            clearSignatureEdukasi();
            switchFormJenis('RM 23');

            getRegPeriksa(no_rawat).done((response) => {
                const { pasien, dokter, kamar_inap } = response;
                const kamar = (kamar_inap || []).filter((item) => item.stts_pulang !== 'Pindah Kamar');
                const bangsal = kamar.map((item) => item.kamar.bangsal.nm_bangsal).join('');
                const diagnosa = (kamar_inap || []).map((item) => item.diagnosa_awal).join('');
                const lama = (kamar_inap || []).map((item) => item.lama).join('');

                formPasienCatatanEdukasi.find('input[name=no_rawat]').val(no_rawat);
                formPasienCatatanEdukasi.find('input[name=nm_pasien]').val(`${response.no_rkm_medis} - ${response.pasien.nm_pasien} (${response.pasien.jk})`);
                formPasienCatatanEdukasi.find('input[name=tgl_lahir]').val(`${formatTanggal(response.pasien.tgl_lahir)} / ${response.umurdaftar} ${response.sttsumur}`);
                formPasienCatatanEdukasi.find('input[name=umur]').val(`${response.umurdaftar} ${response.sttsumur}`);
                formPasienCatatanEdukasi.find('input[name=p_jawab]').val(response.p_jawab);
                formPasienCatatanEdukasi.find('input[name=kamar]').val(bangsal);
                formPasienCatatanEdukasi.find('input[name=diagnosa_awal]').val(diagnosa);
                formPasienCatatanEdukasi.find('input[name=dokter]').val(dokter ? dokter.nm_dokter : '-');
                formPasienCatatanEdukasi.find('input[name=lama]').val(`${hitungLamaHari(response.tgl_registrasi)} Hari`);

                formCatatanEdukasiPasien.find('input[name=nama_penerima]').val(response.p_jawab || response.pasien.nm_pasien);

                renderCatatanEdukasiPasien(no_rawat);
            });
        }

        function renderCatatanEdukasiPasien(no_rawat) {
            tableCatatanEdukasiPasien.find('tbody').empty();
            $.get(`${url}/catatan/pelaksanaan/edukasi/pasien`, { no_rawat: no_rawat }).done((response) => {
                rawCatatanEdukasiList = response || [];
                displayFilteredTable();
            });
        }

        function filterTableCatatan(jenis) {
            activeFilterJenis = jenis;
            $('#filterTableSemua, #filterTableRm23, #filterTableRm24').removeClass('active');
            if (jenis === 'Semua') $('#filterTableSemua').addClass('active');
            if (jenis === 'RM 23') $('#filterTableRm23').addClass('active');
            if (jenis === 'RM 24') $('#filterTableRm24').addClass('active');
            displayFilteredTable();
        }

        function displayFilteredTable() {
            tableCatatanEdukasiPasien.find('tbody').empty();
            let filtered = rawCatatanEdukasiList;
            if (activeFilterJenis !== 'Semua') {
                filtered = rawCatatanEdukasiList.filter(item => (item.jenis_form || 'RM 23') === activeFilterJenis);
            }

            if (!filtered || !filtered.length) {
                tableCatatanEdukasiPasien.find('tbody').html(`<tr><td colspan="11" class="text-center text-muted py-3">Belum ada data catatan edukasi pasien</td></tr>`);
                return;
            }

            const dataCatatan = filtered.map((item, index) => {
                let badgeClass = item.jenis_form === 'RM 24' ? 'bg-info' : 'bg-primary';
                let ttdHtml = '-';
                if (item.ttd_pasien) {
                    let ttdUrl = item.ttd_pasien;
                    if (!ttdUrl.startsWith('data:image') && !ttdUrl.startsWith('http')) {
                        ttdUrl = '{{ asset("storage") }}/' + ttdUrl.replace(/^\/+/, '');
                    }
                    ttdHtml = `<img src="${ttdUrl}" height="28" style="max-width: 60px;" alt="TTD" /><br><span style="font-size: 9px;">${item.nama_penerima || ''}</span>`;
                }

                let materiClean = (item.materi || '').replace(/\n/g, '<br>');

                return `<tr>
                    <td class="text-center">${index + 1}</td>
                    <td class="text-center"><span class="badge ${badgeClass}">${item.jenis_form || 'RM 23'}</span></td>
                    <td class="fw-bold text-primary">${item.disiplin || '-'}</td>
                    <td>${materiClean}</td>
                    <td class="text-center">${item.tanggal}<br><strong class="text-success">${item.durasi || ''}</strong></td>
                    <td class="text-center">${item.metode || '-'}</td>
                    <td>
                        <small><strong>H:</strong> ${item.hambatan_lain ? item.hambatan_lain : (item.hambatan || 'Tidak Ada')}</small><br>
                        <small><strong>I:</strong> ${item.intervensi_lain ? item.intervensi_lain : (item.intervensi || 'Tidak Ada')}</small>
                    </td>
                    <td><small>${item.evaluasi || '-'}</small></td>
                    <td class="text-center">${ttdHtml}</td>
                    <td class="text-center"><small class="fw-bold">${item.petugas ? item.petugas.nama : (item.dokter ? item.dokter.nm_dokter : item.nip)}</small></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm py-0 px-1" title="Hapus" onclick="deleteCatatanEdukasiPasien('${item.no_rawat}', '${item.tanggal}', '${item.nip}')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>`;
            });
            tableCatatanEdukasiPasien.find('tbody').append(dataCatatan);
        }

        function simpanCatatanEdukasi() {
            const jenisForm = $('#jenis_form').val() || 'RM 23';
            let finalMateriLines = [];

            if (jenisForm === 'RM 23') {
                $('.check-materi-item:checked').each(function() {
                    if ($(this).val() !== 'Lain-lain (Catatan Tambahan)') {
                        finalMateriLines.push($(this).val());
                    }
                });
            }

            let textTambahan = $('#materi').val().trim();
            if (textTambahan) {
                finalMateriLines.push(textTambahan);
            }

            if (!finalMateriLines.length) {
                Swal.fire('Peringatan', 'Silakan pilih minimal 1 checklist materi atau ketik materi edukasi!', 'warning');
                return;
            }

            const data = getDataForm('#formCatatanEdukasiPasien', ['input', 'select', 'textarea']);
            data['no_rawat'] = formPasienCatatanEdukasi.find('input[name=no_rawat]').val();
            data['jenis_form'] = jenisForm;
            data['materi'] = finalMateriLines.join("\n");

            let metodeArr = [];
            $('.check-metode:checked').each(function() { metodeArr.push($(this).val()); });
            data['metode'] = metodeArr.length ? metodeArr.join(', ') : 'Diskusi / Wawancara';

            let hambatanArr = [];
            $('.check-hambatan:checked').each(function() {
                if ($(this).val() !== 'Lain-lain') {
                    hambatanArr.push($(this).val());
                }
            });
            if ($('#hambatan_lain_chk').is(':checked') && $('#hambatan_lain').val().trim()) {
                hambatanArr.push('Lain-lain: ' + $('#hambatan_lain').val().trim());
            } else if ($('#hambatan_lain_chk').is(':checked')) {
                hambatanArr.push('Lain-lain');
            }
            data['hambatan'] = hambatanArr.length ? hambatanArr.join(', ') : 'Tidak Ada';
            data['hambatan_lain'] = $('#hambatan_lain_chk').is(':checked') ? $('#hambatan_lain').val() : '';

            let intervensiArr = [];
            $('.check-intervensi:checked').each(function() {
                if ($(this).val() !== 'Lain-lain') {
                    intervensiArr.push($(this).val());
                }
            });
            if ($('#intervensi_lain_chk').is(':checked') && $('#intervensi_lain').val().trim()) {
                intervensiArr.push('Lain-lain: ' + $('#intervensi_lain').val().trim());
            } else if ($('#intervensi_lain_chk').is(':checked')) {
                intervensiArr.push('Lain-lain');
            }
            data['intervensi'] = intervensiArr.length ? intervensiArr.join(', ') : 'Tidak Ada';
            data['intervensi_lain'] = $('#intervensi_lain_chk').is(':checked') ? $('#intervensi_lain').val() : '';

            const tanggalArr = data['tanggal'].split(' ');
            if (tanggalArr.length > 1) {
                data['tanggal'] = `${splitTanggal(tanggalArr[0])} ${tanggalArr[1]}`;
            }

            $.post(`${url}/catatan/pelaksanaan/edukasi/pasien`, data).done((response) => {
                alertSuccessAjax(response).then(() => {
                    renderCatatanEdukasiPasien(data['no_rawat']);
                    $('#materi').val('');
                    $('.check-materi-item').prop('checked', false);
                    $('#checkAllMateri').prop('checked', false);
                    clearSignatureEdukasi();

                    // Reset checklist metode, hambatan, intervensi ke default
                    $('.check-metode').prop('checked', false);
                    $('#metode_diskusi').prop('checked', true);
                    $('.check-hambatan').prop('checked', false);
                    $('#hambatan_tidak_ada').prop('checked', true);
                    $('.check-intervensi').prop('checked', false);
                    $('#intervensi_tidak_ada').prop('checked', true);

                    const nip = "{{ session()->get('pegawai')->nik }}";
                    const nm_petugas = "{{ session()->get('pegawai')->nama }}";
                    const tanggal = moment().format('DD-MM-YYYY HH:mm:ss');

                    formCatatanEdukasiPasien.find('input[name=nip]').val(nip);
                    formCatatanEdukasiPasien.find('input[name=nama]').val(nm_petugas);
                    formCatatanEdukasiPasien.find('input[name=tanggal]').val(tanggal);
                    formCatatanEdukasiPasien.find('#hambatan_lain').attr('disabled', 'disabled').val('');
                    formCatatanEdukasiPasien.find('#intervensi_lain').attr('disabled', 'disabled').val('');
                });
            }).fail((error) => {
                alertErrorAjax(error);
            });
        }

        function deleteCatatanEdukasiPasien(no_rawat, tanggal, nip) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Data edukasi yang dihapus tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`${url}/catatan/pelaksanaan/edukasi/pasien/delete`, {
                        no_rawat: no_rawat,
                        tanggal: tanggal,
                        nip: nip,
                        _token: "{{ csrf_token() }}"
                    }).done((response) => {
                        alertSuccessAjax(response).then(() => {
                            renderCatatanEdukasiPasien(no_rawat);
                        });
                    }).fail((error) => {
                        alertErrorAjax(error);
                    });
                }
            });
        }

        function cetakCatatanEdukasi(tipe) {
            let no_rawat = formPasienCatatanEdukasi.find('input[name=no_rawat]').val();
            if (!no_rawat) {
                Swal.fire('Peringatan', 'Nomor rawat tidak ditemukan', 'warning');
                return;
            }
            let cleanNoRawat = no_rawat.replace(/\//g, '-');
            let printUrl = `${url}/catatan/pelaksanaan/edukasi/pasien/print/${tipe}?no_rawat=${cleanNoRawat}`;
            window.open(printUrl, '_blank');
        }
    </script>
@endpush
