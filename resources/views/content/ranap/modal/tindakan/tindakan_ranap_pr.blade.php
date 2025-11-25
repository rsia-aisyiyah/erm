<div id="tindakanPerawatRajal">
    <form action="" id="formTindakanPerawatRanap">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-lg-12">
                <label for="nip">Petugas</label>
                <select name="nip" id="nip" class="select2 w-100"
                        data-dropdown-parent="#formTindakanPerawatRanap"></select>
            </div>
            <div class="col-md-12 mt-2">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-striped" id="tabelJenisTindakanPerawatRanap">

                    </table>
                </div>

                <button type="button" class="btn btn-sm btn-primary" id="btnCreateTindakanPerawat"
                        onclick="createTindakanPerawatRanap()"><i class="bi bi-floppy"></i> Buat
                </button>
            </div>
        </div>
    </form>
</div>

@push('script')

    <script>
        $('#btnTabTindakanPerawatRanap').on('shown.tab.bs', () => {
            const formInfoPasien = $('#formInfoPasien')
            const formTindakanPerawatRanap = $('#formTindakanPerawatRanap')

            const nm_dokter = formInfoPasien.find('input[name="dokter_dpjp"]').val()
            const kd_dokter = formInfoPasien.find('input[name=kd_dokter_dpjp').val()
            const no_rawat = formInfoPasien.find('#no_rawat').val()

            const user = new Option("{{session()->get('pegawai')->nama}}", "{{session()->get('pegawai')->nik}}", true, true)
            formTindakanPerawatRanap.find('#nip').append(user).trigger('change')


            formTindakanPerawatRanap.find('#nip').select2({
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


            tableJenisTindakanPerawatRanap()

        })

        modalSoapRanap.on('shown.bs.modal', function () {
            $('.tindakan-check').each(function () {
                $(this).prop('checked', false);
            });

            selectedRowsPrRanap = [];
            selectedDataCachePrRanap = {};
            lastRequestStartPr = 0;
        })
        // global
        let selectedRowsPrRanap = [];
        let selectedDataCachePrRanap = {};
        let lastRequestStartPr = 0;

        $('#tabelJenisTindakanPerawatRanap').off('click', 'tbody tr').on('click', 'tbody tr', function (e) {
            if ($(e.target).is('input[type="checkbox"]') || $(this).hasClass('child')) return;

            const $checkbox = $(this).find('.tindakan-check');
            if ($checkbox.length) {
                $checkbox.prop('checked', !$checkbox.prop('checked')).trigger('change');
            }
        });

        function tableJenisTindakanPerawatRanap() {
            // simpan referensi table ke variable supaya bisa dipakai di event handler
            const table = new DataTable('#tabelJenisTindakanPerawatRanap', {
                responsive: true,
                serverSide: true,
                processing: true,
                destroy: true,
                autoWidth: false,
                lengthChange: false,
                info: false,

                ajax: {
                    url: '/erm/jenis-tindakan/ranap/datatable/pr',
                    type: 'GET',
                    // tangkap request params sebelum dikirim
                    data: function (d) {
                        lastRequestStartPr = d.start || 0;
                        return d;
                    },
                    // intercept response dari server
                    dataSrc: function (json) {
                        // update cache untuk selected ids yang mungkin ada di response ini
                        json.data.forEach(d => {
                            if (selectedRowsPrRanap.includes(d.kd_jenis_prw)) {
                                selectedDataCachePrRanap[d.kd_jenis_prw] = d;
                            }
                        });

                        // jika request halaman pertama (start === 0) => gabungkan selected rows di depan
                        if (lastRequestStartPr === 0) {
                            // buat array checkedData berdasarkan urutan selectedRowsPrRanap
                            const checkedData = selectedRowsPrRanap.map(id => selectedDataCachePrRanap[id]).filter(Boolean);

                            // hindari duplikat: kumpulkan id yang sudah ada di checkedData
                            const checkedIds = new Set(checkedData.map(d => d.kd_jenis_prw));

                            // sisanya dari response yang bukan selected
                            const otherData = json.data.filter(d => !checkedIds.has(d.kd_jenis_prw));

                            // gabungkan: selected dulu, lalu data lainnya
                            return [...checkedData, ...otherData];
                        } else {
                            // bukan halaman pertama => jangan tampilkan item yg sudah dipindah ke halaman 1
                            return json.data.filter(d => !selectedRowsPrRanap.includes(d.kd_jenis_prw));
                        }
                    },
                    complete: function () {
                        // $('#tabelJenisTindakanPerawatRanap tbody').width(w - 5); // -- - THIS IS THE FIX
                        // $('#tabelJenisTindakanPerawatRanap').width(w + 5);
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
                        const checked = selectedRowsPrRanap.includes(data) ? 'checked' : '';
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
                        data: 'total_byrpr',
                        title: 'Biaya',
                        render: function (data, type, row, meta) {
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
            $('#tabelJenisTindakanPerawatRanap').off('change', '.tindakan-check').on('change', '.tindakan-check', function () {
                const id = $(this).data('id');
                const $tr = $(this).closest('tr');
                const rowApi = table.row($tr);
                const rowData = rowApi.data(); // ambil data baris sekarang (penting untuk cache)

                if (this.checked) {
                    if (!selectedRowsPrRanap.includes(id)) {
                        selectedRowsPrRanap.push(id);
                    }
                    // simpan ke cache segera supaya saat kita draw halaman 1, data tersedia
                    if (rowData) selectedDataCachePrRanap[id] = rowData;
                } else {
                    // uncheck -> hapus dari selected + cache
                    selectedRowsPrRanap = selectedRowsPrRanap.filter(x => x !== id);
                    delete selectedDataCachePrRanap[id];
                }

                // pindah ke halaman pertama, lalu redraw (false supaya tidak kehilangan state paging)
                table.page(0).draw(false);
            });


            return table;
        }

        function createTindakanPerawatRanap() {
            const formInfoPasien = $('#formInfoPasien')
            const formTindakanPerawatRanap = $('#formTindakanPerawatRanap')

            const no_rawat = formInfoPasien.find('input[name=no_rawat]').val();
            const nip = formTindakanPerawatRanap.find('select[name=nip]').val();
            const nm_pasien = formInfoPasien.find('input[name=pasien]').val();
            const no_rkm_medis = formInfoPasien.find('input[name=no_rkm_medis]').val();

            let selectedData = selectedRowsPrRanap
                .map(id => {
                    const data = selectedDataCachePrRanap[id];
                    if (!data) return null;

                    return data;
                })
                .filter(Boolean);

            $.post('/erm/tindakan-ranap/perawat', {
                no_rawat,
                nip,
                nm_pasien,
                no_rkm_medis,
                tindakan: selectedData
            }).done((response) => {
                $('.tindakan-check').prop('checked', false);
                selectedData = []
                selectedRowsPrRanap = []
                selectedDataCachePrRanap = {}
                getTindakanPerawatRanap()
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

        function deleteTindakanPerawatRanap() {
            const formInfoPasien = $('#formInfoPasien')
            const formTindakanPerawatRanap = $('#formTindakanPerawatRanap')

            const no_rawat = formInfoPasien.find('#no_rawat').val();
            const nip = formTindakanPerawatRanap.find('#nip').val();
            const nm_pasien = formInfoPasien.find('input[name=pasien]').val();
            const no_rkm_medis = formInfoPasien.find('#no_rkm_medis').val();

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
                    const checkedTindakan = $('#tbTindakanPerawatRanap tbody').find('.check-tindakan-perawat:checked').map(function () {
                        const $this = $(this);
                        return {
                            kd_jenis_prw: $this.val(),
                            no_rawat: $this.data('rawat'),
                            jam_rawat: $this.data('jam'),
                            tgl_perawatan: $this.data('tgl'),
                            nip: $this.data('nip')
                        };
                    }).get();

                    $.ajax({
                        url: `/erm/tindakan-ranap/perawat/delete`,
                        method: 'DELETE',
                        data: {
                            no_rawat: no_rawat,
                            nm_pasien: nm_pasien,
                            no_rkm_medis: no_rkm_medis,
                            tindakan: checkedTindakan

                        }
                    }).done((response) => {
                        getTindakanPerawatRanap()
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