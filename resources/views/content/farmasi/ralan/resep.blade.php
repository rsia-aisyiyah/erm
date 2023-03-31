@extends('index')

@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table>
                        <tr style="height: 25px">
                            <td>Jumlah Resep</td>
                            <td>:</td>
                            <td width="100px">
                                <button class="btn btn-sm" id="count-resep"
                                    style=" display: block; width:auto; border-radius: 50%; background-color: #0067dd; color:white; font-weight:bold; font-size:9pt">
                                </button>
                            </td>
                            <td>Selesai</td>
                            <td>:</td>
                            <td>
                                <button id="count-selesai" class="btn btn-sm btn-success"
                                    style=" display: block; width:auto; border-radius: 50%; color:white; font-weight:bold; font-size:9pt">
                                </button>
                            </td>
                        </tr>
                        <tr style="height: 40   px">
                            <td>Menunggu</td>
                            <td>:</td>
                            <td>
                                <button id="count-tunggu" class="btn btn-sm btn-warning"
                                    style=" display: block; width:auto; border-radius: 50%; color:rgb(48, 48, 48); font-weight:bold; font-size:9pt">
                                </button>
                            </td>
                            {{-- <td>Batal</td>
                            <td>:</td>
                            <td>
                                <button id="count-batal" class="btn btn-sm btn-danger"
                                    style=" display: block; width:auto; border-radius: 50%; color:white; font-weight:bold; font-size:9pt">
                                </button>
                            </td> --}}
                        </tr>

                    </table>

                    <input type="hidden" id="hitung-panggil" value="">

                    <table class="table table-striped table-responsive text-sm table-sm" id="tb_resep" width="100%">
                        <thead>
                            <tr role="row">
                                <th>No. Resep</th>
                                {{-- <th>Poliklinik</th> --}}
                                <th>Waktu</th>
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
@endsection

@include('content.farmasi.ralan.modal.modal_resep')

@push('script')
    <script>
        $(document).ready(function() {
            tbResep();
            reloadTabelResep();
        })


        function reloadTabelResep() {
            hitungResep();
            setInterval(function() {
                $('#tb_resep').DataTable().destroy();
                tbResep();
                // if (isModalShow == false) {
                Swal.fire({
                    title: 'Memuat ulang data resep!',
                    position: 'top-end',
                    toast: true,
                    icon: 'success',
                    timerProgressBar: true,
                    showConfirmButton: false,
                    timer: 1500
                })
                // }
                hitungResep();
            }, 10000);
        }

        function hitungResep() {
            $.ajax({
                url: 'resep/ambil/sekarang',
                success: function(response) {
                    resep = 0;
                    valid = 0;
                    tunggu = 0;
                    $.map(response, function(res) {
                        if (res.tgl_perawatan != '0000-00-00') {
                            valid += parseInt(1)
                        }
                        if (res.tgl_peresepan != '0000-00-00') {
                            resep += parseInt(1)
                        }
                        tunggu = resep - valid;
                    })
                    $('#count-resep').text(resep)
                    $('#count-tunggu').text(tunggu)
                    $('#count-selesai').text(valid)
                }
            })
        }

        function tbResep() {
            var table = $('#tb_resep').DataTable({
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
                    url: "resep/ambil/tabel",
                    data: {
                        tgl_peresepan: "{{ date('Y-m-d') }}",
                    }
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            html = row.no_resep + '<br/>';
                            html += '<h6 style="margin:0px">' + row.reg_periksa.pasien.nm_pasien + '</h6>';
                            html += row.no_rawat + '<br/>';
                            html += row.reg_periksa.dokter.nm_dokter;
                            return html;
                        },
                        name: 'nm_pasien'
                    },

                    {
                        data: null,
                        render: function(data, type, row, meta) {

                            html = 'Resep : ' + row.jam_peresepan + '<br/>';
                            html += 'Validasi : ' + row.jam + '<br/>';
                            return html;
                        },
                        name: 'waktu'

                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            if (row.tgl_perawatan == '0000-00-00') {
                                $('.status-' + row.no_resep).addClass('btn-primary');
                                $('.status-' + row.no_resep).text('Belum')
                            } else {
                                $('.status-' + row.no_resep).addClass('btn-success');
                                $('.status-' + row.no_resep).text('Sudah')
                            }
                            html = '<button onclick="tampilResep(\'' + row.no_resep +
                                '\')" class="btn btn-sm mb-2 status-' + row.no_resep +
                                '" type="button" style="width:80px;" data-id="' + row.no_rawat +
                                '"></button><br/>';
                            return html;
                        },
                        name: 'status',
                    }

                ],
                "language": {
                    "zeroRecords": "Tidak ada data resep masuk",
                    "infoEmpty": "Tidak ada data resep masuk",
                }
            });
        }

        $('#modalResepObat').on('hidden.bs.modal', function() {
            $('#tabel-racikan tbody').empty()
            $('#tabel-umum tbody').empty()
        })

        function tampilResep(no_resep) {
            // no_resep = $('#no_resep').val(no_resep)
            $('#modalResepObat').modal('show');
            $.ajax({
                url: 'resep/obat/ambil',
                data: {
                    no_resep: no_resep,
                },
                success: function(response) {
                    $.map(response, function(res) {
                        no = 1;
                        $.map(res.resep_racikan, function(racik) {
                            console.log(racik)
                            html = '<tr>';
                            html += '<td>' + racik.no_racik + '</td>';
                            html += '<td><strong>' + racik.metode.nm_racik + ' ' + racik
                                .nama_racik +
                                ' , Jumlah : ' + racik.jml_dr + ' Aturan Pakai ' + racik
                                .aturan_pakai;
                            html += '</strong><ul>';
                            $.map(racik.detail_racikan, function(dr) {
                                html += '<li>' + dr.p1 + '/' +
                                    dr.p2 + ' x ' + dr.databarang.nama_brng + ' = ' + dr
                                    .kandungan + ' mg, Jumlah : ' + dr.jml +
                                    '</li>'
                            })
                            html += '</ul></td>';
                            html += '</ul></td>';
                            html += '</tr>';

                            $('#tabel-racikan tbody').append(html)
                        })

                        $.map(res.resep_dokter, function(umum) {
                            console.log(umum)
                            html = '<tr>';
                            html += '<td>' + no + '</td>';
                            html += '<td>' + umum.data_barang.nama_brng + '</td>';
                            html += '<td>' + umum.jml + '</td>';
                            html += '<td>' + umum.aturan_pakai + '</td>';
                            html += '</tr>';
                            no++;
                            $('#tabel-umum tbody').append(html)
                        })
                    })
                }
            })
        }
    </script>
@endpush
