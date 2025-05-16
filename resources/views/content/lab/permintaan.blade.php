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
                        <div class="col-lg-6 col-sm-12 col-md-12">
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
                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                        <label for="tgl_lahir">Tgl. Lahir/Umur</label>
                                        <x-input id="tgl_lahir" name="tgl_lahir" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                        <label for="dokter">Dokter DPJP</label>
                                        <x-input id="dokter" name="dokter" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <label for="kamarInap">Kamar Inap</label>
                                        <x-input id="kamarInap" name="kamarInap" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <label for="diagnosis_awal">Dx. Awal</label>
                                        <x-input id="diagnosis_awal" name="diagnosis_awal" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <label for="perujuk">Dokter Rujuk</label>
                                        <x-input id="perujuk" name="perujuk" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                        <label for="petugas">Petugas</label>
                                        <x-input id="petugas" name="petugas" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                        <label for="petugas">Tgl. Periksa</label>
                                        <x-input id="petugas" name="petugas" readonly />
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-6">
                                        <label for="petugas">No. Permintaan</label>
                                        <select class="form-select" id="noorder" name="noorder" data-dropdown-parent="#formHasilPermintaanLab" style="width:100%;font-size:10px"></select>
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
                        <div class="col-lg-6">
                            <div class="accordion" id="accordionPermintaanLab">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item’s accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the
                                            transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>This is the second item’s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though
                                            the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>This is the third item’s accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It’s also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the
                                            transition does limit overflow.
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src={{ asset('js/context-menu/lab.js') }}></script>
    <script>
        const tablePermintaanLab = $('#tablePermintaanLab')
        const btnFilterTglLab = $('#btnFilterTglLab')
        const modalHasilPermintaanLab = $('#modalHasilPermintaanLab')
        const contentHasilPermintaanLab = modalHasilPermintaanLab.find('#contentHasil')
        const tableHasilPermintaanLab = modalHasilPermintaanLab.find('#tbHasilPermintaanLab tbody')
        const formHasilPermintaanLab = modalHasilPermintaanLab.find('#formHasilPermintaanLab')
        const selectNoOrder = formHasilPermintaanLab.find('#noorder')
        const accordionPermintaanLab = $('#accordionPermintaanLab')
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

        console.log(tgl_pertama, tgl_kedua);


        $('#tgl_pertama').datepicker('setDate', tgl_pertama);
        $('#tgl_kedua').datepicker('setDate', tgl_kedua);

        // $('.filterTanggal').datepicker('setDate', `{{ date('d-m-Y') }}`);

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


        function showHasilPemeriksaanLab(no_rawat, tgl_periksa, jam) {
            $.get(`/erm/lab/ambil`, {
                no_rawat: no_rawat,
                tgl_periksa: tgl_periksa,
                jam: jam

            }).done((response) => {

                console.log('SHOW RESPONSE ===', response);

                getRegPeriksa(no_rawat).done((rawat) => {
                    formHasilPermintaanLab.find('#no_rawat').val(rawat.no_rawat);
                });
                modalHasilPermintaanLab.modal('show');
                tableHasilPermintaanLab.html(renderHasilPemeriksaanLab(response));
                riwayatPemeriksaanLab(no_rawat)
            })
        }

        function riwayatPemeriksaanLab(no_rawat) {
            $.get(`/erm/lab/permintaan`, {
                no_rawat: no_rawat
            }).done((response) => {
                const content = response.map((data, index) => {
                    return ` <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${index}" aria-expanded="true" aria-controls="collapse${index}">
                                        ${data.noorder}
                                        </button>
                                    </h2>
                                    <div id="collapse${index}" class="accordion-collapse collapse">
                                        <div class="accordion-body" id="content${index}">
                                            <table class="table table-bordered">
                                                 <thead>
                                            <tr>
                                                <th>Pemeriksaan</th>
                                                <th>Hasil</th>
                                                <th>Nilai Rujukan</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                ${renderItemRiwayatPemeriksaanLab(data.hasil, index)}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>`
                })


                accordionPermintaanLab.html(content);

            })
        }

        function renderItemRiwayatPemeriksaanLab(data, index) {
            return renderHasilPemeriksaanLab(data);
            // $(`#content${index}`).html(content);
        }

        function renderHasilPemeriksaanLab(data) {
            let content = '';
            data.forEach(element => {
                content += `
                <tr class="borderless row-secondary">
                    <td colspan=4><strong>${element.jns_perawatan_lab.nm_perawatan}</strong></td>
                </tr>
                    ${renderSubHasilPemeriksaanLab(element.detail)}`

                // const opPermintaan = new Option(`${element.permintaan.noorder} - ${splitTanggal(element.permintaan.tgl_permintaan)} ${element.permintaan.jam_permintaan}`, element.permintaan.noorder, true, true);
                // selectNoOrder.append(opPermintaan).trigger('change.select2');

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

        selectNoOrder.on('select2:select', (e) => {
            const noorder = e.params.data.id;
            $.get(`/erm/lab/permintaan`, {
                noorder: noorder
            }).done((response) => {
                $.get(`/erm/lab/ambil`, {
                    no_rawat: response.no_rawat,
                    tgl_periksa: response.tgl_hasil,
                    jam: response.jam_hasil
                }).done((response) => {
                    renderHasilPemeriksaanLab(response);
                })
            })
        })
    </script>
@endpush
