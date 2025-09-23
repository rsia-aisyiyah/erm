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



                </div>
            </div>

        </div>
        <div class="col-lg-2 col-md-12 col-sm-12">
            <label for="tgl_peresepan" class="form-label">Tgl. Resep</label>
            <input type="text" class="form-control form-control-sm" id="tgl_peresepan" placeholder="" autocomplete="off" value="{{ date('d-m-Y') }}">
        </div>
        <div class="col-lg-2 col-md-12 col-sm-12">
            <label for="tgl_pemerimaan" class="form-label">Tgl. Penyerahan</label>
            <input type="text" class="form-control form-control-sm" id="tgl_penyerahan" placeholder="" autocomplete="off" value="{{ date('d-m-Y') }}">
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12">
            <button class="btn btn-success mt-4 w-25" id="btnFilterResep" onclick="filterResep()">
                <i class="bi bi-search"></i>
                Cari
            </button>
        </div>
        <div class="col-12">
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
@endsection

@include('content.farmasi.ralan.modal.modal_resep')

@push('script')
    <script>
        const tglPeresepan = $('#tgl_peresepan')
        const tglPenyerahan = $('#tgl_penyerahan')

        $(document).ready(function() {
            tbResep();
            hitungResep();
            reloadTabelResep();
        })

        $('#tgl_peresepan').datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            autoclose: true,
            todayHighlight: true,
            todayBtn: true,
        })
        $('#tgl_penyerahan').datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            autoclose: true,
            todayHighlight: true,
            todayBtn: true,
        })

        function filterResep() {
            const tgl_peresepan = tglPeresepan.val();
            const tgl_penyerahan = tglPenyerahan.val();
            tbResep();
        }

        function reloadTabelResep() {
            setInterval(function() {
                // if (isModalShow == false) {
                $('#tb_resep').DataTable().destroy();
                tbResep();
                hitungResep();
                Swal.fire({
                    text: 'Memuat ulang data resep!',
                    position: 'top-end',
                    toast: true,
                    icon: 'success',
                    timerProgressBar: true,
                    showConfirmButton: false,
                    timer: 1500
                })
                // }
            }, 40000);
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
            const tgl_peresepan = tglPeresepan.val();
            const tgl_penyerahan = tglPenyerahan.val();
            var table = $('#tb_resep').DataTable({
                processing: false,
                destroy: true,
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
                    url: "/erm/resep/ambil/tabel",
                    data: {
                        tgl_peresepan: tgl_peresepan,
                        tgl_penyerahan: tgl_penyerahan
                    }
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
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
                            console.log('DATA ===', row);

                            html = `<button onclick="tampilResep('${row.no_resep}', '${row.reg_periksa.kd_poli}')" class="btn btn-sm mb-2 status-${row.no_resep}" type="button" style="width:110px;display:inline" data-id="${row.no_rawat}"></button><br/>`;
                            html += '<button onclick="panggilResep(\'' + row.no_resep + '\',' + false + ', \'' + row.reg_periksa.pasien.nm_pasien + '\')" class="btn btn-sm btn-warning mb-2 panggil-' + row.no_resep + '" style="width:110px;display:none" type="button" style="width:110px;" data-id="' + row.no_rawat + '">PANGGIL</button><br/>';
                            html += '<button onclick="panggilResep(\'' + row.no_resep + '\',' + true + ', \'' + row.reg_periksa.pasien.nm_pasien + '\')" class="btn btn-sm btn-success mb-2 selesai-' + row.no_resep + '" style="width:110px;display:none" type="button" style="width:110px;" data-id="' + row.no_rawat + '">SELESAI</button>';

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
                                    // $('.status-' + row.no_resep).prop('onclick', '');
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

            // jam = jam_panggil ? "{{ date('H:i:s') }}" : '00:00:00';
            setTimeout(() => {
                localStorage.setItem('panggil', 'no');
            }, 3000);

            $.ajax({
                url: 'resep/obat/panggil',
                data: {
                    no_resep: no_resep,
                    tanggal: "{{ date('Y-m-d') }}",
                    jam: jam_panggil,
                },
                success: function(response) {
                    console.log('RESPONSE ===', response);

                    $('.status-' + no_resep).prop('onclick', '');
                    $('.status-' + no_resep).css('height', '50px');
                    $('.status-' + no_resep).removeClass('btn-primary');
                    $('.status-' + no_resep).removeClass('mb-2');
                    $('.status-' + no_resep).addClass('btn-success');
                    $('.status-' + no_resep).text('SELESAI')
                    $('.panggil-' + no_resep).css('display', 'none')
                    $('.selesai-' + no_resep).css('display', 'none')
                    $('#tb_resep').DataTable().destroy();
                    tbResep();
                    hitungResep();
                }
            })
        }

        function tampilResep(no_resep, kd_poli = '') {
            // reloadTabelResep();

            $.ajax({
                url: 'resep/obat/ambil',
                data: {
                    no_resep: no_resep,
                },
                success: function(response) {
                    getPemeriksaanPoli(response.no_rawat, kd_poli).done((res) => {
                        console.log('RES PEMERIKSAAN ===', res);
                        const resFilter = res.filter((item) => item.rtl !== '-' && item.nip.includes('1.'))
                            .map((item) => item.rtl).join('')
                        $('.notif').val(resFilter)

                    })
                    $('#infoNoResep').html(no_resep)
                    $('#infoTglResep').html(`${response.tgl_peresepan} ${response.jam_peresepan}`)
                    $('#modalResepObat').modal('show');
                    $('.notif').empty()
                }
            })
        }
    </script>
@endpush
