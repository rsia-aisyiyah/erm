@extends('index')

@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Poli : {{ $poli->nm_poli }}</h5>
                    <p style="background-color: var(--bs-blue);color:white;padding:5px;text-align:center;border-radius: 1em;">
                        <strong>{{ Request::get('dokter') ? 'Dokter : ' . $dokter->nm_dokter : '' }}</strong>
                    </p>
                    <table class="" style="margin-bottom : 10px">
                        <tr style="height: 25px">
                            <td>Jumlah Pasien</td>
                            <td>:</td>
                            <td width="100px">
                                <button class="btn btn-sm" id="count-pasien"
                                    style=" display: block; width:auto; border-radius: 50%; background-color: #0067dd; color:white; font-weight:bold">
                                </button>
                            </td>
                            <td>Selesai</td>
                            <td>:</td>
                            <td>
                                <button id="count-selesai" class="btn btn-sm btn-success"
                                    style=" display: block; width:auto; border-radius: 50%; color:white; font-weight:bold">
                                </button>
                            </td>
                        </tr>
                        <tr style="height: 40px">
                            <td>Menunggu</td>
                            <td>:</td>
                            <td>
                                <button id="count-tunggu" class="btn btn-sm btn-warning"
                                    style=" display: block; width:auto; border-radius: 50%; color:rgb(48, 48, 48); font-weight:bold">
                                </button>
                            </td>
                            <td>Batal</td>
                            <td>:</td>
                            <td>
                                <button id="count-batal" class="btn btn-sm btn-danger"
                                    style=" display: block; width:auto; border-radius: 50%; color:white; font-weight:bold">
                                </button>
                            </td>
                        </tr>

                    </table>

                    <input type="hidden" id="hitung-panggil" value="">
                    <div class="row">
                        <div class="col-md-6 col-lg-3 col-sm-12">
                            <div class="mb-3">
                                <label for="tgl_registrasi" class="form-label" style="margin-bottom:0px">Tgl. Registrasi</label>
                                <input type="text" class="form-control form-control-sm" id="tgl_registrasi" placeholder="" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-sm-12">
                            <div class="mb-3">
                                <label for="pasien" class="form-label" style="margin-bottom:0px">Nama Pasien</label>
                                <input type="search" class="form-control form-control-sm" id="pasien-cari" placeholder="Cari nama pasien... " autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-sm-12">
                            <div class="mb-3">
                                <label for="pembiayaan" class="form-label" style="margin-bottom:0px">Pembiayaan</label>
                                <select name="pembiayaan" id="pembiayaan" class="form-select form-select-sm" style="">
                                    <option value="" disabled selected>Pilih Pembiayaan</option>
                                    <option value="">Umum & BPJS </option>
                                    <option value="BPJS">BPJS</option>
                                    <option value="Umum">Umum</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-sm-12">
                            <div class="mb-3">
                                <label for="status_periksa" class="form-label" style="margin-bottom:0px">Status Periksa</label>
                                <select name="status_periksa" id="status_periksa" class="form-select form-select-sm" style="">
                                    <option value="" disabled selected>Pilih Status Periksa</option>
                                    <option value="">Semua</option>
                                    <option value="Sudah">Sudah</option>
                                    <option value="Belum">Belum</option>
                                    <option value="Batal">Batal</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped text-sm table-sm" id="tb_pasien" width="100%" style="font-size: 12px !important">
                        <thead>
                            <tr role="row">
                                <th style="width: 20px">Aksi</th>
                                <th>Nama</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        @include('content.upload.inforegistrasi')
        @include('content.upload.resume')
    </div>
    @include('content.poliklinik.modal.modal_pemeriksaan')
    @include('content.poliklinik.modal.modal_riwayat')
    @include('content.ranap.modal.modal_riwayat')
    @include('content.poliklinik.modal.modal_askep')
    @include('content.poliklinik.modal.modal_askep_anak')
    @include('content.poliklinik.modal.modal_resep')
    @include('content.poliklinik.modal.modal_skrj')
    @include('content.poliklinik.modal.modal_spri')
    @include('content.poliklinik.modal.modal_rujukan_keluar')
    @include('content.poliklinik.modal.modal_kontrol_umum')
    @include('content.poliklinik.modal.modal_icare')
    @include('content.poliklinik.modal.modal_peserta')
    @include('content.poliklinik.modal.modal_catatan')
    @include('content.ranap.modal.modal_hasil_kritis')
@endsection

