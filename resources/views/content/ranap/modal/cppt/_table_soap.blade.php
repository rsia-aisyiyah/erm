<div class="row">
    <div class="col-md-12 col-lg-3 col-sm-12">
        <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control form-control-sm tanggal tglSoap1_soap" value="{{ date('d-m-Y') }}">
            <span class="input-group-text" style="font-size:12px"><i class="bi bi-calendar3"></i></span>
            <input type="text" class="form-control form-control-sm tanggal tglSoap2_soap" value="{{ date('d-m-Y') }}">
        </div>
    </div>
    <div class="col-md-12 col-lg-3 col-sm-12">
        <select name="petugasCppt" id="petugasCppt" class="form-select form-select-sm mb-3" style="font-size: 12px">
            <option value="" disabled selected>Pilih Petugas Medis</option>
            <option value="">Semua</option>
            <option value="1">Dokter</option>
            <option value="2">Petugas Medis Lain</option>
        </select>
    </div>
    <div class="col-md-12 col-lg-3 col-sm-12">
        <button type="button" class="btn btn-success btn-sm mb-3" id="cariCppt"
                onclick="cariSoap()">
            <i class="bi bi-search"> Cari Soap</i>
        </button>
    </div>


</div>
<table class="table table-bordered table-striped table-sm" id="tbSoap" width="100%">
    <thead>
    <tr>
        <td>Aksi</td>
        <td>TTV & Fisik</td>
        <td>CPPT</td>
    </tr>
    </thead>
    <tbody>

    </tbody>
</table>



