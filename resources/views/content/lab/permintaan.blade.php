@extends('index')

@section('contents')
    <div class="card">
        <div class="card-body">
            <div class="row gy-2">
                <div class="col-lg-3 col-md-12 col-md-12">
                    <label class="form-label">Tgl. Pemeriksaan</label>
                    <x-input-group class="input-group-sm">
                        <x-input id="tgl_pertama" name="tgl_pertama" class="filterTanggal" />
                        <x-input-group-text>s.d.</x-input-group-text>
                        <x-input id="tgl_kedua" name="tgl_kedua" class="filterTanggal" />
                        <button class="btn btn-primary" id="btnFilterTglLab">
                            <i class="bi bi-search"></i>
                        </button>
                    </x-input-group>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle" id="tablePermintaanLab" style="font-size: 11px">

                </table>

            </div>

        </div>
    </div>

    @include('content.ranap.modal.modal_riwayat')
    <div class="modal fade" id="modalHasilPermintaanLab" tabindex="-1" aria-labelledby="modalExampleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHasilPermintaanLabLabel">Modal Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row gy-2 mb-3">
                        <div class="col-lg-7 col-sm-12 col-md-12">
                            <form id="formHasilPermintaanLab">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-2">
                                        <label for="no_rawat">No. Rawat</label>
                                        <x-input id="no_rawat" name="no_rawat" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <label for="nm_pasien">Pasien</label>
                                        <x-input id="nm_pasien" name="nm_pasien" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-2">
                                        <label for="tgl_lahir">Tgl. Lahir/Umur</label>
                                        <x-input id="tgl_lahir" name="tgl_lahir" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <label for="dokter">Dokter DPJP</label>
                                        <x-input id="dokter" name="dokter" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                        <label for="kamarInap">Kamar Inap</label>
                                        <x-input id="kamarInap" name="kamarInap" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                        <label for="diagnosis_awal">Dx. Awal</label>
                                        <x-input id="diagnosis_awal" name="diagnosis_awal" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-2">
                                        <label for="informasi">Informasi Lain</label>
                                        <x-input id="informasi" name="informasi" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-2">
                                        <label for="tgl_sampel">Tgl. Sampling/Periksa</label>
                                        <x-input id="tgl_sampel" name="tgl_sampel" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-2">
                                        <label for="petugas">Tgl. Hasil</label>
                                        <x-input id="tgl_hasil" name="tgl_hasil" readonly />
                                    </div>
                                </div>
                                <hr />
                            </form>
                            <div class="row gy-2">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <table class="table table-bordered" id="tbHasilPermintaanLab">
                                        <thead>
                                            <tr>
                                                <th>Pemeriksaan</th>
                                                <th>Hasil</th>
                                                <th>Nilai Rujukan</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>

                                        <tbody></tbody>

                                    </table>
                                </div>
                                {{-- <div class="col-lg-6 col-sm-12 col-md-12">
                                    <div id="formSaranKesanLab">
                                        <label for="saran">Saran</label>
                                        <x-textarea id="saran" name="saran"></x-textarea>
                                        <label for="kesan">Kesan</label>
                                        <x-textarea id="kesan" name="kesan"></x-textarea>
                                    </div>
                                </div> --}}

                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-12 col-md-12">
                            <div class="row gy-3">
                                <div class="col-lg-12 order-lg-1 order-sm-2 order-md-2">
                                    <p class="h5">Riwayat Permintaan </p>
                                    <ol class="list-group list-group-numbered overflow-auto" id="listRiwayatPermintaanLab" style="max-height: 300px">

                                    </ol>
                                </div>
                                <div class="col-lg-12 order-lg-2 order-sm-1 order-md-1">
                                    <fieldset class="border p-3">
                                        <legend class="w-auto float-none" style="font-size : 14px">Saran & Kesan Hasil</legend>
                                        <form action="" id="saranKesanLab">
                                            <label for="saran">Saran</label>
                                            <x-textarea id="saran" name="saran"></x-textarea>
                                            <label for="kesan">Kesan</label>
                                            <x-textarea id="kesan" name="kesan"></x-textarea>
                                            <button type="button" class="mt-2 btn btn-primary btn-sm" id="btnSimpanHasilSaranLab"><i class="bi bi-save"></i> Simpan</button>
                                            <button type="button" class="mt-2 btn btn-danger btn-sm" id="btnHapusHasilSaranLab"><i class="bi bi-trash"></i> Hapus</button>
                                        </form>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    @include('content.ranap.modal.modal_soap')