@push('script')
    <script type="text/javascript">
        var id = '';
        var isModalShow = false;
        var kd_poli = '{{ $poli->kd_poli }}';
        var kd_dokter = "{{ Request::get('dokter') }}";
        var tgl_registrasi = "";
        var nmpasien = localStorage.getItem('pasien');
        var pembiayaan = "";
        var status_periksa = "";

        $('#pasien-cari').on('keyup', function() {
            localStorage.setItem('pasien', $('#pasien-cari').val());
            nmpasien = localStorage.getItem('pasien');
            if (nmpasien.length >= 3 || nmpasien.length == 0) {
                $('#tb_pasien').DataTable().destroy();
                tb_pasien(tgl_registrasi, nmpasien, pembiayaan, status_periksa);
            }
        })

        $('#pasien-cari').on('search', function() {
            nmpasien = '';
            localStorage.setItem('pasien', '');
            $('#tb_pasien').DataTable().destroy();
            tb_pasien(tgl_registrasi);
        })

        $('#pembiayaan').on('change', function() {
            pembiayaan = $(this).val();
            $('#tb_pasien').DataTable().destroy();
            tb_pasien(tgl_registrasi, nmpasien, pembiayaan, status_periksa);
        })
        $('#status_periksa').on('change', function() {
            status_periksa = $(this).val();
            $('#tb_pasien').DataTable().destroy();
            tb_pasien(tgl_registrasi, nmpasien, pembiayaan, status_periksa);
        })

        $(document).ready(function() {
            date = new Date()
            hari = ('0' + (date.getDate())).slice(-2);
            bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;

            $('#tgl_registrasi').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                todayHighlight: true,
            }).on('changeDate', (e) => {
                selectTgl = splitTanggal($('#tgl_registrasi').datepicker('getFormattedDate')) ? splitTanggal($('#tgl_registrasi').datepicker('getFormattedDate')) : "{{ date('Y-m-d') }}";
                localStorage.setItem('tanggal', selectTgl);
                $('#tb_pasien').DataTable().destroy();
                tb_pasien(selectTgl, nmpasien);
                hitungPanggilan();
                tgl_registrasi = localStorage.getItem('tanggal');
            });
            tgl_registrasi = localStorage.getItem('tanggal') ? localStorage.getItem('tanggal') : "{{ date('Y-m-d') }}";
            $('#tb_pasien').DataTable().destroy();
            $('#pasien-cari').val(nmpasien)
            tb_pasien(tgl_registrasi, $('#pasien-cari').val());
            hitungPanggilan();
            $('#tgl_registrasi').datepicker('setDate', splitTanggal(tgl_registrasi));
        });

        function hitungPasien() {
            $.ajax({
                url: '/erm/pemeriksaan/jumlah',
                data: {
                    'kd_poli': kd_poli,
                    'kd_dokter': kd_dokter
                },
                method: 'GET',
                success: function(response) {
                    $('#count-pasien').text(response);
                }
            })
        }



        // function modalsoap(no_rawat) {
        //     jbtn = "{{ session()->get('pegawai')->jbtn }}";
        //     nik = "{{ session()->get('pegawai')->nik }}";
        //     nama = "{{ session()->get('pegawai')->nama }}";
        //     $('#nama_user').val(nama);
        //     $('#user').val(nik);
        //     let kd_dokter = "{{ Request::get('dokter') }}"
        //     let textObject = `Janin : \nPres : \nDJJ : \nTBJ : \nJK : \nPlacenta : \nAk : \n`

        //     getRegPeriksa(no_rawat).done((regPeriksa) => {
        //         if (regPeriksa.pasien.ket_pasien) {
        //             $('#formSoapPoli input[name=ket_pasien]').val(regPeriksa.pasien.ket_pasien.keterangan)
        //         }
        //         $('#formSoapPoli input[name=no_rawat]').val(no_rawat)
        //         $('#formSoapPoli input[name=no_rkm_medis]').val(regPeriksa.no_rkm_medis)
        //         $('#formSoapPoli input[name=nm_pasien]').val(`${regPeriksa.pasien.nm_pasien} (${regPeriksa.pasien.jk}) / ${hitungUmur(regPeriksa.pasien.tgl_lahir)}`)
        //         $('#formSoapPoli input[name=p_jawab]').val(regPeriksa.p_jawab)
        //         $('#formSoapPoli input[name=png_jawab]').val(`${regPeriksa.penjab.png_jawab}`)

        //         if (role === 'dokter') {
        //             cekPanggilanPoli(no_rawat).done((response) => {
        //                 if (!response.length) {
        //                     panggil(textRawat(regPeriksa.no_rawat))
        //                 }
        //             });
        //         }

        //         riwayatResep(regPeriksa.no_rkm_medis)
        //         cekAlergi(regPeriksa.no_rkm_medis)
        //     }).fail((request) => {
        //         alertErrorAjax(request);
        //     })

        // }

        function cekPanggilanPoli(no_rawat) {
            return $.ajax({
                url: '/erm/poli/panggil',
                data: {
                    no_rawat: no_rawat
                },
                method: 'GET',
            })
        }

        function riwayatResep(no_rm) {
            $('#tb-resep-riwayat tbody').empty()
            $.ajax({
                url: `/erm/resep/riwayat/${no_rm}`,
                method: 'GET',
            }).done((response) => {
                $.map(response, (resep) => {
                    if (resep.resep_dokter.length > 0 || resep.resep_racikan.length > 0) {
                        html = `<tr>`
                        html += `<td width="15%">${formatTanggal(resep.tgl_peresepan)} <br>${resep.no_resep}</td>`
                        html += `<td><ul style="disc inside">`
                        $.map(resep.resep_dokter, (dokter) => {
                            html += `<li>${dokter.data_barang.nama_brng}, ${dokter.jml} ${dokter.data_barang.kode_satuan.satuan}, aturan pakai ${dokter.aturan_pakai}</li>`
                        })
                        $.map(resep.resep_racikan, (racikan) => {
                            html += `<li>${racikan.nama_racik}, jumlah ${racikan.jml_dr} ${racikan.metode.nm_racik}, aturan pakai ${racikan.aturan_pakai}</li>`
                            $.map(racikan.detail_racikan, (detail) => {
                                html += `<span class="badge rounded-pill text-bg-success">${detail.databarang.nama_brng}</span>`
                            })
                        })

                        html += `</ul></td>`
                        html += `<td><button style="font-size:12px" class="btn btn-warning btn-sm" onclick="copyResep(${resep.no_resep})" type="button"><i class="bi bi-clipboard-check-fill"></i> Copy Resep</button></td>`;
                        html += `<tr>`
                        $('#tb-resep-riwayat tbody').append(html)
                    }
                })
            })
        }

        function cekAlergi(no_rm) {
            $.ajax({
                url: '/erm/registrasi/riwayat',
                data: {
                    no_rkm_medis: no_rm,
                    sortir: 'ASC',
                },
                success: function(response) {
                    alergi = '-'
                    $.map(response.reg_periksa, function(val) {
                        if (val.pemeriksaan_ralan.length) {
                            $.map(val.pemeriksaan_ralan, (pem) => {
                                if (pem.alergi != '-' || pem.alergi != '' || pem.alergi) {
                                    alergi = pem.alergi
                                }
                            })
                        }
                    })
                    $('#alergi').val(alergi)
                }
            })
            return false;
        }

        function hitungPanggilan() {
            kd_poli = '{{ Request::segment(2) }}';
            kd_dokter = '{{ Request::get('dokter') }}';

            $.ajax({
                url: '/erm/registrasi/status',
                data: {
                    'kd_poli': kd_poli,
                    'kd_dokter': kd_dokter,
                },
                method: 'GET',
                success: function(response) {
                    let jumlah = 0;
                    let batal = 0;
                    let tunggu = 0;
                    let sudah = 0;
                    let periksa = 0;
                    $.map(response, function(val, index) {
                        if (val.stts == 'Belum') {
                            tunggu = val.jumlah;
                        } else if (val.stts == 'Sudah') {
                            sudah = val.jumlah;
                        } else if (val.stts == 'Batal') {
                            batal = val.jumlah;
                        } else if (val.stts == 'Berkas Diterima' || val.stts == 'Periksa') {
                            periksa = val.jumlah;
                            $('#hitung-panggil').val(periksa);
                        }
                        jumlah = jumlah + parseInt(val.jumlah)

                    })
                    $('#count-pasien').text(jumlah)
                    $('#count-tunggu').text(tunggu)
                    $('#count-selesai').text(sudah)
                    $('#count-batal').text(batal)
                },
            });
        }

        function panggil(urut) {

            id = $('.panggil-' + urut).data('id');
            hitung_panggilan = $('#hitung-panggil').val();
            text_recall = $('.panggil-' + urut).text()
            if (hitung_panggilan < 2 || text_recall == 'CALL') {
                $('.selesai-' + urut).prop('disabled', false);
                $('.selesai-' + urut).prop('class', 'btn btn-warning btn-sm mb-2 selesai-' + urut + '');

                $('.batal-' + urut).prop('disabled', false);
                $('.batal-' + urut).prop('class', 'btn btn-danger btn-sm mb-2 batal-' + urut + '');

                $('.panggil-' + urut).prop('class', 'btn btn-primary btn-sm mb-2 panggil-' + urut + '');
                $('.panggil-' + urut).css({
                    'background-color': 'rgb(152 0 175)',
                    'border-color': 'rgb(142 6 163)'
                });
                $('.panggil-' + urut).text('RE-CALL');
                $.ajax({
                    url: '/erm/poliklinik/panggil',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'no_rawat': id,
                    },
                    method: "POST",
                    success: function(data) {
                        $.toast({
                            text: 'Memangil : ' + data.no_rawat + '<br/> Jam Periksa : ' + data
                                .jam_periksa,
                            position: 'bottom-center',
                            bgColor: '#0067dd',
                            loader: false,
                            stack: false,
                        })
                        hitungPanggilan();
                    }
                })
            } else {
                $.toast({
                    text: 'Sedang ada pasien',
                    position: 'bottom-center',
                    bgColor: '#ffc107',
                    textColor: 'black',
                    stack: false,
                    loader: false,
                })
                $.toast().reset();
                hitungPanggilan();
            }

        }

        function selesai(urut) {
            id = $('.panggil-' + urut).data('id');
            reloadTabelPoli();
            Swal.fire({
                title: 'Yakin pemeriksaan selesai ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Belum',
                confirmButtonText: 'Ya, Selesai !'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/erm/poliklinik/selesai',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'no_rawat': id,
                        },
                        method: 'POST',
                        success: function(response) {
                            $.toast({
                                text: 'Periksa : ' + response.no_rawat +
                                    ' Selesai <br/> Jam Periksa : ' +
                                    response.jam_periksa,
                                position: 'bottom-center',
                                bgColor: '#198754',
                                loader: false,
                                stack: false,
                            });
                            $('#aksi-' + urut).empty();
                            $('#aksi-' + urut).append(
                                '<h3 class="text-success" align="center"><i class="bi bi-check-circle-fill"></i></h3>'
                            );
                            hitungPanggilan();
                        }

                    });
                }
            })
        }

        function batal(urut) {

            id = $('.batal-' + urut).data('id');

            $.ajax({
                url: '/erm/poliklinik/batal',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'no_rawat': id,
                },
                method: "DELETE",
            }).done((response) => {
                $.toast({
                    text: response.pesan + ' : ' + response.no_rawat,
                    position: 'bottom-center',
                    bgColor: '#dc3545',
                    loader: false,
                    stack: false,
                });

                $('.panggil-' + urut).prop('class', 'btn btn-success btn-sm mb-2 panggil-' + urut + '');
                $('.panggil-' + urut).removeAttr('style');
                $('.panggil-' + urut).css({
                    'width': '80px'
                });

                $('.batal-' + urut).prop('disabled', true);
                $('.batal-' + urut).prop('class', 'btn btn-secondary btn-sm mb-2 batal-' + urut + '');

                $('.selesai-' + urut).prop('disabled', true);
                $('.selesai-' + urut).prop('class', 'btn btn-secondary btn-sm mb-2 selesai-' + urut + '');

                $('.panggil-' + urut).text('PANGGIL');

                hitungPanggilan();
            }).fail((request, error) => {
                // console.log(, error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: request.responseJSON,
                })
            });


        }

        function getListRencanaKontrol(bulan, tahun, noka, filter) {
            rencana = $.ajax({
                url: '/erm/bridging/rencanaKontrol/list/' + bulan + '/' + tahun + '/' + noka + '/' + filter,
                dataType: 'JSON',
                method: 'GET',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            });

            return rencana;
        }


        function cekSep(sep) {
            sep = $.ajax({
                url: '/erm/sep/' + sep,
                dataType: 'JSON',
            });
            return sep;
        }

        function rujukanKeluar(noSep) {
            $('#modalRujukanKeluar').modal('show')
            cekSep(noSep).done(function(response) {
                $('#no_kartu').val(response.no_kartu)
                $('#no_sep_rujuk').val(response.no_sep)
                $('#no_rawat_rujuk').val(response.no_rawat)
                $('#pasien_rujuk').val(response.reg_periksa.no_rkm_medis + ' - ' + response.nama_pasien)
                $('#tgl_lahir_rujuk').val(splitTanggal(response.tanggal_lahir))
                $('.btn-cari-peserta').attr('onclick', 'getPesertaDetail(\'' + response.no_kartu + '\', \'' + response.tglsep + '\')');
                if (response.rujukan_keluar) {
                    $('#ppk_rujuk').attr('disabled', '')
                    $('#poli_rujuk').attr('disabled', '')
                    $('#tipe_rujuk').attr('disabled', '')
                    $('#tgl_kunjungan_rujuk').attr('disabled', '')
                    $('#diagnosa_rujuk').attr('disabled', '')
                    $('#catatan_rujuk').attr('disabled', '')
                    $('.btn-cari').css('display', 'none')
                    $('#ppk_rujuk').val(response.rujukan_keluar.nm_ppkDirujuk)
                    tanggalKontrol = splitTanggal(response.rujukan_keluar.tglRencanaKunjungan);
                    $('#diagnosa_rujuk').val(response.rujukan_keluar.nama_diagRujukan)
                    $('#poli_rujuk').val(response.rujukan_keluar.poliRujukan)
                    $('#catatan_rujuk').val(response.rujukan_keluar.catatan)
                    $('#tipe_rujuk').append('<option selected disable value="x">' + response.rujukan_keluar.tipeRujukan + '</option>')
                    $('#modalRujukanKeluar .modal-footer').css('display', 'none')
                }
            })
        }



        function geRujukanPcarePeserta(noka) {
            let rujukan = $.ajax({
                url: '/erm/bridging/rujukan/pcare/peserta/' + noka,
                dataType: 'JSON',
                method: 'GET',
            });

            return rujukan;
        }

        function rujukanExpired(tanggal) {
            $('.rujukan-expired').empty()
            let tglRujukan = new Date(tanggal)
            tglRujukan.setDate(tglRujukan.getDate() + 90)
            expiredRujukan = tglRujukan.toISOString().split('T')[0];
            $('.rujukan-expired').append('<div class="alert alert-warning" style="padding:8px;border-radius:0px;font-size:12px;margin:5px" role="alert"><i class="bi bi-info-circle-fill"></i> Masa berlaku rujukan sampai : <strong>' + formatTanggal(expiredRujukan) + '</strong></div>');
        }


        function kontrolUlang(noSep) {
            reloadTabelPoli();

            cekSep(noSep).done(function(response) {
                geRujukanPcarePeserta(response.no_kartu).done(function(rujukan) {
                    if (rujukan.metaData.code == 200 && rujukan.response) {
                        rujukanExpired(rujukan.response.rujukan.tglKunjungan)
                    } else {
                        $('.rujukan-expired').empty()
                        $('.rujukan-expired').append('<div class="alert alert-danger" style="padding:8px;border-radius:0px;font-size:12px;margin:5px" role="alert"><i class="bi bi-info-circle-fill"></i> Tidak ada rujukan dari FKTP</div>');
                    }
                })

                $('.btn-cari-peserta').attr('onclick', 'getPesertaDetail(\'' + response.no_kartu + '\', \'' + response.tglsep + '\')');
                $('.no_rawat').val(response.no_rawat)
                $('.no_sep').val(response.no_sep)
                $('.pasien').val(response.nomr + ' - ' + response.nama_pasien + '(' + response.reg_periksa.umurdaftar + ')');
                $('.tgl_lahir').val(splitTanggal(response.tanggal_lahir))
                $('.kode_poli').val(response.kdpolitujuan)
                $('.nama_poli').val(response.nmpolitujuan)
                $('.diagnosa').val(response.nmdiagnosaawal)
                $('.nama_dokter').val(response.reg_periksa.dokter.nm_dokter)
                $('.kode_dokter').val(response.kddpjp)
                $('.noka').val(response.no_kartu)
                if (response.surat_kontrol) {
                    tanggal = response.surat_kontrol.tgl_rencana.split('-');
                    tanggalKontrol = tanggal[2] + '-' + tanggal[1] + '-' + tanggal[0];
                    $('.no_surat').val(response.surat_kontrol.no_surat)
                    $('.nama_dokter').val(response.surat_kontrol.nm_dokter_bpjs)
                    $('.kode_dokter').val(response.surat_kontrol.kd_dokter_bpjs)
                    $('.btn-buat-skrj').css('display', 'none');
                    $('#btn-spesialis').removeAttr('onclick');
                } else {
                    $('#btn-spesialis').removeAttr('onclick');
                    $('.no_surat').val('')
                    $('.btn-buat-skrj').css('display', 'inline');
                }
                $('#modalSkrj').modal('show')
            })
        }

        function getPerintahInap(nokartu, tanggal) {
            let rawatInap = $.ajax({
                url: '/erm/spri/get/' + nokartu + '/' + tanggal,
                dataType: 'JSON',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            });

            return rawatInap;
        }


        function rawatInap(noRm, tanggal) {
            getPasienPeriksa(noRm, tanggal).done((response) => {
                $.map(response, (periksa) => {
                    getPerintahInap(periksa.pasien.no_peserta, tanggal).done((val) => {

                        $('.btn-cari-peserta').attr('onclick', 'getPesertaDetail(\'' + val.no_kartu + '\')');
                        $('.no_rawat_inap').val(periksa.no_rawat)
                        $('.pasien_inap').val(periksa.no_rkm_medis + ' - ' + periksa.pasien.nm_pasien + ' (' + periksa.umurdaftar + ' ' + periksa.sttsumur + ' )');
                        $('.tgl_lahir_inap').val(splitTanggal(periksa.pasien.tgl_lahir));
                        $('.no_kartu_inap').val(periksa.pasien.no_peserta);
                        $('.no_surat_inap').val(val.no_surat);

                        if (Object.keys(val).length > 0) {
                            $('.tgl_surat_inap').val(splitTanggal(val.tgl_surat));
                            $('.tgl_inap').val(splitTanggal(val.tgl_rencana));
                            $('.kode_dokter_inap').val(val.kd_dokter_bpjs);
                            $('.nama_dokter_inap').val(val.nm_dokter_bpjs);
                            $('.diagnosa_inap').val(val.diagnosa);
                            $('.diagnosa_inap').attr('disabled', true);
                            $('.tgl_inap').attr('disabled', true);
                            $('.btn-buat-spri').css('display', 'none')
                            $('.kode_poli_inap').val(val.kd_poli_bpjs);
                            $('.nama_poli_inap').val(val.nm_poli_bpjs);
                        } else {
                            $('.diagnosa_inap').attr('disabled', false);
                            $('.tgl_inap').attr('disabled', false);
                            $('.btn-buat-spri').css('display', 'inline')
                            $('.tgl_surat_inap').val("{{ date('d-m-Y') }}");
                            $('.tgl_inap').val("{{ date('d-m-Y') }}");
                            getPoliBpjs(periksa.kd_poli).done((response) => {
                                $('.kode_poli_inap').val(response.kd_poli_bpjs)
                                $('.nama_poli_inap').val(response.nm_poli_bpjs)
                            })
                            getDokter(periksa.kd_dokter).done((response) => {
                                $.map(response, (data) => {
                                    $('.kode_dokter_inap').val(data.mapping_dokter.kd_dokter_bpjs);
                                    $('.nama_dokter_inap').val(data.nm_dokter);
                                })
                            })
                        }

                    })
                })
            })
            $('#modalSpri').modal('show');
        }

        $('.diagnosa_inap').on('keyup', function() {
            let dx = $(this).val();
            if (dx.length >= 3) {
                getDiagnosa(dx).done(function(response) {
                    if (response) {
                        html =
                            '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                        no = 1;
                        $.map(response, function(data) {
                            html +=
                                '<li data-nama="' + data.nm_penyakit + '" data-id="' + data.kd_penyakit + '" onclick="setDiagnosaInap(this)"><a class="dropdown-item" href="javascript:void(0)" style="overflow:hidden"> ' + data.kd_penyakit + ' - ' + data.nm_penyakit + '</a></li>'
                            no++;
                        })
                        html += '</ul>';
                        $('.list-diagnosa').fadeIn();
                        $('.list-diagnosa').html(html);
                    }
                })
            }
        })


        function setDiagnosaInap(p) {
            let kdDiagnosa = $(p).data('id');
            let nmDiagnosa = $(p).data('nama');
            $('.diagnosa_inap').val(kdDiagnosa + ' - ' + nmDiagnosa);
            $('.kd_diagnosa_inap').val(kdDiagnosa);
        }

        var tanggalKontrol = '';

        function setTanggalKontrol(param) {
            tanggalKontrol = $(param).val()
        }

        function getPoliBpjs(kdPoli) {
            let poli = $.ajax({
                url: '/erm/poliklinik/bpjs/' + kdPoli,
                dataType: 'JSON',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            });

            return poli;
        }

        function cariDokterPoli(kdPoli) {

            getPoliBpjs(kdPoli).done(function(response) {
                no = 1;
                html = '';
                kd_dokter = '';
                $.map(response, function(res) {
                    $.map(res.poliklinik.mapping_poli, function(data) {
                        if (kd_dokter != data.dokter.kd_dokter) {
                            html += '<tr>'
                            html += '<td>' + no + '</td>'
                            html += '<td><a href="javascript:void(0)" onclick="setDokterSpesialis(\'' + data.dokter.mapping_dokter.kd_dokter_bpjs + '\', \'' + data.dokter.mapping_dokter.nm_dokter_bpjs + '\')"><span style="font-size:12px" class="badge text-bg-primary">' + data.dokter.mapping_dokter.kd_dokter_bpjs + '</span></a></td>'
                            html += '<td>' + data.dokter.nm_dokter + '</td>'
                            html += '</tr>'
                            no++;
                            kd_dokter = data.dokter.kd_dokter;
                        }
                    })
                })
                $('.table-dokter tbody').append(html)
                $('#modalDokter').modal('show');
                tanggalKontrol = $('#tgl_kontrol').val();
                $('#modalSkrj').modal('hide');
            })


        }

        function setDokterSpesialis(kode, nama) {
            $('#modalSkrj').modal('show')
            $('#modalDokter').modal('hide')
            $('.kode_dokter').val(kode);
            $('.nama_dokter').val(nama);
        }

        function tb_pasien(tgl_registrasi, nama = '', pembiayaan = '', status) {
            tgl_registrasi = tgl_registrasi ? tgl_registrasi : "{{ date('Y-m-d') }}";

            var table = $('#tb_pasien').DataTable({
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
                destroy: true,
                columnDefs: [{
                    width: 50,
                    targets: 0,
                }],
                ajax: {
                    url: "table",
                    data: {
                        kd_poli: '{{ $poli->kd_poli }}',
                        kd_dokter: "{{ Request::get('dokter') }}",
                        tgl_registrasi: tgl_registrasi,
                        pasien: nama,
                        pembiayaan: pembiayaan,
                        status_periksa: status,
                    },
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            let html = '';
                            norawat = textRawat(row.no_rawat)
                            if (row.stts == 'Batal') {
                                html =
                                    '<h3 class="text-danger" align="center"><i class="bi bi-x-circle-fill"></i></h3>';
                            } else if (row.stts == 'Sudah') {
                                html =
                                    '<h3 class="text-success" align="center"><i class="bi bi-check-circle-fill"></i></h3>';
                            } else {

                                if (row.stts == 'Berkas Diterima' || row.stts == 'Periksa') {
                                    $('.panggil-' + norawat).text('RE-CALL');
                                    $('.selesai-' + norawat).addClass('btn-warning');
                                    $('.panggil-' + norawat).prop('style',
                                        'width:80px;background-color:#9800af;border-color:#8e06a3;color:white'
                                    );
                                    $('.batal-' + norawat).addClass('btn-danger');
                                } else {
                                    $('.panggil-' + norawat).addClass('btn-success');
                                    $('.batal-' + norawat).addClass('btn-secondary');
                                    $('.selesai-' + norawat).addClass('btn-secondary');
                                    $('.panggil-' + norawat).text('PANGGIL')
                                    $('.batal-' + norawat).prop('disabled', true);
                                    $('.selesai-' + norawat).prop('disabled', true);
                                }
                                html = '<div id="aksi-' + norawat + '">';
                                html += ' <button onclick="panggil(\'' + norawat + '\')" class="btn btn-sm mb-2 panggil-' + norawat + '" type="button" style="width:80px;" data-id="' + row.no_rawat + '"></button><br/>';
                                html += ' <button onclick="selesai(\'' + norawat + '\')" class="btn btn-sm mb-2 selesai-' + norawat + '" type="button" style="width:80px;" data-id="' + row.no_rawat + '">SELESAI</button><br/>';
                                html += ' <button onclick="batal(\'' + norawat + '\')" class="btn btn-sm mb-2 batal-' + norawat + '" type="button" style="width:80px;" data-id="' + row.no_rawat + '">BATAL</button><br/>';
                                html += '</div>';
                            }
                            return html
                        },
                        name: 'aksi'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            if (row.kd_pj == 'A01' || row.kd_pj == 'A05') {
                                classTeksPenjab = 'text-success';
                            } else {
                                classTeksPenjab = 'text-danger';
                            }

                            pasien = data.pasien.nm_pasien;
                            no_rawat = textRawat(row.no_rawat);
                            badgeKontrol = '';
                            btnSep = '<div class="dropdown mb-1 mt-1" id="dropdown-sep-' + no_rawat + '"> <button id="btn-rujuk-' + no_rawat + '" class="btn-sm" style="font-size:10px;width:112px" type="button" data-bs-toggle="dropdown" aria-expanded="false" ><ul class="dropdown-menu" style="font-size:12px"></button></div>';
                            if (row.sep && row.kd_pj != "A03") {
                                $('#btn-rujuk-' + no_rawat).addClass('btn btn-success dropdown-toggle');
                                $('#btn-rujuk-' + no_rawat).text('SEP Sudah Terbit');
                                html = '<ul class="dropdown-menu" style="font-size:12px">'
                                html += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="kontrolUlang(\'' + row.sep.no_sep + '\')">Kontrol Ulang / SKRJ</a></li>'
                                html += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="rawatInap(\'' + row.no_rkm_medis + '\', \'' + row.tgl_registrasi + '\')">Perintah Rawat Inap / SPRI</a></li>'
                                html += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="rujukanKeluar(\'' + row.sep.no_sep + '\')">Rujukan Keluar</a></li>'
                                html += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="riwayatIcare(\'' + row.pasien.no_peserta + '\', ' + row.dokter.mapping_dokter.kd_dokter_bpjs + ')">Riwayat Perawatan ICare</a></li>'
                                html += '</ul>'
                                $('#dropdown-sep-' + no_rawat).append(html)
                                if (row.sep.surat_kontrol) {
                                    badgeKontrol = '<a target="_blank" href="/erm/rencanaKontrol/print/' + row.sep.surat_kontrol.no_surat + '"><span id="kontrol-' + no_rawat + '" class="badge text-bg-warning" >Kontrol : ' + splitTanggal(row.sep.surat_kontrol.tgl_rencana) + '</span></a>';
                                } else if (row.sep.rujukan_keluar) {
                                    textRujukan = row.sep.rujukan_keluar.nm_ppkDirujuk.split(' - ')[0];
                                    rujukan = textRujukan.length > 10 ? textRujukan.substring(0, 10) + '...' : textRujukan
                                    badgeKontrol = '<a target="_blank" href="/erm/rujukan/print/' + row.sep.rujukan_keluar.no_rujukan + '"><span id="kontrol-' + no_rawat + '" class="badge text-bg-warning" >Rujuk : ' + rujukan + '</span></a>';
                                }

                                if (row.pasien.spri?.tgl_surat == row.tgl_registrasi) {
                                    badgeKontrol = '<a target="_blank" href="/erm/spri/print/' + row.pasien.spri.no_surat + '"><span id="kontrol-' + no_rawat + '" class="badge text-bg-warning" >SPRI : ' + splitTanggal(row.pasien.spri.tgl_rencana) + '</span></a>';
                                }
                            } else if (!row.sep && row.kd_pj != "A03") {
                                $('#btn-rujuk-' + no_rawat).addClass('btn btn-danger dropdown-toggle');
                                html = '<ul class="dropdown-menu" style="font-size:12px">'
                                html += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="rawatInap(\'' + row.no_rkm_medis + '\', \'' + row.tgl_registrasi + '\')">Perintah Rawat Inap / SPRI</a></li>'
                                html += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="riwayatIcare(\'' + row.pasien.no_peserta + '\', ' + row.dokter.mapping_dokter.kd_dokter_bpjs + ')">Riwayat Perawatan ICare</a></li>'
                                html += '</ul>'
                                $('#dropdown-sep-' + no_rawat).append(html)
                                $('#btn-rujuk-' + no_rawat).text('Belum Terbit SEP');
                                if (row.pasien.spri?.tgl_surat == row.tgl_registrasi) {
                                    badgeKontrol = '<a target="_blank" href="/erm/spri/print/' + row.pasien.spri.no_surat + '"><span id="kontrol-' + no_rawat + '" class="badge text-bg-warning" >SPRI : ' + splitTanggal(row.pasien.spri.tgl_rencana) + '</span></a>';
                                }
                            } else {
                                if (row.surat_kontrol) {
                                    badgeKontrol = '<a href="javascript:void(0)"><span id="kontrol-' + no_rawat + '" class="badge text-bg-warning" >Kontrol : ' + splitTanggal(row.surat_kontrol.tanggal) + '</span></a>';
                                }
                                $('#dropdown-sep-' + no_rawat).css('display', 'none')
                            }


                            if (row.penjab.png_jawab == 'UMUM') {
                                textPenjab = '<a href="javascript:void(0)" onclick="kontrolUmum(\'' + row.no_rawat + '\')" style="text-decoration:none;color:red">' + row.penjab.png_jawab + '</a>'
                            } else {
                                textPenjab = '<a href="javascript:void(0)" onclick="" style="text-decoration:none;color:green">' + row.penjab.png_jawab + '</a>'
                            }

                            html = '<h5 class="mb-1 h3">' + row.no_reg + '</h5>';
                            html += '<p style="margin:0px"><span class="pasien-' + row.no_reg + '">' + pasien + cekList(row.skrining_tb) +
                                '</span></br>' +
                                row.no_rawat +
                                '</br><i><strong class="' + classTeksPenjab + '">' + textPenjab + '</strong></i></p>' + btnSep + ' ' + badgeKontrol;

                            return html;
                        },
                        name: 'nm_pasien'

                    },
                    {
                        data: '',
                        render: function(data, type, row, meta) {

                            let ambilAskep = '';
                            let no_rkm_medis = row.no_rkm_medis.replace(/\s/g, '');
                            if (row.dokter) {
                                dokter = row.dokter.nm_dokter;
                                if (row.dokter.kd_sps == 'S0001') {
                                    ambilAskep = 'ambilAskepKebidanan(\'' + no_rkm_medis + '\')';
                                } else {
                                    ambilAskep = 'ambilAskepAnak(\'' + no_rkm_medis + '\')';
                                }
                            }
                            // else {
                            //     kd_dokter = row.kd_dokter.replace(/\s/g, '');
                            //     $.ajax({
                            //         url: '/erm/dokter/ambil',
                            //         dataType: 'JSON',
                            //         data: {
                            //             'nik': kd_dokter,
                            //         },
                            //         success: function(response) {
                            //             $.map(response.data, function(res) {
                            //                 if (res.kd_dokter == 'S0001') {
                            //                     $('#btn-askep-' + row.no_reg).attr('onclick', 'ambilAskepAnak(\'' + no_rkm_medis + '\')');

                            //                 } else {
                            //                     $('#btn-askep-' + row.no_reg).attr('onclick', 'ambilAskepKebidanan(\'' + no_rkm_medis + '\')');
                            //                 }
                            //             })
                            //         }
                            //     });
                            // }

                            // html =
                            //     '<a href="#form-upload" class="btn btn-primary btn-sm mb-2 mr-1 btn-width-poliklinik" style="" onclick = "detailPeriksa(\'' +
                            //     row.no_rawat + '\',\'' + row.status_lanjut + '\')" id="btn-upload-' +
                            //     textRawat(row.no_rawat) +
                            //     '"><i id="upload-' +
                            //     textRawat(row.no_rawat) +
                            //     '" class="bi bi-cloud-upload-fill"></i> UPLOAD</a></br>';
                            html = `<button
                                class="btn btn-primary btn-sm mb-2 mr-1 btn-width-poliklinik"
                                onclick="detailPeriksa('${row.no_rawat}', '${row.status_lanjut}')"
                                id="btn-upload-${textRawat(row.no_rawat)}">
                                <i class="bi bi-cloud-upload-fill" id="upload-${textRawat(row.no_rawat)}"></i>
                                UPLOAD
                            </button>`
                            html += `<button id="btn-periksa-${textRawat(row.no_rawat)}" style="" onclick="showSoapRalan('${row.no_rawat}')" class="btn btn-primary btn-sm mb-2 mr-1 btn-width-poliklinik">
                                    <i class="bi bi-pencil-square" id="icon-periksa-${textRawat(row.no_rawat)}"></i>
                                    SOAP
                                </button>`
                            // html +=
                            //     '<button id="btn-periksa-' + textRawat(row.no_rawat) +
                            //     '" style="" onclick="" class="btn btn-primary btn-sm mb-2 mr-1 btn-width-poliklinik" data-bs-toggle="modal" data-bs-target="#modalSoap" data-id="' +
                            //     row.no_rawat + '"><i class="bi bi-pencil-square" id="icon-periksa-' +
                            //     textRawat(row.no_rawat) + '"></i> SOAP</button>';
                            html += '<button id="btn-askep-' + textRawat(row.no_rawat) + '" onclick="' + ambilAskep + '" class="btn btn-primary btn-sm mb-2 mr-1 btn-width-poliklinik" data-id="' +
                                row.no_rkm_medis +
                                '"><i id="icon-askep-' +
                                textRawat(row.no_rawat) +
                                '" class="bi bi-file-bar-graph-fill"></i> ASKEP</button>';
                            html +=
                                '<button class="btn btn-primary btn-sm mb-2 mr-1 btn-width-poliklinik" onclick="confirmUpdateRiwayat(\'' + row.no_rkm_medis + '\')" data-id="' +
                                row.no_rkm_medis + '"  style="width:100px;font-size:11px;text-align:left"><i class="bi bi-search"></i>RIWAYAT</button>';

                            if (row.upload.length > 0) {
                                $('#upload-' + textRawat(row.no_rawat)).removeClass(
                                    'bi bi-cloud-upload-fill')
                                $('#btn-upload-' + textRawat(row.no_rawat)).removeClass('btn-primary')
                                $('#upload-' + textRawat(row.no_rawat)).addClass(
                                    'bi bi-check2-circle')
                                $('#btn-upload-' + textRawat(row.no_rawat)).addClass('btn-success')
                            }



                            if (row.pemeriksaan_ralan.length) {
                                $('#icon-periksa-' + textRawat(row.no_rawat)).removeClass(
                                    'bi bi-pencil-square')
                                $('#btn-periksa-' + textRawat(row.no_rawat)).removeClass('btn-primary')
                                $('#icon-periksa-' + textRawat(row.no_rawat)).addClass(
                                    'bi bi-check2-circle')
                                $('#btn-periksa-' + textRawat(row.no_rawat)).addClass('btn-success')
                                $('.panggil-' + textRawat(row.no_rawat)).addClass('btn-success');
                                $('.panggil-' + textRawat(row.no_rawat)).removeClass('btn-secondary');
                                $('.panggil-' + textRawat(row.no_rawat)).attr('disabled', false);
                            } else {
                                $('.panggil-' + textRawat(row.no_rawat)).removeClass('btn-success');
                                $('.panggil-' + textRawat(row.no_rawat)).addClass('btn-secondary');
                                $('.panggil-' + textRawat(row.no_rawat)).attr('disabled', true);
                            }

                            $.map(row.pasien.reg_periksa, function(data) {
                                if (data.kd_poli == 'P001' || data.kd_poli == 'P007' || data.kd_poli == 'P009') {
                                    if (Object.keys(data.askep_ralan_kebidanan).length > 0) {
                                        $('#btn-askep-' + textRawat(row.no_rawat)).prop('class', 'btn btn-success btn-sm mr-1')
                                    }
                                } else if (data.kd_poli == 'P008' || data.kd_poli == 'P003') {
                                    if (Object.keys(data.askep_ralan_anak).length > 0) {
                                        $('#btn-askep-' + textRawat(row.no_rawat)).prop('class', 'btn btn-success btn-sm mr-1')
                                    }
                                }
                            })

                            return `<div class="d-flex flex-column">${html}</div>`;
                        },
                        name: 'upload',
                    }

                ],
                "language": {
                    "zeroRecords": "Tidak ada data pasien terdaftar",
                    "infoEmpty": "Tidak ada data pasien terdaftar",
                }
            });
        }

        function confirmUpdateRiwayat(no_rkm_medis) {
            if (localStorage.getItem('riwayat') === 'baru') {
                listRiwayatPasien(no_rkm_medis);
            } else if (localStorage.getItem('riwayat') === 'lama') {
                modalRiwayat(no_rkm_medis);
            } else {
                Swal.fire({
                    title: 'Update',
                    text: "Pnambahan tampilan riwayat baru, apakah lanjut ke tampilan riwayat baru ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Gunakan yang baru',
                    cancelButtonText: 'Tidak, Tetap yang lama',
                }).then((result) => {
                    if (result.isConfirmed) {
                        localStorage.setItem('riwayat', 'baru');
                        listRiwayatPasien(no_rkm_medis);
                    } else {
                        localStorage.setItem('riwayat', 'lama');
                        modalRiwayat(no_rkm_medis);
                    }
                })
            }
        }

        function kontrolUmum(no_rawat) {
            $.ajax({
                url: '/erm/registrasi/ambil',
                data: {
                    no_rawat: no_rawat
                },
                success: function(response) {
                    if (response.surat_kontrol) {
                        tanggalKontrol = splitTanggal(response.surat_kontrol.tanggal);
                        $('.no_surat').val(response.surat_kontrol.no_surat)
                        $('.btn-buat-kontrol-umum').css('display', 'none')
                    } else {
                        tanggalKontrol = '';
                        $('.no_surat').val('')
                        $('.btn-buat-kontrol-umum').css('display', 'inline')
                    }
                    $('.btn-cari-peserta').attr('onclick', 'getPesertaDetail(\'' + response.pasien.no_peserta + '\')');
                    $('.no_rawat').val(response.no_rawat)
                    $('.no_rkm_medis').val(response.no_rkm_medis)
                    $('.pasien').val(response.pasien.no_rkm_medis + ' - ' + response.pasien.nm_pasien + ' (' + response.umurdaftar + ' ' + response.sttsumur + ')')
                    $('.umurdaftar').val(response.umurdaftar)
                    $('.sttsumur').val(response.sttsumur)
                    $('.kode_dokter').val(response.kd_dokter)
                    $('.dokter').val(response.dokter.nm_dokter)
                    $('.nama_dokter').val(response.kd_dokter + ' - ' + response.dokter.nm_dokter)
                    $('.tgl_lahir').val(splitTanggal(response.pasien.tgl_lahir))
                    jenis = response.dokter.kd_sps == 'S0003' ? 'PAN' : 'POG';
                    $('.kode_jenis').val(jenis)
                    $('.kode_poli').val(response.kd_poli)
                    $('.nama_poli').val(response.kd_poli + ' - ' + response.poliklinik.nm_poli)
                    $('#modalKontrolUmum').modal('show')
                }
            })
        }

        function buatKontrolUmum() {

            no_rkm_medis = $('.no_rkm_medis').val()
            no_rawat = $('.no_rawat').val()
            jenis = $('.kode_jenis').val()
            tanggal = $('.tgl_kontrol_umum').val()
            dokter = $('.dokter').val()
            kode_dokter = $('.kode_dokter').val()
            kode_poli = $('.kode_poli').val()
            umurdaftar = $('.umurdaftar').val()
            sttsumur = $('.sttsumur').val()
            $.ajax({
                url: '/erm/kontrol/umum/baru',
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rkm_medis: no_rkm_medis,
                    no_rawat: no_rawat,
                    jenis: jenis,
                    tanggal: splitTanggal(tanggal),
                    dokter: dokter,
                },
                success: function(response) {
                    Swal.fire(
                        'Berhasil',
                        'Surat kontrol sudah dibuat',
                        'success'
                    );
                    dataBooking = {
                        'no_rkm_medis': no_rkm_medis,
                        'kd_dokter': kode_dokter,
                        'kd_poli': kode_poli,
                        'tanggal': splitTanggal(tanggal),
                    }

                    buatBooking(dataBooking).done(function(val) {
                        data = {
                            'no_reg': val.response.no_reg,
                            'tgl_registrasi': val.response.tanggal_periksa,
                            'kd_dokter': val.response.kd_dokter,
                            'no_rkm_medis': val.response.no_rkm_medis,
                            'kd_poli': val.response.kd_poli,
                            'p_jawab': val.response.pasien.namakeluarga,
                            'almt_pj': val.response.pasien.alamatpj + ', ' + val.response.pasien.kecamatanpj + ', ' + val.response.pasien.kabupatenpj,
                            'hubungan': val.response.pasien.keluarga,
                            'status_lanjut': 'Ralan',
                            'kd_pj': val.response.kd_pj,
                            'umurdaftar': umurdaftar,
                            'sttsumur': sttsumur,
                            'status_poli': 'Lama',
                            'stts_daftar': 'Lama',
                        }
                        buatRegistrasi(data);
                    })

                    $('#modalKontrolUmum').modal('hide')
                }
            })
        }

        function buatBooking(data) {
            data._token = "{{ csrf_token() }}";

            booking = $.ajax({
                url: '/erm/booking/buat',
                data: data,
                method: 'POST',
                success: function(response) {
                    $('.booking').val('true');
                    Swal.fire(
                        'Berhasil',
                        'Telah di tambahakan booking',
                        'success'
                    );
                },
                error: function(a, b, c) {
                    Swal.fire(
                        'Gagal',
                        'Terjadi kesalahan pembuatan booking',
                        'error'
                    );
                }
            });
            return booking;
        }

        function buatRegistrasi(data) {
            data._token = "{{ csrf_token() }}";

            registrasi = $.ajax({
                url: '/erm/registrasi/buat',
                method: 'POST',
                data: data,
                success: function(response) {
                    $('.registrasi').val('true');
                    Swal.fire(
                        'Berhasil',
                        'Data registrasi telah dibuat dengan nomor registrasi ' + response.response.no_rawat,
                        'success'
                    );
                    reloadTabelPoli();
                },
                error: function(a, b, c) {
                    Swal.fire(
                        'Gagal',
                        'Terjadi kesalahan pembuatan registrasi pasien',
                        'error'
                    );
                }
            })

            return registrasi;
        }

        function ambilAskepAnak(no_rkm_medis) {
            $.ajax({
                url: 'askep/anak',
                data: {
                    no_rkm_medis: no_rkm_medis,
                },
                dataType: 'JSON',
                success: function(response) {
                    if (Object.keys(response).length > 0) {
                        $('#opt-rawat').append(
                            '<option value="" disabled selected>PILIH TANGGAL ASESMEN</option>')
                        $.map(response, function(data) {
                            $('#opt-rawat').append('<option class="opt-asesmen-anak" value=' + data.no_rawat + '>' + formatTanggal(data.tanggal) + ' - ' + data.no_rawat + '</option>')
                            $('.no_rkm_medis').html(': ' + data.reg_periksa.no_rkm_medis);
                            $('.jk').html(data.reg_periksa.pasien.jk == 'L' ? ': Laki-laki' :
                                ': Perempuan')
                            $('.tgl_registrasi').html(': ' + formatTanggal(data.reg_periksa
                                .tgl_registrasi));
                            $('.nm_pasien').html(': ' + data.reg_periksa.pasien.nm_pasien);
                            $('.tgl_lahir').html(': ' + formatTanggal(data.reg_periksa.pasien
                                    .tgl_lahir) +
                                ' / ' + data.reg_periksa.umurdaftar + ' ' + data.reg_periksa
                                .sttsumur);
                            $('.anamnesis').html(': ' + data.informasi);
                            $('.tensi').html(': ' + data.td + ' mmHG');
                            $('.nadi').html(': ' + data.nadi + ' x/menit');
                            $('.respirasi').html(': ' + data.rr + ' x/menit');
                            $('.suhu').html(': ' + data.suhu + ' <sup>o</sup>C');
                            $('.gcs').html(': ' + data.gcs);
                            $('.bb').html(': ' + data.bb + ' Kg');
                            $('.tb').html(': ' + data.bb + ' Cm');
                            $('.lp').html(': ' + data.lp + ' Cm');
                            $('.ld').html(': ' + data.ld + ' Cm');
                            $('.lk').html(': ' + data.lk + ' Cm');
                            $('.keluhan_utama').html(': ' + data.keluhan_utama);
                            $('.rpd').html(': ' + data.rpd);
                            $('.rpk').html(': ' + data.rpk);
                            $('.rpo').html(': ' + data.rpo);
                            $('.alergi').html(': ' + data.alergi);
                            $('.anakke').html(': ' + data.anakke + ', dari ' + data.darisaudara +
                                ' bersaudara');
                            $('.caralahir').html(': ' + data.caralahir + ' ( ' + data
                                .ket_caralahir +
                                ' )');
                            $('.umurkelahiran').html(': ' + data.umurkelahiran);
                            $('.kelainanbawaan').html(': ' + data.kelainanbawaan + ' (' + data
                                .ket_kelainan_bawaan + ' )');

                            namaImunisasi = '';
                            $('.tb-askep-imunisasi tbody').empty()
                            $('.imunisasi').remove()
                            $.map(data.reg_periksa.pasien.riwayat_imunisasi, function(imunisasi) {
                                if (namaImunisasi != imunisasi.master_imunisasi
                                    .nama_imunisasi) {
                                    namaImunisasi = imunisasi.master_imunisasi
                                        .nama_imunisasi
                                    html = '<tr class="imunisasi ' + imunisasi
                                        .kode_imunisasi +
                                        '">'
                                    html += '<td>' + namaImunisasi + '</td>';

                                    html += '</tr>'
                                    $('.tb-askep-imunisasi tbody').append(html)
                                }
                                nomorImun =
                                    '<td><i class="bi bi-check-lg text-success"></i></td>'
                                $('.' + imunisasi.kode_imunisasi).append(nomorImun)
                            })


                            $('.usiatengkurap').html(': ' + data.usiatengkurap);
                            $('.usiaduduk').html(': ' + data.usiaduduk);
                            $('.usiaberdiri').html(': ' + data.usiaberdiri);
                            $('.usiagigipertama').html(': ' + data.usiagigipertama);
                            $('.usiaberjalan').html(': ' + data.usiaberjalan);
                            $('.usiamembaca').html(': ' + data.usiamembaca);
                            $('.usiamenulis').html(': ' + data.usiamenulis);
                            $('.wajah').html(': ' + data.wajah);
                            $('.alat_bantu').html(': ' + data.alat_bantu);
                            $('.prothesa').html(': ' + data.prothesa);
                            $('.aktifitas').html(': ' + data.aktifitas);
                            $('.status_psiko').html(': ' + data.status_psiko + ' (' + data
                                .ket_psiko +
                                ' )');
                            $('.edukasi').html(': ' + data.edukasi + ' (' + data.ket_edukasi +
                                ' )');
                            $('.hub_keluarga').html(': ' + data.hub_keluarga);
                            $('.ekonomi').html(': ' + data.ekonomi);
                            $('.pengasuh').html(': ' + data.pengasuh + ' ( ' + data.ket_pengasuh +
                                ' )');
                            $('.budaya').html(': ' + data.budaya + ' ( ' + data.ket_budaya + ' )');

                        })

                        $('#modalAskepAnak').modal('show');
                    } else {
                        Swal.fire(
                            'Kosong!', 'Belum ada data asesmen', 'error'
                        );
                    }

                }
            });
        }

        $('#opt-rawat').on('change', function() {
            no_rawat = $(this).val();
            $.ajax({
                url: 'askep/anak/detail',
                data: {
                    no_rawat: no_rawat,
                },
                dataType: 'JSON',
                success: function(response) {
                    $('.tgl_registrasi').html(': ' + formatTanggal(response.reg_periksa
                        .tgl_registrasi));
                    $('.tensi').html(': ' + response.td + ' mmHG');
                    $('.nadi').html(': ' + response.nadi + ' x/menit');
                    $('.respirasi').html(': ' + response.rr + ' x/menit');
                    $('.suhu').html(': ' + response.suhu + ' <sup>o</sup>C');
                    $('.gcs').html(': ' + response.gcs);
                    $('.bb').html(': ' + response.bb + ' Kg');
                    $('.tb').html(': ' + response.bb + ' Cm');
                    $('.lp').html(': ' + response.lp + ' Cm');
                    $('.ld').html(': ' + response.ld + ' Cm');
                    $('.lk').html(': ' + response.lk + ' Cm');
                    $('.keluhan_utama').html(': ' + response.keluhan_utama);
                    $('.rpd').html(': ' + response.rpd);
                    $('.rpk').html(': ' + response.rpk);
                    $('.rpo').html(': ' + response.rpo);
                    $('.alergi').html(': ' + response.alergi);
                    $('.anakke').html(': ' + response.anakke + ', dari ' + response.darisaudara +
                        ' bersaudara');
                    $('.caralahir').html(': ' + response.caralahir + ' ( ' + response
                        .ket_caralahir +
                        ' )');
                    $('.umurkelahiran').html(': ' + response.umurkelahiran);
                    $('.kelainanbawaan').html(': ' + response.kelainanbawaan + ' (' + response
                        .ket_kelainan_bawaan + ' )');
                    namaImunisasi = '';
                    $('.tb-askep-imunisasi tbody').empty()
                    $('.imunisasi').remove()
                    $.map(response.reg_periksa.pasien.riwayat_imunisasi, function(imunisasi) {
                        if (namaImunisasi != imunisasi.master_imunisasi.nama_imunisasi) {
                            namaImunisasi = imunisasi.master_imunisasi.nama_imunisasi
                            html = '<tr class="imunisasi ' + imunisasi.kode_imunisasi + '">'
                            html += '<td>' + namaImunisasi + '</td>';

                            html += '</tr>'
                            $('.tb-askep-imunisasi tbody').append(html)
                        }
                        nomorImun = '<td><i class="bi bi-check-lg text-success"></i></td>'
                        $('.' + imunisasi.kode_imunisasi).append(nomorImun)
                    })
                    $('.usiatengkurap').html(': ' + response.usiatengkurap);
                    $('.usiaduduk').html(': ' + response.usiaduduk);
                    $('.usiaberdiri').html(': ' + response.usiaberdiri);
                    $('.usiagigipertama').html(': ' + response.usiagigipertama);
                    $('.usiaberjalan').html(': ' + response.usiaberjalan);
                    $('.usiamembaca').html(': ' + response.usiamembaca);
                    $('.usiamenulis').html(': ' + response.usiamenulis);
                    $('.wajah').html(': ' + response.wajah);
                    $('.alat_bantu').html(': ' + response.alat_bantu);
                    $('.prothesa').html(': ' + response.prothesa);
                    $('.aktifitas').html(': ' + response.aktifitas);
                    $('.status_psiko').html(': ' + response.status_psiko + ' (' + response
                        .ket_psiko +
                        ' )');
                    $('.edukasi').html(': ' + response.edukasi + ' (' + response.ket_edukasi +
                        ' )');
                    $('.hub_keluarga').html(': ' + response.hub_keluarga);
                    $('.ekonomi').html(': ' + response.ekonomi);
                    $('.pengasuh').html(': ' + response.pengasuh + ' ( ' + response.ket_pengasuh +
                        ' )');
                    $('.budaya').html(': ' + response.budaya + ' ( ' + response.ket_budaya + ' )');
                }
            });

        })

        function ambilAskepKebidanan(no_rkm_medis) {
            $.ajax({
                url: 'askep/kebidanan',
                data: {
                    no_rkm_medis: no_rkm_medis,
                },
                dataType: 'JSON',
                success: function(response) {
                    let option = '';
                    response?.data?.map((data) => {
                        $('#select-askep-bidan').append('<option class="opt-askep-bidan" value=' + textRawat(data.no_rawat, '-') + '>' + formatTanggal(data.tanggal) + ' - ' + data.no_rawat + '</option>')
                        $('.no_rkm_medis').html(': ' + data.reg_periksa.no_rkm_medis);
                        $('.jk').html(data.reg_periksa.pasien.jk == 'L' ? ': Laki-laki' : ': Perempuan')
                        $('.tgl_registrasi').html(': ' + formatTanggal(data.reg_periksa.tgl_registrasi));
                        $('.nm_pasien').html(': ' + data.reg_periksa.pasien.nm_pasien);
                        $('.tgl_lahir').html(': ' + formatTanggal(data.reg_periksa.pasien.tgl_lahir) +
                            ' / ' +
                            data
                            .reg_periksa.umurdaftar + ' ' + data.reg_periksa.sttsumur);
                        $('.anamnesis').html(': ' + data.informasi);
                        $('.tensi').html(': ' + data.td + ' mmHG');
                        $('.nadi').html(': ' + data.nadi + ' x/menit');
                        $('.respirasi').html(': ' + data.rr + ' x/menit');
                        $('.suhu').html(': ' + data.suhu + ' <sup>o</sup>C');
                        $('.gcs').html(': ' + data.gcs);
                        $('.bb').html(': ' + data.bb + ' Kg');
                        $('.tb').html(': ' + data.bb + ' Cm');
                        $('.lila').html(': ' + data.lila + ' Cm');
                        $('.bmi').html(': ' + data.bmi + ' Kg/m<sup>2</sup>');
                        $('.tfu').html(': ' + data.tfu + ' Cm');
                        $('.tbj').html(': ' + data.tbj + ' Cm');
                        $('.letak').html(': ' + data.letak);
                        $('.presentasi').html(': ' + data.presentasi);
                        $('.penurunan').html(': ' + data.penurunan);
                        $('.kontraksi').html(': ' + data.his + ' x/10');
                        $('.kekuatan').html(': ' + data.kekuatan);
                        $('.lama').html(': ' + data.lama + ' detik');
                        $('.djj').html(': ' + data.bjj + ' /mnt ' + data.ket_bjj);
                        $('.portio').html(': ' + data.portio);
                        $('.serviks').html(': ' + data.serviks + ' Cm');
                        $('.ketuban').html(': ' + data.ketuban + ' kep/bok');
                        $('.hodge').html(': ' + data.hodge);
                        $('.inspekulo').html(': ' + data.inspekulo + ' ,<br/>Hasil : ' + data
                            .ket_inspekulo);
                        $('.ctg').html(': ' + data.ctg + ' ,<br/>Hasil : ' + data.ket_ctg);
                        $('.lakmus').html(': ' + data.lakmus + ' ,<br/>Hasil : ' + data.ket_lakmus);
                        $('.lab').html(': ' + data.lab + ' ,<br/>Hasil : ' + data.ket_lab);
                        $('.usg').html(': ' + data.usg + ' ,<br/>Hasil : ' + data.ket_usg);
                        $('.panggul').html(': ' + data.panggul);
                        $('.keluhan').text(': ' + data.keluhan_utama);
                        $('.umur').text(': ' + data.umur + ' Th');
                        $('.lama').text(': ' + data.lama + ' Hari');
                        $('.banyak').text(': ' + data.banyaknya + ' Pembalut');
                        $('.haid').text(': ' + data.haid);
                        $('.siklus').text(': ' + data.siklus + ' hari');
                        $('.ket_siklus1').text(data.ket_siklus1);
                        $('.ket_siklus2').text(': ' + data.ket_siklus2);
                        $('.status').text(': ' + data.status);
                        $('.kali').text(data.kali);
                        $('.usia1').text(data.usia1);
                        $('.ket1').text(data.ket1);
                        $('.usia2').text(data.usia2);
                        $('.ket2').text(data.ket2);
                        $('.usia3').text(data.usia3);
                        $('.ket3').text(data.ket3);
                        $('.hpht').text(': ' + formatTanggal(data.hpht));
                        $('.usia_kehamilan').text(': ' + data.usia_kehamilan + ' bln/mgg');
                        $('.tp').text(': ' + formatTanggal(data.tp));
                        $('.imunisasi').text(': ' + data.imunisasi);
                        $('.ket_imunisasi').text(data.ket_imunisasi ? data.ket_imunisasi : '-');
                        $('.gpa').text('G : ' + data.g + ', P :' + data.p + ', A : ' + data.a);
                        $('.hidup').text(data.hidup);
                        $('.ginekologi').text(data.ginekologi);
                        $('.kebiasaan').text(data.kebiasaan + ', ' + data.ket_kebiasaan);
                        $('.kebiasaan1').text(data.kebiasaan1 + ', ' + data.ket_kebiasaan1 +
                            ' Batang /hari');
                        $('.kebiasaan2').text(data.kebiasaan2 + ', ' + data.ket_kebiasaan2 +
                            ' Botol /hari');
                        $('.kebiasaan3').text(data.kebiasaan3);
                        $('.kb').text(data.kb + ' , ', +data.ket_kb);
                        $('.kb').text(data.kb);
                        $('.ket_kb').text(data.ket_kb);
                        $('.komplikasi').text(data.komplikasi + ', ' + data.ket_komplikasi);
                        $('.berhenti').text(data.berhenti);
                        $('.alasan').text(data.alasan);
                        no = 1;
                        data.reg_periksa.pasien.riwayat_persalinan.forEach(function(riwayat) {
                            html = '<tr>';
                            html += '<td>' + no + '</td>'
                            html += '<td>' + formatTanggal(riwayat.tgl_thn) + '</td>'
                            html += '<td>' + riwayat.tempat_persalinan + '</br>' + riwayat
                                .penolong +
                                '</td>'
                            html += '<td>' + riwayat.usia_hamil + '</td>'
                            html += '<td> Persalinan : ' + riwayat.jenis_persalinan +
                                '<br/> Penyulit : ' +
                                riwayat
                                .penyulit +
                                '</td>'
                            html += '<td> JK : ' + riwayat.jk + '<br/> BB/PB : ' + riwayat.bbpb +
                                '<br/> Keadaaan : ' + riwayat.keadaan + '</td>'
                            html += '</tr>';
                            no++;
                            $('.r_persalinan').append(html)
                        })
                        $('#modalAskep').modal('show');
                    })
                }
            });
        }

        function resep(no_rawat) {
            $.ajax({
                url: '/erm/registrasi/ambil',
                data: {
                    no_rawat: no_rawat,
                },
                method: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    $('.no_rawat').val(response.no_rawat);
                    $('.nm_pasien').val(response.no_rkm_medis + ' / ' + response.pasien.nm_pasien + ' / ' +
                        response.umurdaftar + ' ' + response.sttsumur)
                }
            })
            $('#modalResep').modal('show');
        }
    </script>
@endpush
