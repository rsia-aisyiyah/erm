@extends('index')
@push('style')
    <style>
        .nowrap {
            white-space: nowrap !important;
        }

        th {
            white-space: nowrap;
        }

        .dataTables_wrapper {
            width: 100%;
            margin: 0 auto;
        }
    </style>
@endpush
@section('contents')

    <div class="card mb-3">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Tanggal Awal</label>
                    <input type="date" id="tgl_perawatan1" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-3">
                    <label>Tanggal Akhir</label>
                    <input type="date" id="tgl_perawatan2" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-4">
                    <label>Nama Kamar</label>
                    <input type="text" id="kamar" class="form-control" placeholder="Cari bangsal/kamar...">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button id="btnFilterPemeriksaan" class="btn btn-primary w-100" type="button"
                        style="font-size: 12px">Cari Data</button>
                </div>
            </div>
        </div>

    </div>

    <table class="table table-sm table-striped table-hover nowrap" id="tablePemeriksaanRanap"></table>

@endsection
@push('script')
    <script>
        $(document).ready(function () {
           const tablePemeriksaanRanap =  $('#tablePemeriksaanRanap').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [[0, "asc"]],
                "scrollX": true,
                "autoWidth": false,
                "dom": 'Blfrtip',
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "fixedColumns": {
                   left: 3,            
                   right: 0            
               },
               "autoWidth": false,
                "buttons": [
                   {
                       extend: 'excelHtml5',
                       text: 'Export Excel',
                       className: 'btn btn-success btn-sm',
                       filename: 'Laporan_Pemeriksaan_Ranap_' + $('#tgl_perawatan1').val(),
                       title: 'Data Pemeriksaan Rawat Inap',
                       exportOptions: {
                           modifier: {
                               page: 'all',
                               search: 'applied'
                           },
                       }
                   }
               ],
                "ajax": {
                    "url": "{{ route('ranap.pemeriksaan-ranap.table') }}",
                    "data": function (d) {
                        d.tgl_perawatan1 = $('#tgl_perawatan1').val();
                        d.tgl_perawatan2 = $('#tgl_perawatan2').val();
                        d.kamar = $('#kamar').val();
                    },
                },
                "columns": [
                    // { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'no_rawat', name: 'no_rawat', title: 'No. Rawat', className: 'nowrap' },
                    { data: 'reg_periksa.no_rkm_medis', name: 'reg_periksa.no_rkm_medis', title: 'No. RM' },
                    {
                        data: 'reg_periksa', name: 'reg_periksa', title: 'Nama Pasien', className: "fw-bold", render: function (data, type, row) {
                            let genderIcon = '';
                            let penjabIcon = '';
                            if (data.pasien.jk === 'L') {
                                genderIcon = `<span class="badge text-bg-primary"><i class="bi bi-gender-male "></i></span> `
                            } else {
                                genderIcon = `<span class="badge text-bg-warning"><i class="bi bi-gender-female "></i></span> `

                            }
                            if (data.penjab.kd_pj === 'A03') {
                                penjabIcon = `<span class="text-danger">${data.penjab.png_jawab}</span> `
                            } else {
                                penjabIcon = `<span class="text-success">${data.penjab.png_jawab}</span> `
                            }
                            return `${genderIcon} ${data.pasien.nm_pasien} (${data.umurdaftar} ${data.sttsumur}) <br/> ${penjabIcon}`;
                        }
                    },
                    {
                        data: 'reg_periksa.tgl_registrasi', name: 'reg_periksa.tgl_registrasi', title: 'Lama Inap', render: function (data, type, row) {
                            return `${hitungLamaHari(data)} Hari`;
                        }
                    },
                    { data: 'tgl_perawatan', name: 'tgl_perawatan', title: 'Tgl. Pemeriksaan' },
                    { data: 'jam_rawat', name: 'jam_rawat', title: 'Jam' },
                    { data: 'keluhan', name: 'keluhan', title: 'Subjek' },
                    {
                        data: 'pemeriksaan', name: 'pemeriksaan', title: 'Object'
                    },
                    {
                        data: 'penilaian', name: 'penilaian', title: 'Assessment'
                    },
                    {
                        data: 'rtl', name: 'rtl', title: 'Plan'
                    },

                    {
                        data: 'kamar_inap', name: 'kamar_inap', title: 'Kamar', render: function (data, type, row) {
                            if (data && Array.isArray(data) && data.length > 0) {
                                const kamarAktif = data.find((item) => item.stts_pulang !== 'Pindah Kamar');
                                if (kamarAktif && kamarAktif.kamar && kamarAktif.kamar.bangsal) {
                                    return kamarAktif.kamar.bangsal.nm_bangsal;
                                }
                                if (data[0].kamar && data[0].kamar.bangsal) {
                                    return data[0].kamar.bangsal.nm_bangsal;
                                }
                            }
                            return '--'
                        }
                    },
                    { data: 'petugas.nama', name: 'nip', title: 'Petugas' },

                ]
            })

            $('#btnFilterPemeriksaan').on('click', function (e) {
                e.preventDefault();
                tablePemeriksaanRanap.ajax.reload();
            });
        })

    </script>
@endpush