<div class="modal fade" id="modalSoap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">PEMERIKSAAN & RESEP</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- tabs --}}
                <ul class="nav nav-tabs" id="tab-soap-rajal" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-soap" data-bs-toggle="tab"
                            data-bs-target="#tab-soap-pane" type="button" role="tab" aria-controls="tab-soap-pane"
                            aria-selected="true">SOAP</button>
                    </li>
                    <li class="nav-item" role="presentation" id="li-asmed-obg" style="display:none">
                        <button class="nav-link" id="tab-asesmen-obg" data-bs-toggle="tab" data-bs-target="#tab-asmed-obg"
                            type="button" role="tab" aria-controls="tab-asmed-obg" aria-selected="false">Asesmen Medis Rajal Obgyn</button>
                    </li>
                    <li class="nav-item" role="presentation" id="li-asmed-ana">
                        <button class="nav-link" id="tab-asesmen-anak" data-bs-toggle="tab" data-bs-target="#tab-asmed-ana"
                            type="button" role="tab" aria-controls="tab-asmed-ana" aria-selected="false">Asesmen Medis Rajal Anak</button>
                    </li>
                    <li class="nav-item" role="presentation" id="li-asmed-ranap-obg">
                        <button class="nav-link" id="tab-asesmen-ranap-obg" data-bs-toggle="tab" data-bs-target="#tab-asmed-ranap-obg"
                            type="button" role="tab" aria-controls="tab-asmed-ranap-obg" aria-selected="false">Asesmen Medis Ranap Obgyn</button>
                    </li>
                    <li class="nav-item" role="presentation" id="li-asmed-ranap-ana">
                        <button class="nav-link" id="tab-asesmen-ranap-anak" data-bs-toggle="tab" data-bs-target="#tab-asmed-ranap-ana"
                            type="button" role="tab" aria-controls="tab-asmed-ranap-ana" aria-selected="false">Asesmen Medis Ranap Anak</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="permintaan-laborat-tab" data-bs-toggle="tab" data-bs-target="#permintaan-laborat-tab-pane"
                            type="button" role="tab" aria-controls="permintaan-laborat-tab-pane" aria-selected="true">Permintaan Lab</button>
                    </li>
                    <li class="nav-item" role="presentation" id="li-lab-ana">
                        <button class="nav-link" id="tab-lab-anak" data-bs-toggle="tab" data-bs-target="#lab-ana"
                            type="button" role="tab" aria-controls="lab-ana" aria-selected="false">Hasil Laboratorium</button>
                    </li>
                    <li class="nav-item" role="presentation" id="li-rad-ana">
                        <button class="nav-link" id="tab-rad-anak" data-bs-toggle="tab" data-bs-target="#rad-ana"
                            type="button" role="tab" aria-controls="rad-ana" aria-selected="false">Hasil Radiologi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="permintaan-radiologi-tab" data-bs-toggle="tab" data-bs-target="#permintaan-radiologi-tab-pane"
                            type="button" role="tab" aria-controls="permintaan-radiologi-tab-pane" aria-selected="true">Permintaan Radiologi</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="tab-soap-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        @include('content.poliklinik.modal.pemeriksaan.soap')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-asmed-obg" role="tabpanel" aria-labelledby="tab-asmed"
                        tabindex="0">
                        @include('content.poliklinik.modal.pemeriksaan.asmed_kandungan')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-asmed-ana" role="tabpanel" aria-labelledby="tab-asmed"
                        tabindex="0">
                        @include('content.poliklinik.modal.pemeriksaan.asmed_anak')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-asmed-ranap-obg" role="tabpanel" aria-labelledby="tab-asmed-ranap"
                        tabindex="0">
                        @include('content.ranap.form.form_asmed_kandungan')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-asmed-ranap-ana" role="tabpanel" aria-labelledby="tab-asmed-ranap"
                        tabindex="0">
                        @include('content.ranap.form.form_asemd_anak')
                    </div>
                    <div class="tab-pane fade" id="permintaan-laborat-tab-pane" role="tabpanel" aria-labelledby="permintaan-laborat-tab" tabindex="0">
                        @include('content.ranap.modal.penunjang.permintaan_lab')
                    </div>
                    <div class="tab-pane fade p-3" id="lab-ana" role="tabpanel" aria-labelledby="tab-lab"
                        tabindex="0">
                        <small class="mb-3 px-2 py-1 fw-semibold text-danger bg-danger bg-opacity-10 border border-danger opacity-10 rounded-3" id="alertHasilLab" style="display: none">Belum / Tidak dilakukan pemeriksaan laboratorium</small>
                        <div class="container" id="viewHasilLaborat" style="display: none">
                            <h5 class="text-center">HASIL PEMERIKSAAN LAB</h5>
                            <table class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>Pemeriksaan</th>
                                        <th>Hasil</th>
                                        <th>Nilai Rujukan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="tabel-lab">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="permintaan-radiologi-tab-pane" role="tabpanel" aria-labelledby="permintaan-radiologi-tab" tabindex="0">
                        @include('content.ranap.modal.penunjang.permintaan_radiologi')
                    </div>
                    <div class="tab-pane fade p-3" id="rad-ana" role="tabpanel" aria-labelledby="tab-radiologi"
                        tabindex="0">
                        <small class="mb-3 px-2 py-1 fw-semibold text-danger bg-danger bg-opacity-10 border border-danger opacity-10 rounded-3" id="alertHasilRadiologi" style="display: none">Belum / Tidak dilakukan pemeriksaan radiologi</small>
                        <div class="row" id="viewHasilRadiologi" style="display: none">
                            <table class="table text-sm table-bordered" id="tbHasilRadiologi">
                                <thead>
                                    <tr>
                                        <th>Tanggal Sampel</th>
                                        <th>Diagnosa Klinis</th>
                                        <th>Informasi Medis</th>
                                        <th>Jenis Pemeriksaan</th>
                                        <th>Hasil</th>
                                        <th>Gambar</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-success btn-sm btn-soap" onclick="simpanSoap()"><i class="bi bi-save"></i> Simpan SOAP</button>
                <button type="button" class="btn btn-success btn-sm btn-asmed" name="simpan" style="display: none"><i class="bi bi-save"></i> Simpan Asmed Rajal</button>
                <button type="button" class="btn btn-success btn-sm btn-asmed-ranap" name="simpan" style="display: none"><i class="bi bi-save"></i> Simpan Asmed Ranap</button>
            </div>
        </div>
    </div>
