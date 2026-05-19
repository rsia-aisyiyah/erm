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
                        <x-input id="tanggal2" name="tanggal2" type="hidden" />
                        <x-input id="nip2" name="nip2" type="hidden" />

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
                        <button type="button" id="btnSimpanAdimeGizi" class="btn btn-sm btn-primary"><i class="bi bi-save"></i> Simpan</button>
                        <button type="button" id="btnUbahAdimeGizi" class="btn btn-sm btn-warning d-none"><i class="bi bi-pencil"></i> Ubah</button>
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="listParameterGizi">
                    </tbody>
                </table>
            </div>
            <a href="javascript:void(0)" target="_blank" id="btnPrintAdime"
                class="btn btn-sm btn-success mt-2">
                <i class="bi bi-printer"></i> Cetak ADIME Gizi
            </a>
        </div>
    </div>
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
                formAdimeGizi.trigger('reset');
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                    }).then(() => {

                        getCatatanAdimeGizi(no_rawat)
                        formAdimeGizi.find('input[name=tanggal]').val(moment().format('DD-MM-YYYY HH:mm:ss'));
                        formAdimeGizi.find('input[name=nm_petugas]').val("{{ session()->get('pegawai')->nama }}");
                        formAdimeGizi.find('input[name=nip]').val("{{ session()->get('pegawai')->nik }}");
                    })


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
                tbSoapRanap(no_rawat)
                if (response.success === true && response.data.length > 0) {
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
                                                        <td class="text-center text-nowrap"><span class="badge bg-secondary">${item.petugas?.nama ?? '-'}</span></td>
                                                        <td class="text-center text-nowrap">
                                                            <div class="d-flex justify-content-center gap-1">
                                                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="editCatatanAdimeGizi('${item.no_rawat}', '${item.tanggal}')">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteCatatanAdimeGizi('${item.no_rawat}', '${item.tanggal}')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
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
                    $('#listParameterGizi').html('<tr><td colspan="9" class="text-center text-muted">Belum ada riwayat catatan ADIME Gizi.</td></tr>');
                }

            }).fail((xhr, status, error) => {
                console.error("Error: ", error);
                $('#listParameterGizi').html('<tr><td colspan="9" class="text-center text-danger">Gagal mengambil data dari server.</td></tr>');
            });
        }

        function deleteCatatanAdimeGizi(no_rawat, tanggal) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus catatan ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/erm/ranap/gizi/catatan-adime`,
                        type: 'DELETE',
                        data: {
                            no_rawat: no_rawat,
                            tanggal: tanggal
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message,
                                }).then(() => {
                                    getCatatanAdimeGizi(no_rawat);
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: response.message,
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("Error: ", error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan saat menghapus catatan.',
                            });
                        }
                    });
                }
            })
        }

        function editCatatanAdimeGizi(no_rawat, tanggal) {
            $.get(`/erm/ranap/gizi/catatan-adime/edit`, {
                no_rawat: no_rawat,
                tanggal: tanggal
            }).done((response) => {
                if (response.success === true && response.data) {
                    const catatan = response.data;

                    $('#formAdimeGizi').find('[name=tanggal2]').val(catatan.tanggal);
                    $('#formAdimeGizi').find('[name=asesmen]').val(catatan.asesmen);
                    $('#formAdimeGizi').find('[name=diagnosis]').val(catatan.diagnosis);
                    $('#formAdimeGizi').find('[name=intervensi]').val(catatan.intervensi);
                    $('#formAdimeGizi').find('[name=monitoring]').val(catatan.monitoring);
                    $('#formAdimeGizi').find('[name=evaluasi]').val(catatan.evaluasi);
                    $('#formAdimeGizi').find('[name=instruksi]').val(catatan.instruksi);
                    $('#formAdimeGizi').find('[name=nip2]').val(catatan.nip ?? '');


                    // Simpan data kunci untuk update
                    $('#btnUbahAdimeGizi').data('no_rawat', no_rawat);
                    $('#btnUbahAdimeGizi').data('tanggal', tanggal);
                    $('#btnUbahAdimeGizi').removeClass('d-none');

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message,
                    });
                }
            }).fail((xhr, status, error) => {
                console.error("Error: ", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan saat mengambil data untuk diedit.',
                });
            });
        }
        $('#btnUbahAdimeGizi').on('click', function () {
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

            $.ajax({
                url: '/erm/ranap/gizi/catatan-adime',
                type: 'PUT',
                data: data,
                success: function (response) {
                    formAdimeGizi.trigger('reset');
                    $('#btnUbahAdimeGizi').addClass('d-none');
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message,
                        }).then(() => {
                            getCatatanAdimeGizi(no_rawat)
                            formAdimeGizi.find('input[name=tanggal]').val(moment().format('DD-MM-YYYY HH:mm:ss'));
                            formAdimeGizi.find('input[name=nm_petugas]').val("{{ session()->get('pegawai')->nama }}");
                            formAdimeGizi.find('input[name=nip]').val("{{ session()->get('pegawai')->nik }}");
                        })
                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: response.message,
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error: ", xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: xhr.responseJSON.message,
                    });
                }
            })
        })


    </script>
@endpush