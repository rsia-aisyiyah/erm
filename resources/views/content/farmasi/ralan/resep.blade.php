@extends('index')

@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table>
                        <tr style="height: 25px">
                            <td>Jumlah Pasien</td>
                            <td>:</td>
                            <td width="100px">
                                <button class="btn btn-sm" id="count-pasien"
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
                            <td>Batal</td>
                            <td>:</td>
                            <td>
                                <button id="count-batal" class="btn btn-sm btn-danger"
                                    style=" display: block; width:auto; border-radius: 50%; color:white; font-weight:bold; font-size:9pt">
                                </button>
                            </td>
                        </tr>

                    </table>

                    <input type="hidden" id="hitung-panggil" value="">

                    <table class="table table-striped table-responsive text-sm table-sm" id="tb_resep" width="100%">
                        <thead>
                            <tr role="row">
                                <th>Nama</th>
                                <th>Poliklinik</th>
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
        })


        function reloadTabelResep() {
            setInterval(function() {
                $('#tb_resep').DataTable().destroy();
                tbResep();
                if (isModalShow == false) {
                    Swal.fire({
                        title: 'Memuat ulang data resep!',
                        position: 'top-end',
                        toast: true,
                        icon: 'success',
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }, 120000);
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
                            html += '<h6>' + row.reg_periksa.pasien.nm_pasien + '</h6>';
                            return html;
                        },
                        name: 'nm_pasien'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {

                            html = row.reg_periksa.poliklinik.nm_poli + '<br/>';
                            html += row.reg_periksa.dokter.nm_dokter + '<br/>';
                            return html;
                        },
                        name: 'poliklinik'

                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            console.log(row)
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
                    "zeroRecords": "Tidak ada data pasien terdaftar",
                    "infoEmpty": "Tidak ada data pasien terdaftar",
                }
            });
        }

        function tampilResep(no_resep) {
            // no_resep = $('#no_resep').val(no_resep)
            $('#modalResepObat').modal('show');
            $.ajax({
                url: 'resep/obat/ambil',
                data: {
                    no_resep: no_resep,
                },
                success: function(response) {

                    console.log()
                    $.map(response, function(res) {
                        $.map(res.resep_racikan, function(racik) {
                            console.log(racik)
                            html = '<tr>';
                            html += '<td>' + racik.no_racik + '</td>';
                            html += '<td>' + racik.metode.nm_racik + ' Jumlah ' + racik
                                .nama_racik +
                                ' ' + racik.jml_dr + ' aturan ' + racik.aturan_pakai +
                                '</td>';
                            html += '<td colspan="3"><ul>';
                            $.map(racik.detail_racikan, function(dr) {
                                html += '<li>' + dr.p1 + '/' +
                                    dr.p2 + ' x ' + dr.databarang.nama_brng + ' = ' + dr
                                    .kandungan + ' mg, Jumlah : ' + dr.jml +
                                    '</li>'
                            })
                            html += '</ul></td>';
                            // html += '<td>' + racik.aturan_pakai + '</td>';
                            html += '</tr>';

                            $('#tabel-racikan tbody').append(html)
                        })
                    })
                }
            })
        }
    </script>
@endpush