@push('script')
    <script>
        const modalLogTracker = $('#modalLogTracker')
        $('.tglSoap1_soap').datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            autoclose: true,
        })

        $('.tglSoap2_soap').datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            autoclose: true,
        })


        function ambilSoap(no_rawat, tgl, jam) {
            getDetailPemeriksaanRanap(no_rawat, tgl, jam).done((response) => {
                formSoapRanap.find('#cekJam').prop('checked', true)
                checkJam()
                formSoapRanap.find('input[name=tgl_perawatan_ubah]').val(splitTanggal(response.tgl_perawatan));
                formSoapRanap.find('input[name=jam_rawat_ubah]').val(response.jam_rawat);
                formSoapRanap.find('input[name=tgl_perawatan]').val(response.tgl_perawatan);
                formSoapRanap.find('input[name=jam_rawat]').val(response.jam_rawat);
                $('#suhu').val(response.suhu_tubuh);
                $('#tinggi').val(response.tinggi);
                $('#berat').val(response.berat);
                $('#tensi').val(response.tensi);
                $('#respirasi').val(response.respirasi);
                $('#nadi').val(response.nadi);
                $('#spo2').val(response.spo2);
                $('#gcs').val(response.gcs);

                $.map(response.grafik_harian, function (grafik) {
                    if (response.tgl_perawatan == grafik.tgl_perawatan && response.jam_rawat == grafik.jam_rawat) {
                        $('#o2').val(grafik.o2);
                    }
                })

                $('#kesadaran select').val(response.kesadaran);
                $('#alergi').val(response.alergi);
                $('#asesmen').val(response.penilaian);
                $('#plan').val(response.rtl);
                $('#instruksi').val(response.instruksi);
                $('#evaluasi').val(response.evaluasi);
                $('#subjek').val(response.keluhan);
                $('#objek').val(response.pemeriksaan);
                $('#reset_soap').append('')

                $('#btn-reset').css('display', 'inline');
                if (response.petugas.nip == "{{ session()->get('pegawai')->nik }}" || response.reg_periksa.kd_dokter == "{{ session()->get('pegawai')->nik }}" || "{{ session()->get('pegawai')->departemen }}" == "CSM" || "{{ session()->get('pegawai')->nik }}" == "direksi") {
                    $('#btn-ubah').css('display', 'inline');
                } else {
                    $('#btn-ubah').css('display', 'none');
                    $('.btn-simpan').css('display', 'inline');
                }
                if (response.petugas.dokter) {
                    if (response.petugas.dokter.kd_sps == 'S0007') {
                        $('#btn-ubah').css('display', 'inline');
                    }
                }
                bootstrap.Tab.getInstance(tabSoapRanap).show()
            })
        }

        function tbSoapRanap(no_rawat = '', tglSoap1 = '', tglSoap2 = '', petugas = '') {
            no_rawat_soap = no_rawat;
            var tbSoapRanap = $('#tbSoap').dataTable({
                processing: true,
                paging: false,
                info: false,
                destroy: true,
                autoWidth: false,
                saveState: true,
                ordering: false,
                ajax: {
                    url: "soap",
                    data: {
                        'no_rawat': no_rawat,
                        'tgl_pertama': tglSoap1,
                        'tgl_kedua': tglSoap2,
                        'petugas': petugas,
                    },
                    error: (request) => {
                        if (request.status === 401) {
                            Swal.fire({
                                title: 'Sesi login berakhir !',
                                icon: 'info',
                                text: 'Silahkan login kembali ',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/erm';
                                }
                            })
                        }
                    },
                },
                columns: [{
                    data: null,
                    render: function (data, type, row, meta) {
                        if (row.sbar) {
                            return renderBtnActionSbar(row.sbar)
                        }
                        button = '<span class="d-none">' + row.tgl_perawatan + ' ' + row.jam_rawat + '</span><button type="button" class="btn btn-primary btn-sm me-1" onclick="ambilSoap(\'' + row.no_rawat + '\',\'' + row.tgl_perawatan + '\', \'' + row.jam_rawat + '\')"><i class="bi bi-pencil-square"></i></button>';
                        if (row.nip === "{{ session()->get('pegawai')->nik }}" || "{{ session()->get('pegawai')->nik }}" === "direksi") {
                            button += '<button type="button" class="btn btn-danger btn-sm" onclick="hapusSoap(\'' + row.no_rawat + '\',\'' + row.tgl_perawatan + '\', \'' + row.jam_rawat + '\')"><i class="bi bi-trash3-fill"></i></button>';
                        }
                        return button;
                    },
                    name: 'tgl_perawatan',
                    width: '5%'
                },
                    {
                        data: null,
                        render: function (data, type, row, meta) {

                            if (row.sbar) {
                                return renderVerifikasiSbar(row.sbar)
                            }


                            list = '<li><strong>' + formatTanggal(row.tgl_perawatan) + ' ' + row.jam_rawat +
                                '</strong></li>';
                            list += '<li> Kesadaran : ' + row.kesadaran + '</li>';
                            $.map(row.grafik_harian, function (grafik) {
                                if (row.tgl_perawatan === grafik.tgl_perawatan && row.jam_rawat === grafik.jam_rawat) {
                                    list += '<li> O2 : ' + grafik.o2 + '</li>';
                                }
                            })
                            list += '<li> GCS : ' + row.gcs + '</li>';
                            list += '<li> Tensi : ' + row.tensi + ' mmHg</li>';
                            list += '<li> Nadi : ' + row.nadi + ' /mnt</li>';
                            list += '<li> SpO2 : ' + row.spo2 + ' %</li>';
                            list += '<li> Respirasi : ' + row.respirasi + ' /mnt</li>';
                            list += '<li> Suhu Tubuh : ' + row.suhu_tubuh + '  (<sup>o</sup>C)</li>';
                            list += '<li> Tinggi : ' + row.tinggi + ' Cm</li>';
                            list += '<li> Berat : ' + row.berat + ' Kg</li>';
                            list += '<li> alergi : ' + row.alergi + '</li>';
                            html = '<ul>' + list + '</ul>';

                            row.log.filter((item) => item.tgl_perawatan === row.tgl_perawatan && item.jam_rawat === row.jam_rawat).map((item) => {
                                html += `<div class="alert alert-info" role="alert" style="padding:5px;font-size:10px"><i>Di${item.aksi.toLowerCase()} oleh : <b>${item.pegawai.nama}
                                            , ${formatTanggal(item.waktu)}
                                                </i></div>`
                            })

                            // html+=`<a href="javascript:void(0)" onclick="getTrackerLog('pemeriksaan_ranap','${row.no_rawat}')">Lihat log</a>`

                            return html;


                        },
                        name: 'ttv',
                        width: '20%'
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {

                            if (row.sbar) {
                                return renderSbar(row)
                            }

                            baris = `<tr>
                                <th width="5%">Petugas</th>
                                <td width="5%">:</td>
                                <td>${row.petugas.nama} </td>
                                </tr>`
                            baris += '<tr><th>Subjek </th><td>:</td><td>' + stringPemeriksaan(row.keluhan) + '</td></tr>'
                            baris += '<tr><th>Objek </th><td>:</td><td>' + stringPemeriksaan(row.pemeriksaan) + '</td></tr>'
                            baris += '<tr><th>Assesment</th><td>:</td><td>' + stringPemeriksaan(row.penilaian) + '</td></tr>'
                            baris += '<tr><th>Plan</th><td>:</td><td>' + stringPemeriksaan(row.rtl) + '</td></tr>'
                            html = '<table class="table table-striped">' + baris + '</table>'
                            return html;
                        },
                        name: 'soap',
                    },
                ],
                "language": {
                    "zeroRecords": "Tidak ada data  data pemeriksaan",
                    "infoEmpty": "Tidak ada data data pemeriksaan",
                    "search": "Pencarian",
                },
            });
        }


        function getTrackerLog(...args) {
            console.log(args)

            $.ajax({
                url: '/erm/log/track',        // ganti dengan route kamu
                method: 'GET',
                data: {
                    keywords: args  // otomatis jadi keywords[]=...
                },
                success: function(res) {
                    console.log("RESULT:", res);
                    modalLogTracker.modal('show')
                },
                error: function(err) {
                    console.error("ERROR:", err);
                }
            });
        }

        function hapusSoap(no, tgl, jam) {
            Swal.fire({
                title: 'Yakin ?',
                text: "Data yang dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus saja!',

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'soap/hapus',
                        data: {
                            'no_rawat': no,
                            'tgl_perawatan': tgl,
                            'jam_rawat': jam,
                        },
                        method: 'DELETE',
                        success: function (response) {
                            if (response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'BERHASIL !',
                                    text: 'Data Berhasil dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                tbSoapRanap(no, tglSoap1, tglSoap2);
                                grafikPemeriksaan.destroy();
                                buildGrafik(no)
                                setEws(no, 'ranap', formSoapRanap.find('input[name=spesialis]').val())
                            }
                        }
                    })

                }
            })

        }

        function cariSoap() {
            const tglSoap1 = splitTanggal($('.tglSoap1_soap').val());
            const tglSoap2 = splitTanggal($('.tglSoap2_soap').val());
            const petugas = $('#petugasCppt').val();
            tbSoapRanap(no_rawat_soap, tglSoap1, tglSoap2, petugas);
        }

        function verifikasiSoap(no_rawat, tgl, jam) {
            swal.fire({
                title: 'Konfirmasi',
                text: "Hasil pemeriksaan akan diverifikasi ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Verifikasi',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/erm/soap/verifikasi',
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_rawat: no_rawat,
                            tgl_perawatan: tgl,
                            jam_rawat: jam,
                        },
                        method: 'POST',
                        dataType: 'JSON',
                    }).done(() => {
                        swal.fire({
                            title: 'Berhasil',
                            text: 'Hasil pemeriksaan telah diverivikasi',
                            icon: 'success',
                            timer: 1500,
                        });
                        tbSoapRanap(no_rawat);
                    })
                }
            });
        }

        function renderVerifikasiSbar(data) {
            const kdDokter = "{{ session()->get('pegawai')->nik }}";
            const isDokterKonsul = data.dokter_konsul ? data.dokter_konsul.dokter : formInfoPasien.find('input[name=kd_dokter_dpjp]').val();
            let btn = '';
            let isVerified = '';
            let qrDiv = '';

            if (data.verifikasi) {
                const qrData = `Telah diverifikasi oleh ${data.verifikasi.dokter.nm_dokter} pada ${formatTanggal(data.verifikasi.tgl_verif)} ${data.verifikasi.jam_verif}`;
                const qrId = `qr-${data.no_rawat}-${data.tgl_perawatan}-${data.jam_rawat}`;

                isVerified = `<div class="alert alert-success p-2 mt-2" role="alert" style="font-size:10px">
                        <strong><i class="bi bi-circle-check"></i></strong>
                        Telah diverifikasi oleh <br/> <strong>${data.verifikasi.dokter.nm_dokter}</strong> pada <strong>${formatTanggal(data.verifikasi.tgl_verif)} ${data.verifikasi.jam_verif}</strong>
                    </div>`;

                qrDiv = `<div id="${qrId}" class="mt-2"></div>`;

                setTimeout(() => {
                    const qrElement = document.getElementById(qrId);
                    if (qrElement) {
                        qrElement.innerHTML = '';
                        new QRCode(qrElement, {
                            text: qrData,
                            width: 100,
                            height: 100
                        });
                    }
                }, 500);


            } else {
                if (kdDokter === isDokterKonsul) {
                    btn = `<button class="btn btn-sm btn-warning w-100" onclick="verifikasiSoap('${data.no_rawat}', '${data.tgl_perawatan}', '${data.jam_rawat}')">
                    <i class="bi bi-pencil"></i> Verifikasi SBAR
                </button>`;
                }
                isVerified = `<div class="alert alert-warning p-2 mt-2" role="alert">
                        <strong><i class="bi bi-exclamation-triangle"></i></strong> Belum diverifikasi oleh Dokter
                    </div>`;
            }


            return `<ul>
                <li><strong>${formatTanggal(data.tgl_perawatan)} ${data.jam_rawat}</strong></li>
                <li>Konsul Ke : <strong>${data.dokter_konsul ? data.dokter_konsul.dokter_sbar.nm_dokter : formInfoPasien.find('input[name=dokter_dpjp]').val()}</strong></li>
            </ul> 
            ${btn}
            ${isVerified}
            ${qrDiv}`;
        }


        function renderBarcodeSbar(data) {
            setTimeout(() => {
                JsBarcode(`.barcode[data-id="${data.no_rawat}"][data-tgl="${data.tgl_perawatan}"][data-jam="${data.jam_rawat}"]`, 'wkwkwkw', {
                    displayValue: false
                });
            }, 1000)
            return '';
        }

        function renderSbar(data) {
            return `<table class="table table-striped">
        <tr>
            <th width="5%">Petugas</th>
            <th width="5%">:</th>
            <td>${stringPemeriksaan(data.sbar.pegawai.nama)}</td>
        </tr>
        <tr>
            <th width="5%">Situation</th>
            <th width="5%">:</th>
            <td>${stringPemeriksaan(data.keluhan)}</td>
        </tr>
        <tr>
            <th width="5%">Background</th>
            <th width="5%">:</th>
            <td>${stringPemeriksaan(data.pemeriksaan)}</td>
        </tr>
        <tr>
            <th width="5%">Assesment</th>
            <th width="5%">:</th>
            <td>${stringPemeriksaan(data.penilaian)}</td>
        </tr>
        <tr>
            <th width="5%">Recomendation</th>
            <th width="5%">:</th>
            <td>${stringPemeriksaan(data.rtl)}</td>
        </tr>
    </table>`
        }

        function renderBtnActionSbar(data) {

            const kdPetugas = "{{ session()->get('pegawai')->nik }}";
            const dokter = data?.dokter_konsul ? data.dokter_konsul?.dokter : formInfoPasien.find('input[name=dokter_dpjp]').val();
            const petugas = data?.nip;

            if (kdPetugas === petugas) {
                return `<span class="d-none">${data.tgl_perawatan} ${data.jam_rawat}</span><button class="btn btn-sm btn-primary" onclick="getSbar('${data.no_rawat}', '${data.tgl_perawatan}', '${data.jam_rawat}')"><i class="bi bi-pencil-square"></i></button>
    <button class="btn btn-sm btn-danger" onclick="deleteSbar('${data.no_rawat}', '${data.tgl_perawatan}', '${data.jam_rawat}')"><i class="bi bi-trash3-fill"></i></button>`
            }

            return '';

        }

        function deleteSbar(no_rawat, tgl_perawatan, jam_rawat) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Data SBAR akan dihapus ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`${url}/ranap/sbar/delete`, {
                        no_rawat: no_rawat,
                        tgl_perawatan: tgl_perawatan,
                        jam_rawat: jam_rawat,
                        _token: '{{ csrf_token() }}',
                    }).done((response) => {
                        alertSuccessAjax('Data SBAR berhasil dihapus')
                        tbSoapRanap(no_rawat);
                    }).fail((error) => {
                        alertErrorAjax(error)
                    })
                }
            })


        }

        function getSbar(no_rawat, tgl_perawatan, jam) {
            btnTabSbar.trigger('click');
            getDetailPemeriksaanRanap(no_rawat, tgl_perawatan, jam).done((response) => {


                btnSimpanSbar.addClass('d-none');
                btnUbahSbar.removeClass('d-none');
                btnBatalSbar.removeClass('d-none');

                formSbarRanap.find('input[name=no_rawat]').val(response.no_rawat);
                formSbarRanap.find('input[name=tgl_perawatan]').val(`${splitTanggal(response.tgl_perawatan)} ${response.jam_rawat}`);

                formSbarRanap.find('input[name=jam_rawat_awal]').val(response.jam_rawat);
                formSbarRanap.find('input[name=tgl_perawatan_awal]').val(response.tgl_perawatan);

                formSbarRanap.find('input[name=jam_rawat]').val(response.jam_rawat);
                formSbarRanap.find('input[name=petugas]').val(response.petugas.nip);
                formSbarRanap.find('input[name=nm_petugas]').attr(response.petugas.nama);
                formSbarRanap.find('textarea[name=keluhan]').val(response.keluhan);
                formSbarRanap.find('textarea[name=pemeriksaan]').val(response.pemeriksaan);
                formSbarRanap.find('textarea[name=penilaian]').val(response.penilaian);
                formSbarRanap.find('textarea[name=rtl]').val(response.rtl);

                const dokter = new Option(response.sbar.dokter_konsul.dokter_sbar.nm_dokter, response.sbar.dokter_konsul.dokter_sbar.kd_dokter, true, true);
                dokterSbar.append(dokter).trigger('change');

            });
        }
    </script>
@endpush
