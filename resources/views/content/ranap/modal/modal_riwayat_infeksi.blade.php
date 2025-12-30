<div class="modal fade" id="modalRiwayatInfeksi" tabindex="-1" aria-labelledby="modalRiwayatInfeksiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="modalRiwayatInfeksiLabel">Riwayat Penyakit Infeksius</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm" id="tbRiwayatLabInfeksi">
                    <thead></thead>
                    <tbody></tbody>
                </table>

                <table class="table table-sm" id="tbRiwayatHasilLabInfeksi">
                    <thead class="table-light">
                    <tr>
                        <th>Pemeriksaan</th>
                        <th>Hasil</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px">
                    <i class="bi bi-x-circle">
                    </i> Keluar
                </button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        const modalRiwayatInfeksi = $('#modalRiwayatInfeksi');
        const alertContainerId = 'infectionAlertBox';

        // reset saat modal ditutup
        modalRiwayatInfeksi.on('hidden.bs.modal', () => {
            $('#' + alertContainerId).remove();
            $('#tbRiwayatHasilLabInfeksi tbody').empty();
        });

        function showLabInfectionAlert(no_rkm_medis) {

            // loading
            $('#tbRiwayatHasilLabInfeksi tbody').html(`
            <tr>
                <td colspan="4" class="text-center text-muted">
                    <i class="fas fa-spinner fa-spin"></i> Memuat data...
                </td>
            </tr>
        `);

            modalRiwayatInfeksi.modal('show');

            $.get(`/erm/lab/riwayat-hasil/${no_rkm_medis}`)
                .done(response => {

                    renderInfectionAlert(response.infection_alert);
                    renderLabResultTable(response.data);

                })
                .fail(() => {
                    $('#tbRiwayatHasilLabInfeksi tbody').html(`
                    <tr>
                        <td colspan="4" class="text-center text-danger">
                            Gagal memuat data
                        </td>
                    </tr>
                `);
                });
        }

        /* ==============================
         * ALERT RISIKO INFEKSI
         * ============================== */
        function renderInfectionAlert(alertData) {

            $('#' + alertContainerId).remove();

            if (!alertData || alertData.infection_alert !== true) {
                modalRiwayatInfeksi.find('.modal-body').prepend(`
                <div id="${alertContainerId}" class="alert alert-success">
                    Tidak ditemukan hasil lab infeksius.
                </div>
            `);
                return;
            }

            const isModerate = alertData.highest_risk === 'MODERATE';

            const alertClass = isModerate ? 'alert-warning' : 'alert-danger';
            const title = isModerate
                ? '⚠️ Risiko Infeksi Sedang'
                : '⚠️ Risiko Infeksi Tinggi';

            modalRiwayatInfeksi.find('.modal-body').prepend(`
            <div id="${alertContainerId}" class="alert ${alertClass}">
                <strong>${title}</strong>
            </div>
        `);
        }

        /* ==============================
         * TABEL HASIL LAB
         * ============================== */
        function renderLabResultTable(data) {

            const tbody = $('#tbRiwayatHasilLabInfeksi tbody');
            tbody.empty();

            if (!data || data.length === 0) {
                tbody.append(`
            <tr>
                <td colspan="4" class="text-center text-muted">
                    Tidak ada data laboratorium
                </td>
            </tr>
        `);
                return;
            }

            data.forEach(item => {

                const nilai = (item.nilai ?? '').toString();

                // ⚠️ DETEKSI NEGATIF DULU
                const isNegative = /non\s*reaktif|negatif|^-$/i.test(nilai);

                // ✅ BARU DETEKSI POSITIF
                const isPositive = !isNegative && /(^|\s)(reaktif|reaktif\*|positif|\+)(\s|$)/i.test(nilai);

                const badgeClass = isPositive
                    ? 'text-bg-danger'
                    : isNegative
                        ? 'text-bg-success'
                        : 'text-bg-secondary';

                const rowClass = isPositive ? 'table-danger' : '';

                tbody.append(`
            <tr class="${rowClass}">
                <td>${item.jns_perawatan_lab?.nm_perawatan ?? '-'}</td>
                <td>
                    <span class="badge ${badgeClass}">
                        ${nilai || '-'}
                    </span>
                </td>
                <td>${item.tgl_periksa}</td>
                <td>${item.jam}</td>
            </tr>
        `);
            });
        }
    </script>
@endpush

