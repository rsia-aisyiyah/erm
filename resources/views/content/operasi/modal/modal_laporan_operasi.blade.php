<!-- Modal Pengisian Laporan Operasi Komprehensif -->
<div class="modal fade" id="modalLaporanOperasi" tabindex="-1" aria-labelledby="modalLaporanOperasiLabel" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0 shadow">
            
            <!-- Header Modal -->
            <div class="modal-header bg-primary text-white py-2 px-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-medical-fill fs-5"></i>
                    <div>
                        <h6 class="modal-title fw-bold mb-0" id="modalLaporanOperasiLabel">LAPORAN OPERASI</h6>
                        <small class="text-white-50" style="font-size: 11px;">Rekam Medis Laporan Pembedahan Kamar Operasi (IBS)</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-outline-light btn-sm py-0.5 px-2 d-none" id="btnCetakLaporanModal" onclick="cetakLaporanOperasiAktif()" style="font-size: 11.5px;">
                        <i class="bi bi-printer me-1"></i> Cetak PDF
                    </button>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <!-- Body Modal -->
            <div class="modal-body p-3 bg-light" style="max-height: calc(100vh - 160px); overflow-y: auto;">
                <form id="formLaporanOperasi">
                    <input type="hidden" id="laporan_no_rawat" name="no_rawat">

                    <!-- Kartu Identitas Pasien -->
                    <div class="card border-0 shadow-sm rounded-3 mb-2.5 bg-white border-start border-primary border-4 p-2.5">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h6 class="fw-bold text-dark mb-0.5" id="lblLaporanNamaPasien">-</h6>
                                <div class="text-muted small" style="font-size: 11.5px;">
                                    <span>No. RM: <strong id="lblLaporanNoRm" class="font-monospace text-primary">-</strong></span> &bull; 
                                    <span>No. Rawat: <strong id="lblLaporanNoRawat" class="font-monospace">-</strong></span> &bull; 
                                    <span>Kamar: <span id="lblLaporanKamar" class="badge bg-secondary">-</span></span> &bull; 
                                    <span>JK / Tgl Lahir: <span id="lblLaporanJkLahir">-</span></span>
                                </div>
                            </div>
                            <span class="badge bg-primary-subtle text-primary border border-primary px-2.5 py-1 rounded-pill" style="font-size: 11px;">
                                <i class="bi bi-person-badge me-1"></i> Instalasi Bedah Sentral
                            </span>
                        </div>
                    </div>

                    <!-- Section 1: Informasi Waktu & Kategori -->
                    <div class="card border-0 shadow-sm rounded-3 mb-2.5 bg-white">
                        <div class="card-header bg-light py-1.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-clock-history text-primary"></i>
                            <span class="fw-bold small text-dark" style="font-size: 11.5px;">1. Informasi Waktu &amp; Kategori Operasi</span>
                        </div>
                        <div class="card-body p-2.5">
                            <div class="row g-2 mb-2">
                                <div class="col-md-3 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Tgl &amp; Jam Mulai <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control form-control-sm" id="laporan_tgl_operasi" name="tgl_operasi" required>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Tgl &amp; Jam Selesai <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control form-control-sm" id="laporan_tgl_selesai" name="tgl_selesai" required>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Kategori Operasi</label>
                                    <select class="form-select form-select-sm" id="laporan_kategori" name="kategori">
                                        <option value="Elektive" selected>Elektive</option>
                                        <option value="Emergency">Emergency (Cito)</option>
                                        <option value="-">-</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Jenis Anestesi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="laporan_jenis_anestesi" name="jenis_anestesi" placeholder="Contoh: GA / Spinal / Lokal" value="GA" required>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Tindakan Operasi (Paket Operasi) <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-sm" id="laporan_kode_paket" name="kode_paket" required>
                                        <option value="">-- Pilih Tindakan Operasi --</option>
                                        @foreach ($paketList as $pkt)
                                            <option value="{{ $pkt->kode_paket }}">{{ $pkt->nm_perawatan }} ({{ $pkt->kode_paket }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Tim Kamar Operasi -->
                    <div class="card border-0 shadow-sm rounded-3 mb-2.5 bg-white">
                        <div class="card-header bg-light py-1.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-people-fill text-indigo" style="color: #6366f1;"></i>
                            <span class="fw-bold small text-dark" style="font-size: 11.5px;">2. Tim Kamar Operasi</span>
                        </div>
                        <div class="card-body p-2.5">
                            <div class="row g-2 mb-2">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Operator Utama (DPJP Bedah) <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-sm" id="laporan_operator1" name="operator1" required>
                                        <option value="">-- Pilih Dokter Operator 1 --</option>
                                        @foreach ($dokterList as $dok)
                                            <option value="{{ $dok->kd_dokter }}">{{ $dok->nm_dokter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label small fw-bold mb-0" style="font-size: 11px;">Dokter Anestesi</label>
                                        <div class="d-flex align-items-center gap-1">
                                            <span class="small text-muted" style="font-size: 10px;">Hadir?</span>
                                            <select class="form-select form-select-sm py-0 px-1" id="laporan_dr_anestesi_hadir" name="dr_anestesi_hadir" style="font-size: 10px; width: 65px; height: 22px;">
                                                <option value="Ya" selected>Ya</option>
                                                <option value="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <select class="form-select form-select-sm" id="laporan_dokter_anestesi" name="dokter_anestesi">
                                        <option value="-">- (Tidak Ada)</option>
                                        @foreach ($dokterList as $dok)
                                            <option value="{{ $dok->kd_dokter }}">{{ $dok->nm_dokter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Asisten Operator 1</label>
                                    <select class="form-select form-select-sm" id="laporan_asisten_operator1" name="asisten_operator1">
                                        <option value="-">-</option>
                                        @foreach ($pegawaiList as $peg)
                                            <option value="{{ $peg->nip }}">{{ $peg->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Asisten Anestesi</label>
                                    <select class="form-select form-select-sm" id="laporan_asisten_anestesi" name="asisten_anestesi">
                                        <option value="-">-</option>
                                        @foreach ($pegawaiList as $peg)
                                            <option value="{{ $peg->nip }}">{{ $peg->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Asisten Operator 2</label>
                                    <select class="form-select form-select-sm" id="laporan_asisten_operator2" name="asisten_operator2">
                                        <option value="-">-</option>
                                        @foreach ($pegawaiList as $peg)
                                            <option value="{{ $peg->nip }}">{{ $peg->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label small fw-bold mb-0" style="font-size: 11px;">Dokter Anak (SC / Persalinan)</label>
                                        <div class="d-flex align-items-center gap-1">
                                            <span class="small text-muted" style="font-size: 10px;">Hadir?</span>
                                            <select class="form-select form-select-sm py-0 px-1" id="laporan_dr_anak_hadir" name="dr_anak_hadir" style="font-size: 10px; width: 65px; height: 22px;">
                                                <option value="Tidak" selected>Tidak</option>
                                                <option value="Ya">Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <select class="form-select form-select-sm" id="laporan_dokter_anak" name="dokter_anak">
                                        <option value="-">-</option>
                                        @foreach ($dokterList as $dok)
                                            <option value="{{ $dok->kd_dokter }}">{{ $dok->nm_dokter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Onloop (Perawat Sirkuler)</label>
                                    <select class="form-select form-select-sm" id="laporan_onloop" name="onloop">
                                        <option value="-">-</option>
                                        @foreach ($pegawaiList as $peg)
                                            <option value="{{ $peg->nip }}">{{ $peg->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Data Klinis & Temuan Pembedahan -->
                    <div class="card border-0 shadow-sm rounded-3 mb-2.5 bg-white">
                        <div class="card-header bg-light py-1.5 px-3 border-bottom d-flex align-items-center gap-2">
                            <i class="bi bi-clipboard2-pulse text-teal" style="color: #0f766e;"></i>
                            <span class="fw-bold small text-dark" style="font-size: 11.5px;">3. Data Klinis, Jaringan &amp; Laporan Tindakan</span>
                        </div>
                        <div class="card-body p-2.5">
                            <div class="row g-2 mb-2">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Diagnosa Pre-Operasi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="laporan_diagnosa_preop" name="diagnosa_preop" placeholder="Diagnosa awal sebelum operasi..." required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Diagnosa Post-Operasi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm" id="laporan_diagnosa_postop" name="diagnosa_postop" placeholder="Diagnosa definitif pasca operasi..." required>
                                </div>
                            </div>

                            <div class="row g-2 mb-2">
                                <div class="col-md-8">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Jaringan Insisi / Dieksekusi</label>
                                    <input type="text" class="form-control form-control-sm" id="laporan_jaringan_insisi" name="jaringan_insisi" placeholder="Contoh: Jaringan kuretase / tumor mammae / apendiks">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold mb-1" style="font-size: 11px;">Pemeriksaan PA (Patologi Anatomi)?</label>
                                    <select class="form-select form-select-sm" id="laporan_pemeriksaan_pa" name="pemeriksaan_pa">
                                        <option value="Tidak" selected>Tidak</option>
                                        <option value="Ya">Ya</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Editor Laporan Operasi Lengkap -->
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="form-label small fw-bold mb-0" style="font-size: 11px;">Laporan Jalannya Operasi Lengkap <span class="text-danger">*</span></label>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary btn-sm py-0 px-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" style="font-size: 10.5px;">
                                                <i class="bi bi-card-text me-1"></i> Gunakan Template Cepat
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow" style="font-size: 11px;">
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="insertTemplateLaporan('sc')">Sectio Caesarea (SC)</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="insertTemplateLaporan('kuret')">Kuretase / Abortus</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="insertTemplateLaporan('apendiktomi')">Apendiktomi</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="insertTemplateLaporan('hernia')">Herniotomi / Hernioraphy</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="insertTemplateLaporan('umum')">Prosedur Bedah Umum Standar</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <textarea class="form-control form-control-sm font-monospace" id="laporan_narasi_operasi" name="laporan_operasi" rows="7" placeholder="Tuliskan jalannya operasi secara lengkap dan kronologis (posisi, desinfeksi, insisi, eksplorasi, tindakan inti, hemostasis, penutupan luka)..." style="font-size: 11.5px; line-height: 1.5;" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer Modal -->
            <div class="modal-footer py-1.5 px-3 bg-white d-flex justify-content-between">
                <div>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-outline-danger btn-sm ms-1 d-none" id="btnHapusLaporanModal" onclick="hapusLaporanOperasiAktif()">
                        <i class="bi bi-trash me-1"></i> Hapus Laporan
                    </button>
                </div>
                <button type="button" class="btn btn-primary btn-sm px-4 fw-bold shadow-sm" id="btnSimpanLaporanOperasi">
                    <i class="bi bi-save2-fill me-1"></i> Simpan Laporan Operasi
                </button>
            </div>

        </div>
    </div>
</div>

