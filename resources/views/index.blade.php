<!doctype html>
<html lang="en">
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('layout.head')

<body>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow" style="border-radius:0px">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">{{ config('app.name') }}</a>
        <button style="border-radius:0px" class="navbar-toggler position-absolute d-md-none collapsed" type="button"
            data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">
            @include('layout.sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        {{ (Request::segment(1) == null ? 'DASHBOARD' : Request::segment(1) == 'ranap') ? 'Rawat Inap' : strtoupper(Request::segment(1)) }}
                    </h1>
                </div>
                @yield('contents')
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.2.1/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.6.0/js/dataTables.select.min.js"></script>
    <script src="{{ asset('js/jquery.toast.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/qrcode.min.js') }}"></script>

    <!-- Magnify Image Viewer JS -->
    <script src="{{ asset('js/magnifier/jquery.magnify.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>


    @stack('js')

    <script type="text/javascript">
        const role = '{{ session()->get('role') }}'
        const APIURL = 'http://sim.rsiaaisyiyah.com/rsiap-api/api';

        // var qrcode = new QRCode("qrcode");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        window.onerror = function(msg, url, linenumber) {
            const messageError = 'Error message : ' + msg + '<br/>Muat ulang halaman ?';
            Swal.fire({
                title: 'Terjadi Masalah!',
                icon: 'error',
                html: messageError,
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                showDenyButton: true,
                confirmButtonText: 'Ya, Muat ulang',
                denyButtonText: 'Tidak',
                denyButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            })
        }

        $(document).ready(() => {
            $('.datetimepicker').datetimepicker({
                format: 'd-m-Y H:i:s',
            })
        })



        function getBaseUrl(urlSegments = '') {
            const getUrl = "{{ url('') }}"
            const arrDomain = getUrl.split('/');
            const segment = urlSegments ? `/${urlSegments}` : ''
            if (arrDomain[2] == 'sim.rsiaaisyiyah.com') {
                url = 'https://sim.rsiaaisyiyah.com' + segment;
            } else {
                url = `${arrDomain[0]}//192.168.100.33${segment}`
            }
            return url;
        }

        function ambilNoRawat(no_rawat) {
            id = no_rawat;
        }

        function ambilNoRm(no_rkm_medis) {
            no_rm = no_rkm_medis;
        }

        function removeZero(input) {
            if (input.value == '-' || input.value == '0') {
                $(input).val('');
            }
        }

        function cekKosong(input) {
            if (input.value == '') {
                $(input).val('-');
            }
        }

        function isEmptyNumber(input) {
            if (input.value == '') {
                $(input).val('0');
            }
        }

        function toRupiah(number) {
            return rupiahFormat = number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))

                return false;
            return true;
        }

        function splitTanggal(tanggal) {
            let arrTgl = tanggal.split('-');
            let txtTanggal = arrTgl[2] + '-' + arrTgl[1] + '-' + arrTgl[0];
            return txtTanggal;
        }

        function hitungLamaHari(d1, d2) {

            const date2 = d2 ? new Date(d2) : new Date();
            const date1 = new Date(d1);

            const timeDiff = Math.abs(date1.getTime() - date2.getTime());
            const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

            const hari = ('0' + (diffDays)).slice(-2);

            return diffDays;

        }

        // function getDataForm(form, element, except = []) {
        //     let data = {};
        //     // get all data from input
        //     for (let index = 0; index < element.length; index++) {
        //         const e = element[index];
        //         $(`${form} ${e}`).each((index, el) => {
        //             keys = $(el).prop('name');
        //             data[keys] = $(el).val();
        //         })
        //     }
        //     // remove items on array data
        //     for (let i = 0; i < except.length; i++) {
        //         cek = data.hasOwnProperty(except[i])
        //         if (cek) {
        //             delete data[except[i]]
        //         }
        //     }

        //     return data;
        // }
        function getDataForm(form, element, except = []) {
            let data = {};
            // get all data from input
            for (let index = 0; index < element.length; index++) {
                const e = element[index];
                $(`${form} ${e}`).each((index, el) => {
                    const name = $(el).prop('name');
                    const type = $(el).attr('type');

                    if (type === 'radio') {
                        // Handle radio buttons: only add the selected radio button's value
                        if ($(el).is(':checked')) {
                            data[name] = $(el).val();
                        }
                    } else if (type === 'checkbox') {
                        // Handle checkboxes: add all checked checkboxes with the same name
                        if ($(el).is(':checked')) {
                            if (!data[name]) {
                                data[name] = [];
                            }
                            data[name].push($(el).val());
                        }
                    } else {
                        // Handle other input types
                        data[name] = $(el).val();
                    }
                });
            }

            // remove items on array data
            for (let i = 0; i < except.length; i++) {
                if (data.hasOwnProperty(except[i])) {
                    delete data[except[i]];
                }
            }

            return data;
        }


        function toastReload(message, timer) {
            Swal.fire({
                title: message,
                position: 'top-end',
                toast: true,
                icon: 'success',
                timerProgressBar: true,
                showConfirmButton: false,
                timer: timer
            })
        }

        function alertErrorAjax(request) {
            Swal.fire(
                'Gagal',
                'Terjadi kesalahan <br/> Error Code : ' + request.status + ', ' + request.statusText + '<br/> <p style="padding:0 15px 0 15px;font-size:13px;color:red">' + request.responseJSON.message.split('(SQL')[0] + '</p>',
                'error'
            );
        }

        function cekList(parameter) {
            let isCheck = '';
            if (parameter) {
                isCheck = parameter ? '<i class="bi bi-check-circle text-success"></i>' : '';
            }
            return isCheck;
        }

        function alertSuccessAjax(message) {
            return Swal.fire({
                title: 'Berhasil',
                text: message,
                showConfirmButton: false,
                icon: 'success',
                timer: 1200,
            })

        }

        function alertSessionExpired(requestStatus) {
            if (requestStatus == 401) {
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
        }

        function hitungUmur(tgl_lahir) {
            let sekarang = new Date();
            let hari = new Date(sekarang.getFullYear(), sekarang.getMonth(), sekarang.getDate());

            let tahunSekarang = sekarang.getFullYear();
            let bulanSekarang = sekarang.getMonth();
            let tanggalSekarang = sekarang.getDate();

            let splitTgl = tgl_lahir.split('-');
            let lahir = new Date(splitTgl[0], splitTgl[1] - 1, splitTgl[2]);

            let tahunLahir = lahir.getFullYear();
            let bulanLahir = lahir.getMonth();
            let tanggalLahir = lahir.getDate();

            let umurTahun = tahunSekarang - tahunLahir;
            let umurBulan = bulanSekarang - bulanLahir;
            let umurTanggal = tanggalSekarang - tanggalLahir;

            if (umurTanggal < 0) {
                let bulanSebelumnya = new Date(tahunSekarang, bulanSekarang, 0);
                let jmlHariBulanSebelumnya = bulanSebelumnya.getDate();
                umurTanggal += jmlHariBulanSebelumnya;
                umurBulan--;
            }

            if (umurBulan < 0) {
                umurBulan += 12;
                umurTahun--;
            }

            // Pastikan tidak ada nilai negatif
            umurTahun = Math.max(umurTahun, 0);
            umurBulan = Math.max(umurBulan, 0);
            umurTanggal = Math.max(umurTanggal, 0);

            return `${umurTahun} Th ${umurBulan} Bln ${umurTanggal} Hari`;
        }

        function hitungUmurDaftar(tanggalLahir, tanggalUmur) {
            const lahir = new Date(tanggalLahir);
            const umur = new Date(tanggalUmur);

            if (umur < lahir) {
                return {
                    tahun: 0,
                    bulan: 0,
                    hari: 0,
                };
            }

            let tahun = umur.getFullYear() - lahir.getFullYear();
            let bulan = umur.getMonth() - lahir.getMonth();
            let hari = umur.getDate() - lahir.getDate();

            if (bulan < 0 || (bulan === 0 && hari < 0)) {
                tahun--;
                bulan += 12;
                if (hari < 0) {
                    const hariTerakhirBulanLahir = new Date(
                        umur.getFullYear(),
                        umur.getMonth(),
                        0
                    ).getDate();
                    hari += hariTerakhirBulanLahir;
                    bulan--;
                    if (bulan < 0) {
                        bulan += 12;
                    }
                }
            }

            return {
                tahun: Math.max(tahun, 0),
                bulan: Math.max(bulan, 0),
                hari: Math.max(hari, 0),
            };
        }


        // merapikan enter teks soap
        function stringPemeriksaan(value) {
            if (value) {
                const arrValue = value.split('\n');
                let string = '';
                for (let index = 0; index < arrValue.length; index++) {
                    string += `${arrValue[index]} <br/>`;
                }
                return string

            }
            return false;
        }

        function getPetugas(nama, no = '') {
            const petugas = $.ajax({
                url: '/erm/petugas/cari',
                data: {
                    'q': nama
                },
            });

            return petugas;
        }

        function setWarnaPemeriksaan(keterangan) {
            let warna = '';
            if (keterangan == 'L') {
                warna = 'row-primary';
            } else if (keterangan == 'H' || keterangan == '*' || keterangan == '**') {
                warna = 'row-danger';
            } else if (keterangan == 'K' || keterangan == 'k') {
                warna = 'row-indigo';
            }
            return warna;
        }

        function cariPetugas(nama) {
            $.ajax({
                url: '/erm/petugas/cari',
                data: {
                    'q': nama.value
                },
                success: function(response) {

                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                    $.map(response, function(data) {
                        html += '<li>'
                        html += '<a data-id="' + data.nip +
                            '" class="dropdown-item" onclick="setPetugas(this)">' + data
                            .nama +
                            '</a>'
                        html += '</li>'
                    })
                    html += '</ul>';
                    $('.list_petugas').fadeIn();
                    $('.list_petugas').html(html);
                },
            })
        }

        function setPetugas(param) {
            $('#nik').val($(param).data('id'));
            $('#user').val($(param).data('id'));
            $('#nama').val($(param).text());
            $('#nama_user').val($(param).text());
            $('.list_petugas').fadeOut();
        }

        function formatTanggal(oldTgl) {
            let t = new Date(oldTgl);
            let bulan = '';
            switch ((t.getMonth() + 1)) {
                case 1:
                    bulan = "Januari";
                    break;
                case 2:
                    bulan = "Februari";
                    break;
                case 3:
                    bulan = "Maret";
                    break;
                case 4:
                    bulan = "April";
                    break;
                case 5:
                    bulan = "Mei";
                    break;
                case 6:
                    bulan = "Juni";
                    break;
                case 7:
                    bulan = "Juli";
                    break;
                case 8:
                    bulan = "Agustus";
                    break;
                case 9:
                    bulan = "September";
                    break;
                case 10:
                    bulan = "Oktober";
                    break;
                case 11:
                    bulan = "November";
                    break;
                case 12:
                    bulan = "Desember";
                    break;
                default:
                    break;
            }

            if (oldTgl.split(' ').length > 1) {

                return t.getDate() + ' ' + bulan + ' ' + t.getFullYear() + ' ' + oldTgl.split(' ')[1];
            }
            return tanggal = t.getDate() + ' ' + bulan + ' ' + t.getFullYear();
        }

        function isKosong(x, satuan = '') {
            return x ? x + satuan : '-';
        }


        function textRawat(no_rawat, symbol = '') {
            let splitNoRawat = no_rawat.split('/');
            let textNoRawat = symbol ? splitNoRawat.join(symbol) : splitNoRawat.join('');
            return textNoRawat;
        }


        function getPemeriksaanPoli(no_rawat, kd_poli = '') {
            const pemeriksaan = $.ajax({
                url: '/erm/pemeriksaan',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    no_rawat: no_rawat,
                    kd_poli: kd_poli,
                },
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            });
            return pemeriksaan
        }

        function getPemeriksaanRanap(no_rawat, parameter = '', pemeriksaan = '') {
            let perawatan = $.ajax({
                url: '/erm/soap/get',
                data: {
                    'no_rawat': no_rawat,
                    'parameter': parameter,
                    'pemeriksaan': pemeriksaan,
                },
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })

            return perawatan;
        }

        $("[data-magnify=gallery]").magnify({
            initMaximized: true,
            multiInstances: false,
        });


        function detailPeriksa(no_rawat, status) {

            $('#upload-image').css('visibility', 'hidden')
            $('#form-upload').css('visibility', 'visible')
            $('#image .tmb').detach()
            $.ajax({
                url: '/erm/periksa/detail',
                method: "GET",
                data: {
                    'no_rawat': no_rawat,
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#no_rawat').val(data.no_rawat)
                    $('#no_rkm_medis').val(data.no_rkm_medis)
                    $('#tgl_masuk').val(data.tgl_registrasi)
                    $('#td_no_rawat').text(data.no_rawat)
                    $('#td_nm_pasien').text(data.pasien.nm_pasien)
                    $('#td_tgl_reg').text(formatTanggal(data.tgl_registrasi))
                    $('#infoReg').css('visibility', 'visible')

                    $('#button-form label').detach()
                    $('#button-form input').detach()


                    if (status == "Ralan") {
                        html =
                            '<input type="radio" class="btn-check" name="kategori" id="opt-klaim" autocomplete="off" onclick="showForm()" value="klaim"><label class="btn btn-outline-primary btn-sm" for="opt-klaim">Berkas Klaim</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-rujukan" autocomplete="off" onclick="showForm()" value="surat rujukan"><label class="btn btn-outline-primary btn-sm" for="opt-rujukan">Surat Rujukan</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-usg" autocomplete="off" onclick="showForm()" value="usg"><label class="btn btn-outline-primary btn-sm" for="opt-usg">USG</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-cppt" autocomplete="off" onclick="showForm()" value="cppt"><label class="btn btn-outline-primary btn-sm" for="opt-cppt">CPPT</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-laborat" autocomplete="off" onclick="showForm()" value="laborat"><label class="btn btn-outline-primary btn-sm" for="opt-laborat">Laboratorium</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-radiologi" autocomplete="off" onclick="showForm()" value="radiologi"><label class="btn btn-outline-primary btn-sm" for="opt-radiologi">Radiologi</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-legalisasi" autocomplete="off" onclick="showForm()" value="legalisasi"><label class="btn btn-outline-primary btn-sm" for="opt-legalisasi">Surat Legalisasi</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-km" autocomplete="off" onclick="showForm()" value="km"><label class="btn btn-outline-primary btn-sm" for="opt-km">Foto KM</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-ekg" autocomplete="off" onclick="showForm()" value="ekg"><label class="btn btn-outline-primary btn-sm" for="opt-ekg">Berkas EKG</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-form-rujukan" autocomplete="off" onclick="showForm()" value="form-rujukan"><label class="btn btn-outline-primary btn-sm" for="opt-form-rujukan">Form Rujukan</label>'

                        $('#button-form').append(html)
                    } else {
                        html =
                            '<input type="radio" class="btn-check" name="kategori" id="opt-klaim" autocomplete="off" onclick="showForm()" value="klaim"><label class="btn btn-outline-primary btn-sm" for="opt-klaim">Berkas Klaim</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-rujukan" autocomplete="off" onclick="showForm()" value="surat rujukan"><label class="btn btn-outline-primary btn-sm" for="opt-rujukan">Surat Rujukan</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-usg" autocomplete="off" onclick="showForm()" value="usg"><label class="btn btn-outline-primary btn-sm" for="opt-usg">USG</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-resume" autocomplete="off" onclick="showForm()" value="resume"><label class="btn btn-outline-primary btn-sm" for="opt-resume">Resume Medis</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-laborat" autocomplete="off" onclick="showForm()" value="laborat"><label class="btn btn-outline-primary btn-sm" for="opt-laborat">Laboratorium</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-skl" autocomplete="off" onclick="showForm()" value="skl"><label class="btn btn-outline-primary btn-sm" for="opt-skl">SKL</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-radiologi" autocomplete="off" onclick="showForm()" value="radiologi"><label class="btn btn-outline-primary btn-sm" for="opt-radiologi">Radiologi</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-operasi" autocomplete="off" onclick="showForm()" value="operasi"><label class="btn btn-outline-primary btn-sm" for="opt-operasi">Operasi</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-icu" autocomplete="off" onclick="showForm()" value="icu"><label class="btn btn-outline-primary btn-sm" for="opt-icu">ICU</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-lain" autocomplete="off" onclick="showForm()" value="lainnya"><label class="btn btn-outline-primary btn-sm" for="opt-lain">Lainnya</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-legalisasi" autocomplete="off" onclick="showForm()" value="legalisasi"><label class="btn btn-outline-primary btn-sm" for="opt-legalisasi">Surat Legalisasi</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-km" autocomplete="off" onclick="showForm()" value="km"><label class="btn btn-outline-primary btn-sm" for="opt-km">Foto KM</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-ekg" autocomplete="off" onclick="showForm()" value="ekg"><label class="btn btn-outline-primary btn-sm" for="opt-ekg">Berkas EKG</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-form-rujukan" autocomplete="off" onclick="showForm()" value="form-rujukan"><label class="btn btn-outline-primary btn-sm" for="opt-form-rujukan">Form Rujukan</label>'

                        $('#button-form').append(html)

                    }

                    $('#modalPenunjangRanap').modal('show')
                }
            })
        }

        function showForm(no_rawat = '', kategori = '') {
            $('#submit').hide()
            if (!no_rawat && !kategori) {
                no_rawat = $('#no_rawat').val();
                kategori = event.target.value;
            }

            var img = '';
            $('#image .tmb').detach()
            $.ajax({
                url: '/erm/upload/show',
                data: {
                    'no_rawat': no_rawat,
                    'kategori': kategori,
                },

                method: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    countData = Object.keys(data).length
                    if (countData > 0) {
                        img = data.file.split(',');
                        $.map(img, function(file) {
                            splitNamaFile = file.split('.');
                            // console.log(splitNamaFile[1])
                            if (splitNamaFile[1] != 'pdf') {
                                fileName = '{{ asset('erm') }}/' + file;
                            } else {
                                fileName = "{{ asset('img/pdf-icon.png') }}";
                            }
                            $('#image').append(
                                '<div class="tmb col-md-4 col-lg-3 col-sm-12"><img class="img-thumbnail position-relative" src="' +
                                fileName +
                                '"/><span style="cursor:pointer" class="badge text-bg-danger" onclick="deleteImage(' +
                                data.id + ',\'' + file + '\')">Hapus</span></div>')
                        })
                    }
                    $('#upload-image').css('visibility', 'visible')
                }
            })

        }

        function previewImage(input) {


            if (input.files && input.files[0]) {

                $('input[name="kategori"]').each(function(index) {
                    if ($(this).prop('checked') != true) {
                        $(this).prop('disabled', true);
                    }
                })
                $('#submit').show()
                countImage = input.files.length;
                for (let index = 0; index < countImage; index++) {
                    var reader = new FileReader();
                    reader.readAsDataURL(input.files[index]);
                    reader.onload = function(e) {
                        var file = e.target;
                        var fileName = input.files[index].name;
                        var filePreview = '';
                        // console.log(input.files[index].type);
                        if (input.files[index].type == 'application/pdf') {
                            filePreview = "{{ asset('img/pdf-icon.png') }}";
                        } else {
                            filePreview = file.result;
                        }
                        $('#preview').append(
                            '<div class="pip col-md-3 col-lg-3 col-sm-12"><input type="hidden" name="images" value="' +
                            file.result + '" class="images"><img width="75%" src="' + filePreview +
                            '" title="' +
                            fileName + '" alt="' + fileName +
                            '"/><br /><span class="remove badge text-bg-danger">Batal Upload</span></div>')
                        $(".remove").click(function() {
                            $('input[type="file"]').val('');
                            $(this).parent(".pip").remove();
                            if ($('.pip').length == 0) {
                                $('#images').val("");
                                $('#submit').hide()
                                $('input[name="kategori"]').each(function(index) {
                                    $(this).prop('disabled', false);
                                })
                            }
                            return false;
                        });
                    };
                }
            }
        }
        var data = {};

        function getDokter(dokter) {
            let resDokter = $.ajax({
                url: '/erm/dokter/cari',
                data: {
                    'nm_dokter': dokter,
                },
            });

            return resDokter;
        }

        function reloadTabelPoli() {
            tanggal = localStorage.getItem('tanggal') ? localStorage.getItem('tanggal') : "{{ date('Y-m-d') }}"
            hitungPanggilan();
            $('#tb_pasien').DataTable().destroy();
            tb_pasien(tanggal);
        }

        function simpan() {
            var images = []

            $('input:hidden[name="images"]').each(function() {
                images.push($(this).val());
            })

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            data = {
                no_rawat: $('#no_rawat').val(),
                no_rkm_medis: $('#no_rkm_medis').val(),
                images: images,
                tgl_masuk: $('#tgl_masuk').val(),
                kategori: $('#button-form').find('input[type="radio"]:checked').val(),
                username: "{{ session()->get('pegawai')->nik }}",
                _token: "{{ csrf_token() }}"
            }

            $.ajax({
                url: '/erm/upload',
                method: 'POST',
                data: data,
                dataType: 'JSON',
                beforeSend: function() {
                    $('#submit').prop('disabled', true);
                    swal.fire({
                        title: 'Memproses Data',
                        text: 'Mohon Tunggu',
                        showConfirmButton: false,
                        footer: '<img width="25" src="http://192.168.100.33/simrsiav2/assets/gambar/rsiap.ico"><b>&nbsp;RSIA AISYIYAH PEKAJANGAN</b>',
                        didOpen: () => {
                            swal.showLoading();
                        }
                    })
                },
                complete: function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses !',
                        text: 'Data Berhasil Diproses',
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                success: function(msg) {
                    $('#submit').prop('disabled', false);
                    hiddenForm();
                    showHistory();
                    $(".pip").remove();
                    if ($('.pip').length == 0) {
                        $('#images').val("");
                        $('#submit').hide()
                        $('input[name="kategori"]').each(function(index) {
                            $(this).prop('disabled', false);
                        })

                    }
                    if ($('#tb_pasien').length > 0) {
                        reloadTabelPoli();
                    }
                    showForm(data.no_rawat, data.kategori);
                    Swal.fire(
                        'Berhasil!', 'Berkas sudah terupload di server', 'success'
                    )
                    // reloadTabelPoli();

                },
                fail: function(jqXHR, status) {
                    // console.log(status)
                }
            })

        }
        $('#submit').click(function() {})

        function hiddenForm() {
            $('#upload-image').css('visibility', 'hidden')
        }

        function getHasilLab(no_rawat, pemeriksaan = '') {
            let lab = $.ajax({
                url: '/erm/lab/ambil',
                data: {
                    no_rawat: no_rawat,
                    pemeriksaan: pemeriksaan
                },
            })

            return lab;
        }

        function getPermintaanRadiologi(no_rawat, tgl_permintaan = '', jam_permintaan = '') {
            const periksa = $.get('/erm/radiologi/permintaan', {
                no_rawat: no_rawat,
                tgl_permintaan: tgl_permintaan,
                jam_permintaan: jam_permintaan,
            }).fail((request) => {
                alertErrorAjax(request)
            })
            return periksa;
        }

        function getPeriksaRadiologi(no_rawat, tgl_periksa = '', jam = '') {
            const periksa = $.get('/erm/radiologi/periksa', {
                no_rawat: no_rawat,
                tgl_periksa: tgl_periksa,
                jam: jam,
            }).fail((request) => {
                alertErrorAjax(request)
            })
            return periksa;
        }

        function getHasilRadiologi(no_rawat, tgl_periksa = '', jam = '') {
            const periksa = $.get('/erm/radiologi/hasil', {
                no_rawat: no_rawat,
                tgl_periksa: tgl_periksa,
                jam: jam,
            }).fail((request) => {
                alertErrorAjax(request)
            })
            return periksa;
        }

        function getPemberianObat(no_rawat, obat = '') {
            let pemberian = $.ajax({
                url: '/erm/obat/pemberian',
                data: {
                    no_rawat: no_rawat,
                    obat: obat
                },
            })

            return pemberian;

        }

        function getPasienPeriksa(no_rkm_medis, tanggal) {

            paramUrl = tanggal ? no_rkm_medis + '/' + tanggal : no_rkm_medis;
            let pasien = $.ajax({
                url: '/erm/periksa/show/' + paramUrl,
                dataType: 'JSON',
            });

            return pasien;
        }

        function getDiagnosaPasien(no_rawat) {
            let diagnosa = $.ajax({
                url: '/erm/penyakit/pasien/ambil',
                data: {
                    no_rawat: no_rawat
                },
            });

            return diagnosa;
        }

        function getProsedurPasien(no_rawat) {
            let prosedur = $.get('/erm/prosedur/pasien/ambil', {
                no_rawat: no_rawat
            });
            return prosedur;
        }


        function getDiagnosa(diagnosa = '-') {
            let dx = $.ajax({
                url: '/erm/penyakit/cari',
                data: {
                    'kd_penyakit': diagnosa,
                },
                dataType: 'JSON',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return dx
        }

        function getProsedur(prosedur = '') {
            let px = $.ajax({
                url: '/erm/prosedur/cari',
                data: {
                    'kode': prosedur,
                },
                dataType: 'JSON',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return px
        }

        function getResumeMedis(noRawat) {
            const resume = $.ajax({
                url: '/erm/resume/ranap/get',
                data: {
                    no_rawat: noRawat,
                }
            });

            return resume;
        }

        function getRegPeriksa(noRawat) {
            let regPeriksa = $.ajax({
                url: '/erm/periksa/detail',
                data: {
                    no_rawat: noRawat
                },
            });

            return regPeriksa;
        }

        function getRanapPasien(no_rawat) {
            return $.get(`${url}/ranap/pasien/get`, {
                no_rawat: no_rawat
            })
        }

        function showHistory() {
            var no_rkm_medis = $('.search option:selected').val();
            $('#upload-image').css('visibility', 'hidden');
            getPasienPeriksa(no_rkm_medis).done(function(data) {
                $('#ralan tbody').empty();
                $('#ranap tbody').empty();
                $.map(data, function(item) {
                    if (item.upload.length > 0) {
                        button = '<a href="#form-upload" onclick="detailPeriksa(\'' + item
                            .no_rawat
                            .toString() + '\',\'' + item.status_lanjut +
                            '\')" class="btn btn-success btn-sm"><i class="bi bi-check2-circle"></i></a>'


                    } else {
                        button = '<a href="#form-upload" onclick="detailPeriksa(\'' + item
                            .no_rawat
                            .toString() + '\',\'' + item.status_lanjut +
                            '\')" class="btn btn-primary btn-sm"><i class="bi bi-cloud-upload"></i></a>'
                    }
                    button += `<button type="button" class="btn btn-info btn-sm" onclick="confirmRiwayat('${no_rkm_medis}')"><i class="bi bi-info"></i></button>`;
                    html = '<tr>' +
                        '<td>' + item.no_rawat + '</td>' +
                        '<td>' + item.tgl_registrasi + '</td>' +
                        '<td>' + button + '</td>' +
                        '</tr>'

                    if (item.status_lanjut == 'Ralan') {
                        $('#ralan').append(html);
                    } else {
                        $('#ranap').append(html);
                    }
                })
            })

        }

        function deleteImage(id, img) {
            kategori = $('input[type="radio"]:checked').val();
            no_rawat = $('#no_rawat').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: 'Yakin hapus file ini ?',
                text: "anda tidak bisa mengembalikan file yang dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/erm/upload/delete/' + id,
                        dataType: 'JSON',
                        data: {
                            _token: "{{ csrf_token() }}",
                            image: img
                        },
                        success: function(data) {
                            showForm(no_rawat, kategori);
                            if ($('#tb_pasien').length > 0) {
                                $('#tb_pasien').DataTable().destroy();
                                if (localStorage.getItem('tanggal')) {
                                    tb_pasien(`${localStorage.getItem('tanggal')}`);
                                } else {
                                    tb_pasien(`{{ date('Y-m-d') }}`);
                                }
                            }
                            Swal.fire(
                                'Berhasil!', 'Berkas telah dihapus', 'success'
                            )
                        },

                    })
                }
            })
        }



        function hiddenForm() {
            $('#upload-image').css('visibility', 'hidden')
        }

        function cariObatRacikan(obat, no) {
            $.ajax({
                url: '/erm/obat/cari',
                data: {
                    'nama': obat.value,
                },
                success: function(response) {
                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                    $.map(response.data, function(data) {
                        $.map(data.gudang_barang, function(item) {
                            if (data) {
                                if (data.status != "0") {
                                    if (item.stok != "0") {
                                        html +=
                                            '<li data-id="' +
                                            data.kode_brng +
                                            '" data-stok="' + item.stok +
                                            '" data-kapasitas="' + data.kapasitas + '" data-nama ="' + data.nama_brng + '" data-stok ="' + item.stok + '" onclick="setObat(this, ' + no + ')"><a class="dropdown-item" href="#" style="overflow:hidden">' +
                                            data.nama_brng + ' - <span class="text-primary">- Rp. ' + toRupiah(data.ralan) + ' - <i><b>Stok (' + item.stok + ')</b></i></span></a></li>'
                                    } else {
                                        html +=
                                            '<li class="disable" data-id="' + data
                                            .kode_brng +
                                            '" data-kapasitas="' + data.kapasitas + '" data-nama ="' + data.nama_brng + '" data-stok="' + item.stok + '" onclick="setObat(this, ' + no + ')"><i><a class="dropdown-item" href="#" style="overflow:hidden;color:red">' +
                                            data.nama_brng + ' - Rp. ' + toRupiah(data.ralan) + ' - <b>Stok Kosong' +
                                            '</a></i></li>'
                                    }
                                }
                            }
                        })
                    })
                    html += '</ul>';
                    $('.list_obat_' + no).fadeIn();
                    $('.list_obat_' + no).html(html);
                }
            })
        }

        function hitungJumlahObat(kps, p1, p2, jumlah) {
            // jumlah = $('.jml_dr').val();
            kandungan = parseFloat(kps) * (parseFloat(p1) / parseFloat(p2));
            jml_obat = (parseFloat(kandungan) * parseFloat(jumlah)) / parseFloat(kps)
            return parseFloat(jml_obat).toFixed(2);
        }

        function hitungObatRacik(no) {

            kps = $('#kps' + no).val();
            p2 = $('#p2' + no).val();
            p1 = $('#p1' + no).val();
            jumlah = $('.jml_dr').val();

            if (p1 != 0 && p2 != 0) {
                kandungan = parseFloat(kps) * (parseFloat(p1) / parseFloat(p2));
                jml_obat = (parseFloat(kandungan) * parseFloat(jumlah)) / parseFloat(kps)
                $('#kandungan' + no).val(kandungan.toFixed(1));
                $('#jml_obat' + no).val(jml_obat.toFixed(1));
            }

        }

        function setNilaiPembagi(e) {
            pembagi = $(e).val();
            if (pembagi == '' || pembagi == 0) {
                $(e).val(1);
            }

        }

        function setObat(param, no) {
            $('.nama_obat_' + no).val($(param).data('nama'));
            $('#kode_brng' + no).val($(param).data('id'))
            $('#kps' + no).val($(param).data('kapasitas'))
            $('#p1' + no).val(1)
            $('#p2' + no).val(1)
            $('#jml_obat' + no).val(0)
            $('#kandungan' + no).val(0)
            $('#stok' + no).val($(param).data('stok'))
            $('.list_obat_' + no).fadeOut()
        }

        function ambilTemplateRacikan(kd_dokter = '', nm_racik = '', id = '') {
            let template = '';
            $.ajax({
                url: '/erm/resep/racik/template/ambil',
                async: false,
                data: {
                    id: id,
                    kd_dokter: kd_dokter,
                    nm_racik: nm_racik,
                },
                success: function(response) {
                    res = response;
                }
            })
            template = res;
            return template;
        }


        function getTemplateRacikan(kd_dokter = '', nm_racik = '', id = '') {
            let template = $.ajax({
                url: '/erm/resep/racik/template/ambil',
                data: {
                    id: id,
                    kd_dokter: kd_dokter,
                    nm_racik: nm_racik,
                }
            })
            return template;
        }

        function hapusResepRacikan(no_resep, no_racik) {
            let racikan = $.ajax({
                url: '/erm/resep/racik/hapus',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_resep: no_resep,
                    no_racik: no_racik,
                },
                method: 'DELETE',
            });

            return racikan;
        }


        function getPeserta(noka, tglSep = '') {
            let tanggal = tglSep ? tglSep : "{{ date('Y-m-d') }}";
            let peserta = $.ajax({
                beforeSend: function() {
                    swal.fire({
                        title: 'Sedang mengabil data peserta',
                        text: 'Mohon Tunggu',
                        showConfirmButton: false,
                        didOpen: () => {
                            swal.showLoading();
                        }
                    })
                },
                url: '/erm/bridging/peserta/noka/' + noka + '/' + tanggal,
                dataType: 'JSON',
                method: 'GET',
                success: function(response) {
                    if (response.metaData.code == 200 && response.metaData.message == 'OK') {
                        swal.fire({
                            title: 'Berhasil',
                            text: 'Data menampilkan data peserta',
                            showConfirmButton: false,
                            icon: 'success',
                            timer: 500,
                        })

                    } else {
                        swal.fire({
                            title: 'Tidak Ditemukam',
                            text: 'Pasien tidak terdaftar sebagai peserta BPJS / ' + response.metaData.message,
                            showConfirmButton: true,
                            icon: 'error',
                        })
                    }
                },
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            });

            return peserta;
        }

        function getPesertaDetail(noka, tglSep) {
            getPeserta(noka, tglSep).done(function(response) {
                if (response.metaData.code == 200 && response.metaData.message == 'OK') {
                    $.map(response.response, function(p) {
                        jkel = p.sex == 'L' ? 'LAKI-LAKI' : 'PEREMPUAN';
                        p.statusPeserta.kode == 0 ? $('.statusPeserta').css('color', 'green') : $('.statusPeserta').css('color', 'red');
                        $('.namaPeserta').text(p.nama + ' ( ' + jkel + ' )');
                        $('.nikPeserta').text(p.nik);
                        $('.tglLahirPeserta').text(formatTanggal(p.tglLahir));
                        $('.nokaPeserta').text(p.noKartu);
                        $('.statusPeserta').text(p.statusPeserta.keterangan);
                        $('.pisaPeserta').text(p.pisa);
                        $('.teleponPeserta').text(p.mr.noTelepon);
                        $('.kelasPeserta').text(p.hakKelas.kode + '. ' + p.hakKelas.keterangan);
                        $('.jenisPeserta').text(p.jenisPeserta.kode + '. ' + p.jenisPeserta.keterangan);
                        $('.fktpPeserta').text(p.provUmum.kdProvider + '. ' + p.provUmum.nmProvider);
                        $('.tglKartuPeserta').text(formatTanggal(p.tglCetakKartu));
                        $('.tglTMTpeserta').text(formatTanggal(p.tglTMT));
                        $('.tglTATpeserta').text(formatTanggal(p.tglTAT));
                        $('.umurSekarangPeserta').text(p.umur.umurSekarang);
                        $('.umurPelayananPeserta').text(p.umur.umurSaatPelayanan);
                    })
                    $('#modalPesertaBpjs').modal('show');
                }
            })
        }
        $('#modalPesertaBpjs').on('bs.modal.hidden', function() {
            $('.namaPeserta').text('');
            $('.nikPeserta').text('');
            $('.tglLahirPeserta').text('');
            $('.nokaPeserta').text('');
            $('.nokaPeserta').text('');
            $('.pisaPeserta').text('');
            $('.teleponPeserta').text('');
            $('.kelasPeserta').text('');
            $('.jenisPeserta').text('');
            $('.fktpPeserta').text('');
            $('.tglKartuPeserta').text('');
            $('.tglTMTpeserta').text('');
            $('.tglTATpeserta').text('');
            $('.umurSekarangPeserta').text('');
            $('.umurPelayananPeserta').text('');
        });

        function getEws(params, stts) {
            const url = stts == 'ranap' ? '/erm/ews/ranap/' + textRawat(params, '-') : '/erm/ews/ralan/' + textRawat(params, '-');
            const ews = $.ajax({
                url: url,
                dataType: 'JSON',
                method: 'GET',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })

            return ews;
        }


        function setEws(no_rawat, stts, spesialis) {
            if (spesialis == 'S0003') {
                setEwsAnak(no_rawat, stts)
            } else if (spesialis == 'S0001') {
                setEwsMaternal(no_rawat, stts)
            }
        }

        function setEwsAnak(params, stts) {
            getRegPeriksa(params).done((rawat) => {
                jk = rawat.pasien.jk == 'L' ? 'Laki-laki' : 'Perempuan';
                $('#no_rawat_ews').html(rawat.no_rawat);
                $('#nama_pasien_ews').html(rawat.pasien.nm_pasien);
                $('#umur_ews').html(rawat.umurdaftar + ' ' + rawat.sttsumur + ' / ' + jk);
            });
            getEws(params, stts).done(function(response) {
                $('#table-ews tbody').empty()
                $('.td-jam').remove()
                $('.td-tanggal').remove()
                let no = '';
                j = '';
                tanggal = '';
                html = '';
                style = '';
                let rowspan = '';
                $.map(response, (res) => {
                    $('#kategori-' + res.kategori).empty()

                    rowspan = res.data.length + 1
                    html += '<tr style="text-align:center" class="judul-ews">'
                    html += '<td rowspan="' + rowspan + '" style="padding:10px">' + res.judul + '</td>'
                    $.map(res.data, (data) => {
                        $('.kategori').text(data.kategori);
                        let hasilPemeriksaan = '';

                        if (data.hasil == 3) {
                            style = "style='background-color:red;color:#fff'";
                        } else if (data.hasil == 2) {
                            style = "style='background-color:orange;color:#fff'";
                        } else if (data.hasil == 1) {
                            style = "style='background-color:yellow;color:#000'";
                        } else {
                            style = "";
                        }

                        html += '<tr class="ews-' + data.id + '" ' + style + ' id="kategori-' + res.kategori + '">'
                        html += '<td style="padding:5px" data-nilai1="' + data.nilai1 + '" data-nilai2="' + data.nilai2 + '" width="5%">' + data.parameter + '</td>'

                        let inputHasil = '';
                        no = 1;
                        $.map(data.hp, (hp) => {

                            if (hp) {
                                inputHasil = '<input type="hidden" value="' + data.hasil + '" class="baris-' + no + ' " name="baris[' + no + '] "/>'
                                html += '<td width="5%">' + inputHasil + '<strong>' + hp + '</strong></td>'
                            } else {
                                html += '<td width="5%"></td>';
                            }
                            no++;

                        })
                        tanggal = '';
                        $.map(data.tanggal, (tgl) => {
                            tanggal += '<td width="5%" class="td-tanggal">' + splitTanggal(tgl) + '</td>';
                        })

                        j = '';
                        $.map(data.jam, (jam) => {
                            j += '<td width="5%" class="td-jam">' + jam + '</td>';
                        })

                        html += '<td style="padding:5px" class="hasil">' + data.hasil + '</td>'
                        html += '</tr>'

                    })
                    html += '</tr>'


                })
                $('#table-ews tbody').append(html)
                $('.tr-jam').append(j)
                $('.tr-tanggal').append(tanggal)
                hitungNilaiEws(no)
            })
        }

        function getRiwayatPasien(no_rkm_medis, sortir = '') {
            const riwayat = $.get('/erm/registrasi/riwayat', {
                no_rkm_medis: no_rkm_medis,
                sortir: sortir
            })
            return riwayat;
        }

        function getJam() {
            const waktu = new Date();
            jam = waktu.getHours() >= 10 ? waktu.getHours() : '0' + waktu.getHours();
            menit = waktu.getMinutes() >= 10 ? waktu.getMinutes() : '0' + waktu.getMinutes();
            detik = waktu.getSeconds() >= 10 ? waktu.getSeconds() : '0' + waktu.getSeconds();
            return `${jam}:${menit}:${detik}`;
        }



        function hitungNilaiEws(no) {
            html = '<tr>'
            html += '<th colspan=2>NILAI EWS TOTAL</th>'
            let index = 1;
            for (index; index < no; index++) {
                let total = 0;
                let classNilai = '';
                $('.baris-' + index).each(function(index, element) {
                    total = total + parseFloat($(element).val());
                });

                if (total >= 7) {
                    classNilai = `bg-danger`;
                } else if (total >= 5 && total <= 6) {
                    classNilai = `bg-warning`;
                } else if (total >= 1 && total <= 4) {
                    classNilai = `bg-warning`;
                    // cekArray = arrNilai.find((o) => {
                    //     if (o == 3) {
                    //         ews = `<div class="alert alert-warning" role="alert" style="padding:12px">Monitoring ulang minimal tiap 3-4 jam, <strong>Panggil dokter jaga</strong> <br/> Monitoring ulang minimal tiap 6-8 jam</div>`;
                    //     }
                    // });
                }

                html += '<td onclick="tindakanEws(' + total + ', ' + index + ')" class="nilai-' + index + ' ' + classNilai + '" style="cursor:pointer" id="total-ews">'
                html += total
                html += '</td>'
                tindakanEws(total, index)
            }
            html += '</tr>'
            $('#table-ews tbody').append(html)
        }

        function tindakanEws(total, index) {
            let nilai = total;
            $('.hasil-ews').empty();
            ews = '';
            let arrNilai = [];
            $('.baris-' + index).each(function(index, element) {
                a = $(element).val();
                arrNilai[index] = a;
            });
            if (nilai >= 7) {
                ews = `<div class="alert alert-danger" role="alert" style="padding:12px"> Monitoring ulang tiap jam, <span class="text-danger"><i>call code blue</i></span>, Pindahkan perawatan ke level 2/3 (HCU)</div>`;
            } else if (nilai >= 5 && nilai <= 6) {
                ews = `<div class="alert alert-warning" role="alert" style="padding:12px">Monitoring ulang minimal tiap 3-4 jam, Panggil dokter jaga</div>`;
            } else if (nilai >= 1 && nilai <= 4) {
                ews = `<div class="alert alert-warning" role="alert" style="padding:12px">Monitoring ulang minimal tiap 6-8 jam</div>`;
                cekArray = arrNilai.find((o) => {
                    if (o == 3) {
                        ews = `<div class="alert alert-warning" role="alert" style="padding:12px">Monitoring ulang minimal tiap 3-4 jam, <strong>Panggil dokter jaga</strong> <br/> Monitoring ulang minimal tiap 6-8 jam</div>`;
                    }
                });
            } else if (nilai == 0) {
                ews = `<div class="alert alert-primary" role="alert" style="padding:12px">Monitoring ulang minimal tiap 12 jam </div>`;
            } else {
                $('.hasil-ews').empty(ews);
            }

            $('.hasil-ews').append(ews);
        }

        function getEwsMaternal(params, stts) {
            const url = stts == 'ranap' ? '/erm/ews/maternal/ranap/' + textRawat(params, '-') : '/erm/ews/maternal/ralan/' + textRawat(params, '-');
            const ews = $.ajax({
                url: url,
                dataType: 'JSON',
                method: 'GET',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })

            return ews;
        }


        function setEwsMaternal(params, stts) {
            getRegPeriksa(params).done((rawat) => {
                jk = rawat.pasien.jk == 'L' ? 'Laki-laki' : 'Perempuan';
                $('#no_rawat_ews').html(rawat.no_rawat);
                $('#nama_pasien_ews').html(rawat.pasien.nm_pasien);
                $('#umur_ews').html(rawat.umurdaftar + ' ' + rawat.sttsumur + ' / ' + jk);
            });
            getEwsMaternal(params, stts).done(function(response) {
                $('#table-ews tbody').empty()
                $('.td-jam').remove()
                $('.td-tanggal').remove()
                let no = '';
                j = '';
                tanggal = '';
                html = '';
                style = '';
                let rowspan = '';
                $.map(response, (res) => {
                    $('#kategori-' + res.kategori).empty()

                    rowspan = res.data.length + 1
                    html += '<tr style="text-align:center" class="judul-ews">'
                    html += '<td rowspan="' + rowspan + '" style="padding:10px">' + res.judul + '</td>'
                    $.map(res.data, (data) => {
                        $('.kategori').text(data.kategori);
                        let hasilPemeriksaan = '';

                        if (data.hasil == 'Merah') {
                            style = "style='background-color:red;color:#fff'";
                        } else if (data.hasil == 'Kuning') {
                            style = "style='background-color:yellow;color:#000'";
                        } else {
                            style = "style='background-color:#fff;color:#000'";
                        }

                        html += '<tr class="ews-' + data.id + '" ' + style + ' id="kategori-' + res.kategori + '">'
                        html += '<td style="padding:5px" data-nilai1="' + data.nilai1 + '" data-nilai2="' + data.nilai2 + '" width="5%">' + data.parameter + '</td>'

                        let inputHasil = '';
                        no = 1;
                        $.map(data.hp, (hp) => {
                            if (hp) {
                                inputHasil = '<input type="hidden" value="' + data.hasil + '" class="baris-' + no + ' " name="baris[' + no + '] "/>'
                                html += '<td width="5%">' + inputHasil + '<strong>' + hp + '</strong></td>'
                            } else {
                                html += '<td width="5%"></td>';
                            }
                            no++;

                        })
                        tanggal = '';
                        $.map(data.tanggal, (tgl, index) => {
                            const id = index + 1;
                            tanggal += '<td width="5%" class="td-tanggal" id="tanggal' + id + '">' + splitTanggal(tgl) + '</td>';
                        })

                        j = '';
                        $.map(data.jam, (jam, index) => {
                            const id = index + 1;
                            j += '<td width="5%" class="td-jam jam' + id + '">' + jam + '</td>';
                        })

                        html += '<td style="padding:5px" class="hasil">' + data.hasil + '</td>'
                        html += '</tr>'

                    })
                    html += '</tr>'


                })
                $('#table-ews tbody').append(html)
                $('.tr-jam').append(j)
                $('.tr-tanggal').append(tanggal)
                hitungNilaiEwsMaternal(no)
            })
        }

        function hitungNilaiEwsMaternal(no) {
            let merah = '';
            let kuning = '';
            $('.hasil-ews').empty();
            let kolom = 0;
            html = '<tr style="background:yellow;" id="rowKuning">'
            html += '<th colspan=2>JUMLAH KUNING</th>'
            for (let index = 1; index < no; index++) {
                let total = 0;
                $('.baris-' + index).each(function(index, element) {
                    warna = $(element).val();
                    if (warna == 'Kuning') {
                        total++
                    }
                    kolom++;
                });
                html += `<td class="kuning-${index}" id="" onclick="tindakanEwsMaternal(${index})">`
                kuning = total;
                html += total;
                html += '</td>'
            }
            html += '</tr>'
            html += '<tr style="background:red;color:#fff" id="rowMerah">'
            html += '<th colspan=2>JUMLAH MERAH</th>'
            for (let index = 1; index < no; index++) {
                let total = 0;
                $('.baris-' + index).each(function(index, element) {
                    warna = $(element).val();
                    if (warna == 'Merah') {
                        total++
                    }
                });
                html += `<td class="merah-${index}" id="" onclick="tindakanEwsMaternal(${index})">`
                merah = total;
                html += total;
                html += '</td>'
            }


            // if (merah >= 1 || kuning >= 2) {
            //     tindakan = `<span><strong>LAPOR DPJP : Terdapat nilai <span class="text-danger">merah ${merah}</span> dan <span class="text-warning">kuning ${kuning}</span></strong></span>`
            // } else {
            //     tindakan = `-`
            // }

            tindakan = `<span><strong>Keterangan : Lapor DPJP Bila Terdapat <span class="badge bg-danger text-white" style="font-size:12px">1 Skor Merah</span> dan <span class="badge bg-warning text-dark" style="font-size:12px">2 Skor Kuning</span></strong></span>`
            html += '</tr>'
            html += '<tr>'
            html += `<th colspan=2>TINDAKAN</th>`
            html += `<td class="tindakan" colspan=${kolom+1}>${tindakan}</td>`
            html += '</tr>'

            $('#table-ews tbody').append(html)
        }

        function tindakanEwsMaternal(index) {


            const merah = $('.merah-' + index).text();
            const kuning = $('.kuning-' + index).text();
            const tanggal = $(`#tanggal${index}`).text();
            const jam = $(`.jam${index}`).text();
            // if (merah >= 1 || kuning >= 2) {
            //     tindakan = `<span><strong>Keterangan : Lapor DPJP Bila Terdapat <span class="badge bg-danger text-white" style="font-size:12px">1 Skor Merah</span> dan <span class="badge bg-warning text-dark" style="font-size:12px">2 Skor Kuning</span></strong></span>`
            // } else {
            //     tindakan = `<span><strong>Keterangan : Lapor DPJP Bila Terdapat <span class="badge bg-danger text-white" style="font-size:12px">1 Skor Merah</span> dan <span class="badge bg-warning text-dark" style="font-size:12px">2 Skor Kuning</span></strong></span>`
            // }
            tindakan = `<span><strong>Keterangan : Lapor DPJP Bila Terdapat <span class="badge bg-danger text-white" style="font-size:12px">1 Skor Merah</span> dan <span class="badge bg-warning text-dark" style="font-size:12px">2 Skor Kuning</span></strong></span>`
            $('.tindakan').html(tindakan)

        }

        function getListAsmedRajalKandungan(no_rkm_medis) {
            const asmed = $.ajax({
                url: `/erm/poliklinik/asmed/kandungan/riwayat/${no_rkm_medis}`,
                method: 'GET',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return asmed;
        }


        function getLaporanOperasi(no_rawat) {
            const laporan = $.get('/erm/operasi/laporan/detail', {
                no_rawat: no_rawat,
            });
            return laporan
        }

        function listAsmedRajalKandungan(data) {
            $('#listAsmedKandungan').empty()
            $.map(data, (a) => {
                html = `<div class="mb-3 col-lg-3 col-md-4 col-sm-12">
                       <div class="card card-shadow">
                        <p class="card-header" style="font-size:12px">Tgl. Asesmen ${formatTanggal(a.tanggal)} ${a.tanggal.split(' ')[1]} </p>
                        <div class="card-body">
                            <h6 class="card-title">${a.dokter.nm_dokter}</h6>
                            <p class="card-text"><b>(${a.reg_periksa.no_rkm_medis} ) - ${a.reg_periksa.pasien.nm_pasien} </b> <br> ${a.no_rawat} <br/> Tgl. Periksa ${formatTanggal(a.reg_periksa.tgl_registrasi)}</p>
                            <a href="/erm/poliklinik/asmed/kandungan/print/${textRawat(a.no_rawat, '-')}" target="_blank" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i> Lihat</a>
                            <a href="javascript:void(0)" onclick="setAsmedRajalKandungan('${a.no_rawat}')" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                            </div>
                            </div>
                         </div>`
                $('#listAsmedKandungan').append(html)
            })
        }

        function getAsmedRanapKandungan(noRawat) {
            const asmedKebidanan = $.ajax({
                url: '/erm/asmed/ranap/kandungan/' + textRawat(noRawat, '-'),
                dataType: 'JSON',
                method: 'GET',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            });

            return asmedKebidanan;
        }

        function getAsmedRanapAnak(noRawat) {
            const asmed = $.ajax({
                url: '/erm/asmed/ranap/anak/' + textRawat(noRawat, '-'),
                dataType: 'JSON',
                method: 'GET',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })

            return asmed;
        }

        function getAsmedUgd(no_rawat) {
            const txtNoRawat = textRawat(no_rawat, '-');
            const asmed = $.get(`/erm/ugd/asesmen/medis/${txtNoRawat}`).fail((request) => {
                alertSessionExpired(request.status)
            })
            return asmed;
        }

        function getAskepRanapAnak(no_rawat) {
            const askep = $.ajax({
                url: '/erm/ranap/askep/anak',
                method: 'GET',
                data: {
                    no_rawat: no_rawat,
                },
            })

            return askep;
        }

        function getAskepUgd(no_rawat) {
            const askep = $.get('/erm/ugd/asesmen/keperawatan', {
                no_rawat: no_rawat
            });

            return askep;
        }

        function getTriase(no_rawat) {
            const triase = $.get('/erm/triase/get', {
                no_rawat: no_rawat
            });
            return triase;
        }

        function getAskepRalanAnak(no_rawat) {
            const askep = $.get('/erm/poliklinik/askep/anak/detail', {
                no_rawat: no_rawat
            });
            return askep;
        }

        function getAskepRalanKandungan(no_rawat) {
            const askep = $.get(`/erm/poliklinik/askep/kebidanan/${textRawat(no_rawat)}`);
            return askep;
        }

        function notifSend(topics, title, body, no_rawat, kategori) {
            $.ajax({
                url: APIURL + '/notification/send',
                data: {
                    "topic": topics,
                    "title": title,
                    "body": body,
                    "data": {
                        "no_rawat": no_rawat,
                        "kategori": kategori,
                    }
                },
                method: 'POST',
                dataType: 'JSON',
                error: (request) => {
                    console.log(request);
                },
                success: (response) => {
                    console.log(response);
                }
            });
        }

        function renderListsAsesmenNyeri(tgl_lahir, tgl_daftar, no_rawat) {

            const umur = hitungUmurDaftar(tgl_lahir, tgl_daftar)

            const totalHari = Number((umur.tahun * 365)) + Number((umur.bulan * 28)) + Number(umur.hari)
            let list = '';
            if (totalHari <= 28) {
                list = `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalAsesmenNyeriNeonatus('${no_rawat}')">Asesmen Nyeri Neonatus</a></li>`;
            } else if (totalHari <= 3 * 365) {
                // Batita
                list = `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalAsesmenNyeriBatita('${no_rawat}')">Asesmen Nyeri Anak</a></li>`;
            } else if (totalHari <= 7 * 365) {
                // Balita
                list = `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalAsesmenNyeriBalita('${no_rawat}')">Asesmen Nyeri Anak</a></li>`
            } else if (totalHari <= 13 * 365) {
                // Anak
                list = `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalAsesmenNyeriAnak('${no_rawat}')">Asesmen Nyeri Anak</a></li>`
            } else {
                // Dewasa
                list = `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalAsesmenNyeriDewasa('${no_rawat}')">Asesmen Nyeri Dewasa</a></li>`
            }

            return list;
        }
    </script>
    @stack('script')
</body>

</html>
