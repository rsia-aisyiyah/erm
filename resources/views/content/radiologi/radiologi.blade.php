@extends('index')

@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form id="formFilterRadiologi">
                        <div class="row">
                            <div class="col-md-6 col-lg-3 col-sm-12">
                                <label for="tgl_registrasi" class="form-label" style="font-size: 12px;margin-bottom:0px">Periode</label>
                                <div class="input-group input-group-sm input-daterange">
                                    <input type="text" class="form-control form-control-sm tgl_awal" style="font-size:12px">
                                    <div class="input-group-text">ke</div>
                                    <input type="text" class="form-control form-control-sm tgl_akhir" style="font-size:12px">
                                    <button class="btn btn-success btn-sm" type="button" id="btnFilterPeriode"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-sm-12">
                                <label for="" style="font-size: 12px;margin-bottom:0px">Spesialis</label>
                                <select name="spesialis" id="spesialis" class="form-select form-select-sm">
                                    <option value="" selected>Semua</option>
                                    <option value="S0007">Dokter Umum</option>
                                    <option value="S0003">Spesialis Anak</option>
                                    <option value="S0001">Spesialis Kandungan & Kebidanan</option>
                                    <option value="S0005">Spesialis Penyakit Dalam</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-lg-3 col-sm-12">
                                <label for="" style="font-size: 12px;margin-bottom:0px">Status</label>
                                <select name="status" id="status" class="form-select form-select-sm">
                                    <option value="" selected>Semua</option>
                                    <option value="ranap">Rawat Inap</option>
                                    <option value="ralan">Rawat Jalan</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-responsive text-sm table-sm" id="tbRadiologi" width="100%">
                        <thead>
                            <tr role="row">
                                <th>No Rawat</th>
                                <th>Nama / No. RM</th>
                                <th>Tgl Periksa</th>
                                <th>Dokter Perujuk</th>
                                <th>Diagnosa Klinis</th>
                                <th>Informasi Klinis</th>
                                <th>Jenis Perawatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    @include('content.radiologi.modal.modal_hasil_radiologi')
@endsection

