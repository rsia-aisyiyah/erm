<div class="row gy-2">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <p class="card-title">
                    Hasil Pemeriksaan Laboratorium
                </p>
            </div>
            <div class="card-body">
                <div class="row gy-2">
                    <div class="col-12">
                        <select name="selectPemeriksaanLab" id="selectPemeriksaanLab">
                            <option value="">Pilih Pemeriksaan</option>
                        </select>
                    </div>
                    <div class="col-12 overflow-y-auto" style="max-height: 500px">
                        <table class="table table-bordered" width="100%" id="tbHasilLabRalan">
                            <thead>
                                <tr>
                                    <th>Pemeriksaan</th>
                                    <th>Hasil</th>
                                    <th>Nilai Rujukan</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="tabel-lab">
                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="button" class="mt-1 btn btn-warning btn-sm" id="btnHasilKritis"><i
                        class="bi bi-pencil me-2"></i> Hasil Kritis
                </button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        function setSelectPemeriksaanLab(no_rkm_medis) {

            $.get(`/erm/lab/riwayat/${no_rkm_medis}`).done((response) => {
                const { data } = response;
                const selectPemeriksaanLab = $('#selectPemeriksaanLab');

                // Destroy Select2 jika sudah aktif
                if (selectPemeriksaanLab.hasClass('select2-hidden-accessible')) {
                    selectPemeriksaanLab.select2('destroy');
                }

                // Kosongkan option
                selectPemeriksaanLab.empty();
                selectPemeriksaanLab.append('<option value="">Pilih Pemeriksaan</option>');


                const options = data.map((item, index) => {
                    return `<option value="${item.noorder}" data-index="${index}" data-no-rawat="${item.no_rawat}">${formatTanggal(item.tgl_permintaan)} ${item.jam_permintaan} - ${item.diagnosa_klinis} (${item.status.toUpperCase()})</option>`;
                }).join('');

                selectPemeriksaanLab.append(options);

                // Inisialisasi Select2
                selectPemeriksaanLab.select2({
                    placeholder: 'Pilih Pemeriksaan',
                    allowClear: true,
                    width: '100%',
                    dropdownParent: $('#modalSoapRalan')
                });
                if (data.length > 0) {
                    selectPemeriksaanLab.prop('selectedIndex', 1); // 0 = "Pilih Pemeriksaan", 1 = data pertama
                    selectPemeriksaanLab.trigger('change');
                }

            });
        }
        $(document).on('change', '#selectPemeriksaanLab', function () {
            const noRawat = $(this).find('option:selected').data('no-rawat');

            if (noRawat) {
                hasilLabRalan(noRawat);
            }
        });
       


    </script>
@endpush