<form action="" class="p-2" id="formAdimeGizi">
    <div class="row gy-2">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-lg-2 col-md-12">
                    <label for="tanggal">Tgl & Jam Pemeriksaan</label>
                    <x-input-group class="input-group-sm">
                        <x-input-group-text>
                            <i class="bi bi-calendar3"></i>
                        </x-input-group-text>
                        <x-input id="tanggal" name="tanggal" class="datetimepicker" />
                    </x-input-group>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <label for="petugas">Petugas</label>
                    <x-input-group class="input-group-sm">
                        <x-input-group-text>
                            <i class="bi bi-person-fill"></i>
                        </x-input-group-text>
                        <x-input name="nip" id="nip" readonly />
                        <x-input name="nm_petugas" id="nm_petugas" class="w-25" readonly />
                    </x-input-group>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="row gy-2">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="asesmen">Assesment</label>
                    <x-textarea cols="10" rows="6" name="asesmen" id="asesmen">-</x-textarea>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="diagnosis">Dagnosis</label>
                    <x-textarea cols="10" rows="6" name="diagnosis" id="diagnosis">-</x-textarea>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="intervensi">Intervensi</label>
                    <x-textarea cols="10" rows="6" name="intervensi" id="intervensi">-</x-textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="row gy-2">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="monitoring">Monitoring</label>
                    <x-textarea cols="10" rows="6" name="monitoring" id="monitoring">-</x-textarea>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="evaluasi">Evaluasi</label>
                    <x-textarea cols="10" rows="6" name="evaluasi" id="evaluasi">-</x-textarea>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <label for="instruksi">Instruksi</label>
                    <x-textarea cols="10" rows="6" name="instruksi" id="instruksi">-</x-textarea>
                    <div class="d-flex justify-content-end mt-2 gap-2">
                        <button type="button" id="btnSimpanAdimeGizi" class="btn btn-sm btn-primary">Simpan</button>
                        <button type="button" id="btnUbahAdimeGizi" class="btn btn-sm btn-warning">Ubah</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="table-responsive w-100">
                <table class="table table-striped table-hover" id="tableCatatanAdimeGizi" style="width:100%">
                    <thead class="bg-light text-center align-middle">
                        <tr>
                            <th>Tanggal</th>
                            <th>Asesmen</th>
                            <th>Diagnosis</th>
                            <th>Intervensi</th>
                            <th>Monitoring</th>
                            <th>Evaluasi</th>
                            <th>Instruksi</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody id="listParameterGizi">
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</form>

@push('script')
    <script>
        $('#btnSimpanAdimeGizi').on('click', function () {
            const formAdimeGizi = $('#formAdimeGizi')
            const formInfoPasienResep = $('#formInfoPasienResep')
            const no_rawat = formInfoPasienResep.find('[name=no_rawat]').val();
            const data = formAdimeGizi.serializeArray()

            data.push({
                name: 'no_rawat',
                value: no_rawat
            }, {
                name: 'tanggal',
                value: splitTanggal(formAdimeGizi.find('[name=tanggal]').val())
            })



            $.post('/erm/ranap/gizi/catatan-adime', data).done((response) => {


                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                    })
                    getCatatanAdimeGizi(no_rawat)
                    formAdimeGizi.trigger('reset');
                    formAdimeGizi.find('input[tanggal]').val(moment().format('DD-MM-YYYY HH:mm:ss'));
                    formAdimeGizi.find('input[name=nm_petugas]').val("{{ session()->get('pegawai')->nama }}");
                    formAdimeGizi.find('input[name=nip]').val("{{ session()->get('pegawai')->nip }}");
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message,
                    })
                }
            })
        })

        function getCatatanAdimeGizi(no_rawat) {
            // 1. DESTROY: Cek jika DataTable sudah pernah diinisialisasi sebelumnya
            if ($.fn.DataTable.isDataTable('#tableCatatanAdimeGizi')) {
                // Hancurkan instance lama dan kembalikan HTML ke struktur aslinya
                $('#tableCatatanAdimeGizi').DataTable().destroy();
            }

            // Tampilkan efek memuat data di dalam tbody
            $('#listParameterGizi').html('<tr><td colspan="8" class="text-center">Memuat data...</td></tr>');

            // 2. FETCH DATA VIA AJAX
            $.get(`/erm/ranap/gizi/catatan-adime`, {
                no_rawat: no_rawat
            }).done((response) => {
                $('#listParameterGizi').empty();

                if (response.status === "success" && response.data.length > 0) {
                    let htmlRow = '';

                    response.data.forEach((item) => {
                        let tanggalFormatted = moment(item.tanggal).format('DD-MM-YYYY HH:mm:ss');

                        htmlRow += `
                                                    <tr class="align-middle">
                                                        <td class="text-center text-nowrap">${tanggalFormatted}</td>
                                                        <td>${item.asesmen ?? '-'}</td>
                                                        <td>${item.diagnosis ?? '-'}</td>
                                                        <td>${item.intervensi ?? '-'}</td>
                                                        <td>${item.monitoring ?? '-'}</td>
                                                        <td>${item.evaluasi ?? '-'}</td>
                                                        <td>${item.instruksi ?? '-'}</td>
                                                        <td class="text-center text-nowrap"><span class="badge bg-secondary">${item.nip ?? '-'}</span></td>
                                                    </tr>
                                                `;
                    });

                    // Masukkan baris baru ke dalam tabel
                    $('#listParameterGizi').html(htmlRow);

                    // 3. RE-INITIALIZE DATATABLE DENGAN FITUR SCROLL
                    $('#tableCatatanAdimeGizi').DataTable({
                        // Konfigurasi Scroll
                        scrollY: '300px',      // Tinggi maksimal area vertikal (muncul scrollbar jika data penuh)
                        scrollX: true,         // Aktifkan scrollbar horizontal jika kolom melebihi lebar layar
                        scrollCollapse: true,         // Jika data sedikit, tinggi tabel otomatis mengecil mengikuti data
                        paging: true,         // Tetap aktifkan pagination jika diinginkan
                        pageLength: 5,            // Jumlah baris default per halaman
                        lengthMenu: [5, 10, 25, 50],

                        // Konfigurasi Tambahan (Opsional untuk estetika RM)
                        order: [[0, 'desc']],         // Urutkan berdasarkan tanggal terbaru dahulu
                        columnDefs: [
                            { targets: [0, 7], className: 'text-center' } // Maksa kolom tanggal & NIP rata tengah
                        ]
                    });

                } else {
                    $('#listParameterGizi').html('<tr><td colspan="8" class="text-center text-muted">Belum ada riwayat catatan ADIME Gizi.</td></tr>');
                }

            }).fail((xhr, status, error) => {
                console.error("Error: ", error);
                $('#listParameterGizi').html('<tr><td colspan="8" class="text-center text-danger">Gagal mengambil data dari server.</td></tr>');
            });
        }

    </script>
@endpush