@extends('index')

@section('contents')
    {{-- <div class="row">
        <div class="col-md-2 col-sm-6 col-xs-6">
            <div class="card text-bg-primary mb-3">
                <div class="card-header">Jumlah Resep</div>
                <div class="card-body">
                    <h3 class="card-title" id="count-resep"></h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6">
            <div class="card text-bg-warning mb-3">
                <div class="card-header">Menungu</div>
                <div class="card-body">
                    <h3 class="card-title" id="count-tunggu"></h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6">
            <div class="card text-bg-info mb-3">
                <div class="card-header">Divalidasi</div>
                <div class="card-body">
                    <h3 class="card-title" id="count-valid"> </h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6">
            <div class="card mb-3 text-bg-success mb-3">
                <div class="card-header">Selesai</div>
                <div class="card-body">
                    <h3 class="card-title" id="count-selesai"></h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-6">
            <div class="card mb-3 text-bg-danger mb-3">
                <div class="card-header">Tidak Diambil</div>
                <div class="card-body">
                    <h3 class="card-title" id="count-tidak"></h3>
                </div>
            </div>
        </div>
    </div> --}}

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
                        <tr style="height: 40px">
                            <td>Menunggu</td>
                            <td>:</td>
                            <td>
                                <button id="count-tunggu" class="btn btn-sm btn-warning"
                                    style=" display: block; width:auto; border-radius: 50%; color:rgb(48, 48, 48); font-weight:bold; font-size:9pt">
                                </button>
                            </td>
                            <td>Tidak Ambil</td>
                            <td>:</td>
                            <td>
                                <button id="count-tidak" class="btn btn-sm btn-danger"
                                    style=" display: block; width:auto; border-radius: 50%; color:white; font-weight:bold; font-size:9pt">
                                </button>
                            </td>
                        </tr>

                    </table>

                    <input type="hidden" id="hitung-panggil" value="">

                    <table class="table table-striped table-responsive text-sm table-sm" id="tb_resep" width="100%">
                        <thead>
                            <tr role="row">
                                <th>No. Resep</th>
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
            hitungResep();
            reloadTabelResep();
        })


        function reloadTabelResep() {
            setInterval(function() {
                // if (isModalShow == false) {
                $('#tb_resep').DataTable().destroy();
                tbResep();
                hitungResep();
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
            }, 30000);
        }

        function hitungResep() {
            $.ajax({
                url: 'resep/ambil/sekarang',
                success: function(response) {
                    resep = 0;
                    valid = 0;
                    tunggu = 0;
                    tidak = 0;
                    selesai = 0;
                    $.map(response, function(res) {
                        if (res.tgl_perawatan != '0000-00-00') {
                            valid += parseInt(1)
                        } else {
                            if (res.reg_periksa.status_bayar ==
                                'Sudah Bayar') {
                                tidak += parseInt(1);
                            }
                        }
                        if (res.tgl_peresepan != '0000-00-00') {
                            resep += parseInt(1)
                        }
                        if (res.tgl_penyerahan != '0000-00-00' && res.jam_penyerahan) {
                            selesai += parseInt(1)
                        }
                        tunggu = resep - valid - tidak;
                    })
                    $('#count-resep').text(resep)
                    $('#count-tunggu').text(tunggu)
                    $('#count-selesai').text(selesai)
                    $('#count-valid').text(valid)
                    $('#count-tidak').text(tidak)
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
                // scrollY: 500,
                // scrollX: true,
                ajax: {
                    url: "resep/ambil/tabel",
                    data: {
                        tgl_peresepan: "{{ date('Y-m-d') }}",
                    }
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            console.log(row)

                            if (row.reg_periksa.kd_pj == 'A03') {
                                penjab = '<b><span class="text-danger">(UMUM)</span></b>'
                            } else {
                                penjab = '<b><span class="text-success">(BPJS)</span></b>'
                            }
                            html = row.no_resep + '<br/>';
                            html += '<h6 style="margin:0px">' + row.reg_periksa.pasien.nm_pasien + '</h6>';
                            html += row.no_rawat + '<br/>';
                            html += row.reg_periksa.poliklinik.nm_poli + ' ' + penjab + '<br/>';
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
                            html += 'Penyerahan : ' + row.jam_penyerahan + '<br/>';
                            return html;
                        },
                        name: 'waktu'

                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {

                            console.log(row)

                            html = '<button onclick="tampilResep(\'' + row.no_resep + '\')" class="btn btn-sm mb-2 status-' + row.no_resep + '" type="button" style="width:110px;display:inline" data-id="' + row.no_rawat + '"></button><br/>';

                            html += '<button onclick="panggilResep(\'' + row.no_resep + '\',' + false + ', \'' + row.reg_periksa.pasien.nm_pasien + '\')" class="btn btn-sm btn-warning mb-2 panggil-' + row.no_resep + '" style="width:110px;display:none" type="button" style="width:110px;" data-id="' + row.no_rawat + '">PANGGIL</button><br/>';
                            html += '<button onclick="panggilResep(\'' + row.no_resep + '\',\'' + true + '\', \'' + row.reg_periksa.pasien.nm_pasien + '\')" class="btn btn-sm btn-success mb-2 selesai-' + row.no_resep + '" style="width:110px;display:none" type="button" style="width:110px;" data-id="' + row.no_rawat + '">SELESAI</button>';

                            if (row.tgl_perawatan == '0000-00-00') {
                                if (row.reg_periksa.status_bayar == 'Belum Bayar') {
                                    $('.status-' + row.no_resep).addClass('btn-primary');
                                    $('.status-' + row.no_resep).text('BELUM')
                                    $('.panggil-' + row.no_resep).css('display', 'none')

                                } else {
                                    $('.status-' + row.no_resep).addClass('btn-danger');
                                    $('.status-' + row.no_resep).text('TIDAK DIAMBIL')
                                    $('.panggil-' + row.no_resep).css('display', 'none')
                                }
                            } else {
                                if (row.jam_penyerahan == '00:00:00') {
                                    $('.status-' + row.no_resep).addClass('btn-primary');
                                    $('.status-' + row.no_resep).text('RESEP')
                                    $('.panggil-' + row.no_resep).css('display', 'inline')
                                    $('.selesai-' + row.no_resep).css('display', 'inline')
                                } else if (row.jam_penyerahan != '00:00:00') {
                                    $('.status-' + row.no_resep).prop('onclick', '');
                                    $('.status-' + row.no_resep).css('height', '50px');
                                    $('.status-' + row.no_resep).removeClass('btn-primary');
                                    $('.status-' + row.no_resep).removeClass('mb-2');
                                    $('.status-' + row.no_resep).addClass('btn-success');
                                    $('.status-' + row.no_resep).text('SELESAI')
                                    $('.panggil-' + row.no_resep).css('display', 'none')
                                    $('.selesai-' + row.no_resep).css('display', 'none')
                                }
                            }


                            return html;
                        },
                        name: 'status',
                    },

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

        function resetPanggilan(no_resep) {
            $.ajax({
                url: 'resep/obat/panggil',
                data: {
                    no_resep: no_resep,
                    tanggal: '0000-00-00',
                },
                success: function(response) {
                    console.log('reset panggil')
                    panggilResep(no_resep).delay(5000)
                }
            })
        }

        function panggilResep(no_resep, jam_panggil, nm_pasien = null) {
            localStorage.setItem('panggil', 'yes');

            localStorage.setItem('no_panggil', no_resep);
            if (nm_pasien != null) {
                localStorage.setItem('nm_pasien', nm_pasien);
            }

            jam = jam_panggil ? "{{ date('H:i:s') }}" : '00:00:00';
            setTimeout(() => {
                localStorage.setItem('panggil', 'no');
            }, 3000);

            $.ajax({
                url: 'resep/obat/panggil',
                data: {
                    no_resep: no_resep,
                    tanggal: "{{ date('Y-m-d') }}",
                    jam: jam,
                },
                success: function(response) {
                    reloadTabelResep();
                }
            })
        }

        function tampilResep(no_resep) {
            // no_resep = $('#no_resep').val(no_resep)
            reloadTabelResep();
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

                            html = '<tr>';
                            html += '<td>' + racik.no_racik + '</td>';
                            html += '<td><strong>' + racik.metode.nm_racik + ' ' + racik
                                .nama_racik +
                                ' , Jumlah : ' + racik.jml_dr + ' Aturan Pakai ' + racik
                                .aturan_pakai;
                            html += '</strong><ul>';
                            no_racik = 1;
                            $.map(racik.detail_racikan, function(dr) {
                                if (racik.no_racik == dr.no_racik) {
                                    html += '<li>' + dr.p1 + '/' + dr.p2 + ' x ' + dr.databarang.nama_brng + ' = ' + dr.kandungan + ' mg, Jumlah : ' + dr.jml + '</li>'
                                }
                            })
                            html += '</ul></td>';
                            html += '</ul></td>';
                            html += '</tr>';

                            $('#tabel-racikan tbody').append(html)
                        })

                        $.map(res.resep_dokter, function(umum) {
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