@push('script')
    <script>
        var tgl_awal = '';
        var tgl_akhir = '';
        var spesialis = '';
        var dateStart = '';
        var status = '';

        const tbRadiologi = $('#tbRadiologi')

        $('#formFilterRadiologi select[name=status]').on('change', (e) => {
            e.preventDefault;
            status = e.target.value
            localStorage.setItem('status', status)
            drawTbRadiologi()
        })
        $('#formFilterRadiologi select[name=spesialis]').on('change', (e) => {
            e.preventDefault;
            spesialis = e.target.value
            localStorage.setItem('spesialis', spesialis)
            drawTbRadiologi()
        })
        $('#formFilterRadiologi #btnFilterPeriode').on('click', (e) => {
            awal = splitTanggal($('.tgl_awal').val());
            akhir = splitTanggal($('.tgl_akhir').val());
            localStorage.setItem('tgl_akhir', akhir)
            localStorage.setItem('tgl_awal', awal)
            tgl_awal = awal
            tgl_akhir = akhir
            drawTbRadiologi()
        })


        $(document).ready(() => {
            date = new Date()
            hari = ('0' + (date.getDate())).slice(-2);
            bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;
            let t1 = ''
            let t2 = ''
            spesialis = localStorage.getItem('spesialis') ? localStorage.getItem('spesialis') : ''
            status = localStorage.getItem('status') ? localStorage.getItem('status') : ''
            tgl_awal = localStorage.getItem('tgl_awal') ? localStorage.getItem('tgl_awal') : splitTanggal(dateStart)
            tgl_akhir = localStorage.getItem('tgl_akhir') ? localStorage.getItem('tgl_akhir') : splitTanggal(dateStart)
            $('.tgl_awal').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                todayHighlight: true,
                setDate: 0,
                todayBtn: true,

            })

            $('.tgl_akhir').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                todayHighlight: true,
                startDate: 0,
                todayBtn: true,
            })
            $('#formFilterRadiologi select[name=spesialis]').val(spesialis)
            $('#formFilterRadiologi select[name=status]').val(status)
            $('.tgl_awal').datepicker('setDate', splitTanggal(tgl_awal))
            $('.tgl_akhir').datepicker('setDate', splitTanggal(tgl_akhir))

            drawTbRadiologi()
        })

        function drawTbRadiologi() {
            tbRadiologi.dataTable({
                destroy: true,
                paging: false,
                info: false,
                responsive: true,
                scrollX: true,
                ajax: {
                    url: '/erm/radiologi/table',
                    data: {
                        spesialis: spesialis,
                        tgl_awal: tgl_awal,
                        tgl_akhir: tgl_akhir,
                        status: status,
                    }
                },
                language: {
                    "zeroRecords": "Tidak ada data pasien terdaftar",
                    "infoEmpty": "Tidak ada data pasien terdaftar",
                    "search": "Pencarian",
                },
                createdRow: (row, data, dataIndex) => {
                    $(row).css('cursor', 'pointer');
                    $(row).attr('onclick', `modalHasilRadiologi('${data.no_rawat}', '${data.tgl_periksa}', '${data.jam}')`);
                },
                columns: [{
                        data: 'no_rawat',
                        render: (data, type, row, meta) => {
                            if (row.hasil_radiologi.length) {
                                cek = `<i class="bi bi-check-circle-fill text-success"></i>`
                            } else {
                                cek = '';
                            }
                            return `${data} ${cek}`;
                        }
                    },
                    {
                        data: 'pasien',
                        render: (data, type, row, meta) => {

                            return `${row.reg_periksa.pasien.nm_pasien} (${row.reg_periksa.no_rkm_medis})`
                        }
                    },
                    {
                        data: 'tgl_permintaan',
                        render: (data, type, row, meta) => {
                            return `${splitTanggal(row.tgl_periksa)} ${row.jam}`
                        }
                    },
                    {
                        data: 'dokter',
                        render: (data, type, row, meta) => {
                            return row.dokter_rujuk.nm_dokter
                        }
                    },
                    {
                        data: 'permintaan_radiologi.diagnosa_klinis',
                        render: (data, type, row, meta) => {
                            return data ? data : '';
                        }
                    },
                    {
                        data: 'permintaan_radiologi.informasi_tambahan',
                        render: (data, type, row, meta) => {
                            return data ? data : '';
                        }
                    },
                    {
                        data: 'jns_perawatan',
                        render: (data, type, row, meta) => {
                            if (data) {
                                return data.nm_perawatan
                            } else {
                                return '-'

                            }
                        }
                    },
                    {
                        data: 'status',
                        render: (data, type, row, meta) => {
                            if (data.toUpperCase() == 'RANAP') {
                                html = `<button type="button" class="btn btn-danger btn-sm">Rawat Inap</button>`
                            } else {
                                html = `<button type="button" class="btn btn-warning btn-sm">Rawat Jalan</button>`
                            }
                            return html
                            // return row.jns_perawatan.nm_perawatan
                        }
                    },
                ]
            })
        }

        function modalHasilRadiologi(no_rawat, tgl_periksa, jam) {
            getPeriksaRadiologi(no_rawat, tgl_periksa, jam).done((response) => {
                let gambar = ''
                const tglPeriksa = response.permintaan_radiologi ? response.permintaan_radiologi.tgl_sampel : response.tgl_periksa
                const jamPeriksa = response.permintaan_radiologi ? response.permintaan_radiologi.jam_sampel : response.jam
                // $('#btnDownloadImage').attr('href', `${gambar}`);
                // $('#btnDownloadImage').attr('download', `${splitTanggal(tglPeriksa)} ${response.reg_periksa.pasien.nm_pasien}`);
                $('#formHasilRadiologi input[name=no_rawat]').val(response.no_rawat);
                $('#formHasilRadiologi input[name=jam]').val(response.jam);
                $('#formHasilRadiologi input[name=tgl_periksa]').val(response.tgl_periksa);
                $('#formHasilRadiologi input[name=nm_pasien]').val(`${response.reg_periksa.pasien.nm_pasien} (${response.reg_periksa.no_rkm_medis})`);
                $('#formHasilRadiologi input[name=tgl_lahir]').val(`${splitTanggal(response.reg_periksa.pasien.tgl_lahir)} (${response.reg_periksa.umurdaftar} ${response.reg_periksa.sttsumur})`);
                $('#formHasilRadiologi input[name=poliklinik]').val(`${response.reg_periksa.poliklinik.nm_poli}`);
                $('#formHasilRadiologi input[name=penjab]').val(`${response.reg_periksa.penjab.png_jawab}`);
                $('#formHasilRadiologi input[name=tgl_sampel]').val(`${splitTanggal(tglPeriksa)} ${jamPeriksa}`);
                $('#formHasilRadiologi input[name=proyeksi]').val(`${response.proyeksi}`);
                $('#formHasilRadiologi input[name=kv]').val(`${response.kV}`);
                $('#formHasilRadiologi input[name=inak]').val(`${response.inak}`);
                $('#formHasilRadiologi input[name=jml_penyinaran]').val(`${response.jml_penyinaran}`);
                response.hasil_radiologi.map((hsx) => {
                    if (tgl_periksa == hsx.tgl_periksa && jam == hsx.jam) {
                        $('#formHasilRadiologi textarea[name=hasil]').val(`${hsx ? hsx.hasil : ''}`);
                    }
                })
                if (Object.keys(response.gambar_radiologi).length) {
                    response.gambar_radiologi.map((imgx, index) => {
                        if (tgl_periksa == imgx.tgl_periksa && jam == imgx.jam) {
                            gambar = `https://sim.rsiaaisyiyah.com/webapps/radiologi/${imgx.lokasi_gambar}`
                        } else {
                            gambar = "{{ asset('/img/default.png') }}";

                        }
                        html = `
                             <a class="btn btn-success btn-sm mb-2" id="btnMagnifyImage" class="magnifyImg${index}" data-magnify="gallery" data-src="${gambar}">
                                <i class="bi bi-eye"></i> LAYAR PENUH
                            </a>
                            <a class="btn btn-primary btn-sm mb-2" id="btnDownloadImage" class="downloadImg${index}" download="${textRawat(no_rawat)}" data-src="${gambar}">
                                <i class="bi bi-download"></i> UNDUH GAMBAR
                            </a>
                            <img id="gambarRadiologi" loading="lazy" class="img-thumbnail position-relative thumbnailImg${index}" src="${gambar}" style="padding: 10px" width="100%">
                        `;
                        $('.image-set').append(html);
                    })

                } else {
                    gambar = "{{ asset('/img/default.png') }}";

                }
                $('#gambarRadiologi').attr('src', `${gambar}`);
                $('#btnMagnifyImage').attr('href', `${gambar}`);
            })
            $('#btnSimpanHasil').attr('onclick', `simpanHasilRadiologi('${no_rawat}')`);
            $('#modalHasilRadiologi').modal('show')
        }


        function updateHasilRadiologi(data) {
            const hasil = $.post('/erm/radiologi/hasil/update', data).fail((request) => {
                alertErrorAjax(request)
            })
            return hasil;
        }

        function createHasilRadiologi(data) {
            const hasil = $.post('/erm/radiologi/hasil/create', data).fail((request) => {
                alertErrorAjax(request)
            })
            return hasil;
        }

        function simpanHasilRadiologi() {
            const data = {
                no_rawat: $('#formHasilRadiologi input[name=no_rawat]').val(),
                hasil: $('#formHasilRadiologi textarea[name=hasil]').val(),
                tgl_periksa: $('#formHasilRadiologi input[name=tgl_periksa]').val(),
                jam: $('#formHasilRadiologi input[name=jam]').val(),
                _token: $('#formHasilRadiologi input[name=_token]').val(),
            };
            getHasilRadiologi(data.no_rawat, data.tgl_periksa, data.jam).done((hasil) => {
                if (Object.keys(hasil).length) {
                    updateHasilRadiologi(data).done(() => {
                        alertSuccessAjax('Hasil radiologi berhasil disimpan').then(() => {
                            drawTbRadiologi()
                            $('#modalHasilRadiologi').modal('hide')
                        })
                    })

                } else {
                    createHasilRadiologi(data).done(() => {
                        alertSuccessAjax('Hasil radiologi berhasil ditambah').then(() => {
                            drawTbRadiologi()
                            $('#modalHasilRadiologi').modal('hide')
                        })
                    })
                }
            })
        }

        $('#modalHasilRadiologi').on('hidden.bs.modal', () => {
            $('#gambarRadiologi').attr('src', '');
            $('#btnMagnifyImage').attr('href', '');
            $('.image-set').empty();
            $('#formHasilRadiologi #hasil').val('');
        })
    </script>
@endpush
