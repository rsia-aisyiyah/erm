<!-- Modal Tambah / Booking Jadwal Operasi -->
<div class="modal fade" id="modalBookingOperasi" tabindex="-1" aria-labelledby="modalBookingOperasiLabel" aria-hidden="true" style="z-index: 1055;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header bg-danger text-white py-2 px-3">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar-plus-fill fs-5"></i>
                    <div>
                        <h6 class="modal-title fw-bold mb-0" id="modalBookingOperasiLabel">TAMBAH JADWAL OPERASI</h6>
                        <small class="text-white-50" style="font-size: 11px;">Pendaftaran Jadwal Pasien Kamar Operasi (IBS)</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-3 bg-light">
                <form id="formBookingOperasi">
                    <input type="hidden" id="booking_no_rawat" name="no_rawat">

                    <!-- Pencarian Pasien -->
                    <div class="card border-0 shadow-sm rounded-3 p-2.5 mb-3 bg-white">
                        <label class="form-label small fw-bold mb-1 text-danger">
                            <i class="bi bi-person-search me-1"></i> Cari Pasien (Rawat Inap / Rawat Jalan)
                        </label>
                        <div class="input-group input-group-sm mb-1 position-relative">
                            <input type="text" class="form-control form-control-sm" id="booking_cari_pasien" placeholder="Ketik No. RM / Nama Pasien / No. Rawat..." autocomplete="off">
                            <button class="btn btn-danger btn-sm" type="button" id="btnCariPasienBooking">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        <div id="booking_dropdown_pasien" class="list-group position-absolute shadow-sm d-none" style="z-index: 1090; max-height: 220px; overflow-y: auto; width: 95%; margin-top: 55px;"></div>

                        <!-- Card Info Pasien Terpilih -->
                        <div id="booking_info_pasien_terpilih" class="p-2 border rounded-2 bg-light mt-2 d-none">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-bold text-dark mb-0" id="lblBookingNamaPasien">-</h6>
                                    <small class="text-muted" style="font-size: 11px;">
                                        No. RM: <b id="lblBookingNoRm" class="font-monospace text-primary">-</b> | 
                                        No. Rawat: <b id="lblBookingNoRawat" class="font-monospace">-</b> | 
                                        Kamar: <span id="lblBookingKamar" class="badge bg-secondary">-</span>
                                    </small>
                                </div>
                                <button type="button" class="btn btn-outline-secondary btn-sm py-0 px-1" onclick="resetPilihanPasienBooking()" title="Ganti Pasien">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Tindakan & Waktu Operasi -->
                    <div class="card border-0 shadow-sm rounded-3 p-3 bg-white">
                        <div class="row g-2 mb-2">
                            <div class="col-md-12">
                                <label class="form-label small fw-bold mb-1">Paket Tindakan Operasi <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" id="booking_kode_paket" name="kode_paket" required>
                                    <option value="">-- Pilih Paket Operasi --</option>
                                    @foreach ($paketList as $pkt)
                                        <option value="{{ $pkt->kode_paket }}">{{ $pkt->nm_perawatan }} ({{ $pkt->kode_paket }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold mb-1">Tanggal Operasi <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-sm" id="booking_tanggal" name="tanggal" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold mb-1">Perkiraan Jam Mulai <span class="text-danger">*</span></label>
                                <input type="time" class="form-control form-control-sm text-center" id="booking_jam_mulai" name="jam_mulai" value="08:00" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold mb-1">Perkiraan Jam Selesai <span class="text-danger">*</span></label>
                                <input type="time" class="form-control form-control-sm text-center" id="booking_jam_selesai" name="jam_selesai" value="10:00" required>
                            </div>
                        </div>

                        <div class="row g-2">
                            <div class="col-md-8">
                                <label class="form-label small fw-bold mb-1">Dokter Operator (DPJP Bedah) <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" id="booking_kd_dokter" name="kd_dokter" required>
                                    <option value="">-- Pilih Dokter Operator --</option>
                                    @foreach ($dokterList as $dok)
                                        <option value="{{ $dok->kd_dokter }}">{{ $dok->nm_dokter }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold mb-1">Status Awal</label>
                                <select class="form-select form-select-sm" id="booking_status" name="status">
                                    <option value="Menunggu" selected>Menunggu</option>
                                    <option value="Proses Operasi">Proses Operasi</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer py-1.5 px-3 bg-white d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger btn-sm px-4 fw-bold shadow-sm" id="btnSimpanBookingOperasi">
                    <i class="bi bi-check2-circle me-1"></i> Simpan Jadwal Operasi
                </button>
            </div>

        </div>
    </div>
</div>

