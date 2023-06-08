<!doctype html>
<html lang="en">
@include('layout.head')

<body>
    <style>
        /* .container-fluid {
            background-image: url("https://sim.rsiaaisyiyah.com/rsiap/assets/images/wa7.png") !important;
        } */

        table {
            font-size: 12px;
        }

        table td {
            vertical-align: middle;
        }

        .borderless th,
        .borderless td {
            border: none;
            height: 5px !important;
            padding: 5px !important;
        }

        .form-soap .form-control {
            border-color: #a5a5a5;
        }

        .modal-content {
            border-radius: 0px;
        }

        .card,
        .card-header {
            border-radius: 0px !important;
        }

        .nav-tabs .nav-link {
            border: 0px !important;
            border-radius: 0px !important;
        }

        .nav-tabs .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }


        .nav-link {
            font-size: 12px;
            padding: 8px;
            border-radius: 0px !important;
        }

        @media (max-width: 400px) {
            .tb-askep {
                font-size: 9px !important;
            }

            .modal-riwayat table {
                font-size: 9px !important;
            }

            #modalSoap table,
            #modalSoap form input,
            #modalSoap form select,
            #modalSoap form textarea {
                font-size: 10px !important;
            }
        }

        .form-control-sm {
            font-size: 12px;
            min-height: 12px;
            border-radius: 0;
        }

        .form-underline {
            border: none;
            border-bottom: 1px solid #e9e9e9;
        }

        .form-underline:focus {
            border-bottom: 1px dashed #ececec;
            box-shadow: none;
            transition: background-size .3s ease;
            ;
        }
    </style>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
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
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        {{ (Request::segment(1) == null ? 'DASHBOARD' : Request::segment(1) == 'ranap') ? 'Rawat Inap' : strtoupper(Request::segment(1)) }}
                    </h1>
                </div>
                @yield('contents')
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.2.1/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.6.0/js/dataTables.select.min.js"></script>
    <script src="{{ asset('js/jquery.toast.min.js') }}"></script>


    <script src="{{ asset('js/dashboard.js') }}"></script>


    <script>
        $(document).ready(function() {
            // hitungPanggilan();
        })

        function ambilNoRawat(no_rawat) {
            id = no_rawat;
        }

        function ambilNoRm(no_rkm_medis) {
            no_rm = no_rkm_medis;
        }

        function removeZero(input) {
            if (input.value == '-') {
                $(input).val('');
            }
        }

        function cekKosong(input) {
            if (input.value == '') {
                $(input).val('-');
            }
        }

        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

                return false;
            return true;
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
            return tanggal = t.getDate() + ' ' + bulan + ' ' + t.getFullYear();
        }

        function isKosong(x, satuan = '') {
            return x ? x + satuan : '-';
        }


        function textRawat(no_rawat) {
            let splitNoRawat = no_rawat.split('/');
            textNoRawat = splitNoRawat.join('');
            return textNoRawat;

        }

        function detailPeriksa(no_rawat, status) {

            $('#upload-image').css('visibility', 'hidden')
            $('#form-upload').css('visibility', 'visible')
            $('#image .tmb').detach()
            $.ajax({
                url: '/erm/periksa/detail?no_rawat=' + no_rawat,
                method: "GET",
                dataType: 'JSON',
                success: function(data) {
                    console.log(data)
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
                            '<input type="radio" class="btn-check" name="kategori" id="opt-lain" autocomplete="off" onclick="showForm()" value="lainnya"><label class="btn btn-outline-primary btn-sm" for="opt-lain">Lainnya</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-legalisasi" autocomplete="off" onclick="showForm()" value="legalisasi"><label class="btn btn-outline-primary btn-sm" for="opt-legalisasi">Surat Legalisasi</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-km" autocomplete="off" onclick="showForm()" value="km"><label class="btn btn-outline-primary btn-sm" for="opt-km">Foto KM</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-form-rujukan" autocomplete="off" onclick="showForm()" value="form-rujukan"><label class="btn btn-outline-primary btn-sm" for="opt-form-rujukan">Form Rujukan</label>'

                        $('#button-form').append(html)
                    }
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
                        console.log(input.files[index].type);
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


        function reloadTabelPoli() {
            hitungPanggilan();
            $('#tb_pasien').DataTable().destroy();
            tb_pasien();
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
                kategori: $('input[type="radio"]:checked').val(),
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
                        $('#tb_pasien').DataTable().destroy();
                        tb_pasien();
                    }
                    showForm(data.no_rawat, data.kategori);
                    Swal.fire(
                        'Berhasil!', 'Berkas sudah terupload di server', 'success'
                    )
                    reloadTabelPoli();

                },
                fail: function(jqXHR, status) {
                    console.log(status)
                }
            })

        }
        $('#submit').click(function() {})

        function hiddenForm() {
            $('#upload-image').css('visibility', 'hidden')
        }

        function showHistory() {
            var no_rkm_medis = $('.search option:selected').val();
            $('#upload-image').css('visibility', 'hidden');
            $.ajax({
                url: '/erm/periksa/show/' + no_rkm_medis,
                dataType: 'JSON',
                success: function(data) {
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
                }
            });

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
                                tb_pasien();
                                hitungUpload();
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
    </script>
    @stack('script')
</body>

</html>