@endsection

@push('script')
    <script src={{ asset('js/context-menu/lab.js') }}></script>
    <script>
        const tablePermintaanLab = $('#tablePermintaanLab')
        const btnFilterTglLab = $('#btnFilterTglLab')
        const modalHasilPermintaanLab = $('#modalHasilPermintaanLab')
        const contewntHasilPermintaanLab = modalHasilPermintaanLab.find('#contentHasil')
        const tableHasilPermintaanLab = modalHasilPermintaanLab.find('#tbHasilPermintaanLab tbody')
        const formHasilPermintaanLab = modalHasilPermintaanLab.find('#formHasilPermintaanLab')
        const selectNoOrder = formHasilPermintaanLab.find('#noorder')
        const listRiwayatPermintaanLab = $('#listRiwayatPermintaanLab')
        const btnSimpanHasilSaranLab = $('#btnSimpanHasilSaranLab');
        const saranKesanLab = $('#saranKesanLab');
        const saranLab = saranKesanLab.find('#saran');
        const kesanLab = saranKesanLab.find('#kesan');
        const btnHapusHasilSaranLab = $('#btnHapusHasilSaranLab');

        $(document).ready(() => {
            renderTablePermintaanLab();
        })

        $('.filterTanggal').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            orientation: 'bottom',
            todayHighlight: true,
        })
        const tgl_pertama = localStorage.getItem('tgl_pertama') ? localStorage.getItem('tgl_pertama') : `{{ date('d-m-Y') }}`;
        const tgl_kedua = localStorage.getItem('tgl_kedua') ? localStorage.getItem('tgl_kedua') : `{{ date('d-m-Y') }}`;

        $('#tgl_pertama').datepicker('setDate', tgl_pertama);
        $('#tgl_kedua').datepicker('setDate', tgl_kedua);

        function renderTablePermintaanLab() {
            tablePermintaanLab.dataTable({
                processing: true,
                destroy: true,
                serverSide: true,
                nowrap: true,
                ajax: {
                    url: '/erm/lab/permintaan/table',
                    data: function(d) {
                        d.tgl_pertama = $('#tgl_pertama').val();
                        d.tgl_kedua = $('#tgl_kedua').val();
                    }
                },
                createdRow: (row, data, index) => {
                    $(row).addClass('row-permintaan-lab')
                        .attr('data-id', data.no_rawat)
                        .attr('data-tgl', data.tgl_hasil)
                        .attr('data-jam', data.jam_hasil)
                        .attr('data-noorder', data.noorder)
                        .attr('data-no_rkm_medis', data.reg_periksa.no_rkm_medis);
                },
                columnDefs: [{
                    target: 1,
                    width: 260,

                }, {
                    target: 3,
                    width: 80,
                }, {
                    target: 4,
                    width: 95,
                }, {
                    target: 5,
                    width: 95,
                }, {
                    target: 6,
                    width: 95,
                }, {
                    target: 8,
                    width: 90,
                }],
                columns: [{
                        title: 'No. Order',
                        data: 'noorder',
                        name: 'noorder',
                    },
                    {
                        title: 'Nama',
                        data: 'reg_periksa',
                        name: 'no_rawat',
                        render: (data, type, row, meta) => {
                            return `${data.no_rawat} <br/> ${data.no_rkm_medis} - ${data.pasien.nm_pasien} (${data.umurdaftar} ${data.sttsumur})`
                        }
                    },
                    {
                        title: 'Diagnosis',
                        data: 'diagnosa_klinis',
                        name: 'diagnosa_klinis',
                    },
                    {
                        title: 'Informasi',
                        data: 'informasi_tambahan',
                        name: 'informasi_tambahan',
                    },

                    {
                        title: 'Tgl. Permintaan',
                        data: 'tgl_permintaan',
                        render: (data, type, row, meta) => {
                            return `${moment(data).format('DD-MM-YYYY')} <br/>${row.jam_permintaan}`
                        }
                    }, {
                        title: 'Tgl. Sampling',
                        data: 'tgl_sampel',
                        render: (data, type, row, meta) => {
                            if (data === '0000-00-00') {
                                return '-';
                            }
                            return `${moment(data).format('DD-MM-YYYY')} <br/>${row.jam_sampel}`
                        }
                    },
                    {
                        title: 'Tgl. Hasil',
                        data: 'tgl_hasil',
                        render: (data, type, row, meta) => {
                            if (data === '0000-00-00') {
                                return '-';
                            }
                            return `${moment(data).format('DD-MM-YYYY')} <br/>${row.jam_hasil}`
                        }
                    },
                    {
                        title: 'Dokter Perujuk',
                        data: 'dokter.nm_dokter',
                        name: 'dokter_perujuk',
                    },
                    {
                        title: 'Pembiayaan',
                        data: 'reg_periksa.penjab',
                        orderable: false,
                        // name: 'reg_periksa.penjab',
                        render: (data, type, row, meta) => {
                            if (data.kd_pj == 'A01' || data.kd_pj == 'A05') {
                                return `<strong class="text-success">${data.png_jawab}</strong>`
                            } else {
                                return `<strong class="text-danger">${data.png_jawab}</strong>`
                            }
                        }
                    },
                    {
                        title: 'Status',
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        render: (data, type, row, meta) => {
                            if (data === 'ralan') {
                                return '<button type="button" class="btn btn-warning btn-sm ">Rawat Jalan</button>';
                            } else {
                                return '<button type="button" class="btn btn-danger btn-sm">Rawat Inap</button>';
                            }
                        }
                    },

                ],
            })
        }

        btnFilterTglLab.on('click', () => {
            renderTablePermintaanLab();
            const tgl_pertama = $('#tgl_pertama').val();
            const tgl_kedua = $('#tgl_kedua').val();
            localStorage.setItem('tgl_pertama', $('#tgl_pertama').val());
            localStorage.setItem('tgl_kedua', $('#tgl_kedua').val());
        })


        function showHasilPemeriksaanLab(no_rawat, noorder) {
            riwayatPemeriksaanLab(no_rawat).done((response) => {
                getPermintaanLab(noorder).done((data) => {
                    $(`#item${noorder}`).addClass('active');
                    $(`#item${noorder}`).siblings().removeClass('active');
                })

            })
            modalHasilPermintaanLab.modal('show');
        }

        function getPermintaanLab(noorder) {
            return $.get(`/erm/lab/permintaan`, {
                noorder: noorder
            }).done((response) => {
                getRegPeriksa(response.no_rawat).done((rawat) => {
                    formHasilPermintaanLab.find('#no_rawat').val(rawat.no_rawat);
                    formHasilPermintaanLab.find('#nm_pasien').val(`${rawat.no_rkm_medis} - ${rawat.pasien.nm_pasien} (${rawat.pasien.jk})`);
                    formHasilPermintaanLab.find('#tgl_lahir').val(`${splitTanggal(rawat.pasien.tgl_lahir)} / ${rawat.umurdaftar} ${rawat.sttsumur}`);
                    formHasilPermintaanLab.find('#dokter').val(rawat.dokter.nm_dokter);
                    formHasilPermintaanLab.find('#penjab').val(rawat.penjab.png_jawab);
                    const kamar = rawat.kamar_inap.filter((item) => {
                            return item.stts_pulang !== 'Pindah Kamar'
                        })
                        .map((item) => {
                            return item.kamar.bangsal.nm_bangsal
                        })
                    formHasilPermintaanLab.find('#kamarInap').val(kamar);
                });
                formHasilPermintaanLab.find('#diagnosis_awal').val(response.diagnosa_klinis);
                formHasilPermintaanLab.find('#informasi').val(response.informasi_tambahan);
                formHasilPermintaanLab.find('#tgl_sampel').val(`${splitTanggal(response.tgl_sampel)} ${response.jam_sampel}`);
                formHasilPermintaanLab.find('#tgl_hasil').val(`${splitTanggal(response.tgl_hasil)} ${response.jam_hasil}`);
                tableHasilPermintaanLab.html(renderHasilPemeriksaanLab(response.hasil, response.saran_kesan));

                saranLab.val(response.saran_kesan?.saran);
                kesanLab.val(response.saran_kesan?.kesan);

            })
        }

        function riwayatPemeriksaanLab(no_rawat) {
            return $.get(`/erm/lab/permintaan`, {
                no_rawat: no_rawat
            }).done((response) => {
                const content = response.map((data, index) => {
                    return `<li class="list-group-item d-flex justify-content-between align-items-start" onclick="getRiwayatPemeriksaanLab('${data.noorder}', this)" id="item${data.noorder}">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">${data.noorder}</div>
                                        Tgl. Permintaan ${splitTanggal(data.tgl_permintaan)} ${data.jam_permintaan}
                                    </div>
                                    ${ data.tgl_hasil === '0000-00-00' ? '<span class="badge bg-danger rounded-pill my-auto">Tidak Ada Pemeriksaan</span>' : `<span class="badge bg-success rounded-pill my-auto">Tgl. Hasil ${splitTanggal(data.tgl_hasil)} ${data.jam_hasil}</span>`}
                                </li> `
                })


                listRiwayatPermintaanLab.html(content);

            })
        }

        function renderItemRiwayatPemeriksaanLab(data, index) {
            return renderHasilPemeriksaanLab(data);
            // $(`#content${index}`).html(content);
        }

        function renderHasilPemeriksaanLab(data, saran = null) {
            if (saran) {
                btnSimpanHasilSaranLab.removeClass('btn-primary')
                    .addClass('btn-warning')
                    .attr('onclick', `ubahHasilSaranLab()`)
                    .html('<i class="bi bi-pencil"></i> Ubah');

                btnHapusHasilSaranLab.removeClass('d-none')
            } else {
                btnSimpanHasilSaranLab
                    .removeClass('btn-warning')
                    .addClass('btn-primary')
                    .attr('onclick', `simpanHasilSaranLab()`)
                    .html('<i class="bi bi-save"></i> Simpan');
                btnHapusHasilSaranLab.addClass('d-none')
                    .removeAttr('onclick');
            }


            let content = '';
            data.forEach(element => {
                content += `
                <tr class="borderless row-secondary">
                    <td colspan=3><strong>${element.jns_perawatan_lab.nm_perawatan}</strong></td>
                    <td>${element.petugas.nama}</td>
                </tr>
                    ${renderSubHasilPemeriksaanLab(element.detail)}`
            });
            return content;
        }

        function renderSubHasilPemeriksaanLab(data) {
            let content = '';
            data.sort((a, b) => a.template.urut - b.template.urut);

            data.forEach(element => {
                content += `
                    <tr class="${setWarnaPemeriksaan(element.keterangan)}">
                        <td>${element.template.Pemeriksaan}</td>
                        <td>${element.nilai} ${element.template.satuan}</td>
                        <td>${element.nilai_rujukan} ${element.template.satuan}</td>
                        <td>${element.keterangan}</td>
                    </tr>`
            });
            return content;
        }

        selectNoOrder.select2({
            placeholder: 'Pilih No Order',
            ajax: {
                url: `/erm/lab/permintaan`,
                dataType: 'json',
                data: (params) => {
                    return {
                        no_rawat: formHasilPermintaanLab.find('#no_rawat').val(),
                    }
                },
                dataType: 'json',
                processResults: function(data) {
                    return {
                        results: data.map((item) => {
                            return {
                                id: item.noorder,
                                text: `${item.noorder} - ${splitTanggal(item.tgl_permintaan)} ${item.jam_permintaan}`,
                            }
                        })
                    };
                },
                cache: true
            },
        })

        function getRiwayatPemeriksaanLab(noorder, e) {
            getPermintaanLab(noorder);
            $(e).addClass('active');
            $(e).siblings().removeClass('active');
        }

        function simpanHasilSaranLab() {
            const no_rawat = formHasilPermintaanLab.find('#no_rawat').val();
            const tglPeriksa = formHasilPermintaanLab.find('#tgl_hasil').val();
            const tanggal = tglPeriksa.split(' ')[0];
            const jam = tglPeriksa.split(' ')[1];
            const saran = $('#saranKesanLab').find('#saran').val();
            const kesan = $('#saranKesanLab').find('#kesan').val();

            $.post(`/erm/lab/saran-kesan`, {
                no_rawat: no_rawat,
                tgl_periksa: splitTanggal(tanggal),
                jam: jam,
                saran: saran,
                kesan: kesan
            }).done((response) => {
                alertSuccessAjax('Berhasil menyimpan saran dan kesan').then(() => {
                    btnSimpanHasilSaranLab.removeClass('btn-primary')
                        .addClass('btn-warning')
                        .attr('onclick', `ubahHasilSaranLab()`)
                        .html('<i class="bi bi-pencil"></i> Ubah');

                    btnHapusHasilSaranLab.removeClass('d-none')
                })

            }).fail((error) => {
                const errors = error.responseJSON.errors;
                const errorStringOneLine = Object.entries(errors)
                    .map(([field, messages]) => `${messages.join(', ')}`)
                    .join('; ');

                const errorString = `${error.responseJSON.message} <br/> ${errorStringOneLine}`;

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: `${errorString}`
                })
            })
        }

        function ubahHasilSaranLab() {
            const no_rawat = formHasilPermintaanLab.find('#no_rawat').val();
            const tglPeriksa = formHasilPermintaanLab.find('#tgl_hasil').val();
            const tanggal = tglPeriksa.split(' ')[0];
            const jam = tglPeriksa.split(' ')[1];
            const saran = $('#saranKesanLab').find('#saran').val();
            const kesan = $('#saranKesanLab').find('#kesan').val();


            $.ajax({
                url: `/erm/lab/saran-kesan`,
                method: 'PUT',
                data: {
                    no_rawat: no_rawat,
                    tgl_periksa: splitTanggal(tanggal),
                    jam: jam,
                    saran: saran,
                    kesan: kesan
                },
            }).done((response) => {
                alertSuccessAjax('Berhasil menyimpan perubahan saran dan kesan')
            }).fail((error) => {
                const errors = error.responseJSON.errors;
                const errorStringOneLine = Object.entries(errors)
                    .map(([field, messages]) => `${messages.join(', ')}`)
                    .join('; ');
            })

        }

        btnHapusHasilSaranLab.on('click', () => {
            Swal.fire({
                title: 'Yakin ingin menghapus saran dan kesan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteHasilSaranLab();
                }
            })


        })

        function deleteHasilSaranLab() {
            const no_rawat = formHasilPermintaanLab.find('#no_rawat').val();
            const tglPeriksa = formHasilPermintaanLab.find('#tgl_hasil').val();
            const tanggal = tglPeriksa.split(' ')[0];
            const jam = tglPeriksa.split(' ')[1];
            $.ajax({
                url: `/erm/lab/saran-kesan`,
                method: 'DELETE',
                data: {
                    no_rawat: no_rawat,
                    tgl_periksa: splitTanggal(tanggal),
                    jam: jam
                },
            }).done((response) => {
                alertSuccessAjax('Berhasil menghapus saran dan kesan').then(() => {
                    btnSimpanHasilSaranLab
                        .removeClass('btn-warning')
                        .addClass('btn-primary')
                        .attr('onclick', `simpanHasilSaranLab()`)
                        .html('<i class="bi bi-save"></i> Simpan');
                    btnHapusHasilSaranLab.addClass('d-none')
                        .removeAttr('onclick');
                })
                saranLab.val('');
                kesanLab.val('');
            }).fail((error) => {
                const errors = error.responseJSON.errors;
                const errorStringOneLine = Object.entries(errors)
                    .map(([field, messages]) => `${messages.join(', ')}`)
                    .join('; ');
            })
        }
    </script>
@endpush
