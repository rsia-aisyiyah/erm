@extends('index')

@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-bg-primary">
                    Registrasi Pasien Hari ini
                </div>
                <div class="card-body">
                    <table class="table table-striped table-responsive text-sm table-sm" id="tb_daftar_pasien" width="100%">
                        <thead>
                            <tr role="row">
                                <th>Pasien</th>
                                <th>Status</th>
                                {{-- <th>Waktu</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
@endsection

@include('content.farmasi.ralan.modal.modal_resep')

@push('script')
    <script>
        $(document).ready(function() {
            tbDaftarPasien()

            setInterval(function() {
                $('#tb_daftar_pasien').DataTable().destroy();
                tbDaftarPasien()
            }, 5000);
        })

        function tbDaftarPasien() {
            var table = $('#tb_daftar_pasien').DataTable({
                processing: false,
                scrollX: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ordering: false,
                paging: false,
                lenghtChange: false,
                info: false,
                deferRender: true,
                ajax: {
                    url: "registrasi/ambil/table",
                    data: {
                        // tgl_registrasi: "04-04-2023",
                        tgl_registrasi: "{{ date('Y-m-d') }}",
                    }
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            // console.log(row)


                            html = row.no_rawat + '<br/>';
                            html += '<h5 style="margin:0px">' + row.pasien.nm_pasien + '</h5>';
                            html += row.poliklinik.nm_poli + '<br/>';
                            html += row.dokter.nm_dokter + '<br/>';
                            // html += row.reg_periksa.dokter.nm_dokter;
                            return html;
                        },
                        name: 'nm_pasien'
                    },

                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            // console.log(row)
                            if (row.general_consent) {
                                if (row.general_consent.ttd) {
                                    html = '<img src="{{ asset('ttd') }}/' + row.general_consent.ttd +
                                        '" width = "200px" / > '
                                } else {
                                    html =
                                        '<img src="{{ asset('img/default.png') }}/" width="200px"/>'
                                }

                            } else {
                                html =
                                    '<button onclick="buka(this, 1)" class="btn btn-sm btn-primary mb-2" type="button" style="width:110px;" data-id="' +
                                    row.no_rawat +
                                    '" data-rm="' + row.no_rkm_medis +
                                    '" data-loket="1">LOKET 1</button><br/>';
                                html +=
                                    '<button onclick="buka(this, 2)" class="btn btn-sm btn-primary mb-2" type="button" style="width:110px;" data-id="' +
                                    row.no_rawat +
                                    '" data-loket="2">LOKET 2</button><br/>';
                                // html +=
                                //     '<button onclick="buka(this, 3)" class="btn btn-sm btn-primary mb-2" type="button" style="width:110px;" data-id="' +
                                //     row.no_rawat +
                                //     '" data-loket="3">P3</button><br/>';
                            }
                            return html;
                        },
                        name: 'waktu'

                    },


                ],
                "language": {
                    "zeroRecords": "Tidak ada pasien terdaftar",
                    "infoEmpty": "Tidak ada pasien terdaftar",
                }
            });
        }

        function buka(p, loket) {
            console.log('Loket ', loket)
            no_rawat = $(p).data('id');
            no_rkm_medis = $(p).data('rm');
            nik = "{{ session()->get('pegawai')->nik }}"
            console.log(no_rkm_medis)
            $.ajax({
                url: 'persetujuan/tambah',
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    no_rkm_medis: no_rkm_medis,
                    nik: nik,
                    loket: loket,
                },
                success: function(response) {
                    $('#tb_daftar_pasien').DataTable().destroy();
                    tbDaftarPasien()
                },
                error: function(request, status, error) {
                    swal.fire(
                        'Gagal',
                        request.responseJSON.message,
                        'error'
                    )
                }
            })
            // console.log(nik)
        }
    </script>
@endpush
