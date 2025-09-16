<div class="modal fade" id="modalPenunjangRanap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-body">
                <h5 class="text-center">BERKAS PEMERIKSAAN PENUNJANG</h5>
                <div id="berkas">
                    @include('content.upload.inforegistrasi')
                    @include('content.upload.resume')
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanSoap()"><i class="bi bi-save"></i>
                    Simpan</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        // function modalPenunjangRanap(no_rawat) {
        //     detailPeriksa(no_rawat, 'Ranap');
        //     $.ajax({
        //         url: 'registrasi/foto',
        //         data: {
        //             'no_rawat': no_rawat,
        //         },
        //         success: function(response) {
        //             console.log(response)
        //         }
        //     })

        //     $('#modalPenunjangRanap').modal('show')

        // }

        // $('#modalPenunjangRanap').on('hidden.bs.modal', function() {
        //     // $('#tabel-lab').empty()
        // })

        const formUploadPenunjang = $('#formUploadPenunjang');

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

                    formUploadPenunjang.find('#no_rawat').val(data.no_rawat)
                    formUploadPenunjang.find('#no_rkm_medis').val(data.no_rkm_medis)
                    formUploadPenunjang.find('#tgl_masuk').val(data.tgl_registrasi)
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

        function uploadBerkas() {
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
                no_rawat: formUploadPenunjang.find('#no_rawat').val(),
                no_rkm_medis: formUploadPenunjang.find('#no_rkm_medis').val(),
                images: images,
                tgl_masuk: formUploadPenunjang.find('#tgl_masuk').val(),
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses !',
                        text: 'Data Berhasil Diproses',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    // reloadTabelPoli();

                },
                fail: function(jqXHR, status) {
                    // console.log(status)
                }
            })

        }
    </script>
@endpush
