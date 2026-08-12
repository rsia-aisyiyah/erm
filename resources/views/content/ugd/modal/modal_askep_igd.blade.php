<div class="modal fade" id="modalAskepUgd" tabindex="-1" aria-labelledby="modalAskepUgdLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-gradient-primary text-white py-2 px-3" style="background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-heart-pulse-fill fs-5"></i>
                    <div>
                        <h6 class="modal-title fw-bold mb-0" id="modalAskepUgdLabel">PENGKAJIAN AWAL KEPERAWATAN GAWAT DARURAT</h6>
                        <small class="opacity-75" style="font-size: 11px;">Standar Akreditasi Rekam Medis Keperawatan IGD</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span id="badgeStatusAskepUgd" class="badge bg-light text-primary px-2 py-1" style="font-size: 11px;">
                        <i class="bi bi-file-earmark-plus me-1"></i> Data Baru
                    </span>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>

            <div class="modal-body bg-light p-3">
                <!-- PATIENT INFO BANNER -->
                <div class="card border-0 shadow-sm rounded-3 mb-3" style="background: #ffffff;">
                    <div class="card-body p-3">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-2 col-6">
                                <label class="text-muted small mb-0" style="font-size: 10px;">NO. RAWAT</label>
                                <div class="fw-bold text-primary font-monospace" id="askep_info_no_rawat" style="font-size: 12px;">-</div>
                            </div>
                            <div class="col-md-2 col-6">
                                <label class="text-muted small mb-0" style="font-size: 10px;">NO. REKAM MEDIS</label>
                                <div class="fw-bold text-dark font-monospace" id="askep_info_no_rkm_medis" style="font-size: 12px;">-</div>
                            </div>
                            <div class="col-md-3 col-12">
                                <label class="text-muted small mb-0" style="font-size: 10px;">NAMA PASIEN</label>
                                <div class="fw-bold text-dark" id="askep_info_nm_pasien" style="font-size: 12px;">-</div>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="text-muted small mb-0" style="font-size: 10px;">TGL. LAHIR / JK</label>
                                <div class="fw-semibold text-dark" id="askep_info_tgl_lahir" style="font-size: 12px;">-</div>
                            </div>
                            <div class="col-md-2 col-6">
                                <label class="text-muted small mb-0" style="font-size: 10px;">PENJAMIN</label>
                                <div class="fw-semibold text-success" id="askep_info_penjab" style="font-size: 12px;">-</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MAIN FORM ASKEP UGD -->
                <form id="formAskepUgd">
                    <input type="hidden" name="no_rawat" id="askep_no_rawat">
                    <input type="hidden" name="nip" id="askep_nip" value="{{ session()->get('pegawai')->nik ?? '' }}">

                    <div class="row g-3">
                        <!-- BAGIAN I. RIWAYAT KESEHATAN -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-3">
                                <div class="card-header bg-white py-2 px-3 border-bottom d-flex align-items-center justify-content-between">
                                    <span class="fw-bold text-primary" style="font-size: 13px;">
                                        <i class="bi bi-info-circle-fill me-1"></i> I. INFORMASI &amp; RIWAYAT KESEHATAN
                                    </span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold small mb-1">Tanggal Asuhan</label>
                                            <input type="text" class="form-control form-control-sm datetimepicker" name="tanggal" id="askep_tanggal" value="{{ date('Y-m-d H:i:s') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold small mb-1">Informasi Dari</label>
                                            <select class="form-select form-select-sm" name="informasi" id="askep_informasi">
                                                <option value="Autoanamnesis" selected>Autoanamnesis (Pasien Sendiri)</option>
                                                <option value="Alloanamnesis">Alloanamnesis (Keluarga / Pengantar)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small mb-1">Perawat Pengkaji</label>
                                            <input type="text" class="form-control form-control-sm bg-light" id="askep_nm_petugas" value="{{ session()->get('pegawai')->nama ?? '' }}" readonly>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold small mb-1">Keluhan Utama (RPS) <span class="text-danger">*</span></label>
                                            <textarea class="form-control form-control-sm" name="keluhan_utama" id="askep_keluhan_utama" rows="3" placeholder="Riwayat Penyakit Sekarang / Keluhan Utama Masuk UGD" required></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold small mb-1">Riwayat Penyakit Dahulu (RPD)</label>
                                            <textarea class="form-control form-control-sm" name="rpd" id="askep_rpd" rows="3" placeholder="Penyakit / riwayat operasi masa lalu">-</textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold small mb-1">Riwayat Penggunaan Obat (RPO)</label>
                                            <textarea class="form-control form-control-sm" name="rpo" id="askep_rpo" rows="3" placeholder="Obat-obatan yang sedang dikonsumsi">-</textarea>
                                        </div>

                                        <!-- STATUS KEHAMILAN -->
                                        <div class="col-12" id="wrapper_status_hamil">
                                            <div class="p-2 border rounded-2 bg-light">
                                                <div class="row g-2 align-items-center">
                                                    <div class="col-md-3">
                                                        <label class="form-label fw-semibold small mb-0">Status Kehamilan :</label>
                                                        <select class="form-select form-select-sm mt-1" name="status_kehamilan" id="askep_status_kehamilan">
                                                            <option value="Tidak Hamil" selected>Tidak Hamil</option>
                                                            <option value="Hamil">Hamil</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-9" id="panel_detail_hamil" style="display: none;">
                                                        <div class="row g-2">
                                                            <div class="col-md-3 col-6">
                                                                <label class="form-label small mb-0">Gravida (G)</label>
                                                                <input type="text" class="form-control form-control-sm" name="gravida" id="askep_gravida" placeholder="G" value="-">
                                                            </div>
                                                            <div class="col-md-3 col-6">
                                                                <label class="form-label small mb-0">Para (P)</label>
                                                                <input type="text" class="form-control form-control-sm" name="para" id="askep_para" placeholder="P" value="-">
                                                            </div>
                                                            <div class="col-md-3 col-6">
                                                                <label class="form-label small mb-0">Abortus (A)</label>
                                                                <input type="text" class="form-control form-control-sm" name="abortus" id="askep_abortus" placeholder="A" value="-">
                                                            </div>
                                                            <div class="col-md-3 col-6">
                                                                <label class="form-label small mb-0">HPHT</label>
                                                                <input type="text" class="form-control form-control-sm" name="hpht" id="askep_hpht" placeholder="Tgl HPHT" value="-">
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

                        <!-- BAGIAN II. PEMERIKSAAN FISIK KEPERAWATAN -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-3">
                                <div class="card-header bg-white py-2 px-3 border-bottom d-flex align-items-center justify-content-between">
                                    <span class="fw-bold text-primary" style="font-size: 13px;">
                                        <i class="bi bi-body-text me-1"></i> II. PEMERIKSAAN FISIK KEPERAWATAN
                                    </span>
                                    <button type="button" class="btn btn-outline-primary btn-sm py-0 px-2" id="btnAskepSetSemuaNormal" onclick="setSemuaNormalFisikAskep()" style="font-size: 11px;">
                                        <i class="bi bi-check-all me-1"></i> Set Semua Normal / TAK
                                    </button>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-3">
                                        <div class="col-md-3 col-6">
                                            <label class="form-label fw-semibold small mb-1">Tekanan Intrakranial</label>
                                            <select class="form-select form-select-sm" name="tekanan" id="askep_tekanan">
                                                <option value="TAK" selected>TAK (Tidak Ada Kelainan)</option>
                                                <option value="Sakit Kepala">Sakit Kepala</option>
                                                <option value="Muntah">Muntah</option>
                                                <option value="Pusing">Pusing</option>
                                                <option value="Bingung">Bingung</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label fw-semibold small mb-1">Pupil</label>
                                            <select class="form-select form-select-sm" name="pupil" id="askep_pupil">
                                                <option value="Isokor" selected>Isokor</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Miosis">Miosis</option>
                                                <option value="Anisokor">Anisokor</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label fw-semibold small mb-1">Neurosensorik / Muskulo</label>
                                            <select class="form-select form-select-sm" name="neurosensorik" id="askep_neurosensorik">
                                                <option value="TAK" selected>TAK</option>
                                                <option value="Spasme Otot">Spasme Otot</option>
                                                <option value="Perubahan Sensorik">Perubahan Sensorik</option>
                                                <option value="Perubahan Motorik">Perubahan Motorik</option>
                                                <option value="Perubahan Bentuk Ekstremitas">Perubahan Bentuk Ekstremitas</option>
                                                <option value="Penurunan Tingkat Kesadaran">Penurunan Tingkat Kesadaran</option>
                                                <option value="Fraktur/Dislokasi">Fraktur / Dislokasi</option>
                                                <option value="Luksasio">Luksasio</option>
                                                <option value="Kerusakan Jaringan/Luka">Kerusakan Jaringan / Luka</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label fw-semibold small mb-1">Integumen</label>
                                            <select class="form-select form-select-sm" name="integumen" id="askep_integumen">
                                                <option value="TAK" selected>TAK</option>
                                                <option value="Lecet">Lecet</option>
                                                <option value="Luka Robek">Luka Robek</option>
                                                <option value="Luka Bakar">Luka Bakar</option>
                                                <option value="Luka Decubitus">Luka Decubitus</option>
                                                <option value="Luka Gangren">Luka Gangren</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 col-6">
                                            <label class="form-label fw-semibold small mb-1">Turgor Kulit</label>
                                            <select class="form-select form-select-sm" name="turgor" id="askep_turgor">
                                                <option value="Baik" selected>Baik</option>
                                                <option value="Menurun">Menurun</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label fw-semibold small mb-1">Edema</label>
                                            <select class="form-select form-select-sm" name="edema" id="askep_edema">
                                                <option value="Tidak Ada" selected>Tidak Ada</option>
                                                <option value="Ekstremitas">Ekstremitas</option>
                                                <option value="Seluruh Tubuh">Seluruh Tubuh</option>
                                                <option value="Asites">Asites</option>
                                                <option value="Palpebrae">Palpebrae</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label fw-semibold small mb-1">Mukosa Mulut</label>
                                            <select class="form-select form-select-sm" name="mukosa" id="askep_mukosa">
                                                <option value="Lembab" selected>Lembab</option>
                                                <option value="Kering">Kering</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="form-label fw-semibold small mb-1">Intoksikasi</label>
                                            <select class="form-select form-select-sm" name="intoksikasi" id="askep_intoksikasi">
                                                <option value="Tidak Ada" selected>Tidak Ada</option>
                                                <option value="Ada">Ada</option>
                                                <option value="Gigitan Binatang">Gigitan Binatang</option>
                                                <option value="Zat Kimia">Zat Kimia</option>
                                                <option value="Gas">Gas</option>
                                                <option value="Obat">Obat</option>
                                            </select>
                                        </div>

                                        <!-- PERDARAHAN -->
                                        <div class="col-md-6">
                                            <div class="p-2 border rounded-2 bg-white">
                                                <div class="row g-2 align-items-center">
                                                    <div class="col-md-4">
                                                        <label class="form-label fw-semibold small mb-0">Perdarahan :</label>
                                                        <select class="form-select form-select-sm mt-1" name="perdarahan" id="askep_perdarahan" onchange="onPerdarahanChanged(this)">
                                                            <option value="Tidak Ada" selected>Tidak Ada</option>
                                                            <option value="Ada">Ada</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label small mb-0">Jumlah (cc)</label>
                                                        <input type="text" class="form-control form-control-sm mt-1" name="jumlah_perdarahan" id="askep_jumlah_perdarahan" placeholder="Jumlah cc" value="-" disabled>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label small mb-0">Warna</label>
                                                        <input type="text" class="form-control form-control-sm mt-1" name="warna_perdarahan" id="askep_warna_perdarahan" placeholder="Warna" value="-" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- ELIMINASI BAB & BAK -->
                                        <div class="col-md-6">
                                            <div class="p-2 border rounded-2 bg-white">
                                                <label class="form-label fw-semibold small mb-1 text-primary">Status Eliminasi (BAB &amp; BAK) :</label>
                                                <div class="row g-2">
                                                    <div class="col-3">
                                                        <input type="text" class="form-control form-control-sm" name="bab" id="askep_bab" placeholder="BAB x" value="1">
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control form-control-sm" name="xbab" id="askep_xbab" placeholder="Hari/Mgg" value="Hari">
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control form-control-sm" name="kbab" id="askep_kbab" placeholder="Konsistensi" value="Lunak">
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control form-control-sm" name="wbab" id="askep_wbab" placeholder="Warna BAB" value="Kuning">
                                                    </div>

                                                    <div class="col-3">
                                                        <input type="text" class="form-control form-control-sm" name="bak" id="askep_bak" placeholder="BAK x" value="4">
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control form-control-sm" name="xbak" id="askep_xbak" placeholder="Hari/Jam" value="Hari">
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control form-control-sm" name="wbak" id="askep_wbak" placeholder="Warna BAK" value="Kuning Jernih">
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control form-control-sm" name="lbak" id="askep_lbak" placeholder="Lain-lain" value="-">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BAGIAN III & IV. PSIKOSOSIAL & FUNGSIONAL (ADL) -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-3 h-100">
                                <div class="card-header bg-white py-2 px-3 border-bottom">
                                    <span class="fw-bold text-primary" style="font-size: 13px;">
                                        <i class="bi bi-people-fill me-1"></i> III. PSIKOSOSIAL, BUDAYA &amp; SPIRITUAL
                                    </span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small mb-1">Kondisi Psikologis</label>
                                            <select class="form-select form-select-sm" name="psikologis" id="askep_psikologis">
                                                <option value="Tidak Ada Masalah" selected>Tidak Ada Masalah</option>
                                                <option value="Cemas">Cemas</option>
                                                <option value="Gelisah">Gelisah</option>
                                                <option value="Takut">Takut</option>
                                                <option value="Marah">Marah</option>
                                                <option value="Depresi">Depresi</option>
                                                <option value="Cepat Lelah">Cepat Lelah</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small mb-1">Gangguan Jiwa Masa Lalu</label>
                                            <select class="form-select form-select-sm" name="jiwa" id="askep_jiwa">
                                                <option value="Tidak" selected>Tidak Ada</option>
                                                <option value="Ya">Ya</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small mb-1">Perilaku Berisiko</label>
                                            <select class="form-select form-select-sm" name="perilaku" id="askep_perilaku">
                                                <option value="-" selected>-</option>
                                                <option value="Perilaku Kekerasan">Perilaku Kekerasan</option>
                                                <option value="Gangguan Efek">Gangguan Efek</option>
                                                <option value="Gangguan Memori">Gangguan Memori</option>
                                                <option value="Halusinasi">Halusinasi</option>
                                                <option value="Kecenderungan Percobaan Bunuh Diri">Percobaan Bunuh Diri</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small mb-1">Lapor Ke</label>
                                            <input type="text" class="form-control form-control-sm" name="dilaporkan" id="askep_dilaporkan" placeholder="Lapor ke" value="-">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small mb-1">Sebutkan</label>
                                            <input type="text" class="form-control form-control-sm" name="sebutkan" id="askep_sebutkan" placeholder="Sebutkan" value="-">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small mb-1">Hubungan Anggota Keluarga</label>
                                            <select class="form-select form-select-sm" name="hubungan" id="askep_hubungan">
                                                <option value="Harmonis" selected>Harmonis</option>
                                                <option value="Kurang Harmonis">Kurang Harmonis</option>
                                                <option value="Tidak Harmonis">Tidak Harmonis</option>
                                                <option value="Konflik Besar">Konflik Besar</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small mb-1">Tinggal Bersama</label>
                                            <div class="input-group input-group-sm">
                                                <select class="form-select" name="tinggal_dengan" id="askep_tinggal_dengan" style="max-width: 45%;">
                                                    <option value="Orang Tua" selected>Orang Tua</option>
                                                    <option value="Suami / Istri">Suami / Istri</option>
                                                    <option value="Sendiri">Sendiri</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                                <input type="text" class="form-control" name="ket_tinggal" id="askep_ket_tinggal" placeholder="Ket..." value="-">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small mb-1">Nilai Budaya / Khusus</label>
                                            <div class="input-group input-group-sm">
                                                <select class="form-select" name="budaya" id="askep_budaya" style="max-width: 45%;">
                                                    <option value="Tidak Ada" selected>Tidak Ada</option>
                                                    <option value="Ada">Ada</option>
                                                </select>
                                                <input type="text" class="form-control" name="ket_budaya" id="askep_ket_budaya" placeholder="Ket Budaya..." value="-">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small mb-1">Pendidikan Penanggung Jawab</label>
                                            <div class="input-group input-group-sm">
                                                <select class="form-select" name="pendidikan_pj" id="askep_pendidikan_pj" style="max-width: 45%;">
                                                    <option value="SMA" selected>SMA / Sederajat</option>
                                                    <option value="SD">SD</option>
                                                    <option value="SMP">SMP</option>
                                                    <option value="D3">D3</option>
                                                    <option value="S1">S1</option>
                                                    <option value="S2">S2</option>
                                                    <option value="TS">Tidak Sekolah</option>
                                                    <option value="-">-</option>
                                                </select>
                                                <input type="text" class="form-control" name="ket_pendidikan_pj" id="askep_ket_pendidikan_pj" placeholder="Ket PJ..." value="-">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-semibold small mb-1">Edukasi Diberikan Kepada</label>
                                            <div class="input-group input-group-sm">
                                                <select class="form-select" name="edukasi" id="askep_edukasi" style="max-width: 35%;">
                                                    <option value="Pasien" selected>Pasien</option>
                                                    <option value="Keluarga">Keluarga</option>
                                                </select>
                                                <input type="text" class="form-control" name="ket_edukasi" id="askep_ket_edukasi" placeholder="Keterangan / Nama Penerima Edukasi..." value="-">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BAGIAN IV & VI. FUNGSIONAL (ADL) & RISIKO JATUH -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-3 h-100">
                                <div class="card-header bg-white py-2 px-3 border-bottom">
                                    <span class="fw-bold text-primary" style="font-size: 13px;">
                                        <i class="bi bi-person-walking me-1"></i> IV. PENGKAJIAN FUNGSI (ADL) &amp; RISIKO JATUH
                                    </span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-2">
                                        <div class="col-md-4 col-6">
                                            <label class="form-label fw-semibold small mb-1">Kemampuan ADL</label>
                                            <select class="form-select form-select-sm" name="kemampuan" id="askep_kemampuan">
                                                <option value="Mandiri" selected>Mandiri</option>
                                                <option value="Bantuan Minimal">Bantuan Minimal</option>
                                                <option value="Bantuan Sebagian">Bantuan Sebagian</option>
                                                <option value="Ketergantungan Total">Ketergantungan Total</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <label class="form-label fw-semibold small mb-1">Aktivitas</label>
                                            <select class="form-select form-select-sm" name="aktifitas" id="askep_aktifitas">
                                                <option value="Berjalan" selected>Berjalan</option>
                                                <option value="Duduk">Duduk</option>
                                                <option value="Tirah Baring">Tirah Baring</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <label class="form-label fw-semibold small mb-1">Alat Bantu Jalan</label>
                                            <div class="input-group input-group-sm">
                                                <select class="form-select" name="alat_bantu" id="askep_alat_bantu" style="max-width: 50%;">
                                                    <option value="Tidak" selected>Tidak</option>
                                                    <option value="Ya">Ya</option>
                                                </select>
                                                <input type="text" class="form-control" name="ket_bantu" id="askep_ket_bantu" placeholder="Jenis alat..." value="-">
                                            </div>
                                        </div>

                                        <!-- RISIKO JATUH (GET UP AND GO) -->
                                        <div class="col-12 mt-3">
                                            <div class="p-2 border rounded-2 bg-light">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <label class="form-label fw-bold text-dark small mb-0">Penilaian Risiko Jatuh (Get Up and Go Test) :</label>
                                                    <span id="badgeHasilRisikoJatuh" class="badge bg-success px-2 py-1" style="font-size: 10px;">Tidak Berisiko</span>
                                                </div>

                                                <div class="mb-1">
                                                    <div class="d-flex align-items-center justify-content-between small">
                                                        <span>a. Cara berjalan sempoyongan / limbung / tidak seimbang?</span>
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <input type="radio" class="btn-check hitung-risiko-jatuh" name="berjalan_a" id="berjalan_a_tidak" value="Tidak" checked>
                                                            <label class="btn btn-outline-secondary py-0 px-2" for="berjalan_a_tidak" style="font-size: 11px;">Tidak</label>
                                                            <input type="radio" class="btn-check hitung-risiko-jatuh" name="berjalan_a" id="berjalan_a_ya" value="Ya">
                                                            <label class="btn btn-outline-danger py-0 px-2" for="berjalan_a_ya" style="font-size: 11px;">Ya</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-1">
                                                    <div class="d-flex align-items-center justify-content-between small">
                                                        <span>b. Memegang penopang / meja saat akan duduk?</span>
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <input type="radio" class="btn-check hitung-risiko-jatuh" name="berjalan_b" id="berjalan_b_tidak" value="Tidak" checked>
                                                            <label class="btn btn-outline-secondary py-0 px-2" for="berjalan_b_tidak" style="font-size: 11px;">Tidak</label>
                                                            <input type="radio" class="btn-check hitung-risiko-jatuh" name="berjalan_b" id="berjalan_b_ya" value="Ya">
                                                            <label class="btn btn-outline-danger py-0 px-2" for="berjalan_b_ya" style="font-size: 11px;">Ya</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-2">
                                                    <div class="d-flex align-items-center justify-content-between small">
                                                        <span>c. Menggunakan alat bantu jalan saat masuk UGD?</span>
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <input type="radio" class="btn-check hitung-risiko-jatuh" name="berjalan_c" id="berjalan_c_tidak" value="Tidak" checked>
                                                            <label class="btn btn-outline-secondary py-0 px-2" for="berjalan_c_tidak" style="font-size: 11px;">Tidak</label>
                                                            <input type="radio" class="btn-check hitung-risiko-jatuh" name="berjalan_c" id="berjalan_c_ya" value="Ya">
                                                            <label class="btn btn-outline-danger py-0 px-2" for="berjalan_c_ya" style="font-size: 11px;">Ya</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row g-2 align-items-center pt-2 border-top">
                                                    <div class="col-md-6">
                                                        <label class="form-label small mb-0 fw-semibold">Hasil Evaluasi :</label>
                                                        <select class="form-select form-select-sm mt-1 bg-white" name="hasil" id="askep_hasil">
                                                            <option value="Tidak beresiko (tidak ditemukan a dan b)" selected>Tidak beresiko (tidak ditemukan a dan b)</option>
                                                            <option value="Resiko rendah (ditemukan a/b)">Resiko rendah (ditemukan a/b)</option>
                                                            <option value="Resiko tinggi (ditemukan a dan b)">Resiko tinggi (ditemukan a dan b)</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label small mb-0">Lapor Dokter :</label>
                                                        <select class="form-select form-select-sm mt-1" name="lapor" id="askep_lapor">
                                                            <option value="Tidak" selected>Tidak</option>
                                                            <option value="Ya">Ya</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label small mb-0">Keterangan / Jam :</label>
                                                        <input type="text" class="form-control form-control-sm mt-1" name="ket_lapor" id="askep_ket_lapor" placeholder="Jam / Ket" value="-">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BAGIAN V. PENGKAJIAN SKALA NYERI (PQRST) -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-3">
                                <div class="card-header bg-white py-2 px-3 border-bottom d-flex align-items-center justify-content-between">
                                    <span class="fw-bold text-primary" style="font-size: 13px;">
                                        <i class="bi bi-bandaid-fill me-1"></i> V. PENGKAJIAN TINGKAT SKALA NYERI (PQRST)
                                    </span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold small mb-1">Skrining Nyeri</label>
                                            <select class="form-select form-select-sm" name="nyeri" id="askep_nyeri">
                                                <option value="Tidak Ada Nyeri" selected>Tidak Ada Nyeri</option>
                                                <option value="Nyeri Akut">Nyeri Akut (&lt; 3 Bulan)</option>
                                                <option value="Nyeri Kronis">Nyeri Kronis (&gt; 3 Bulan)</option>
                                            </select>
                                        </div>

                                        <div class="col-md-9" id="panel_pqrst" style="display: none;">
                                            <div class="p-3 border rounded-2 bg-light">
                                                <div class="row g-2">
                                                    <!-- SKALA NYERI VISUAL -->
                                                    <div class="col-12 mb-2">
                                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                                            <label class="form-label fw-bold small mb-0">Skala Nyeri (NRS / Wong Baker):</label>
                                                            <span id="badgeSkalaNyeri" class="badge bg-success px-3 py-1 fs-6">0 - Tidak Nyeri</span>
                                                        </div>
                                                        <input type="range" class="form-range" name="skala_nyeri" id="askep_skala_nyeri" min="0" max="10" step="1" value="0">
                                                        <div class="d-flex justify-content-between small text-muted px-1" style="font-size: 10px;">
                                                            <span>0 (Bebas Nyeri)</span>
                                                            <span>1-3 (Ringan)</span>
                                                            <span>4-6 (Sedang)</span>
                                                            <span>7-10 (Berat / Hebat)</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label class="form-label small mb-1">P (Provocating / Pemicu)</label>
                                                        <select class="form-select form-select-sm" name="provokes" id="askep_provokes">
                                                            <option value="Proses Penyakit" selected>Proses Penyakit</option>
                                                            <option value="Benturan">Benturan / Trauma</option>
                                                            <option value="Lain-lain">Lain-lain</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label small mb-1">Ket. Pemicu</label>
                                                        <input type="text" class="form-control form-control-sm" name="ket_provokes" id="askep_ket_provokes" placeholder="Penyebab..." value="-">
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label class="form-label small mb-1">Q (Quality / Kualitas)</label>
                                                        <select class="form-select form-select-sm" name="quality" id="askep_quality">
                                                            <option value="Seperti Tertusuk" selected>Seperti Tertusuk</option>
                                                            <option value="Berdenyut">Berdenyut</option>
                                                            <option value="Teriris">Teriris</option>
                                                            <option value="Tertindih">Tertindih</option>
                                                            <option value="Tertiban">Tertiban</option>
                                                            <option value="Lain-lain">Lain-lain</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label small mb-1">Ket. Kualitas</label>
                                                        <input type="text" class="form-control form-control-sm" name="ket_quality" id="askep_ket_quality" placeholder="Rasa nyeri..." value="-">
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label class="form-label small mb-1">R (Region / Lokasi)</label>
                                                        <input type="text" class="form-control form-control-sm" name="lokasi" id="askep_lokasi" placeholder="Lokasi Nyeri" value="-">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label small mb-1">Menyebar ke Area Lain?</label>
                                                        <select class="form-select form-select-sm" name="menyebar" id="askep_menyebar">
                                                            <option value="Tidak" selected>Tidak</option>
                                                            <option value="Ya">Ya</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label class="form-label small mb-1">T (Timing / Durasi)</label>
                                                        <input type="text" class="form-control form-control-sm" name="durasi" id="askep_durasi" placeholder="Contoh: Hilang timbul, 15 mnt" value="-">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label small mb-1">Nyeri Berkurang Saat</label>
                                                        <select class="form-select form-select-sm" name="nyeri_hilang" id="askep_nyeri_hilang">
                                                            <option value="Istirahat" selected>Istirahat</option>
                                                            <option value="Minum Obat">Minum Obat</option>
                                                            <option value="Medengar Musik">Mendengar Musik / Relaksasi</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label small mb-1">Keterangan Tambahan Nyeri</label>
                                                        <input type="text" class="form-control form-control-sm" name="ket_nyeri" id="askep_ket_nyeri" placeholder="Keterangan..." value="-">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label small mb-1">Lapor Ke Dokter?</label>
                                                        <select class="form-select form-select-sm" name="pada_dokter" id="askep_pada_dokter">
                                                            <option value="Tidak" selected>Tidak</option>
                                                            <option value="Ya">Ya</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label small mb-1">Jam Lapor Dokter</label>
                                                        <input type="text" class="form-control form-control-sm" name="ket_dokter" id="askep_ket_dokter" placeholder="Jam lapor..." value="-">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BAGIAN VII. MASALAH & RENCANA KEPERAWATAN (SDKI / KHANZA) -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-3">
                                <div class="card-header bg-white py-2 px-3 border-bottom d-flex align-items-center justify-content-between">
                                    <span class="fw-bold text-primary" style="font-size: 13px;">
                                        <i class="bi bi-list-check me-1"></i> VII. MASALAH &amp; RENCANA KEPERAWATAN (INTERVENSI)
                                    </span>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row g-3">
                                        <!-- KOLOM MASALAH KEPERAWATAN -->
                                        <div class="col-md-5">
                                            <div class="border rounded-2 p-2 bg-light h-100">
                                                <div class="d-flex align-items-center justify-content-between pb-1 border-bottom mb-2">
                                                    <strong class="text-dark small"><i class="bi bi-clipboard2-pulse me-1"></i> Masalah Keperawatan (Diagnosa) :</strong>
                                                    <div class="d-flex align-items-center gap-1">
                                                        <span id="badgeCountMasalahTerpilih" class="badge bg-primary" style="font-size: 10px;">0 Terpilih</span>
                                                        <button type="button" class="btn btn-outline-danger btn-sm py-0 px-2" onclick="resetSemuaMasalahAskep()" style="font-size: 10.5px;" title="Batalkan semua pilihan masalah">
                                                            <i class="bi bi-x-circle me-1"></i> Reset
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-sm mb-2">
                                                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                                                    <input type="text" class="form-control border-start-0" id="cariMasalahAskep" placeholder="Cari masalah keperawatan...">
                                                </div>
                                                <div id="containerListMasalahAskep" style="max-height: 380px; overflow-y: auto;">
                                                    <div class="text-center text-muted py-3 small"><div class="spinner-border spinner-border-sm me-1"></div> Memuat daftar masalah keperawatan...</div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- KOLOM RENCANA INTERVENSI KEPERAWATAN -->
                                        <div class="col-md-7">
                                            <div class="border rounded-2 p-2 bg-light h-100">
                                                <div class="d-flex align-items-center justify-content-between pb-2 border-bottom mb-2">
                                                    <strong class="text-dark small"><i class="bi bi-journal-medical me-1"></i> Rencana Intervensi Keperawatan :</strong>
                                                    <button type="button" class="btn btn-outline-primary btn-sm py-0 px-2" id="btnSalinRencanaKeCatatan" style="font-size: 11px;">
                                                        <i class="bi bi-clipboard-plus me-1"></i> Salin ke Catatan
                                                    </button>
                                                </div>
                                                <div id="containerListRencanaAskep" style="max-height: 280px; overflow-y: auto;">
                                                    <div class="text-center text-muted py-4 small">
                                                        <i class="bi bi-arrow-left-circle me-1"></i> Centang salah satu masalah di sebelah kiri untuk memunculkan dan memilih rencana intervensi.
                                                    </div>
                                                </div>

                                                <div class="mt-2 pt-2 border-top">
                                                    <label class="form-label fw-semibold small mb-1">Catatan / Rencana Tambahan :</label>
                                                    <textarea class="form-control form-control-sm" name="rencana" id="askep_rencana" rows="2" placeholder="Tuliskan rencana atau instruksi keperawatan tambahan jika ada...">-</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- MODAL FOOTER -->
            <div class="modal-footer bg-white border-top py-2 px-3 justify-content-between">
                <div>
                    <button type="button" class="btn btn-outline-danger btn-sm btn-askep-hapus d-none" id="btnHapusAskepUgd">
                        <i class="bi bi-trash me-1"></i> Hapus Asesmen
                    </button>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-primary btn-sm btn-askep-print d-none" id="btnCetakAskepUgd">
                        <i class="bi bi-printer me-1"></i> Cetak Asesmen
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Tutup
                    </button>
                    <button type="button" class="btn btn-primary btn-sm btn-simpan-askep-ugd" id="btnSimpanAskepUgd">
                        <i class="bi bi-save me-1"></i> Simpan Asesmen
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Global Cache Master Masalah & Rencana Keperawatan IGD
    window.masterAskepIgdData = [];

    // Load Master Masalah & Rencana saat startup
    function loadMasterAskepIgd(callback) {
        if (window.masterAskepIgdData && window.masterAskepIgdData.length > 0) {
            if (callback) callback(window.masterAskepIgdData);
            return;
        }

        $.get('/erm/ugd/asesmen/keperawatan/master').done(function(response) {
            window.masterAskepIgdData = response || [];
            if (callback) callback(window.masterAskepIgdData);
        }).fail(function() {
            $('#containerListMasalahAskep').html('<div class="text-danger small py-2">Gagal memuat master masalah keperawatan.</div>');
        });
    }

    // Render Master Masalah ke dalam Checklist UI
    function renderMasterMasalahList(selectedMasalahCodes = [], selectedRencanaCodes = []) {
        const container = $('#containerListMasalahAskep');
        container.empty();

        if (!window.masterAskepIgdData || window.masterAskepIgdData.length === 0) {
            container.html('<div class="text-muted small py-2">Tidak ada data master masalah keperawatan.</div>');
            return;
        }

        let html = '';
        window.masterAskepIgdData.forEach(function(m) {
            const isChecked = selectedMasalahCodes.includes(m.kode_masalah);
            html += `
                <div class="card item-masalah-card border ${isChecked ? 'border-primary bg-primary-subtle' : 'border-light-subtle bg-white'} shadow-sm mb-1 p-2" id="card_masalah_${m.kode_masalah}" onclick="toggleMasalahCheckbox('${m.kode_masalah}')" style="cursor: pointer; transition: all 0.2s;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-check mb-0">
                            <input class="form-check-input chk-masalah-askep" type="checkbox" name="masalah[]" value="${m.kode_masalah}" id="masalah_${m.kode_masalah}" ${isChecked ? 'checked' : ''} onclick="event.stopPropagation();" onchange="onMasalahChanged('${m.kode_masalah}', this.checked)" style="cursor: pointer;">
                            <label class="form-check-label small fw-semibold text-dark ms-1 cursor-pointer" onclick="event.stopPropagation(); toggleMasalahCheckbox('${m.kode_masalah}');" style="cursor: pointer;">
                                ${m.kode_masalah} - ${m.nama_masalah}
                            </label>
                        </div>
                        <span class="badge ${isChecked ? 'bg-primary' : 'bg-light text-muted border'} rounded-pill badge-rencana-count" style="font-size: 10px;">
                            ${(m.master_rencana || []).length} intervensi
                        </span>
                    </div>
                </div>
            `;
        });

        container.html(html);
        updateBadgeCountMasalah();
        renderRencanaIntervensiList(selectedRencanaCodes);
    }

    // Toggle Masalah via Card / Label Click
    function toggleMasalahCheckbox(kodeMasalah) {
        const $chk = $(`#masalah_${kodeMasalah}`);
        const nextState = !$chk.is(':checked');
        $chk.prop('checked', nextState);
        onMasalahChanged(kodeMasalah, nextState);
    }

    // Handler Utama Saat Masalah Berubah
    function onMasalahChanged(kodeMasalah, isChecked) {
        const $card = $(`#card_masalah_${kodeMasalah}`);
        const $chk = $(`#masalah_${kodeMasalah}`);
        $chk.prop('checked', isChecked);

        if (isChecked) {
            $card.removeClass('border-light-subtle bg-white').addClass('border-primary bg-primary-subtle');
            $card.find('.badge-rencana-count').removeClass('bg-light text-muted border').addClass('bg-primary');
        } else {
            $card.removeClass('border-primary bg-primary-subtle').addClass('border-light-subtle bg-white');
            $card.find('.badge-rencana-count').removeClass('bg-primary').addClass('bg-light text-muted border');
        }

        updateBadgeCountMasalah();

        // Kumpulkan rencana aktif saat ini
        let activeRencana = [];
        $('.chk-rencana-askep:checked').each(function() {
            activeRencana.push($(this).val());
        });

        // Jika masalah di-uncheck, bersihkan rencana yang terkait masalah tersebut
        if (!isChecked) {
            const m = (window.masterAskepIgdData || []).find(item => item.kode_masalah === kodeMasalah);
            if (m && m.master_rencana) {
                const rencanaToRemove = m.master_rencana.map(r => r.kode_rencana);
                activeRencana = activeRencana.filter(rCode => !rencanaToRemove.includes(rCode));
            }
        }

        renderRencanaIntervensiList(activeRencana);
    }

    // Update Badge Total Masalah Terpilih
    function updateBadgeCountMasalah() {
        const totalChecked = $('.chk-masalah-askep:checked').length;
        $('#badgeCountMasalahTerpilih').text(`${totalChecked} Terpilih`);
    }

    // Render Rencana Intervensi yang aktif sesuai masalah yang dicentang
    function renderRencanaIntervensiList(selectedRencanaCodes = []) {
        const container = $('#containerListRencanaAskep');
        const checkedMasalah = [];

        $('.chk-masalah-askep:checked').each(function() {
            checkedMasalah.push($(this).val());
        });

        if (checkedMasalah.length === 0) {
            container.html(`
                <div class="text-center text-muted py-4 small">
                    <i class="bi bi-arrow-left-circle me-1"></i> Centang salah satu masalah di sebelah kiri untuk memunculkan dan memilih rencana intervensi.
                </div>
            `);
            return;
        }

        let html = '';
        window.masterAskepIgdData.forEach(function(m) {
            if (checkedMasalah.includes(m.kode_masalah)) {
                // Periksa apakah semua rencana dalam masalah ini tercentang
                const totalRencana = (m.master_rencana || []).length;
                let checkedCount = 0;
                if (m.master_rencana && m.master_rencana.length > 0) {
                    m.master_rencana.forEach(function(r) {
                        const isRencanaChecked = (selectedRencanaCodes && selectedRencanaCodes.length > 0)
                            ? selectedRencanaCodes.includes(r.kode_rencana)
                            : false;
                        if (isRencanaChecked) checkedCount++;
                    });
                }
                const isAllChecked = totalRencana > 0 && (checkedCount === totalRencana);

                html += `
                    <div class="card border border-primary-subtle shadow-sm mb-2">
                        <div class="card-header bg-primary bg-opacity-10 py-1 px-2 d-flex align-items-center justify-content-between">
                            <span class="small fw-bold text-primary" style="font-size: 11.5px;">
                                <i class="bi bi-check2-square me-1"></i> [${m.kode_masalah}] ${m.nama_masalah}
                            </span>
                            <div class="form-check form-check-inline mb-0 me-0 d-flex align-items-center">
                                <input class="form-check-input chk-select-all-rencana me-1" type="checkbox" id="selectAll_${m.kode_masalah}" ${isAllChecked ? 'checked' : ''} onchange="toggleSelectAllRencana(this, '${m.kode_masalah}')" style="cursor: pointer; transform: scale(0.9);">
                                <label class="form-check-label text-primary fw-semibold small cursor-pointer" for="selectAll_${m.kode_masalah}" style="font-size: 11px; cursor: pointer;">
                                    Pilih Semua
                                </label>
                            </div>
                        </div>
                        <div class="card-body p-2 bg-white" id="rencana_group_${m.kode_masalah}">
                `;

                if (m.master_rencana && m.master_rencana.length > 0) {
                    m.master_rencana.forEach(function(r) {
                        const isRencanaChecked = (selectedRencanaCodes && selectedRencanaCodes.length > 0)
                            ? selectedRencanaCodes.includes(r.kode_rencana)
                            : false;

                        html += `
                            <div class="form-check small py-1 mb-0 border-bottom border-light">
                                <input class="form-check-input chk-rencana-askep" type="checkbox" name="rencana_keperawatan[]" value="${r.kode_rencana}" id="rencana_${r.kode_rencana}" ${isRencanaChecked ? 'checked' : ''} onchange="onRencanaItemChanged('${m.kode_masalah}')" style="cursor: pointer;">
                                <label class="form-check-label cursor-pointer text-dark ms-1" for="rencana_${r.kode_rencana}" style="font-size: 11.5px; cursor: pointer;">
                                    ${r.rencana_keperawatan}
                                </label>
                            </div>
                        `;
                    });
                } else {
                    html += `<div class="text-muted small fst-italic" style="font-size: 11px;">Belum ada master intervensi spesifik.</div>`;
                }

                html += `
                        </div>
                    </div>
                `;
            }
        });

        container.html(html);
    }

    // Filter Live Search Masalah Keperawatan
    $(document).on('input', '#cariMasalahAskep', function() {
        const query = $(this).val().toLowerCase().trim();
        $('.item-masalah-card').each(function() {
            const text = $(this).text().toLowerCase();
            if (text.includes(query)) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        });
    });

    // Toggle Pilih Semua Checkbox di Header Grup Rencana
    function toggleSelectAllRencana(el, kodeMasalah) {
        const isChecked = $(el).is(':checked');
        $(`#rencana_group_${kodeMasalah} input.chk-rencana-askep`).prop('checked', isChecked);
    }

    // Update Checkbox "Pilih Semua" di Header jika ada checkbox rencana yang diubah secara manual
    function onRencanaItemChanged(kodeMasalah) {
        const $group = $(`#rencana_group_${kodeMasalah}`);
        const checkboxes = $group.find('input.chk-rencana-askep');
        const allChecked = checkboxes.length > 0 && (checkboxes.length === checkboxes.filter(':checked').length);
        $(`#selectAll_${kodeMasalah}`).prop('checked', allChecked);
    }

    // Tombol Global Reset / Uncheck Semua Masalah Keperawatan
    function resetSemuaMasalahAskep() {
        $('#containerListMasalahAskep .chk-masalah-askep').prop('checked', false);
        $('#containerListMasalahAskep .item-masalah-card').removeClass('border-primary bg-primary-subtle').addClass('border-light-subtle bg-white');
        $('#containerListMasalahAskep .badge-rencana-count').removeClass('bg-primary').addClass('bg-light text-muted border');
        $('#cariMasalahAskep').val('');
        $('#containerListMasalahAskep .item-masalah-card').removeClass('d-none');
        updateBadgeCountMasalah();
        renderRencanaIntervensiList([]);
    }

    // Tombol Salin Rencana Intervensi ke Textarea Catatan
    $(document).on('click', '#btnSalinRencanaKeCatatan', function() {
        const listText = [];
        $('.chk-rencana-askep:checked').each(function() {
            const labelText = $(this).siblings('label').text().trim();
            if (labelText) listText.push(`- ${labelText}`);
        });

        if (listText.length === 0) {
            Swal.fire('Informasi', 'Belum ada rencana intervensi yang dicentang.', 'info');
            return;
        }

        const currentNote = $('#askep_rencana').val().trim();
        const generatedText = listText.join('\n');

        if (!currentNote || currentNote === '-') {
            $('#askep_rencana').val(generatedText);
        } else {
            $('#askep_rencana').val(currentNote + '\n' + generatedText);
        }

        Swal.fire({
            icon: 'success',
            title: 'Tersalin!',
            text: 'Rencana intervensi berhasil disalin ke Catatan Tambahan.',
            timer: 1200,
            showConfirmButton: false
        });
    });

    // Auto-Trigger Masalah Keperawatan dari Hasil Pengkajian Fisik
    function autoTriggerMasalah(kodeMasalah, shouldCheck = true) {
        const $chk = $(`#masalah_${kodeMasalah}`);
        if ($chk.length > 0) {
            if (shouldCheck && !$chk.is(':checked')) {
                onMasalahChanged(kodeMasalah, true);
            }
        }
    }

    // Listener Auto-Trigger
    $('#askep_nyeri').on('change', function() {
        if ($(this).val() === 'Nyeri Akut') {
            autoTriggerMasalah('006', true); // 006 - Nyeri Akut
        }
    });

    $('#askep_integumen').on('change', function() {
        if ($(this).val() !== 'TAK') {
            autoTriggerMasalah('007', true); // 007 - Gangguan Integritas Kulit
        }
    });

    // Handler Perubahan Status Perdarahan
    function onPerdarahanChanged(elem) {
        const val = $(elem).val();
        if (val === 'Ada') {
            $('#askep_jumlah_perdarahan, #askep_warna_perdarahan').prop('disabled', false);
            if ($('#askep_jumlah_perdarahan').val() === '-') {
                $('#askep_jumlah_perdarahan').val('');
            }
            if ($('#askep_warna_perdarahan').val() === '-') {
                $('#askep_warna_perdarahan').val('');
            }
            $('#askep_jumlah_perdarahan').focus();
            autoTriggerMasalah('008', true); // 008 - Risiko Perdarahan
        } else {
            $('#askep_jumlah_perdarahan, #askep_warna_perdarahan').prop('disabled', true).val('-');
        }
    }

    $(document).on('change', '#askep_perdarahan', function() {
        onPerdarahanChanged(this);
    });

    $('#askep_turgor').on('change', function() {
        if ($(this).val() === 'Menurun') {
            autoTriggerMasalah('004', true); // 004 - Risiko Ketidakseimbangan Cairan
        }
    });

    $('#askep_kbab').on('change blur', function() {
        const val = $(this).val().toLowerCase();
        if (val.includes('cair') || val.includes('diare')) {
            autoTriggerMasalah('009', true); // 009 - Diare
        }
    });

    // Auto-Kalkulasi Risiko Jatuh (Get Up and Go Test)
    function updateKalkulasiRisikoJatuh() {
        const a = $('input[name="berjalan_a"]:checked').val() === 'Ya';
        const b = $('input[name="berjalan_b"]:checked').val() === 'Ya';
        const c = $('input[name="berjalan_c"]:checked').val() === 'Ya';

        let hasil = 'Tidak beresiko (tidak ditemukan a dan b)';
        let badgeClass = 'bg-success';
        let badgeText = 'Tidak Berisiko';

        if (a && b) {
            hasil = 'Resiko tinggi (ditemukan a dan b)';
            badgeClass = 'bg-danger';
            badgeText = 'Risiko Tinggi';
        } else if (a || b || c) {
            hasil = 'Resiko rendah (ditemukan a/b)';
            badgeClass = 'bg-warning text-dark';
            badgeText = 'Risiko Rendah';
        }

        $('#askep_hasil').val(hasil);
        $('#badgeHasilRisikoJatuh').attr('class', `badge ${badgeClass} px-2 py-1`).text(badgeText);
    }

    $(document).on('change', '.hitung-risiko-jatuh', function() {
        updateKalkulasiRisikoJatuh();
    });

    // Update Visual Skala Nyeri Slider
    function updateVisualSkalaNyeri(val) {
        const intVal = parseInt(val) || 0;
        let badgeClass = 'bg-success';
        let text = `${intVal} - Tidak Nyeri`;

        if (intVal >= 7) {
            badgeClass = 'bg-danger';
            text = `${intVal} - Nyeri Berat / Hebat`;
        } else if (intVal >= 4) {
            badgeClass = 'bg-warning text-dark';
            text = `${intVal} - Nyeri Sedang`;
        } else if (intVal >= 1) {
            badgeClass = 'bg-info text-dark';
            text = `${intVal} - Nyeri Ringan`;
        }

        $('#badgeSkalaNyeri').attr('class', `badge ${badgeClass} px-3 py-1 fs-6`).text(text);
    }

    $('#askep_skala_nyeri').on('input change', function() {
        updateVisualSkalaNyeri($(this).val());
    });

    // Toggle Skrining Nyeri
    $('#askep_nyeri').on('change', function() {
        if ($(this).val() === 'Tidak Ada Nyeri') {
            $('#panel_pqrst').slideUp(200);
            $('#askep_skala_nyeri').val(0).trigger('change');
        } else {
            $('#panel_pqrst').slideDown(200);
            if (parseInt($('#askep_skala_nyeri').val()) === 0) {
                $('#askep_skala_nyeri').val(3).trigger('change');
            }
        }
    });

    // Toggle Status Kehamilan
    $('#askep_status_kehamilan').on('change', function() {
        if ($(this).val() === 'Hamil') {
            $('#panel_detail_hamil').slideDown(200);
        } else {
            $('#panel_detail_hamil').slideUp(200);
        }
    });

    // Set Semua Normal Fisik
    function setSemuaNormalFisikAskep() {
        $('#askep_tekanan').val('TAK').trigger('change');
        $('#askep_pupil').val('Isokor').trigger('change');
        $('#askep_neurosensorik').val('TAK').trigger('change');
        $('#askep_integumen').val('TAK').trigger('change');
        $('#askep_turgor').val('Baik').trigger('change');
        $('#askep_edema').val('Tidak Ada').trigger('change');
        $('#askep_mukosa').val('Lembab').trigger('change');
        $('#askep_intoksikasi').val('Tidak Ada').trigger('change');
        $('#askep_perdarahan').val('Tidak Ada').trigger('change');
        $('#askep_jumlah_perdarahan').val('-').prop('disabled', true);
        $('#askep_warna_perdarahan').val('-').prop('disabled', true);
        $('#askep_bab').val('1');
        $('#askep_xbab').val('Hari');
        $('#askep_kbab').val('Lunak');
        $('#askep_wbab').val('Kuning');
        $('#askep_bak').val('4');
        $('#askep_xbak').val('Hari');
        $('#askep_wbak').val('Kuning Jernih');
        $('#askep_lbak').val('-');

        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Pemeriksaan fisik diset Normal / TAK.',
            timer: 1000,
            showConfirmButton: false
        });
    }

    // Reset Form Asesmen Keperawatan UGD
    function resetFormAskepUgd() {
        $('#formAskepUgd')[0].reset();
        $('#askep_status_kehamilan').val('Tidak Hamil').trigger('change');
        $('#askep_nyeri').val('Tidak Ada Nyeri').trigger('change');
        $('#askep_perdarahan').val('Tidak Ada').trigger('change');
        $('input[name="berjalan_a"][value="Tidak"]').prop('checked', true);
        $('input[name="berjalan_b"][value="Tidak"]').prop('checked', true);
        $('input[name="berjalan_c"][value="Tidak"]').prop('checked', true);
        updateKalkulasiRisikoJatuh();
        updateVisualSkalaNyeri(0);
        $('#btnCetakAskepUgd, #btnHapusAskepUgd').addClass('d-none');
        $('#badgeStatusAskepUgd').attr('class', 'badge bg-light text-primary px-2 py-1').html('<i class="bi bi-file-earmark-plus me-1"></i> Data Baru');
        $('#btnSimpanAskepUgd').html('<i class="bi bi-save me-1"></i> Simpan Asesmen');
    }

    // Buka Modal Asesmen Keperawatan UGD
    function modalAskepUgd(noRawat) {
        resetFormAskepUgd();
        $('#askep_no_rawat').val(noRawat);

        // Ambil Data Registrasi Pasien
        getRegPeriksa(noRawat).done(function(reg) {
            const p = reg?.pasien || {};
            $('#askep_info_no_rawat').text(reg?.no_rawat || noRawat);
            $('#askep_info_no_rkm_medis').text(p?.no_rkm_medis || '-');
            $('#askep_info_nm_pasien').text(p?.nm_pasien || '-');
            $('#askep_info_tgl_lahir').text(`${p?.tgl_lahir ? formatTanggal(p.tgl_lahir) : '-'} (${p?.jk || '-'})`);
            $('#askep_info_penjab').text(reg?.penjab?.png_jawab || '-');

            // Jika Pasien Pria, sembunyikan section kehamilan
            if ((p?.jk || '').toUpperCase() === 'L') {
                $('#wrapper_status_hamil').hide();
            } else {
                $('#wrapper_status_hamil').show();
            }

            // Pre-fill Riwayat Pemeriksaan Ralan jika entri baru
            if (reg?.pemeriksaan_ralan && reg.pemeriksaan_ralan.length > 0) {
                const pr = reg.pemeriksaan_ralan[0];
                if (pr.keluhan) $('#askep_keluhan_utama').val(pr.keluhan);
            }
        });

        // Load Master & Data Asesmen Keperawatan Pasien
        loadMasterAskepIgd(function() {
            $.get(`/erm/ugd/asesmen/keperawatan?no_rawat=${encodeURIComponent(noRawat)}`).done(function(response) {
                if (response && response.no_rawat) {
                    // MODE EDIT DATA
                    $('#badgeStatusAskepUgd').attr('class', 'badge bg-success px-2 py-1').html('<i class="bi bi-check-circle-fill me-1"></i> Data Tersimpan');
                    $('#btnCetakAskepUgd, #btnHapusAskepUgd').removeClass('d-none');
                    $('#btnSimpanAskepUgd').html('<i class="bi bi-save me-1"></i> Perbarui Asesmen');

                    // Isi seluruh field form
                    $('#askep_tanggal').val(response.tanggal || '');
                    $('#askep_informasi').val(response.informasi || 'Autoanamnesis');
                    $('#askep_nip').val(response.nip || '');
                    $('#askep_nm_petugas').val(response.pengkaji?.nama || response.nip || '');

                    $('#askep_keluhan_utama').val(response.keluhan_utama || '-');
                    $('#askep_rpd').val(response.rpd || '-');
                    $('#askep_rpo').val(response.rpo || '-');

                    $('#askep_status_kehamilan').val(response.status_kehamilan || 'Tidak Hamil').trigger('change');
                    $('#askep_gravida').val(response.gravida || '-');
                    $('#askep_para').val(response.para || '-');
                    $('#askep_abortus').val(response.abortus || '-');
                    $('#askep_hpht').val(response.hpht || '-');

                    $('#askep_tekanan').val(response.tekanan || 'TAK');
                    $('#askep_pupil').val(response.pupil || 'Isokor');
                    $('#askep_neurosensorik').val(response.neurosensorik || 'TAK');
                    $('#askep_integumen').val(response.integumen || 'TAK');
                    $('#askep_turgor').val(response.turgor || 'Baik');
                    $('#askep_edema').val(response.edema || 'Tidak Ada');
                    $('#askep_mukosa').val(response.mukosa || 'Lembab');
                    $('#askep_intoksikasi').val(response.intoksikasi || 'Tidak Ada');

                    $('#askep_perdarahan').val(response.perdarahan || 'Tidak Ada').trigger('change');
                    $('#askep_jumlah_perdarahan').val(response.jumlah_perdarahan || '-');
                    $('#askep_warna_perdarahan').val(response.warna_perdarahan || '-');

                    $('#askep_bab').val(response.bab || '1');
                    $('#askep_xbab').val(response.xbab || 'Hari');
                    $('#askep_kbab').val(response.kbab || 'Lunak');
                    $('#askep_wbab').val(response.wbab || 'Kuning');
                    $('#askep_bak').val(response.bak || '4');
                    $('#askep_xbak').val(response.xbak || 'Hari');
                    $('#askep_wbak').val(response.wbak || 'Kuning Jernih');
                    $('#askep_lbak').val(response.lbak || '-');

                    $('#askep_psikologis').val(response.psikologis || 'Tidak Ada Masalah');
                    $('#askep_jiwa').val(response.jiwa || 'Tidak');
                    $('#askep_perilaku').val(response.perilaku || '-');
                    $('#askep_dilaporkan').val(response.dilaporkan || '-');
                    $('#askep_sebutkan').val(response.sebutkan || '-');
                    $('#askep_hubungan').val(response.hubungan || 'Harmonis');
                    $('#askep_tinggal_dengan').val(response.tinggal_dengan || 'Orang Tua');
                    $('#askep_ket_tinggal').val(response.ket_tinggal || '-');
                    $('#askep_budaya').val(response.budaya || 'Tidak Ada');
                    $('#askep_ket_budaya').val(response.ket_budaya || '-');
                    $('#askep_pendidikan_pj').val(response.pendidikan_pj || 'SMA');
                    $('#askep_ket_pendidikan_pj').val(response.ket_pendidikan_pj || '-');
                    $('#askep_edukasi').val(response.edukasi || 'Pasien');
                    $('#askep_ket_edukasi').val(response.ket_edukasi || '-');

                    $('#askep_kemampuan').val(response.kemampuan || 'Mandiri');
                    $('#askep_aktifitas').val(response.aktifitas || 'Berjalan');
                    $('#askep_alat_bantu').val(response.alat_bantu || 'Tidak');
                    $('#askep_ket_bantu').val(response.ket_bantu || '-');

                    $(`input[name="berjalan_a"][value="${response.berjalan_a || 'Tidak'}"]`).prop('checked', true);
                    $(`input[name="berjalan_b"][value="${response.berjalan_b || 'Tidak'}"]`).prop('checked', true);
                    $(`input[name="berjalan_c"][value="${response.berjalan_c || 'Tidak'}"]`).prop('checked', true);
                    updateKalkulasiRisikoJatuh();
                    $('#askep_hasil').val(response.hasil || 'Tidak beresiko (tidak ditemukan a dan b)');
                    $('#askep_lapor').val(response.lapor || 'Tidak');
                    $('#askep_ket_lapor').val(response.ket_lapor || '-');

                    $('#askep_nyeri').val(response.nyeri || 'Tidak Ada Nyeri').trigger('change');
                    $('#askep_skala_nyeri').val(response.skala_nyeri || 0).trigger('change');
                    $('#askep_provokes').val(response.provokes || 'Proses Penyakit');
                    $('#askep_ket_provokes').val(response.ket_provokes || '-');
                    $('#askep_quality').val(response.quality || 'Seperti Tertusuk');
                    $('#askep_ket_quality').val(response.ket_quality || '-');
                    $('#askep_lokasi').val(response.lokasi || '-');
                    $('#askep_menyebar').val(response.menyebar || 'Tidak');
                    $('#askep_durasi').val(response.durasi || '-');
                    $('#askep_nyeri_hilang').val(response.nyeri_hilang || 'Istirahat');
                    $('#askep_ket_nyeri').val(response.ket_nyeri || '-');
                    $('#askep_pada_dokter').val(response.pada_dokter || 'Tidak');
                    $('#askep_ket_dokter').val(response.ket_dokter || '-');

                    $('#askep_rencana').val(response.rencana || '-');

                    // Set checklist masalah & rencana
                    const selectedMasalahCodes = (response.masalah_keperawatan || []).map(m => m.kode_masalah);
                    const selectedRencanaCodes = (response.rencana_keperawatan || []).map(r => r.kode_rencana);
                    renderMasterMasalahList(selectedMasalahCodes, selectedRencanaCodes);
                } else {
                    // MODE BARU
                    renderMasterMasalahList([], []);
                }
            });
        });

        $('#modalAskepUgd').modal('show');
    }

    // Submit Simpan Asesmen Keperawatan UGD
    $('#btnSimpanAskepUgd').on('click', function(e) {
        e.preventDefault();

        const noRawat = $('#askep_no_rawat').val();
        const keluhan = $('#askep_keluhan_utama').val().trim();

        if (!noRawat) {
            Swal.fire('Peringatan', 'No. Rawat tidak valid.', 'warning');
            return;
        }

        if (!keluhan || keluhan === '-') {
            Swal.fire('Peringatan', 'Keluhan Utama (RPS) wajib diisi.', 'warning');
            $('#askep_keluhan_utama').focus();
            return;
        }

        const formData = $('#formAskepUgd').serialize();
        const $btn = $(this);
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...');

        $.ajax({
            url: '/erm/ugd/asesmen/keperawatan/simpan',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    $('#badgeStatusAskepUgd').attr('class', 'badge bg-success px-2 py-1').html('<i class="bi bi-check-circle-fill me-1"></i> Data Tersimpan');
                    $('#btnCetakAskepUgd, #btnHapusAskepUgd').removeClass('d-none');
                    $btn.html('<i class="bi bi-save me-1"></i> Perbarui Asesmen');
                    if (typeof tb_ugd !== 'undefined') {
                        tb_ugd.ajax.reload(null, false);
                    }
                } else {
                    Swal.fire('Gagal', response.message || 'Terjadi kesalahan saat menyimpan.', 'error');
                }
            },
            error: function(xhr) {
                Swal.fire('Error', xhr.responseJSON?.message || 'Gagal menyimpan data ke server.', 'error');
            },
            complete: function() {
                $btn.prop('disabled', false);
            }
        });
    });

    // Tombol Cetak PDF
    $('#btnCetakAskepUgd').on('click', function() {
        const noRawat = $('#askep_no_rawat').val();
        if (noRawat) {
            window.open(`/erm/ugd/asesmen/keperawatan/print?no_rawat=${encodeURIComponent(noRawat)}`, '_blank');
        }
    });

    // Tombol Hapus Asesmen
    $('#btnHapusAskepUgd').on('click', function() {
        const noRawat = $('#askep_no_rawat').val();
        if (!noRawat) return;

        Swal.fire({
            title: 'Hapus Asesmen Keperawatan?',
            text: 'Data asesmen keperawatan UGD ini akan dihapus permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('/erm/ugd/asesmen/keperawatan/hapus', { no_rawat: noRawat }, function(res) {
                    if (res.success) {
                        Swal.fire('Terhapus!', res.message, 'success');
                        $('#modalAskepUgd').modal('hide');
                        if (typeof tb_ugd !== 'undefined') {
                            tb_ugd.ajax.reload(null, false);
                        }
                    } else {
                        Swal.fire('Gagal', res.message, 'error');
                    }
                }).fail(function(xhr) {
                    Swal.fire('Error', xhr.responseJSON?.message || 'Gagal menghapus data.', 'error');
                });
            }
        });
    });
</script>
