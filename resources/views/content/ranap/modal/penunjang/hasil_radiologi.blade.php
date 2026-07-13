<div class="mb-2">
    <select name="selectRiwayatRadiologi" id="selectRiwayatRadiologi" data-parent-dropdown="#modalSoapRalan"
        style="width: 100%"></select>
</div>
<div class="d-flex justify-content-center w-100">
    <p class="mb-3 px-2 py-1 fw-semibold text-danger bg-danger bg-opacity-10 border border-danger rounded-3 text-center"
        id="alertHasilRadiologi">
        Belum / Tidak dilakukan pemeriksaan radiologi
    </p>
</div>
<div id="viewHasilRadiologi">
    {{-- <table class="table text-sm table-bordered" id="tbHasilRadiologi">
        <thead>
            <tr>
                <th>Tanggal Sampel</th>
                <th>Diagnosa Klinis</th>
                <th>Informasi Medis</th>
                <th>Jenis Pemeriksaan</th>
                <th>Hasil</th>
                <th>Gambar</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table> --}}
</div>
@push('script')
    <script>
        $('button[data-bs-target="#rad-ana"]').on('shown.bs.tab', function () {

            $('.btn-asmed-ranap').addClass('d-none');
            $('.btn-asmed').addClass('d-none');
            $('.btn-soap').addClass('d-none');

            const no_rkm_medis = $('#no_rm').val();

            $('#tbHasilRadiologi tbody').empty();
            $('#viewHasilRadiologi').addClass('d-none');
            $('#alertHasilRadiologi').removeClass('d-none');

            $.get(`/erm/radiologi/riwayat/${no_rkm_medis}`).done((response) => {

                const { data } = response;
                const $select = $('#selectRiwayatRadiologi');

                console.log('RIWAYAT RESPONSE RADIOLOGI ===', data);


                // Destroy Select2 jika sudah ada
                if ($select.hasClass('select2-hidden-accessible')) {
                    $select.select2('destroy');
                }

                // Reset option
                $select.empty();
                $select.append('<option value="">Pilih Riwayat Pemeriksaan Radiologi</option>');

                // Tambahkan option

                const options = data.map((item, index) => {
                    return `<option value="${item.no_rawat}" data-index="${index}">${formatTanggal(item.tgl_permintaan)} - ${item.diagnosa_klinis} (${item.status.toUpperCase()})</option>`;
                }).join('');


                console.log('OPTIONS ===', options);


                $select.append(options);
                // Inisialisasi Select2
                $select.select2({
                    placeholder: 'Pilih Riwayat Pemeriksaan Radiologi',
                    allowClear: true,
                    width: '100%',
                    dropdownParent: $('#modalSoapRalan')
                });

                // Otomatis pilih data terbaru
                if (data.length > 0) {
                    $select.val(data[0].no_rawat).trigger('change');
                }

            });

        });


        $(document).off('change', '#selectRiwayatRadiologi').on('change', '#selectRiwayatRadiologi', function () {

            const no_rawat = $(this).val();

            if (!no_rawat) {
                $('#tbHasilRadiologi tbody').empty();
                $('#viewHasilRadiologi').addClass('d-none');
                $('#alertHasilRadiologi').removeClass('d-none');
                return;
            }

            $('#tbHasilRadiologi tbody').empty();

            getPermintaanRadiologi(no_rawat).done((permintaan) => {

                console.log('PERMINTAAN RADIOLOGI ===', permintaan);
                $('#viewHasilRadiologi').empty();
                let html = ``;
                if (permintaan.length) {

                    permintaan.forEach((prm, index) => {
                        console.log('PRM ===', prm);

                        html = `
                                                                                                <div class="card shadow-sm border-0 mb-3">
                                                                                                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                                                                                        <div>
                                                                                                            <i class="bi bi-calendar-event"></i>
                                                                                                            ${splitTanggal(prm.tgl_hasil)} ${prm.jam_hasil} ${prm.noorder}
                                                                                                        </div>
                                                                                                        <span class="badge bg-light text-dark">
                                                                                                            ${prm.periksa_radiologi.length} Pemeriksaan
                                                                                                        </span>
                                                                                                    </div>

                                                                                                    <div class="card-body">

                                                                                                        <div class="row g-3">

                                                                                                            <div class="col-md-4">
                                                                                                                <div class="border rounded p-3 h-100">
                                                                                                                    <div class="fw-bold text-primary mb-2">
                                                                                                                        <i class="bi bi-clipboard2-pulse"></i>
                                                                                                                        Diagnosa Klinis
                                                                                                                    </div>

                                                                                                                    ${prm.diagnosa_klinis ?? '-'}
                                                                                                                </div>
                                                                                                            </div>

                                                                                                            <div class="col-md-4">
                                                                                                                <div class="border rounded p-3 h-100">
                                                                                                                    <div class="fw-bold text-success mb-2">
                                                                                                                        <i class="bi bi-info-circle"></i>
                                                                                                                        Informasi Medis
                                                                                                                    </div>

                                                                                                                    ${prm.informasi_tambahan ?? '-'}
                                                                                                                </div>
                                                                                                            </div>

                                                                                                            <div class="col-md-4">
                                                                                                                <div class="border rounded p-3">
                                                                                                                    <div class="fw-bold text-danger mb-2">
                                                                                                                        <i class="bi bi-radioactive"></i>
                                                                                                                        Jenis Pemeriksaan
                                                                                                                    </div>
                                                                                                `;

                        prm.periksa_radiologi.forEach((periksa) => {

                            if (
                                periksa.tgl_periksa == prm.tgl_hasil &&
                                periksa.jam == prm.jam_hasil
                            ) {

                                html += `
                                                                                                                <span class="badge bg-primary me-2 mb-2">
                                                                                                                    ${periksa.jns_perawatan.nm_perawatan}
                                                                                                                </span>
                                                                                                            `;

                            }

                        });

                        html += `
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="col-6">
                                                                                                            <div class="border rounded p-3">

                                                                                                                <div class="fw-bold text-warning mb-3">
                                                                                                                    <i class="bi bi-file-earmark-medical"></i>
                                                                                                                    Hasil Radiologi
                                                                                                                </div>
                                                                                            `;

                        prm.hasil_radiologi.forEach((hasil) => {

                            if (
                                hasil.tgl_periksa == prm.tgl_hasil &&
                                hasil.jam == prm.jam_hasil
                            ) {

                                html += `
                                                                                                                <div class="alert alert-light border mb-2" style="font-size: 0.8rem;">
                                                                                                                    ${stringPemeriksaan(hasil.hasil)}
                                                                                                                </div>
                                                                                                            `;

                            }

                        });

                        html += `
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="col-6">

                                                                                                            <div class="fw-bold text-success mb-3">
                                                                                                                <i class="bi bi-images"></i>
                                                                                                                Gambar Radiologi
                                                                                                            </div>

                                                                                                            <div class="row">
                                                                                            `;

                        let adaGambar = false;

                        prm.gambar_radiologi.forEach((gambar) => {

                            if (
                                gambar.tgl_periksa == prm.tgl_hasil &&
                                gambar.jam == prm.jam_hasil
                            ) {

                                adaGambar = true;

                                const gbr = getBaseUrl(`/webapps/radiologi/${gambar.lokasi_gambar}`);

                                html += `


                                                                                                            <div class="card border-0">



                                                                                                                <div class="card-body text-center">
                                                                                                                <img
                                                                                                                    src="${gbr}"
                                                                                                                    class="card-img-top"
                                                                                                                    style="height:180px;object-fit:cover">
                                                                                                                    <a
                                                                                                                        class="btn btn-success btn-sm w-100"
                                                                                                                        data-magnify="gallery"
                                                                                                                        data-src="${gbr}">
                                                                                                                        <i class="bi bi-eye"></i>
                                                                                                                        Lihat Gambar
                                                                                                                    </a>

                                                                                                                </div>

                                                                                                            </div>


                                                                                                    `;

                            }

                        });

                        if (!adaGambar) {

                            html += `
                                                                                                        <div class="col-12">

                                                                                                            <div class="alert alert-danger mb-0">

                                                                                                                <i class="bi bi-image"></i>

                                                                                                                Tidak ada gambar radiologi.

                                                                                                            </div>

                                                                                                        </div>
                                                                                                    `;

                        }

                        html += `
                                                                                                            </div>

                                                                                                        </div>

                                                                                                    </div>

                                                                                                </div>

                                                                                            </div>
                                                                                            `;


                    });
                    $('#viewHasilRadiologi').append(html);

                    $('#viewHasilRadiologi').removeClass('d-none');
                    $('#alertHasilRadiologi').addClass('d-none');

                } else {

                    $('#viewHasilRadiologi').addClass('d-none');
                    $('#alertHasilRadiologi').removeClass('d-none');

                }

            });

        });
    </script>
@endpush