@extends('index')

@section('contents')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>SEP Terbit</span>
                <span class="text-muted small" style="font-size: 11.5px;"><i class="bi bi-info-circle me-1"></i>Klik kanan pada baris tabel untuk memproses menu (SKRJ, SPRI, Rujuk Keluar)</span>
            </div>
            <div class="card-body">
                <div class="row g-2 mb-3 align-items-center">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <x-input-group class="input-group-sm">
                            <x-input class="form-control" id="start_date" name="start_date" value="{{ date('Y-m-d') }}" type="date"></x-input>
                            <x-input-group-text for="no_sep" label="s/d"></x-input-group-text>
                            <x-input class="form-control" id="end_date" name="end_date" value="{{ date('Y-m-d') }}" type="date"></x-input>
                        </x-input-group>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6">
                        <select class="form-select form-select-sm" id="jnspelayanan" name="jnspelayanan">
                            <option value="">Semua Pelayanan</option>
                            <option value="2">Rawat Jalan</option>
                            <option value="1">Rawat Inap</option>
                        </select>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-6">
                        <select class="form-select form-select-sm select2" id="kd_poli" name="kd_poli">
                            <option value="">Semua Poliklinik</option>
                            @foreach ($poliklinik as $p)
                                <option value="{{ $p->kd_poli }}">{{ $p->nm_poli }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <select class="form-select form-select-sm select2" id="kd_dokter" name="kd_dokter">
                            <option value="">Semua Dokter</option>
                            @foreach ($dokter as $d)
                                <option value="{{ $d->kd_dokter }}">{{ $d->nm_dokter }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-2 col-lg-1 col-md-6 col-sm-12 d-flex gap-1">
                        <button id="filter" class="btn btn-primary btn-sm flex-fill" title="Terapkan Filter"><i class="bi bi-filter"></i> Filter</button>
                        <button id="btn-reset" class="btn btn-secondary btn-sm" title="Reset Filter"><i class="bi bi-arrow-clockwise"></i></button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="tableSep"></table>
                </div>
            </div>
        </div>
    </div>
    @include('content.poliklinik.modal.modal_icare')
    @include('content.poliklinik.modal.modal_rujukan_keluar')
    @include('content.poliklinik.modal.modal_kontrol_umum')
    @include('content.poliklinik.modal.modal_spri')
    @include('content.poliklinik.modal.modal_skrj')
    @include('content.poliklinik.modal.modal_peserta')


@endsection


@push('script')
    <script type="text/javascript" src="{{ asset('js/context-menu/sep.js') }}"></script>
    <script>
        const start = $('#start_date');
        const end = $('#end_date');
        const jnsPelayanan = $('#jnspelayanan');
        const kdPoli = $('#kd_poli');
        const kdDokter = $('#kd_dokter');
        const filter = $('#filter');
        const btnReset = $('#btn-reset');

        $('#kd_poli, #kd_dokter').select2({
            width: '100%'
        });

        const tableSep = $('#tableSep').DataTable({
            processing: true,
            serverSide: true,
            lengthChange: true,
            ordering: true,
            processing: true,
            searching: true,
            scrollY: '50vh',
            ajax: {
                url: "{{ route('sep.datatable') }}",
                data: function(d) {
                    d.start_date = start.val();
                    d.end_date = end.val();
                    d.jnspelayanan = jnsPelayanan.val();
                    d.kd_poli = kdPoli.val();
                    d.kd_dokter = kdDokter.val();
                }
            },
            createdRow: (element, data, index, meta) => {
                const row = $(element);
                console.log('DATA SEP === ', data)
                const dataAttr = {
                    'no_rawat': data.no_rawat,
                    'no_rkm_medis': data.reg_periksa.no_rkm_medis,
                    'kd_dokter': data.reg_periksa.kd_dokter,
                    'tgl_lahir': data.pasien.tgl_lahir,
                    'umurdaftar': data.reg_periksa.umurdaftar,
                    'tgl_reg': data.reg_periksa.tgl_registrasi,
                    'sttsumur': data.reg_periksa.sttsumur,
                    'no_peserta': data.pasien.no_peserta,
                    'sep': data.no_sep,
                    'tglsep': data.tglsep,
                    'jnspelayanan': data.jnspelayanan,
                    // 'kd_dokter_bpjs': data.reg_periksa.dokter.mapping_dokter.kd_dokter_bpjs,
                    // 'kd_pj': data.reg_periksa.kd_pj,
                    // 'kd_sps': data.reg_periksa.dokter.kd_sps
                }
                //
                row.attr('data-pasien', JSON.stringify(dataAttr))
                    .addClass('row-sep');
            },
            columns: [{
                data: 'kddpjp',
                // name: 'action',

                title: '',
                render: (data, type, row, meta) => {
                    return `<button class="btn btn-sm btn-success" onclick="riwayatIcare('${row.no_kartu}', '${data}')"><i class="bi bi-file-earmark-text"></i> Icare</button>`
                }
            }, {
                data: 'tglsep',
                name: 'tglsep',
                title: 'Tgl. SEP'
            }, {
                data: 'no_sep',
                name: 'no_sep',
                title: 'No. Sep'
            }, {
                data: 'no_rawat',
                name: 'no_rawat',
                title: 'No. Rawat'
            }, {
                data: 'nomr',
                name: 'nomr',
                title: 'No. RM'
            }, {
                data: 'nama_pasien',
                render: (data, type, row, meta) => {
                    return `${data} (${row.jkel})`
                },
                name: 'nama_pasien',
                title: 'Nama'

            }, {
                data: 'reg_periksa.umurdaftar',
                name: 'reg_periksa.umurdaftar',
                render: (data, type, row, meta) => {
                    return `${data} ${row.reg_periksa.sttsumur}`
                },
                title: 'Umur'
            }, {
                data: 'reg_periksa.poliklinik.nm_poli',
                name: 'reg_periksa.poliklinik.nm_poli',
                title: 'Poli'
            }, {
                data: 'jnspelayanan',
                name: 'jnspelayanan',
                render: (data, type, row, meta) => {
                    const jenis = `${row.jnspelayanan =='2' ? 'Rawat Jalan' : 'Rawat Inap'}`;
                    const colorClass = `${row.jnspelayanan =='2' ? 'text-success' : 'text-danger'}`
                    return `<strong class="${colorClass}">${jenis}</strong>`
                },
                title: 'Jenis Pelayanan'
            }, {
                data: 'reg_periksa.rencana_kontrol_ralan',
                name: 'reg_periksa.rencana_kontrol_ralan.status_tindak_lanjut',
                title: 'Rencana Tindak Lanjut',
                orderable: false,
                searchable: false,
                render: (data, type, row, meta) => {
                    const rtl = row.reg_periksa?.rencana_kontrol_ralan;
                    const skrj = row.surat_kontrol;
                    const rujukan = row.rujukan_keluar;
                    let html = '';

                    if (rtl && rtl.status_tindak_lanjut) {
                        const status = rtl.status_tindak_lanjut;
                        if (status === 'KONTROL') {
                            if (skrj && skrj.no_surat) {
                                html += `<a href="/erm/rencanaKontrol/print/${skrj.no_surat}" target="_blank" class="badge bg-success text-decoration-none" title="Cetak SKRJ"><i class="bi bi-printer me-1"></i>SKRJ: ${splitTanggal(skrj.tgl_rencana) || skrj.tgl_rencana}</a>`;
                            } else {
                                const tglPlan = rtl.tgl_rencana_kontrol ? (splitTanggal(rtl.tgl_rencana_kontrol) || rtl.tgl_rencana_kontrol) : '-';
                                html += `<div><span class="badge bg-warning text-dark"><i class="bi bi-calendar-event me-1"></i>Kontrol: ${tglPlan}</span><span class="badge bg-light text-secondary border ms-1" style="font-size: 10px;" title="Klik kanan untuk terbitkan SKRJ">Belum Terbit</span></div>`;
                            }
                        } else if (status === 'SEMBUH') {
                            html += `<div><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Sembuh / Selesai</span></div>`;
                        } else if (status === 'RUJUK_BALIK') {
                            html += `<div><span class="badge bg-info text-dark"><i class="bi bi-arrow-return-left me-1"></i>Kembali ke FKTP</span></div>`;
                        } else if (status === 'RUJUK_LANJUT') {
                            html += `<div><span class="badge" style="background-color: #6f42c1; color: white;"><i class="bi bi-hospital me-1"></i>Rujuk RS Lain</span>`;
                            if (rujukan && rujukan.no_rujukan) {
                                html += `<a href="/erm/rujukan/print/${rujukan.no_rujukan}" target="_blank" class="badge bg-secondary text-decoration-none ms-1" title="Cetak Rujukan"><i class="bi bi-printer me-1"></i>${rujukan.no_rujukan}</a>`;
                            }
                            html += `</div>`;
                        } else if (status === 'RAWAT_INAP') {
                            html += `<div><span class="badge bg-danger"><i class="bi bi-hospital-fill me-1"></i>Rawat Inap</span></div>`;
                        } else {
                            html += `<div><span class="badge bg-secondary">${status}</span></div>`;
                        }

                        if (rtl.catatan && rtl.catatan !== '-' && rtl.catatan.trim() !== '') {
                            html += `<div class="text-muted small mt-1" style="font-size: 11px; line-height: 1.25; max-width: 250px; word-break: break-word;" title="${rtl.catatan}"><i class="bi bi-chat-left-text text-primary me-1"></i>${rtl.catatan}</div>`;
                        }
                    } else if (skrj && skrj.no_surat) {
                        html += `<a href="/erm/rencanaKontrol/print/${skrj.no_surat}" target="_blank" class="badge bg-success text-decoration-none" title="Cetak SKRJ"><i class="bi bi-printer me-1"></i>SKRJ: ${splitTanggal(skrj.tgl_rencana) || skrj.tgl_rencana}</a>`;
                    } else if (rujukan && rujukan.no_rujukan) {
                        html += `<a href="/erm/rujukan/print/${rujukan.no_rujukan}" target="_blank" class="badge bg-secondary text-decoration-none" title="Cetak Rujukan"><i class="bi bi-printer me-1"></i>Rujukan: ${rujukan.no_rujukan}</a>`;
                    } else {
                        html = `<span class="text-muted">-</span>`;
                    }

                    return html;
                }
            }]
        })
        // })

        filter.on('click', function() {
            tableSep.ajax.reload(null, true);
        });

        $('#jnspelayanan, #kd_poli, #kd_dokter').on('change', function() {
            tableSep.ajax.reload(null, true);
        });

        btnReset.on('click', function() {
            start.val("{{ date('Y-m-d') }}");
            end.val("{{ date('Y-m-d') }}");
            jnsPelayanan.val('');
            kdPoli.val('').trigger('change.select2');
            kdDokter.val('').trigger('change.select2');
            tableSep.ajax.reload(null, true);
        });
    </script>
@endpush
