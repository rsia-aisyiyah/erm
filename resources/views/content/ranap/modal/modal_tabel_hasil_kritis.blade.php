<div class="modal fade" id="modalTabelHasilKritis" tabindex="-1" aria-labelledby="modalHasilKritisLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h6 class="modal-title fs-5" id="modalHasilKritisLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Panel Hasil Kritis Pasien
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light" style="min-height: 550px">

                <div class="row g-3" id="containerHasilKritis">
                    <div class="col-12 text-center py-5 text-muted" id="loaderHasilKritis">
                        <div class="spinner-border text-danger mb-2" role="status"></div>
                        <br>Memuat data hasil kritis...
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">

                <div class="d-flex gap-2">
                    {{-- filter berdasarkan bulan --}}


                    <div class="d-flex align-items-center">
                        <div class="me-2">
                            <small class="text-muted">Filter bulan:</small>
                        </div>
                        <div>
                            <select name="bulan" id="bulan" class="form-select form-select-sm">
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-2">
                            <small class="text-muted">Filter status:</small>
                        </div>
                        <div>
                            <select name="status" id="status" class="form-select form-select-sm">
                                <option value="0">Belum diverifikasi</option>
                                <option value="1">Sudah diverifikasi</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- tambahkan filter untuk melihat yang sudah dan yang belum --}}

                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        function showTabelHasilKritis() {
            $('#modalTabelHasilKritis').modal('show');
            $('#containerHasilKritis').html(`
                                                                                                                                                                <div class="col-12 text-center py-5 text-muted">
                                                                                                                                                                    <div class="spinner-border text-danger mb-2" role="status"></div><br>Memuat data...
                                                                                                                                                                </div>
                                                                                                                                                            `);

            // Panggil API backend yang sudah kita perbaiki sebelumnya
            $.ajax({
                url: "{{ route('hasil-kritis.petugas', ['nip' => session()->get('pegawai')->nik]) }}",
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    let cardsHtml = '';
                    const dataList = response.data || response; // Sesuaikan format output server-side data json Anda

                    if (dataList.length === 0) {
                        $('#containerHasilKritis').html('<div class="col-12 text-center text-muted py-5"><h5>Tidak ada data hasil kritis.</h5></div>');
                        return;
                    }

                    dataList.forEach(function (item) {
                        const pasien = item.reg_periksa?.pasien || {};
                        const nmPasien = pasien.nm_pasien || 'Tidak Diketahui';
                        const noRm = pasien.no_rkm_medis || '-';
                        console.log(item);


                        // 1. Tentukan status verifikasi (apakah dokter sudah membaca/mengonfirmasi?)
                        const isVerified = item.tgl_dokter && item.tgl_dokter !== '0000-00-00 00:00:00';

                        // 2. Styling kondisional berdasarkan urgensi status
                        const borderClass = isVerified ? 'border-start border-success border-2' : 'border-start border-danger border-2 shadow-sm';
                        const badgeStatus = isVerified
                            ? `<span class="badge bg-success-subtle text-success border border-success rounded-pill px-2">Dikonfirmasi Dokter: ${item.tgl_dokter}</span>`
                            : `<span class="badge bg-danger text-white animate-pulse px-2"><i class="bi bi-lightning-fill"></i> BELUM DIKONFIRMASI</span>`;

                        const btnAksi = isVerified
                            ? `<button class="btn btn-sm btn-success w-100 disabled" disabled><i class="bi bi-check-circle-fill"></i> Selesai</button>`
                            : `<button class="btn btn-sm btn-danger w-100 fw-bold shadow-sm" onclick="konfirmasiDokter('${item.id}')"><i class="bi bi-telephone-outbound"></i> Laporkan & Konfirmasi</button>`;

                        const nama = item.petugas?.nama;
                        const namaSubstring = (nama) => {
                            if (nama && nama.length > 15) {
                                return nama.substring(0, 25) + '...';
                            }
                            return nama || '-';
                        }

                        // 3. Susun komponen Card
                        cardsHtml += `
                                                                                <div class="col-md-6 col-lg-4">
                                                                                    <div class="card h-100 ${borderClass}">
                                                                                        <div class="card-header bg-white pb-0 d-flex justify-content-between align-items-start border-0">
                                                                                            <div class="d-flex flex-column">
                                                                                                <small class="text-muted fw-semibold" style="font-size:10px;">NO. RAWAT: ${item.no_rawat}</small>
                                                                                                <h6 class="text-primary mb-0 fw-bold mt-1">${nmPasien} (${noRm})</h6>
                                                                                            </div>
                                                                                            ${item.reg_periksa?.kd_poli ? `<span class="badge bg-secondary small">${item.reg_periksa.kd_poli}</span>` : ''}
                                                                                        </div>
                                                                                        <div class="card-body py-2">
                                                                                            <div class="p-2 bg-danger-subtle text-danger rounded border border-danger-subtle mb-2">
                                                                                                <small class="fw-bold d-block text-uppercase" style="font-size: 9px; letter-spacing: 0.5px;"><i class="bi bi-exclamation-triangle-fill"></i> Parameter Kritis:</small>
                                                                                                <span class="fs-7 fw-bold text-wrap" style="word-break: break-word;">${stringPemeriksaan(item.hasil)}</span>
                                                                                            </div>
                                                                                            <div class="d-flex flex-column gap-1">
                                                                                                <small class="text-muted"><i class="bi bi-clock me-1"></i> Tanggal : <span class="text-dark fw-medium">${formatTanggal(item.tgl)}</span></small>
                                                                                                <small class="text-muted"><i class="bi bi-person-badge me-1"></i> Analis Penunjang: <span class="text-dark">${namaSubstring(item.petugas?.nama)}</span></small>
                                                                                                <small class="text-muted"><i class="bi bi-building-check me-1"></i> Ruangan: <span class="text-dark">${namaSubstring(item.petugas_ruang?.nama) || '-'}</span></small>
                                                                                            </div>
                                                                                            <div class="mt-2 text-center">
                                                                                                ${badgeStatus}
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="card-footer bg-white border-0 pt-0">
                                                                                            ${btnAksi}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            `;
                    });

                    $('#containerHasilKritis').html(cardsHtml);
                },
                error: function (xhr) {
                    $('#containerHasilKritis').html(`
                                                                                                                                                                                                <div class="col-12 text-center text-danger py-5">
                                                                                                        <i class="bi bi-exclamation-octagon fs-2"></i>
                                                                                                        <p class="mt-2">Gagal memuat data. Periksa kembali jaringan atau log session.</p>
                                                                                                    </div>
                                                                                                `);
                }
            });
        }

    </script>
@endpush