<div id="tindakanDokterPerawatRajal">
    <form action="" id="formTindakanDokterPerawat">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <label for="kd_dokter">Dokter</label>
                        <select name="kd_dokter" id="kd_dokter" class="select2 w-100"
                                data-dropdown-parent="#formTindakanDokterPerawat"></select>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <label for="nip">Petugas</label>
                        <select name="nip" id="nip" class="select2 w-100"
                                data-dropdown-parent="#formTindakanDokterPerawat"></select>
                    </div>
                    <div class="col-lg-12 col-md-12 mt-2">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-striped"
                                   id="tabelJenisTindakanDokterPerawat">

                            </table>
                        </div>

                        <button type="button" class="btn btn-sm btn-primary" id="btnCreateTindakanDokterPerawat"
                                onclick="createTindakanDokterPerawat()"><i class="bi bi-floppy"></i> Buat
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title h5">Tindakan Dilakukan</h4>
                        <table class="table table-bordered" id="tabelTindakanDilakukanDrPr">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tgl.</th>
                                <th>Jam</th>
                                <th>Perawatan</th>
                                <th>Dokter & Perawat</th>
                                <th>Biaya</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteTindakanDokterPerawat()">
                            <i class="ti ti-trash"></i>Hapus
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

@push('script')

    <script>
        $('#btnTabTindakanDokterPerawat').on('shown.tab.bs', () => {

            const formTindakanDokterPerawat = $('#formTindakanDokterPerawat')
            const formInfoTindakan = $('.formInfoTindakan')

            const no_rawat = formInfoTindakan.find('#no_rawat').val();
            const user = new Option("{{session()->get('pegawai')->nama}}", "{{session()->get('pegawai')->nik}}", true, true)
            formTindakanDokterPerawat.find('#nip').append(user).trigger('change')

            const dokter = new Option(formInfoTindakan.find('#nm_dokter').val(), formInfoTindakan.find('#dokter').val(), true, true)
            formTindakanDokterPerawat.find('select[name=kd_dokter]').append(dokter).trigger('change')

            formTindakanDokterPerawat.find('select[name=kd_dokter]').select2({
                delay: 0,
                scrollAfterSelect: false,
                allowClear: true,
                initSelection: function (element, callback) {
                },
                ajax: {
                    url: `/erm/dokter/cari`,
                    dataType: 'json',
                    data: (params) => {
                        const query = {
                            nm_dokter: params.term
                        }
                        return query
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.nm_dokter,
                                    id: item.kd_dokter
                                }
                            })
                        };
                    },
                    cache: false
                }
            });


            formTindakanDokterPerawat.find('#nip').select2({
                delay: 0,
                scrollAfterSelect: false,
                initSelection: function (element, callback) {
                },
                ajax: {
                    url: '/erm/petugas/cari',
                    dataType: 'json',
                    data: (params) => {
                        const query = {
                            q: params.term
                        }
                        return query
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.nama,
                                    id: item.nip
                                }
                            })
                        };
                    },
                    cache: false
                }
            });


            tableJenisTindakanDokterPerawat()
            getTindakanDilakukanDrPr(no_rawat)
        })

        // global
        let selectedRowsDrPr = [];
        let selectedDataCacheDrPr = {};
        let lastRequestStartDrPr = 0;

        function tableJenisTindakanDokterPerawat() {
            // simpan referensi table ke variable supaya bisa dipakai di event handler
            const table = new DataTable('#tabelJenisTindakanDokterPerawat', {
                responsive: true,
                serverSide: true,
                processing: true,
                destroy: true,
                autoWidth: false,
                lengthChange: false,
                info: false,

                ajax: {
                    url: '/erm/jenis-tindakan/datatable/drpr',
                    type: 'GET',
                    // tangkap request params sebelum dikirim
                    data: function (d) {
                        lastRequestStartDrPr = d.start || 0;
                        return d;
                    },
                    // intercept response dari server
                    dataSrc: function (json) {
                        // update cache untuk selected ids yang mungkin ada di response ini
                        json.data.forEach(d => {
                            if (selectedRowsDrPr.includes(d.kd_jenis_prw)) {
                                selectedDataCacheDrPr[d.kd_jenis_prw] = d;
                            }
                        });

                        // jika request halaman pertama (start === 0) => gabungkan selected rows di depan
                        if (lastRequestStartDrPr === 0) {
                            // buat array checkedData berdasarkan urutan selectedRowsDrPr
                            const checkedData = selectedRowsDrPr.map(id => selectedDataCacheDrPr[id]).filter(Boolean);

                            // hindari duplikat: kumpulkan id yang sudah ada di checkedData
                            const checkedIds = new Set(checkedData.map(d => d.kd_jenis_prw));

                            // sisanya dari response yang bukan selected
                            const otherData = json.data.filter(d => !checkedIds.has(d.kd_jenis_prw));

                            // gabungkan: selected dulu, lalu data lainnya
                            return [...checkedData, ...otherData];
                        } else {
                            // bukan halaman pertama => jangan tampilkan item yg sudah dipindah ke halaman 1
                            return json.data.filter(d => !selectedRowsDrPr.includes(d.kd_jenis_prw));
                        }
                    },
                    complete: function () {
                        // $('#tabelJenisTindakanDokterPerawat tbody').width(w - 5); // -- - THIS IS THE FIX
                        // $('#tabelJenisTindakanDokterPerawat').width(w + 5);
                    }
                },

                columnDefs: [{
                    targets: [0],
                    orderable: false
                },
                    {
                        targets: [4],
                        className: 'text-end'
                    }
                ],

                columns: [{
                    name: 'kd_jenis_prw',
                    data: 'kd_jenis_prw',
                    title: '',
                    render: function (data, type, row, meta) {
                        // jangan gunakan onchange inline (kita pakai delegated handler)
                        const checked = selectedRowsDrPr.includes(data) ? 'checked' : '';
                        return `<input type="checkbox" class="form-check-input tindakan-check" data-id="${data}" ${checked}>`;
                    }
                },
                    {
                        data: 'kd_jenis_prw',
                        title: 'Kode',
                    },
                    {
                        data: 'nm_perawatan',
                        title: 'Nama Tindakan'
                    },
                    {
                        data: 'kategori.nm_kategori',
                        title: 'Kategori'
                    },
                    {
                        data: 'total_byrdrpr',
                        title: 'Biaya',
                        render: function (data, type, row, meta) {
                            console.log('DATA ===', data)
                            return formatCurrency(data);
                        }
                    },
                ],
                initComplete: function (setting, json) {
                    const api = this.api();
                    api.columns.adjust().draw();
                }
            });

            // delegated handler untuk checkbox (satu handler untuk seluruh table)
            $('#tabelJenisTindakanDokterPerawat').off('change', '.tindakan-check').on('change', '.tindakan-check', function () {
                const id = $(this).data('id');
                const $tr = $(this).closest('tr');
                const rowApi = table.row($tr);
                const rowData = rowApi.data(); // ambil data baris sekarang (penting untuk cache)

                if (this.checked) {
                    if (!selectedRowsDrPr.includes(id)) {
                        selectedRowsDrPr.push(id);
                    }
                    // simpan ke cache segera supaya saat kita draw halaman 1, data tersedia
                    if (rowData) selectedDataCacheDrPr[id] = rowData;
                } else {
                    // uncheck -> hapus dari selected + cache
                    selectedRowsDrPr = selectedRowsDrPr.filter(x => x !== id);
                    delete selectedDataCacheDrPr[id];
                }

                // pindah ke halaman pertama, lalu redraw (false supaya tidak kehilangan state paging)
                table.page(0).draw(false);
            });


            return table;
        }

        function createTindakanDokterPerawat() {
            const formInfoTindakan = $('.formInfoTindakan')
            const formTindakanDokterPerawat = $('#formTindakanDokterPerawat')

            const no_rawat = formInfoTindakan.find('#no_rawat').val();
            const nip = formTindakanDokterPerawat.find('#nip').val();
            const kd_dokter = formTindakanDokterPerawat.find('#kd_dokter').val();
            const nm_pasien = formInfoTindakan.find('#nm_pasien').val();
            const no_rkm_medis = formInfoTindakan.find('#no_rkm_medis').val();

            let selectedData = selectedRowsDrPr
                .map(id => {
                    const data = selectedDataCacheDrPr[id];
                    if (!data) return null;

                    return data;
                })
                .filter(Boolean);

            $.post('/erm/tindakan/dokter-perawat', {
                no_rawat,
                nip,
                kd_dokter,
                nm_pasien,
                no_rkm_medis,
                tindakan: selectedData
            }).done((response) => {
                $('.tindakan-check').prop('checked', false);
                selectedData = []
                selectedRowsDrPr = []
                selectedDataCacheDrPr = {}
                getTindakanDilakukanDrPr(no_rawat)
                swalToast('Berhasil Menambah Tindakan')
            }).fail((result) => {
                Swal.fire({
                    title: 'Gagal',
                    html: result.responseJSON.message,
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Tutup',
                })
            });
        }


        function getTindakanDilakukanDrPr(no_rawat) {
            $.get(`/erm/tindakan/dokter-perawat/get`, {
                no_rawat: no_rawat
            }).done((response) => {
                const tbody = $('#tabelTindakanDilakukanDrPr tbody');
                tbody.empty();

                console.log('RESPONSE TINDAKAN DR PR ===', response)
                response.forEach((item, index) => {
                    const row = `<tr>
                        <td><input type="checkbox" class="form-check-input tindakan-hasil" name="kode_tindakan[]" id="tindakan${index}" value="${item.kd_jenis_prw}" data-tgl="${item.tgl_perawatan}" data-jam="${item.jam_rawat}" data-rawat="${item.no_rawat}"  data-nip="${item.nip}" data-dokter="${item.kd_dokter}"/></td>
                        <td>${splitTanggal(item.tgl_perawatan)}</td>
                        <td>${item.jam_rawat}</td>
                        <td>${item.tindakan.nm_perawatan}</td>
                        <td>
                            <ul>
                                <li>${item.dokter.nm_dokter}</li>
                                <li>${item.petugas.nama} </li>
                            </ul>
                        </td>
                        <td class="text-end">${formatCurrency(item.biaya_rawat)}</td>
                    </tr>`;
                    tbody.append(row);
                });
            })
        }


        function deleteTindakanDokterPerawat() {
            const formInfoTindakan = $('.formInfoTindakan')
            const formTindakanDokterPerawat = $('#formTindakanDokterPerawat')

            const no_rawat = formInfoTindakan.find('#no_rawat').val();
            const nm_pasien = formInfoTindakan.find('#nm_pasien').val();
            const no_rkm_medis = formInfoTindakan.find('#no_rkm_medis').val();


            Swal.fire({
                title: 'Yakin ?',
                html: `Anda akan menghapus data tindakan ini ?`,
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',

            }).then((result) => {
                if (result.isConfirmed) {
                    const checkedTindakan = $('.tindakan-hasil:checked').map(function () {
                        const $this = $(this);
                        return {
                            kd_jenis_prw: $this.val(),
                            no_rawat: $this.data('rawat'),
                            jam_rawat: $this.data('jam'),
                            tgl_perawatan: $this.data('tgl'),
                            nip : $this.data('nip'),
                            kd_dokter : $this.data('dokter')
                        };
                    }).get();

                    $.ajax({
                        url: `/erm/tindakan/dokter-perawat/delete`,
                        method: 'DELETE',
                        data: {
                            no_rawat: no_rawat,
                            nm_pasien: nm_pasien,
                            no_rkm_medis: no_rkm_medis,
                            tindakan: checkedTindakan

                        }
                    }).done((response) => {
                        getTindakanDilakukanDrPr(no_rawat)
                        swalToast('Berhasil Menghapus Tindakan')
                    }).fail((result) => {
                        Swal.fire({
                            title: 'Gagal',
                            html: result.responseJSON.message,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'Tutup',
                        })
                    })
                }
            })


        }
    </script>
@endpush