</div>
@include('content.poliklinik.modal.moda_detail_resep')
@push('script')
    <script>
        function hapusBaris(param) {
            console.log($(this).parent().remove())
        }

        $('button[data-bs-target="#tab-soap-pane"]').on('shown.bs.tab', function(e, x, y) {
            $('.btn-asmed-ranap').css('display', 'none')
            $('.btn-asmed').css('display', 'none')
            $('.btn-soap').css('display', 'inline')

        })

        $('button[data-bs-target="#tab-asmed-ana"]').on('shown.bs.tab', function(e, x, y) {
            $('.btn-asmed-ranap').css('display', 'none')
            $('.btn-asmed').css('display', 'inline')
            $('.btn-soap').css('display', 'none')

        })
        $('button[data-bs-target="#tab-asmed-obg"]').on('shown.bs.tab', function(e, x, y) {
            $('.btn-asmed-ranap').css('display', 'none')
            $('.btn-asmed').css('display', 'inline')
            $('.btn-soap').css('display', 'none')

        })
        $('button[data-bs-target="#tab-asmed-ranap-obg"]').on('shown.bs.tab', function(e, x, y) {
            $('.btn-asmed-ranap').css('display', 'inline')
            $('.btn-asmed').css('display', 'none')
            $('.btn-soap').css('display', 'none')
        })
        $('button[data-bs-target="#tab-asmed-ranap-ana"]').on('shown.bs.tab', function(e, x, y) {
            $('.btn-asmed-ranap').css('display', 'inline')
            $('.btn-asmed').css('display', 'none')
            $('.btn-soap').css('display', 'none')
        })
        $('button[data-bs-target="#lab-ana"]').on('shown.bs.tab', function(e, x, y) {
            $('.btn-asmed-ranap').css('display', 'none')
            $('.btn-asmed').css('display', 'none')
            $('.btn-soap').css('display', 'none')
            const no_rawat = $('#nomor_rawat').val();
            $('#tabel-lab').empty()
            getHasilLab(no_rawat).done((lab) => {
                // console.log(lab.length);
                let jenisPerawatan = '';
                let tglPeriksa = '';
                let hasil = '';
                if (lab.length) {
                    lab.map((item, index) => {
                        if (jenisPerawatan != item.jns_perawatan_lab.kd_jenis_prw || tglPeriksa != item.tgl_periksa) {
                            hasil += `<tr class="borderless" style="background-color:#eee">
                                <td colspan="3"><strong>${item.jns_perawatan_lab.nm_perawatan}</strong><br/>
                                ${formatTanggal(item.tgl_periksa)} ${item.jam}</td>
                                <td>${item.periksa_lab.petugas.nama}</td></tr>
                                `
                        }

                        if (item.keterangan == 'L') {
                            warna = 'style="color:#fff;background-color:#0d6efd;font-weight:bold"';
                        } else if (item.keterangan == 'H' || item.keterangan == '*' || item.keterangan == '**') {
                            warna = 'style="color:#fff;background-color:#dc3545;font-weight:bold"';
                        } else if (item.keterangan == 'K' || item.keterangan == 'k') {
                            warna = 'style="color:#fff;background-color:#dc3;font-weight:bold"';
                        } else {
                            warna = '';
                        }
                        hasil += '<tr ' + warna + '>';
                        hasil += '<td>' + item.template.Pemeriksaan + '</td>';
                        hasil += '<td>' + item.nilai + ' ' + item.template.satuan +
                            '</td>';
                        hasil += '<td>' + item.nilai_rujukan + '</td>';
                        hasil += '<td>' + item.keterangan + '</td>';
                        hasil += '</tr>';

                        jenisPerawatan = item.jns_perawatan_lab.kd_jenis_prw;
                        tglPeriksa = item.tgl_periksa;
                    })
                    $('#tabel-lab').append(hasil)
                    $('#viewHasilLaborat').css('display', 'inline')
                    $('#alertHasilLab').css('display', 'none')
                } else {
                    $('#viewHasilLaborat').css('display', 'none')
                    $('#alertHasilLab').css('display', 'inline')

                }
            })
        })
        $('button[data-bs-target="#rad-ana"]').on('shown.bs.tab', function(e, x, y) {
            $('.btn-asmed-ranap').css('display', 'none')
            $('.btn-asmed').css('display', 'none')
            $('.btn-soap').css('display', 'none')
            const no_rawat = $('#nomor_rawat').val();
            $('#tbHasilRadiologi tbody').empty()
            getPermintaanRadiologi(no_rawat).done((permintaan) => {
                if (Object.keys(permintaan).length) {
                    permintaan.map((prm, index) => {
                        html = `<tr><td>${splitTanggal(prm.tgl_hasil)} ${prm.jam_hasil}</td>
                                <td>${prm.diagnosa_klinis}</td>
                                <td>${prm.informasi_tambahan}</td>
                                <td>
                        `
                        prm.periksa_radiologi.map((periksa) => {
                            if (periksa.tgl_periksa == prm.tgl_hasil && periksa.jam == prm.jam_hasil) {
                                html += `${periksa.jns_perawatan.nm_perawatan}, <br/>`
                            }
                        })

                        html += `</td>`
                        html += `<td>`
                        prm.hasil_radiologi.map((hasil) => {
                            if (hasil.tgl_periksa == prm.tgl_hasil && hasil.jam == prm.jam_hasil) {
                                html += `${stringPemeriksaan(hasil.hasil)}`
                            }
                        })
                        html += `</td>`
                        html += `<td>`
                        if (prm.gambar_radiologi.length) {
                            prm.gambar_radiologi.map((gambar) => {
                                if (gambar.tgl_periksa == prm.tgl_hasil && gambar.jam == prm.jam_hasil) {
                                    gbr = `https://sim.rsiaaisyiyah.com/webapps/radiologi/${gambar.lokasi_gambar}`
                                    html += `<a class="btn btn-success btn-sm mb-2" id="btnMagnifyImage" class="magnifyImg${index}" data-magnify="gallery" data-src="${gbr}">
                                                <i class="bi bi-eye"></i> BUKA GAMBAR
                                            </a><br/>`
                                } else {
                                    html += `<button class="btn btn-danger btn-sm mb-2"><i class="bi bi-eye-slash"></i> GAMBAR KOSONG</button>`

                                }
                            })
                        } else {
                            html += `<button class="btn btn-danger btn-sm mb-2"><i class="bi bi-eye-slash"></i> GAMBAR KOSONG</button>`
                        }
                        html += `</td>`
                        html += `<tr>`

                        $('#tbHasilRadiologi tbody').append(html)
                    })

                    $('#viewHasilRadiologi').css('display', 'flex')
                    $('#alertHasilRadiologi').css('display', 'none')

                } else {
                    $('#viewHasilRadiologi').css('display', 'none')
                    $('#alertHasilRadiologi').css('display', 'inline')
                }
            })
        })

        function setNoRacik(no_resep) {
            let no_racik = '';
            $.ajax({
                url: '/erm/resep/racik/ambil',
                method: 'GET',
                dataType: 'JSON',
                async: false,
                data: {
                    no_resep: no_resep,
                },
                success: function(response) {
                    if (Object.keys(response).length >= 1) {
                        $.map(response, function(data) {
                            no = data.no_racik
                        })
                        no_racik = parseInt(no) + 1;
                    } else {
                        no_racik = 1
                    }

                }
            })
            return no_racik;


        }

        function copyResep(kdResep) {
            Swal.fire({
                title: 'Yakin ?',
                text: "Anda mengcopy resep ini",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    setNoResep().done((response) => {
                        if (Object.keys(response).length > 0) {
                            if (response.tgl_perawatan == '0000-00-00' && response.no_rawat == $('#nomor_rawat').val()) {
                                nomor = response.no_resep;
                            } else {
                                nomor = parseInt(response.no_resep) + 1
                            }
                        } else {
                            nomor = "{{ date('Ymd') }}" + '0001';
                        }
                        $('.no_resep').val(nomor)
                    })
                    let dataResep;
                    let dataObat;
                    let dataRacikan;
                    let no_resep = $('.no_resep').val();
                    let no_rawat = $('#nomor_rawat').val();
                    let no_racik = setNoRacik(no_resep)
                    cekResep(no_rawat).done((response) => {
                        jmlResep = Object.keys(response).length;
                        if (jmlResep == 0) {
                            simpanResepObat().done((response) => {
                                console.log('BUAT RESEP', response)
                            });
                        }
                        ambilResep(kdResep).done((resep) => {
                            if (Object.keys(resep.resep_dokter).length > 0) {
                                $.map(resep.resep_dokter, function(rd) {
                                    $.ajax({
                                        url: '/erm/resep/umum/simpan',
                                        method: 'POST',
                                        data: {
                                            '_token': '{{ csrf_token() }}',
                                            'no_resep': no_resep,
                                            'kode_brng': rd.kode_brng,
                                            'aturan_pakai': rd.aturan_pakai,
                                            'jml': rd.jml,
                                        },
                                    }).done((response) => {
                                        console.log('SUKSES')
                                    })
                                })
                            }
                            if (Object.keys(resep.resep_racikan).length > 0) {
                                $.map(resep.resep_racikan, function(racik) {
                                    $.ajax({
                                        url: '/erm/resep/racik/simpan',
                                        method: 'POST',
                                        data: {
                                            '_token': "{{ csrf_token() }}",
                                            'no_resep': no_resep,
                                            'no_racik': racik.no_racik,
                                            'nama_racik': racik.nama_racik,
                                            'kd_racik': racik.kd_racik,
                                            'jml_dr': racik.jml_dr,
                                            'aturan_pakai': racik.aturan_pakai,
                                            'keterangan': racik.keterangan,
                                        },
                                        success: function(response) {
                                            $.map(racik.detail_racikan, function(racikan) {
                                                $.ajax({
                                                    url: '/erm/resep/racik/detail/simpan',
                                                    method: 'POST',
                                                    data: {
                                                        '_token': '{{ csrf_token() }}',
                                                        'no_resep': no_resep,
                                                        'no_racik': racikan.no_racik,
                                                        'kode_brng': racikan.kode_brng,
                                                        'p1': racikan.p1,
                                                        'p2': racikan.p2,
                                                        'jml': racikan.jml,
                                                        'kandungan': racikan.kandungan,
                                                    },
                                                }).done((response) => {
                                                    console.log('SUKSES')
                                                })
                                            })
                                        }
                                    }).done((response) => {
                                        console.log('SUKSES')
                                    })
                                })
                            }
                            $('#tb-resep-riwayat tbody').empty()
                            cekResep(no_rawat)
                            riwayatResep($('#no_rm').val())
                            tulisPlan();
                        })
                    });
                }

            })
        }

        function simpanObat() {
            no_resep = $('.no_resep_umum').val()
            kode_obat = $('.kode_obat_umum').val()
            jml = $('.jml_umum').val()
            aturan_pakai = $('.aturan_pakai').val()
            if (kode_obat && jml && aturan_pakai) {
                $.ajax({
                    url: '/erm/resep/umum/simpan',
                    method: 'POST',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'no_resep': no_resep,
                        'kode_brng': kode_obat,
                        'jml': jml,
                        'aturan_pakai': aturan_pakai,
                    },
                    success: function(response) {

                        cekResep($('#nomor_rawat').val())
                        tulisPlan()
                    },
                    error: function(request, status, error) {
                        Swal.fire(
                            'Gagal !',
                            'Obat tidak tersimpan<br/>' + request.responseJSON.message,
                            'error',
                        )

                    }
                }).done(function() {
                    tulisPlan()
                })
            } else {

                textObat = kode_obat ? '' : '<b class="text-danger" >Obat, </b>';
                textJml = jml ? '' : '<b class="text-danger"> Jumlah, </b>';
                textAturan = aturan_pakai ? '' : '<b class="text-danger"> Aturan Pakai</b>';
                Swal.fire(
                    'Gagal !',
                    'Kolom ' + textObat + textJml + textAturan + ' tidak boleh kosong',
                    'error'
                )
            }

        }


        $('#simpanObat').on('click', function() {
            $.ajax({
                url: '/erm/resep/obat/ambil',
                data: {
                    'no_resep': $('.no_resep').val(),
                },
                success: function(response) {
                    if (Object.keys(response).length == 0) {
                        simpanResepObat()
                    }
                    $.ajax({
                        url: '/erm/resep/umum/simpan',
                        method: 'POST',
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'no_resep': $('.no_resep').val(),
                            'kode_brng': $('.kode_obat').val(),
                            'jml': $('.jml').val(),
                            'aturan_pakai': $('.aturan_pakai').val() + ' ' + $(
                                    '.keterangan')
                                .val(),
                        },
                        success: function(response) {
                            cekResep(id)
                        },
                        error: function() {
                            Swal.fire('Gagal !', 'Obat tidak tersimpan', 'error')
                        }
                    })
                }
            })
        });


        function simpanResepObat() {

            kd_dokter = "{{ Request::get('dokter') }}";
            dokter = kd_dokter ? kd_dokter : $('#nik').val();

            let resep = $.ajax({
                url: '/erm/resep/obat/simpan',
                data: {
                    _token: "{{ csrf_token() }}",
                    kd_dokter: dokter,
                    no_rawat: $('#nomor_rawat').val(),
                    no_resep: $('.no_resep').val(),
                },
                method: 'POST',
                error: function(request, status, error) {
                    Swal.fire(
                        'Gagal !',
                        'Tidak bisa menambah resep<br/>' + request.responseJSON.message,
                        'error',
                    )

                }
            });

            return resep;
        }

        function ambilRacikan(no_resep, no_racik) {
            const hasil = $.ajax({
                url: '/erm/resep/racik/ambil',
                data: {
                    no_resep: no_resep,
                    no_racik: no_racik,
                },
            })
            return hasil;
        }

        function ambilResep(no_resep) {
            hasil = '';
            let resep = $.ajax({
                url: '/erm/resep/obat/ambil',
                data: {
                    no_resep: no_resep,
                },
                success: function(response) {
                    hasil = response;
                },
            })
            return resep;
        }

        function tulisPlan() {
            no_rawat = $('#nomor_rawat').val();
            $.ajax({
                url: '/erm/resep/obat/ambil',
                method: 'GET',
                data: {
                    no_rawat: no_rawat,
                },
                success: function(response) {
                    teksRd = '';
                    teksRr = '';
                    $.map(response, function(res) {
                        $.map(res.resep_dokter, function(rd) {
                            teksRd += `${rd.data_barang.nama_brng}, jml : ${rd.jml} ${rd.data_barang.kode_satuan.satuan} aturan pakai ${rd.aturan_pakai} \n`;
                        })

                        $.map(res.resep_racikan, function(rr) {
                            teksRr += `${rr.metode.nm_racik} ${rr.nama_racik}, jml : ${rr.jml_dr} aturan pakai ${rr.aturan_pakai}, isian :  \n`
                            let no = 1
                            $.map(rr.detail_racikan, function(dr) {
                                if (rr.no_racik == dr.no_racik) {
                                    teksRr += `   - ${dr.databarang.nama_brng} dosis ${dr.kandungan} mg, \n`
                                    no++;
                                }
                            })
                            teksRr += '\n';
                        })

                    })
                    $('#plan').val(teksRd + '\n' + teksRr);
                },
                error: function(request, status, error) {
                    Swal.fire(
                        'Gagal !',
                        'Tidak tertulis di PLAN<br/>' + request.responseJSON.message,
                        'error',
                    )

                }
            })
        }

        function hitungJumlahObat(kps, p1, p2, jumlah) {
            jumlah = $('.jml_dr').val();
            kandungan = kps * p1 / p2;
            jml_obat = kandungan * jumlah / kps
            return parseFloat(jml_obat).toFixed(0);
        }

        function ambilObatRacikan() {
            $('.table-racikan tbody').empty();
            no_resep = $('.no_resep').val();
            no_racik = $('.no_racik').val();
            $.ajax({
                url: '/erm/resep/racik/detail/ambil',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    no_resep: no_resep,
                    no_racik: no_racik,
                },
                success: function(response, status, detail) {
                    html = '';
                    no = 1;
                    $.map(response, function(res) {

                        kandungan = res.kandungan != 0 ? res.kandungan : res.data_barang.kapasitas;

                        html += '<tr class="obat-' + no + '">'
                        html += '<td><input type="hidden" id="kode_brng' + no + '" value="' + res.kode_brng + '" name="kode_brng[]"/>' + res.data_barang.nama_brng + '</td>'
                        html += '<td><input type="hidden" id="kps' + no + '" name="kps[]" value="' + res.data_barang.kapasitas + '"/>' + res.data_barang.kapasitas + ' mg </td>'
                        html += '<td><input type="search" class="form-control form-control-sm form-underline" id="p1' + no + '" name="p1[]" value="' + res.p1 + '" onkeyup="hitungObatRacik(' + no + ')" onfocusout="setNilaiPembagi(this)" autocomplete="off" onkeypress="return hanyaAngka(event)"/></td>'
                        html += '<td>/</td>'
                        html += '<td><input type="search" class="form-control form-control-sm form-underline" id="p2' + no + '"name="p2[]" onkeyup="hitungObatRacik(' + no + ')" value="' + res.p2 + '" onfocusout="setNilaiPembagi(this)" autocomplete="off" onkeypress="return hanyaAngka(event)"/></td>'
                        html += '<td><input type="search" class="form-control form-control-sm form-underline" id="kandungan' + no + '" name="kandungan[]" onkeypress="return hanyaAngka(event)" value="' + kandungan + '" onkeyup="hitungDosis(' + no + ')" autocomplete="off"/></td>'
                        html += '<td>mg</td>'
                        html += '<td><input type="search" class="form-control form-control-sm form-underline" id="jml_obat' + no + '" name="jml[]" value="' + hitungJumlahObat(res.data_barang.kapasitas, res.p1, res.p2) + '" readonly/></td>'
                        html += '<td><button type="button" class="btn btn-danger btn-sm" style="font-size:12px" data-resep="' + res.no_resep + '" data-racik="' + res.no_racik + '" data-obat="' + res.kode_brng + '" data-no="' + no + '" onclick="hapusObat(this)"><i class="bi bi-trash-fill"></i></button></td>'
                        html += '</tr>'
                        no++
                    });
                    $('.table-racikan tbody').append(html);
                    $('.nomor').val(no)
                },
            })
        }

        function editObat(param) {
            kode_obat = $(param).data('barang');
            kps = $(param).data('kps');
            obat = $(param).data('obat');

            $('.simpan-obat').css('display', 'none');
            $('.ubah-obat').css('display', '');
            $('.obat-baru').css('display', '');

            $('.kandungan').val(0);
            $('.jml_obat').val(0);
            $('.kps').val(kps);
            $('.kode_obat').val(kode_obat);
            $('.nama_obat').val(obat);
            $('.p1').val(1);
            $('.p2').val(1);
        }

        $('.ubah-obat').on('click', function() {
            no_racik = $('.no_racik').val();
            no_resep = $('.no_resep').val();
            kode_brng = $('.kode_obat').val();
            p1 = $('.p1').val();
            p2 = $('.p2').val();
            kandungan = $('.kandungan').val();
            jml = $('.jml_obat').val();

            $.ajax({
                url: '/erm/resep/racik/detail/ubah',
                data: {
                    _token: '{{ csrf_token() }}',
                    kode_brng: kode_brng,
                    no_racik: no_racik,
                    no_resep: no_resep,
                    p1: p1,
                    p2: p2,
                    kandungan: kandungan,
                    jml: jml,
                },
                method: 'POST',
                success: function(response) {
                    ambilObatRacikan();
                },
                error: function(request, status, error) {
                    Swal.fire(
                        'Gagal !',
                        'Tidak bisa mengubah obat<br/>' + request.responseJSON.message,
                        'error',
                    )
                }
            }).done(function() {
                tulisPlan();
            })
        })




        $('.obat-baru').on('click', function() {
            $('.simpan-obat').css('display', '');
            $('.ubah-obat').css('display', 'none');
            $('.obat-baru').css('display', 'none');

            $('.kandungan').val('');
            $('.jml_obat').val('');
            $('.kps').val('');
            $('.kode_obat').val('');
            $('.nama_obat').val('');
            $('.p1').val('');
            $('.p2').val('');

            $('.nama_obat').focus();

        })

        function hapusObat(param) {

            no_resep = $(param).data('resep');
            no_racik = $(param).data('racik');
            kode_brng = $(param).data('obat');
            no = $(param).data('no');


            Swal.fire({
                title: 'Yakin ?',
                text: "Anda tidak bisa mengembalikan lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!',
                cancelButtonText: 'Jangan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/erm/resep/racik/detail/hapus',
                        method: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_resep: no_resep,
                            no_racik: no_racik,
                            kode_brng: kode_brng,
                        },
                        success: function() {
                            $('.obat-' + no).remove();
                            hitungBarisObat($('.table-racikan'))
                            cekResep(id);
                            riwayatResep($('#no_rm').val())
                        },
                        error: function(request, status, error) {
                            Swal.fire(
                                'Gagal !',
                                'Tidak menghapus obat<br/>' + request.responseJSON
                                .message,
                                'error',
                            )

                        }
                    }).done(function() {
                        tulisPlan();
                    })
                }
            })
        }

        function hitungBarisObat($table) {
            $table.find('tr').each(function(index, element) {
                $(element).attr('class', 'obat-' + index)
                $(element).find('td:eq(0) input').attr('id', 'kode_brng' + index)
                $(element).find('td:eq(1) input').attr('id', 'kps' + index)
                $(element).find('td:eq(2) input').attr('id', 'p1' + index)
                $(element).find('td:eq(2) input').attr('onchange', 'hitungObatRacik(' + index + ')')
                $(element).find('td:eq(4) input').attr('id', 'p2' + index)
                $(element).find('td:eq(4) input').attr('onchange', 'hitungObatRacik(' + index + ')')
                $(element).find('td:eq(5) input').attr('id', 'kandungan' + index)
                $(element).find('td:eq(5) input').attr('onchange', 'hitungDosis(' + index + ')')
                $(element).find('td:eq(7) input').attr('id', 'jml_obat' + index)
            });
            $('.nomor').val($table.find('tr').length);
        }

        $('tbody').on('click', '.edit', function() {
            let no_resep = $(this).attr('data-resep');
            let kode_brng = $(this).attr('data-obat');
            let no_racik = $(this).data('racik');
            // console.log('noracik', no_racik)
            $('#modalObatRacik').modal('show');
            ambilRacikan(no_resep, no_racik).done((racikan) => {
                $('.no_resep').val(racikan.no_resep);
                $('.metode').val(racikan.metode.nm_racik);
                $('.nm_racik').val(racikan.nama_racik);
                $('.no_racik').val(no_racik);
                $('.jml_dr').val(racikan.jml_dr);
                $('.aturan_pakai').val(racikan.aturan_pakai);
                ambilObatRacikan();
            })
        })

        $('#modalObatRacik').on('shown.bs.modal', function() {
            $('.kps').val('');
            $('.p1').val('');
            $('.p2').val('');
            $('.jml_obat').val('');
            $('.kandungan').val('');
            $('.kandungan').val('');
        });
        $('#modalObatRacik').on('hidden.bs.modal', function() {
            $('.no_racik').val('');
            $('.kps').val('');
            $('.p1').val('');
            $('.p2').val('');
            $('.jml_obat').val('');
            $('.nama_obat').val('');
            $('.kandungan').val('');
        });

        $('tbody').on('click', '.hapus-baris', function() {
            cekResep(id)
            return false;
        })


        function hapusResepUmum(no_resep, kode_brng) {
            let resepUmum = $.ajax({
                url: '/erm/resep/umum/hapus',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_resep: no_resep,
                    kode_brng: kode_brng,
                },
                method: 'DELETE',
            });

            return resepUmum;
        }

        function hapusNomorResep(no_resep) {
            ambilResep(no_resep).done(function(res) {
                resepDokter = Object.keys(res.resep_dokter).length
                resepRacik = Object.keys(res.resep_racikan).length
                if (resepDokter == 0 && resepRacik == 0) {
                    hapusResep(no_resep).done(function() {
                        Swal.fire({
                            title: 'Berhasil',
                            text: "Resep telah dihapus",
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 1500,
                        })
                    })
                }
            })
        }
        $('tbody').on('click', '.remove', function() {
            let no_resep = $(this).attr('data-resep');
            let kode_brng = $(this).attr('data-obat');
            let no_racik = $(this).attr('data-racik');
            Swal.fire({
                title: 'Yakin ?',
                text: "Anda tidak bisa mengembalikan lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!',
                cancelButtonText: 'Jangan',
            }).then((result) => {
                if (result.isConfirmed) {
                    if (no_racik) {
                        hapusResepRacikan(no_resep, no_racik).done(function(response) {
                            hapusNomorResep(no_resep)
                            tulisPlan();
                            $('#body_racik').empty();
                            $('#tb-resep-racikan tbody').empty();
                            cekResep($('#nomor_rawat').val());
                        })
                    } else {
                        hapusResepUmum(no_resep, kode_brng).done(function(response) {
                            hapusNomorResep(no_resep)
                            $('#body_umum').empty();
                            cekResep($('#nomor_rawat').val())
                            tulisPlan();
                        })
                    }
                    riwayatResep($('#no_rm').val());
                }
            })
            return false;
        })



        function cariDiagnosaSoap(diagnosa) {
            getDiagnosa(diagnosa.value).done(function(response) {
                if (response) {
                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                    no = 1;
                    $.map(response, function(data) {
                        html +=
                            '<li data-nama="' + data.nm_penyakit + '" data-id="' + data.kd_penyakit + '" onclick="tambahDiagnosa(this)"><a class="dropdown-item" href="#" style="overflow:hidden"> ' + data.kd_penyakit + ' - ' + data.nm_penyakit + '</a></li>'
                        no++;
                    })
                    html += '</ul>';
                    $('.list-diagnosa').fadeIn();
                    $('.list-diagnosa').html(html);
                }
            })
        }

        function cariProsedur(kode) {
            if (kode.value.length) {
                $.ajax({
                    url: '/erm/prosedur/cari',
                    data: {
                        'kode': kode.value,
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        if (response) {
                            html =
                                '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                            no = 1;
                            $.map(response, function(data) {
                                html +=
                                    '<li data-nama="' + data.deskripsi_pendek + '" data-id="' + data.kode + '" onclick="tambahProsedur(this)"><a class="dropdown-item" href="#" style="overflow:hidden"> ' + data.kode + ' - ' + data.deskripsi_pendek + '</a></li>'
                                no++;
                            })
                            html += '</ul>';
                            $('.list-prosedur').fadeIn();
                            $('.list-prosedur').html(html);
                        }
                    }
                })
            }
        }

        function tambahDiagnosa(param) {
            no_rawat = $('#nomor_rawat').val();
            kd_penyakit = $(param).data('id');
            prioritas = $('.no_diagnosa').val()

            $.ajax({
                url: '/erm/penyakit/pasien/tambah',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    kd_penyakit: kd_penyakit,
                    status: "Ralan",
                    prioritas: prioritas,
                },
                method: 'POST',
                success: function(response) {
                    ambilDiagnosaPasien(no_rawat)
                    $('#diagnosa').val('').focus();
                }
            })

        }

        function tambahProsedur(param) {
            no_rawat = $('#nomor_rawat').val();
            kode = $(param).data('id');
            prioritas = $('.no_prosedur').val()

            $.ajax({
                url: '/erm/prosedur/pasien/tambah',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    kode: kode,
                    status: "Ralan",
                    prioritas: prioritas,
                },
                method: 'POST',
                success: function(response) {
                    ambilProsedurPasien(no_rawat)
                    $('#prosedur').val('').focus();
                }
            })

        }

        function ambilDiagnosaPasien(no_rawat) {
            $.ajax({
                url: '/erm/penyakit/pasien/ambil',
                data: {
                    no_rawat: no_rawat,
                },
                success: function(response) {
                    nomor = 1;
                    $('.table-diagnosa tbody').empty();
                    if (Object.keys(response).length > 0) {
                        $.map(response, function(res) {
                            html = '<tr class="diagnosa_' + res.kd_penyakit + '">'
                            html += '<td>'
                            html += res.prioritas
                            html += '</td>'
                            html += '<td>'
                            html += res.kd_penyakit
                            html += '</td>'
                            html += '<td>'
                            html += res.penyakit.nm_penyakit
                            html += '</td>'
                            html += '<td>'
                            html += '<button type="button" class="btn btn-danger btn-sm" style="font-size:12px" onclick="hapusDiagnosaPasien(\'' + no_rawat + '\', \'' + res.kd_penyakit + '\')"><i class="bi bi-trash-fill"></i></button>'
                            html += '</td>'
                            html += '</tr>'
                            nomor = res.prioritas + 1;
                            $('.table-diagnosa tbody').append(html)
                        })
                    } else {
                        html = '<tr>'
                        html += '<td colspan="4" style="text-align:center">Tidak ada diagnosa</td>'
                        html += '</tr>'
                        $('.table-diagnosa tbody').append(html)

                    }
                    $('.no_diagnosa').val(nomor)
                }
            })
        }

        function ambilProsedurPasien(no_rawat) {
            $.ajax({
                url: '/erm/prosedur/pasien/ambil',
                data: {
                    no_rawat: no_rawat,
                },
                success: function(response) {
                    nomor = 1;
                    $('.table-prosedur tbody').empty();
                    if (Object.keys(response).length > 0) {
                        $.map(response, function(res) {
                            html = '<tr class="prosedur_' + res.kode + '">'
                            html += '<td>'
                            html += res.prioritas
                            html += '</td>'
                            html += '<td>'
                            html += res.kode
                            html += '</td>'
                            html += '<td>'
                            html += res.icd9.deskripsi_pendek
                            html += '</td>'
                            html += '<td>'
                            html += '<button type="button" class="btn btn-danger btn-sm" style="font-size:12px" onclick="hapusProsedurPasien(\'' + no_rawat + '\', \'' + res.kode + '\')"><i class="bi bi-trash-fill"></i></button>'
                            html += '</td>'
                            html += '</tr>'
                            nomor = res.prioritas + 1;
                            $('.table-prosedur tbody').append(html)
                        })
                    } else {
                        html = '<tr>'
                        html += '<td colspan="4" style="text-align:center">Tidak ada prosedur</td>'
                        html += '</tr>'
                        $('.table-prosedur tbody').append(html)

                    }
                    $('.no_prosedur').val(nomor)
                }
            })
        }

        function hapusProsedurPasien(no_rawat, kode) {
            no = $('.no_diagnosa').val();
            $.ajax({
                url: '/erm/prosedur/pasien/hapus',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    kode: kode,
                },
                method: 'DELETE',
                success: function(response) {

                    $('.no_prosedur').val(parseInt(no) - 1)
                    ambilProsedurPasien(no_rawat)
                }
            })
        }

        function hapusDiagnosaPasien(no_rawat, kd_penyakit) {
            // console.log(no_rawat)
            no = $('.no_diagnosa').val();
            $.ajax({
                url: '/erm/penyakit/pasien/hapus',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    kd_penyakit: kd_penyakit,
                },
                method: 'DELETE',
                success: function(response) {

                    $('.no_diagnosa').val(parseInt(no) - 1)
                    ambilDiagnosaPasien(no_rawat)
                }
            })
        }

        function cariRacikan(racik) {
            $.ajax({
                url: '/erm/resep/racik/cari',
                data: {
                    'nm_racik': racik.value,
                    'kd_dokter': "{{ Request::get('dokter') }}",
                },
                dataType: 'JSON',
                success: function(response) {
                    if (Object.keys(response).length > 0) {
                        html =
                            '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                        $.map(response, function(data) {
                            html +=
                                '<li onclick="setNamaRacik(this)" data-nama="' + data.nm_racik + '" data-id="' + data.id + '"><a class="dropdown-item" href="#" style="overflow:hidden">' + data.nm_racik + '</a></li>'
                        })
                        html += '</ul>';
                        $('.list_racik').fadeIn();
                        $('.list_racik').html(html);
                    }

                }
            })
        }

        $('.list_racik').on('click', 'li', function() {
            $('.list_racik').fadeOut();
        })

        function setNamaRacik(racik) {
            nama_racik = $(racik).data('nama');
            id_racik = $(racik).data('id');
            $('.nm_racik').val(nama_racik);
            $('.id_racik').val(id_racik);
        }

        function cariObat(obat) {
            $.ajax({
                url: '/erm/obat/cari',
                data: {
                    'nama': obat.value,
                },
                success: function(response) {
                    // console.log(response)
                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                    $.map(response.data, function(data) {
                        $.map(data.gudang_barang, function(item) {
                            if (data) {
                                if (data.status != "0") {
                                    if (item.stok >= "0") {
                                        html +=
                                            '<li data-id="' +
                                            data.kode_brng +
                                            '" data-stok="' + item.stok +
                                            '" data-kapasitas="' + data.kapasitas +
                                            '" data-nama="' + data.nama_brng + '" onclick="ambilObat(this)"><a class="dropdown-item" href="#" style="overflow:hidden">' +
                                            data.nama_brng + ' <span class="text-primary">- Rp. ' + toRupiah(data.ralan) + ' - <i><b>Stok (' + item.stok + ')</b></i></span></a></li>'
                                    } else {
                                        html +=
                                            '<li class="disable" data-id="' + data
                                            .kode_brng +
                                            '" data-stok="' + item.stok +
                                            '"><i><a class="dropdown-item" href="#" style="overflow:hidden;color:red">' +
                                            data.nama_brng + ' - Rp. ' + toRupiah(data.ralan) + ' - <b>Stok Kosong' +
                                            '</b></a></i></li>'
                                    }
                                }
                            }
                        })
                    })
                    html += '</ul>';
                    $('.list_obat').fadeIn();
                    $('.list_obat').html(html);



                }
            })
        }


        function cariAturan(aturan) {
            $.ajax({
                url: '/erm/resep/cari',
                data: {
                    'aturan_pakai': aturan.value,
                },
                success: function(response) {
                    if (response) {
                        html = '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                        $.map(response, function(data) {
                            html +=
                                '<li onclick="ambilAturan(this)" ><a class="dropdown-item" href="#" style="overflow:hidden">' +
                                data.aturan_pakai + '</a></li>'
                        })
                        html += '</ul>';
                        $('.list_aturan').fadeIn();
                        $('.list_aturan').html(html);
                    }
                }
            })
        }
        $('.list_obat').on('click', 'li', function() {
            if ($(this).data('stok') > 0) {
                $('.kode_obat').val($(this).data('id'));
                $('.nama_obat').val($(this).text());
                $('.kps').val($(this).data('kapasitas'));
                $('.p1').val(1);
                $('.p2').val(1);
                $('.list_obat').fadeOut();
                // $('#modalObat').modal('hide');
            } else {
                $('.nama_obat').val('');
            }
        });

        function ambilAturan(param) {
            $('.aturan_pakai').val($(param).text());
        }
        $('.list_aturan').on('click', 'li', function() {
            // console.log($(this).text())
            $('.list_aturan').fadeOut();
        });

        $(document).click(function() {
            $('.list_obat').fadeOut();
            $('.list_aturan').fadeOut();
            $('.list_racik').fadeOut();
            $('.list-diagnosa').fadeOut();
            $('.list-prosedur').fadeOut();
            $('.list-dokter').fadeOut();

        });

        function tambahUmum() {
            no_resep = $('.no_resep_umum').val();
            no_rawat = $('#nomor_rawat').val();
            cekResep(no_rawat).done(function(response) {
                resep = Object.keys(response).length
                if (resep == 0) {
                    simpanResepObat().done(function(res) {
                        $('.no_resep_umum ').val(res.no_resep)
                    });
                } else {
                    $.map(response, function(res) {
                        $('.no_resep_umum ').val(res.no_resep)
                    })
                }
            });

            html = '<tr>';
            html += '<td><input type="hidden" class="kode_obat_umum"/>';
            html +=
                '<input type="text" class="no_resep_umum form-control form-control-sm form-underline" readonly/>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="text" onkeyup="cariObat(this)" autocomplete="off" class="form-control form-control-sm nama_obat_umum form-underline" name="nama_obat_umum" /><div class="list_obat"></div>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="text" class="jml_umum form-control form-control-sm form-underline"/>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="text" onkeyup="cariAturan(this)" autocomplete="off" class="form-control form-control-sm aturan_pakai form-underline" name="aturan_pakai" /><div class="list_aturan"></div>';
            html += '</td>';
            html += '<td>';
            html +=
                '<div class="status"><button type="button" class="btn btn-primary btn-sm" onclick="simpanObat()" style="font-size:12px"><i class="bi bi-plus-circle"></i></button><button type="button" class="btn btn-danger btn-sm hapus-baris" style="font-size:12px"><i class="bi bi-trash"></i></button></div>';
            html += '</td>';
            html += '</tr>';
            $('#tb-resep tbody').append(html)
            riwayatResep($('#no_rm').val())

        }

        function ambilObat(param) {
            $('.nama_obat_umum').val($(param).data('nama'));
            $('.kode_obat_umum').val($(param).data('id'))
        }

        function tambahRacikan() {
            no_resep = $('.no_resep').val();
            no_rawat = $('#nomor_rawat').val();
            cekResep(no_rawat).done(function(response) {
                resep = Object.keys(response).length
                if (resep == 0) {
                    simpanResepObat().done(function(res) {
                        $('.no_resep_umum ').val(res.no_resep)
                    });
                } else {
                    $.map(response, function(res) {
                        $('.no_resep_umum ').val(res.no_resep)
                    })
                }
            });

            html = '<tr>';
            html += '<td>';
            html +=
                '<input type="text" class="no_racik form-control form-control-sm form-underline" readonly/>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="text" class="no_resep form-control form-control-sm form-underline" readonly/>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="search" autocomplete="off" onkeyup="cariRacikan(this)" class="form-control form-control-sm nm_racik form-underline" name="nm_racik"/><input type="hidden" class="id_racik" /><div class="list_racik"></div>';
            html += '</td>';

            html += '<td>';
            html +=
                '<select name=kd_racik" id="" class="form-select form-select-sm kd_racik form-underline" style="font-size:12px"> <option value="R01" selected>Puyer</option> <option value="R02">Sirup</option> <option value="R03">Salep</option> <option value="R04">Kapsul</option> </select>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="search" autocomplete="off" class="form-control form-control-sm jml_dr form-underline" name="jml_dr" onkeypress="return hanyaAngka(event)" />';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="search" onkeyup="cariAturan(this)" autocomplete="off" class="form-control form-control-sm aturan_pakai form-underline" name="aturan_pakai" /><div class="list_aturan"></div>';
            html += '</td>';
            html += '<td>';
            html +=
                '<div class="status"><button type="button" class="btn btn-primary btn-sm" onclick="simpanRacikan()" style="font-size:12px"><i class="bi bi-plus-circle"></i></button><button type="button" class="btn btn-danger btn-sm hapus-baris" style="font-size:12px"><i class="bi bi-trash"></i></button></div>';
            html += '</td>';
            html += '</tr>';
            $('#tb-resep-racikan tbody').append(html)

            no_racik = 0;
            $.ajax({
                url: '/erm/resep/racik/ambil',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    no_resep: $('.no_resep').val(),
                },
                success: function(response) {
                    if (response) {
                        $.map(response, function(data) {
                            no_racik = data.no_racik
                        })
                        no_racik = parseInt(no_racik) + 1;
                    } else {
                        no_racik = 1
                    }
                    // console.log(no_racik)
                    $('.no_racik').val(no_racik)
                    $('.no_resep').val(no_resep)
                }
            })
        }

        $('#modalResepRacikan').on('hidden.bs.modal', function() {
            $('.nm_racik').val('');
            $('.jml').val('');
            $('.aturan_pakai').val('');
            $('.keterangan').val('');
            $('.no_racik').val('');
        })

        $('#modalResepRacikan').on('shown.bs.modal', function() {
            cekResep(id);
            $('.no_resep').val(setNoResep())
        })

        function setNoResep() {
            let tanggal = "{{ date('Y-m-d') }}";
            let nomor = '';
            const resep = $.ajax({
                url: '/erm/resep/obat/akhir',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    'tgl_peresepan': tanggal,
                    'tgl_perawatan': tanggal,
                },
            })
            return resep;

        }

        $('#modalSoap').on('shown.bs.modal', function() {
            $('.tambah_umum').css('visibility', 'visible')
            let kd_dokter = "{{ Request::get('dokter') }}"

            modalsoap(id);
            cekResep(id);
            ambilDiagnosaPasien(id);
            ambilProsedurPasien(id);
            getRegPeriksa(id).done((regPeriksa) => {
                var form = '';
                if (regPeriksa.dokter.kd_sps == 'S0003') {
                    $('#li-asmed-ana').css('display', 'inline');
                    $('#li-asmed-ranap-ana').css('display', 'inline');
                    $('#li-data-anak').css('display', 'inline');
                    $('#li-asmed-obg').css('display', 'none');
                    $('#li-asmed-ranap-obg').css('display', 'none');
                    $('#li-data-obg').css('display', 'none');
                    $('.btn-asmed-ranap').attr('onclick', 'simpanAsmedRanapAnak()')
                    $('.btn-asmed').attr('onclick', 'simpanAsmedRajalAnak()')
                    form = '.form-asmed-anak';
                    setAsmedAnak(id);
                    setAsmedRanapAnak(id)

                } else if (regPeriksa.dokter.kd_sps == 'S0001') {
                    $('#li-asmed-ana').css('display', 'none');
                    $('#li-asmed-ranap-ana').css('display', 'none');
                    $('#li-data-anak').css('display', 'none');
                    $('#li-asmed-obg').css('display', 'inline');
                    $('#li-asmed-ranap-obg').css('display', 'inline');
                    $('#li-data-obg').css('display', 'inline');
                    $('.btn-asmed-ranap').attr('onclick', 'simpanAsmedRanapKandungan()')
                    $('.btn-asmed').attr('onclick', 'simpanAsmedRajalKandungan()')
                    form = '.form-asmed-kandungan';

                    setAsmedRajalKandungan(id);
                    setAsmedRanapKandungan(id)
                }
                $(`${form} input[name="no_rawat"]`).val(regPeriksa.no_rawat)
                $(`${form} input[name="pasien"]`).val(`${regPeriksa.pasien.nm_pasien} (${regPeriksa.pasien.jk})`)
                $(`${form} input[name="tgl_lahir"]`).val(`${formatTanggal(regPeriksa.pasien.tgl_lahir)} (${hitungUmur(regPeriksa.pasien.tgl_lahir)})`)
                $(`${form} input[name="kd_dokter"]`).val(regPeriksa.kd_dokter)
                $(`${form} input[name="nm_dokter"]`).val(regPeriksa.dokter.nm_dokter)
                $(`${form} input[name="nm_dokter"]`).attr('readonly', 'readonly')

            })
            no = 1;
            isModalShow = true;
        });

        function setSoapToAsmed(no_rawat, form) {
            return getPemeriksaanPoli(no_rawat).done((response) => {
                if (Object.keys(response).length != 0) {
                    $(`${form} select[name="kesadaran"]`).val(response.kesadaran).change();
                    $(`${form} input[name="gcs"]`).val(response.gcs);
                    $(`${form} input[name="tb"]`).val(response.tinggi);
                    $(`${form} input[name="bb"]`).val(response.berat);
                    $(`${form} input[name="td"]`).val(response.tensi);
                    $(`${form} input[name="nadi"]`).val(response.nadi);
                    $(`${form} input[name="rr"]`).val(response.respirasi);
                    $(`${form} input[name="suhu"]`).val(response.suhu_tubuh);
                    $(`${form} input[name="spo"]`).val(response.spo2);
                    $(`${form} textarea[name="rps"]`).val(response.keluhan);
                    $(`${form} textarea[name="ket_fisik"]`).val(response.pemeriksaan);
                    $(`${form} textarea[name="diagnosis"]`).val(response.penilaian);
                    $(`${form} textarea[name="konsul"]`).val(response.instruksi);
                    $(`${form} textarea[name="tata"]`).val(response.rtl);

                }
            })
        }

        function setAsmedRajalKandungan(no_rawat) {
            getAsmedRajalKandungan(no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRajalKandungan select[name=${index}]`);
                        input = $(`#formAsmedRajalKandungan input[name=${index}]`);
                        textarea = $(`#formAsmedRajalKandungan textarea[name=${index}]`);

                        if (select.length) {
                            $(`#formAsmedRajalKandungan select[name=${index}]`).val(value)
                        } else if (input.length) {
                            $(`#formAsmedRajalKandungan input[name=${index}]`).val(value)
                        } else {
                            $(`#formAsmedRajalKandungan textarea[name=${index}]`).val(value)
                        }
                    })
                } else {
                    setSoapToAsmed(no_rawat, '#formAsmedRajalKandungan');
                }
            })
        }

        function setAsmedAnak(no_rawat) {
            getAsmedAnak(no_rawat).done((response) => {
                $('.form-asmed-anak button[name="simpan"]').css('display', 'inline')
                $('.form-asmed-anak button[name="edit"]').css('display', 'none')
                if (Object.keys(response).length != 0) {
                    $('.form-asmed-anak button[name="simpan"]').css('display', 'none')
                    $('.form-asmed-anak button[name="edit"]').css('display', 'inline')
                    $('.form-asmed-anak select[name="anamnesis"]').val(response.anamnesis).change()
                    $('.form-asmed-anak input[name="hubungan"]').val(response.hubungan)
                    $('.form-asmed-anak textarea[name="keluhan_utama"]').val(response.keluhan_utama)
                    $('.form-asmed-anak textarea[name="rps"]').val(response.rps)
                    $('.form-asmed-anak textarea[name="rpk"]').val(response.rpk)
                    $('.form-asmed-anak textarea[name="rpd"]').val(response.rpd)
                    $('.form-asmed-anak textarea[name="rpo"]').val(response.rpo)
                    $('.form-asmed-anak input[name="alergi"]').val(response.alergi)
                    $('.form-asmed-anak select[name="keadaan"]').val(response.keadaan).change()
                    $('.form-asmed-anak select[name="kesadaran"]').val(response.kesadaran).change()
                    $('.form-asmed-anak input[name="gcs"]').val(response.gcs)
                    $('.form-asmed-anak input[name="tb"]').val(response.tb)
                    $('.form-asmed-anak input[name="bb"]').val(response.bb)
                    $('.form-asmed-anak input[name="td"]').val(response.td)
                    $('.form-asmed-anak input[name="nadi"]').val(response.nadi)
                    $('.form-asmed-anak input[name="rr"]').val(response.rr)
                    $('.form-asmed-anak input[name="suhu"]').val(response.suhu)
                    $('.form-asmed-anak input[name="spo"]').val(response.spo)
                    $('.form-asmed-anak select[name="kepala"]').val(response.kepala).change()
                    $('.form-asmed-anak select[name="mata"]').val(response.mata).change()
                    $('.form-asmed-anak select[name="genital"]').val(response.genital).change()
                    $('.form-asmed-anak select[name="gigi"]').val(response.gigi).change()
                    $('.form-asmed-anak select[name="ekstremitas"]').val(response.ekstremitas).change()
                    $('.form-asmed-anak select[name="tht"]').val(response.tht).change()
                    $('.form-asmed-anak select[name="kulit"]').val(response.kulit).change()
                    $('.form-asmed-anak select[name="thoraks"]').val(response.thoraks).change()
                    $('.form-asmed-anak select[name="kontraksi"]').val(response.kontraksi).change()
                    $('.form-asmed-anak textarea[name="ket_fisik"]').val(response.ket_fisik)
                    $('.form-asmed-anak input[name="tfu"]').val(response.tfu)
                    $('.form-asmed-anak input[name="tbj"]').val(response.tbj)
                    $('.form-asmed-anak input[name="his"]').val(response.his)
                    $('.form-asmed-anak input[name="djj"]').val(response.djj)
                    $('.form-asmed-anak input[name="inspeksi"]').val(response.inspeksi)
                    $('.form-asmed-anak input[name="vt"]').val(response.vt)
                    $('.form-asmed-anak input[name="inspekulo"]').val(response.inspekulo)
                    $('.form-asmed-anak input[name="rt"]').val(response.rt)
                    $('.form-asmed-anak textarea[name="ultra"]').val(response.ultra)
                    $('.form-asmed-anak textarea[name="kardio"]').val(response.kardio)
                    $('.form-asmed-anak textarea[name="lab"]').val(response.lab)
                    $('.form-asmed-anak textarea[name="diagnosis"]').val(response.diagnosis)
                    $('.form-asmed-anak textarea[name="tata"]').val(response.tata)
                    $('.form-asmed-anak textarea[name="konsul"]').val(response.konsul)

                }
            })
        }


        function setAsmedRanapAnak(no_rawat) {
            getAsmedRanapAnak(no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRanapAnak select[name=${index}]`);
                        input = $(`#formAsmedRanapAnak input[name=${index}]`);
                        textarea = $(`#formAsmedRanapAnak textarea[name=${index}]`);

                        if (select.length) {
                            $(`#formAsmedRanapAnak select[name=${index}]`).val(value)
                        } else if (input.length) {
                            $(`#formAsmedRanapAnak input[name=${index}]`).val(value)
                        } else {
                            $(`#formAsmedRanapAnak textarea[name=${index}]`).val(value)
                        }
                    })
                } else {
                    setSoapToAsmed(no_rawat, '#formAsmedRanapAnak');
                }
            })
        }

        function setAsmedRanapKandungan(no_rawat) {
            getAsmedRanapKandungan(no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRanapKandungan select[name=${index}]`);
                        input = $(`#formAsmedRanapKandungan input[name=${index}]`);
                        textarea = $(`#formAsmedRanapKandungan textarea[name=${index}]`);

                        if (select.length) {
                            $(`#formAsmedRanapKandungan select[name=${index}]`).val(value)
                        } else if (input.length) {
                            $(`#formAsmedRanapKandungan input[name=${index}]`).val(value)
                        } else {
                            $(`#formAsmedRanapKandungan textarea[name=${index}]`).val(value)
                        }
                    })
                } else {
                    setSoapToAsmed(no_rawat, '#formAsmedRanapKandungan');
                }
            })
        }

        function hapusResep(no_resep) {
            let resep = $.ajax({
                url: '/erm/resep/obat/hapus/' + no_resep,
                data: {
                    _token: "{{ csrf_token() }}",
                },
                method: 'DELETE',
            })

            riwayatResep($('#no_rm').val())
            return resep;
        }

        function ubahObatDokter(no_resep, kode_brng, no) {
            $.ajax({
                url: '/erm/resep/umum/ubah',
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_resep: no_resep,
                    kode_brng: kode_brng,
                    jml: $('.u_jml_' + no).val(),
                    aturan_pakai: $('.u_aturan_' + no).val(),
                },
                success: function(response) {
                    // alert(response);
                    cekResep(id)
                    tulisPlan()
                }
            })
        }

        $('tbody').on('click', '.ubah-obat', function() {
            no = $(this).data('id')
            jml = $('.jml_' + no).text();
            aturan_pakai = $('.aturan_pakai_' + no).text();
            $('.simpan-obat-' + no).css('visibility', 'visible');
            $('.simpan-obat-' + no).css('font-size', '12px');
            $('.ubah-obat').css('display', 'none');
            $('.jml_' + no).empty()
            $('.aturan_pakai_' + no).empty()
            $('.jml_' + no).append('<input type="text" class="form-control form-control-sm form-underline u_jml_' + no + '" value="' + jml + '" />')
            $('.aturan_pakai_' + no).append('<input type="text" onkeyup="cariAturan(this)" autocomplete="off" class="form-control form-control-sm aturan_pakai form-underline u_aturan_' + no + '" value="' + aturan_pakai + '" /><div class="list_aturan"></div>')

        })

        function cekResep(no_rawat) {
            $('#body_umum').empty();
            $('#body_racikan').empty();
            $('#body_riwayat').empty();
            $('.tambah_racik').css('visibility', 'visible')
            $('.tambah_umum').css('visibility', 'visible')
            let resep = $.ajax({
                url: '/erm/resep/obat/ambil',
                data: {
                    no_rawat: no_rawat,
                },
                success: function(response) {

                    if (Object.keys(response).length > 0) {
                        $.map(response, function(res) {
                            if (Object.keys(res.resep_dokter).length > 0) {
                                no = 1;
                                $.map(res.resep_dokter, function(resep) {
                                    html = '<tr class="obat_' + no + '">';
                                    html += '<td>' + resep.no_resep + '</td>'
                                    html += '<td>' + resep.data_barang.nama_brng +
                                        '</td>'
                                    html += '<td class="jml_' + no + '">' + resep.jml + '</td>'
                                    html += '<td class="aturan_pakai_' + no + '">' + resep.aturan_pakai + '</td>'
                                    if (res.tgl_perawatan != "0000-00-00") {
                                        $('.tambah_racik').css('visibility', 'hidden')
                                        $('.tambah_umum').css('visibility', 'hidden')
                                        html += '<td class="aksi"><button type="button" class="btn btn-success btn-sm" style="font-size:12px"><i class="bi bi-check"></i></button></td>';
                                    } else {
                                        $('.tambah_racik').css('visibility', 'visible')
                                        $('.tambah_umum').css('visibility', 'visible')
                                        html += '<td class="aksi"><button type="button" class="btn btn-danger btn-sm remove" style="font-size:12px" data-resep="' + resep.no_resep + '" data-obat="' + resep.kode_brng + '"><i class="bi bi-trash-fill"></i></button><button style="font-size:12px" type="button" class="btn btn-warning btn-sm ubah-obat" data-id="' + no +
                                            '"><i class="bi bi-pencil"></i></button><button type="button" class="btn btn-primary simpan-obat-' + no +
                                            ' btn-sm" style="font-size:12;visibility:hidden" onclick="ubahObatDokter(' + resep.no_resep + ', \'' + resep.kode_brng + '\', ' + no + ')"><i class="bi bi-plus-circle"></i></button></td>';
                                    }
                                    html += '</tr>';
                                    $('#body_umum').append(html);
                                    no++;
                                })
                            }


                            if (Object.keys(res.resep_racikan).length > 0) {

                                $.map(res.resep_racikan, function(resep) {

                                    html = '<tr class="racikan_' + resep.no_racik + '">';
                                    html += '<td>' + resep.no_racik + '</td>'
                                    html += '<td>' + resep.no_resep + '</td>'
                                    html += '<td>' + resep.nama_racik + '</td>'
                                    html += '<td>' + resep.metode.nm_racik + '</td>'
                                    html += '<td class="jml_dr_' + no + '">' + resep.jml_dr + '</td>'
                                    html += '<td class="aturan_pakai_dr_' + no + '">' + resep.aturan_pakai + '</td>'
                                    html +=
                                        '<td class="' + resep.no_resep + resep
                                        .no_racik +
                                        '"></td>';
                                    html += '</tr>';
                                    $('#body_racikan').append(html);
                                    if (Object.keys(resep.detail_racikan).length >
                                        0) {
                                        d = '<tr><td></td><td colspan="6">'
                                        $.map(resep.detail_racikan, function(
                                            detail) {
                                            if (resep.no_racik == detail
                                                .no_racik) {

                                                d += '<span class="badge rounded-pill text-bg-success"><i>' +
                                                    detail.databarang
                                                    .nama_brng + ' (' +
                                                    detail.kandungan +
                                                    ' mg)' +
                                                    '<i></span>';
                                            }
                                        })
                                        d += '</td></tr>'
                                        $('#body_racikan').append(d);
                                    }
                                    if (res.tgl_perawatan != "0000-00-00") {
                                        $('.tambah_racik').css('visibility', 'hidden')
                                        $('.tambah_umum').css('visibility', 'hidden')

                                        const btnLihatDetail = `<button type="button" class="btn btn-success btn-sm" style="font-size:12px" onclick="showDetailRacikan('${resep.no_resep}', '${resep.no_racik}')">
                                                    <i class="bi bi-check"></i>
                                            </button>`

                                        $('.' + resep.no_resep + resep.no_racik).html(btnLihatDetail)
                                    } else {
                                        $('.tambah_racik').css('visibility',
                                            'visible')
                                        $('.tambah_umum').css('visibility',
                                            'visible')
                                        $('.' + resep.no_resep + resep.no_racik)
                                            .html(
                                                '<button type="button" class="btn btn-danger btn-sm remove rm-dr-' + no + '" style="font-size:12px" data-resep="' +
                                                resep.no_resep + '" data-racik="' +
                                                resep.no_racik +
                                                '"><i class="bi bi-trash-fill"></i></button><button type="button" class="btn btn-warning btn-sm edit" style="font-size:12px" data-resep="' +
                                                resep.no_resep + '" data-racik="' +
                                                resep.no_racik +
                                                '"><i class="bi bi-pencil"></i>'
                                            )
                                    }
                                    no++;
                                })

                            }

                            $('.no_resep').val(res.no_resep)
                        })
                    } else {

                        setNoResep().done((response) => {
                            if (Object.keys(response).length > 0) {
                                if (response.tgl_perawatan == '0000-00-00' && response.no_rawat == $('#nomor_rawat').val()) {
                                    nomor = response.no_resep;
                                } else {
                                    nomor = parseInt(response.no_resep) + 1
                                }
                            } else {
                                nomor = "{{ date('Ymd') }}" + '0001';
                            }
                            $('.no_resep').val(nomor)
                        })
                    }

                },
                error: function(request, status, error) {
                    Swal.fire(
                        'Gagal !',
                        'Ada kesalahan pemuatan obat',
                        'error'
                    );
                }
            })

            return resep;
        }

        $('#modalSoap').on('hidden.bs.modal', function() {
            $('#tb-resep tbody').empty();
            $('#tb-resep-racikan tbody').empty();
            isModalShow = false;
            $('#nomor_rawat').val('-');
            $('#p_jawab').val('-');
            $('#no_rm').val('-');
            $('#nama_pasien').val('-');
            $('#nama').val('-');
            $('#nik').val('-');
            $('#jabatan').val('-');
            $('#nomor_rawat').val('-');
            $('#tgl_perawatan').val('-');
            $('#subjek').val('-');
            $('#objek').val('-');
            $('#asesmen').val('-');
            $('#plan').val('-');
            $('#instruksi').val('-');
            $('#suhu').val('-');
            $('#tensi').val('-');
            $('#tinggi').val('-');
            $('#berat').val('-');
            $('#gcs').val('-');
            $('#respirasi').val('-');
            $('#alergi').val('-')
            $('#nadi').val('-');
            $('#spo2').val('-');
            $('#body_umum').empty();
            $('#body_racikan').empty();
            $('#body_riwayat').empty();
            $('#ket_pasien').val('');
            $('button[data-bs-target="#tab-soap-pane"]').tab('show')

        });

        function catatanPasien() {
            $('#modalCatatan').modal('show')
        }

        function getAsmedRajalKandungan(noRawat) {
            const id = textRawat(noRawat, '-')
            const asmed = $.ajax({
                url: '/erm/poliklinik/asmed/kandungan/get/' + id,
                metho: `GET`,
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return asmed;
        }

        function getAsmedAnak(noRawat) {
            const id = textRawat(noRawat, '-')
            const asmed = $.ajax({
                url: '/erm/poliklinik/asmed/anak/get/' + id,
                metho: `GET`,
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return asmed;
        }
    </script>
@endpush
