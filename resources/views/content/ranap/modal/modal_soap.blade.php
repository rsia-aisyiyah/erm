<div class="modal fade" id="modalSoapRanap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">PEMERIKSAAN PASIEN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gy-2 mb-2" id="formInfoPasien">
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">
                                <label for="">No Rawat</label>
                            </span>
                            <input type="text" class="form-control form-control-sm" style="font-size: 11px"
                                   id="no_rawat" name="no_rawat" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">
                                <label for="">Pasien</label>
                            </span>
                            <input type="text" class="form-control form-control-sm" style="font-size: 11px"
                                   id="no_rkm_medis" name="no_rkm_medis" placeholder="" readonly>
                            <input type="text" class="form-control form-control-sm w-50" style="font-size: 11px"
                                   id="pasien" name="pasien" placeholder="" readonly>
                            <input type="text" class="form-control form-control-sm" style="font-size: 11px" id="umur"
                                   name="umur" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">
                                <label for="">Kamar</label>
                            </span>
                            <input type="text" class="form-control form-control-sm" style="font-size: 11px" id="kamar"
                                   name="kamar" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">
                                <label for="">Dx Awal</label>
                            </span>
                            <input type="text" class="form-control form-control-sm" style="font-size: 11px"
                                   id="diagnosa_awal" name="diagnosa_awal" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">
                                <label for="">DPJP</label>
                            </span>
                            <input type="text" class="form-control form-control-sm" style="font-size: 11px"
                                   id="dokter_dpjp" name="dokter_dpjp" placeholder="" readonly>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="tab-soap-ranap" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-soap" data-bs-toggle="tab"
                                data-bs-target="#tab-soap-pane" type="button" role="tab" aria-controls="tab-soap-pane"
                                aria-selected="true">SOAP
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-tabel" data-bs-toggle="tab" data-bs-target="#tab-tabel-pane"
                                type="button" role="tab" aria-controls="tab-tabel-pane" aria-selected="false">Riwayat
                            S.O.A.P
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-grafik" data-bs-toggle="tab" data-bs-target="#tab-grafik-pane"
                                type="button" role="tab" aria-controls="tab-grafik-pane" aria-selected="false">Grafik
                            Pasien
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-ews" data-bs-toggle="tab" data-bs-target="#tab-ews-pane"
                                type="button" role="tab" aria-controls="tab-ews-pane" aria-selected="false">EWS
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-resep" data-bs-toggle="tab" data-bs-target="#tab-resep-pane"
                                type="button" role="tab" aria-controls="tab-resep-pane" aria-selected="false">Resep
                        </button>
                    </li>
                    <li class="nav-item d-none" role="presentation">
                        <button class="nav-link" id="tabAsuhanGiziDewasa" data-bs-toggle="tab"
                                data-bs-target="#tabAsuhanGiziDewasa-pane"
                                type="button" role="tab" aria-controls="tabAsuhanGiziDewasa-pane" aria-selected="false">
                            Asuhan Gizi Dewasa
                        </button>
                    </li>
                    <li class="nav-item d-none" role="presentation">
                        <button class="nav-link" id="tabAsuhanGiziAnak" data-bs-toggle="tab"
                                data-bs-target="#tabAsuhanGiziAnak-pane"
                                type="button" role="tab" aria-controls="tabAsuhanGiziAnak-pane" aria-selected="false">
                            Asuhan Gizi Anak
                        </button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="tab-soap-pane" role="tabpanel"
                         aria-labelledby="home-tab" tabindex="0">
                        @include('content.ranap.modal.cppt._form_soap')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-tabel-pane" role="tabpanel" aria-labelledby="tab-tabel"
                         tabindex="0">
                        @include('content.ranap.modal.cppt._table_soap')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-ews-pane" role="tabpanel" aria-labelledby="tab-ews"
                         tabindex="0">
                        @include('content.ranap.modal.cppt._ewsRanap')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-resep-pane" role="tabpanel" aria-labelledby="tab-resep"
                         tabindex="0">
                        @include('content.ranap.modal.cppt._resep')
                    </div>
                    <div class="tab-pane fade" id="tab-grafik-pane" role="tabpanel" aria-labelledby="tab-grafik"
                         tabindex="0">
                        @include('content.ranap.modal.cppt._grafikPemeriksaan')
                    </div>
                    <div class="tab-pane fade" id="tabAsuhanGiziDewasa-pane" role="tabpanel"
                         aria-labelledby="tabAsuhanGiziDewasa"
                         tabindex="0">
                        @include('content.ranap.modal.cppt._formAsuhanGiziDewasa')
                    </div>
                    <div class="tab-pane fade" id="tabAsuhanGiziAnak-pane" role="tabpanel"
                         aria-labelledby="tabAsuhanGiziAnak"
                         tabindex="0">
                        @include('content.ranap.modal.cppt._formAsuhanGiziAnak')
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px"><i
                            class="bi bi-x-circle"></i> Keluar
                </button>

            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        let no_rawat_soap = '';
        const tgl_pertama = '';
        const tgl_kedua = '';
        let getInstance = '';
        let sel = '';

        const formSoapRanap = $('#formSoapRanap')

        const tabSoapRanap = document.querySelector('#tab-soap-ranap li:first-child button')
        const modalSoapRanap = $('#modalSoapRanap')

        const departemen = "{{ session()->get('pegawai')->departemen }}";
        const formInfoPasien = $('#formInfoPasien')

        modalSoapRanap.on('hidden.bs.modal', () => {
            const elementInput = $('input');
            bootstrap.Tab.getInstance(tabSoapRanap).show()
            elementInput.hasClass('is-valid') && elementInput.removeClass('is-valid');
            formAsuhanGiziDewasa.trigger('reset')
            formAsuhanGiziAnak.trigger('reset')
        })

        modalSoapRanap.on('shown.bs.modal', () => {

            if (departemen === 'CSM' || departemen === '-') {
                $('#tgl_perawatan_ubah').removeAttr('disabled');
                $('#jam_rawat_ubah').removeAttr('disabled');
            } else {
                $('#tgl_perawatan_ubah').attr('disabled', 'true');
                $('#jam_rawat_ubah').attr('disabled', 'true');
            }

            date = new Date()
            const hari = ('0' + (date.getDate())).slice(-2);
            const bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            const tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;

            const canvasSuhu = $('#grafik-suhu');

            sel = document.querySelector('#tab-tabel')
            getInstance = bootstrap.Tab.getInstance(sel);
            jamSekarang = setInterval(() => {
                $('#jam_rawat_ubah').val(getJam())
            }, 1000);

            $('#tgl_perawatan_ubah').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                setDate: dateStart,
            });

            $('#tgl_perawatan_ubah').datepicker('setDate', dateStart)
        })

        function getDetailPemeriksaanRanap(no_rawat, tgl, jam) {
            const pemeriksaan = $.ajax({
                url: '/erm/soap/ambil',
                data: {
                    'no_rawat': no_rawat,
                    'tgl_perawatan': tgl,
                    'jam_rawat': jam
                },
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return pemeriksaan;
        }


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

        $('#btn-reset').on('click', function (event) {
            no_rawat =formSoapRanap.find('input[name="nomor_rawat"]').val();
           formSoapRanap.find('input').each((index, element) => {
                $(element).val('-');
                $(element).removeAttr('readonly');
                $('#jam_rawat').val('');
                $('#tgl_perawatan').val('');
            })
           formSoapRanap.find('textarea').each((index, element) => {
                $(element).val('-')
            });

           formSoapRanap.find('textarea').removeAttr('readonly')
           formSoapRanap.find('select').removeAttr('disabled', false)

            getRegPeriksa(no_rawat).done((response) => {

               formSoapRanap.find('input[name="nomor_rawat"]').val(response.no_rawat)
               formSoapRanap.find('input[name="nm_pasien"]').val(`${response.pasien.nm_pasien} (${hitungUmur(response.pasien.tgl_lahir)})`)
               formSoapRanap.find('input[name="nama"]').val("{{ session()->get('pegawai')->nama }}")
               formSoapRanap.find('input[name="nik"]').val("{{ session()->get('pegawai')->nik }}")

               formSoapRanap.find('input[name="nomor_rawat"]').attr('readonly', true)
               formSoapRanap.find('input[name="nm_pasien"]').attr('readonly', true)
               formSoapRanap.find('input[name="nama"]').attr('readonly', true)
               formSoapRanap.find('input[name="nik"]').attr('readonly', true)
            })


            $('#btn-reset').css('display', 'none')
            $('#btn-ubah').css('display', 'none')

        });

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
                            '_token': '{{ csrf_token() }}',
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
                                $('#tbSoap').DataTable().destroy();
                                tbSoapRanap(no, tgl_pertama, tgl_kedua);
                                grafikPemeriksaan.destroy();
                                buildGrafik(no)
                                setEws(no, 'ranap',formSoapRanap.find('input[name=spesialis]').val())
                            }
                        }
                    })

                }
            })

        }

        function editSoap() {
            const triggerResetForm = formSoapRanap.trigger('reset') ;
            if(triggerResetForm){

            }
            $.ajax({
                url: 'soap/ubah',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'suhu_tubuh': $('#suhu').val(),
                    'nip': $('#nik').val(),
                    'no_rawat': $('#nomor_rawat').val(),
                    'jam_rawat': $('#jam_rawat').val(),
                    'tgl_perawatan': $('#tgl_perawatan').val(),
                    'tinggi': $('#tinggi').val(),
                    'berat': $('#berat').val(),
                    'respirasi': $('#respirasi').val(),
                    'tensi': $('#tensi').val(),
                    'nadi': $('#nadi').val(),
                    'kesadaran': $('#kesadaran option:selected').val(),
                    'spo2': $('#spo2').val(),
                    'o2': $('#o2').val(),
                    'gcs': $('#gcs').val(),
                    'alergi': $('#alergi').val(),
                    'keluhan': $('#subjek').val(),
                    'pemeriksaan': $('#objek').val(),
                    'penilaian': $('#asesmen').val(),
                    'rtl': $('#plan').val(),
                    'evaluasi': $('#plan').val(),
                    'instruksi': $('#instruksi').val(),
                    'tgl_perawatan_ubah': splitTanggal($('#tgl_perawatan_ubah').val()),
                    'jam_rawat_ubah': $('#jam_rawat_ubah').val(),
                },
                method: 'POST',
                beforeSend: function () {
                    swal.fire({
                        title: 'Sedang mengirim data',
                        text: 'Mohon Tunggu',
                        showConfirmButton: false,
                        didOpen: () => {
                            swal.showLoading();
                        }
                    })
                },
                error: (request, status, error) => {
                    Swal.fire(
                        'Gagal !',
                        `Tidak bisa mengubah pemeriksaan<br/> Kode ${request.status} : ${request.statusText} `,
                        'error',
                    )
                },
                success: function (response) {
                    if (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'SUKSES !',
                            text: 'Data Berhasil Diubah',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#tbSoap').DataTable().destroy();
                        tbSoapRanap(no_rawat_soap, tgl_pertama, tgl_kedua);
                        grafikPemeriksaan.destroy();
                        buildGrafik(no_rawat_soap)
                        setEws(no_rawat_soap, 'ranap',formSoapRanap.find('input[name=spesialis]').val())
                        getInstance.show();
                        const isTriggering = formSoapRanap.reset('triger');
                        $('#btn-ubah').css('display', 'none')
                        $('#btn-reset').css('display', 'none')
                    } else {
                        Swal.fire({
                            icon: 'danger',
                            title: 'GAGAL !',
                            text: 'Data Gagal Diubah',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }


                }
            })
        }

        function cariSoap() {
            const tgl_pertama = splitTanggal($('.tgl_pertama_soap').val());
            const tgl_kedua = splitTanggal($('.tgl_kedua_soap').val());
            petugas = $('#petugas option:selected').val();
            $('#tbSoap').DataTable().destroy();
            tbSoapRanap(no_rawat_soap, tgl_pertama, tgl_kedua, petugas);
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
                        $('#tbSoap').DataTable().destroy();
                        tbSoapRanap(no_rawat);
                    })
                }
            });
        }

        function simpanSoapRanap() {

            const no_rawat = modalSoapRanap.find('input[name=no_rawat]').val();
            let kd_dokter =formSoapRanap.find('.btn-simpan').attr('data-kd-dokter');
            let spesialis =formSoapRanap.find('.btn-simpan').attr('data-spesialis');
            let nm_pasien =formSoapRanap.find('.btn-simpan').attr('data-nm-pasien');
            $.ajax({
                url: '/erm/soap/simpan',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'suhu_tubuh': $('#suhu').val(),
                    'nip': $('#nik').val(),
                    'no_rawat': no_rawat,
                    'tinggi': $('#tinggi').val(),
                    'berat': $('#berat').val(),
                    'respirasi': $('#respirasi').val(),
                    'nadi': $('#nadi').val(),
                    'tensi': $('#tensi').val(),
                    'spo2': $('#spo2').val(),
                    'gcs': $('#gcs').val(),
                    'o2': $('#o2').val(),
                    'kesadaran': $('#kesadaran option:selected').val(),
                    'alergi': $('#alergi').val(),
                    'keluhan': $('#subjek').val(),
                    'pemeriksaan': $('#objek').val(),
                    'penilaian': $('#asesmen').val(),
                    'rtl': $('#plan').val(),
                    'instruksi': $('#instruksi').val(),
                    'keluaran_urin': $('.formEws select[name=keluaran_urin]').val(),
                    'proteinuria': $('.formEws select[name=proteinuria]').val(),
                    'air_ketuban': $('.formEws select[name=air_ketuban]').val(),
                    'skala_nyeri': $('.formEws select[name=skala_nyeri]').val(),
                    'lochia': $('.formEws select[name=lochia]').val(),
                    'terlihat_tidak_sehat': $('.formEws select[name=terlihat_tidak_sehat]').val(),
                },
                method: 'POST',
                beforeSend: function () {
                    swal.fire({
                        title: 'Sedang mengirim data',
                        text: 'Mohon Tunggu',
                        showConfirmButton: false,
                        didOpen: () => {
                            swal.showLoading();
                        }
                    })
                },
                success: function (response) {
                    if (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'SUKSES !',
                            text: 'Data Berhasil Ditambah',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('#tbSoap').DataTable().destroy();
                            tbSoapRanap(no_rawat_soap, tgl_pertama, tgl_kedua);
                            grafikPemeriksaan.destroy();
                            buildGrafik(no_rawat_soap)
                            setEws(no_rawat_soap, 'ranap',formSoapRanap.find('input[name=spesialis]').val())
                           formSoapRanap.find('textarea[name=subjek]').val('-');
                           formSoapRanap.find('textarea[name=objek]').val('-');
                           formSoapRanap.find('textarea[name=asesmen]').val('-');
                           formSoapRanap.find('textarea[name=plan]').val('-');
                           formSoapRanap.find('textarea[name=instruksi]').val('-');
                           formSoapRanap.find('input[name=suhu]').val('-');
                           formSoapRanap.find('input[name=tinggi]').val('-');
                           formSoapRanap.find('input[name=berat]').val('-');
                           formSoapRanap.find('input[name=tensi]').val('-');
                           formSoapRanap.find('input[name=respirasi]').val('-');
                           formSoapRanap.find('input[name=nadi]').val('-');
                           formSoapRanap.find('input[name=spo2]').val('-');
                           formSoapRanap.find('input[name=gcs]').val('-');
                           formSoapRanap.find('input[name=o2]').val('-');
                           formSoapRanap.find('input[name=alergi]').val('-');
                           formSoapRanap.find('select[name=kesadaran]').val('Compos Mentis').change();
                            getInstance.show()
                        });

                        var suhu_tubuh = $('#suhu').val();
                        if (suhu_tubuh.includes(',')) {
                            suhu_tubuh = suhu_tubuh.replace(',', '.');
                        }

                        if (spesialis.toLowerCase().includes('anak')) {
                            console.log('anak');
                            if (suhu_tubuh < 35.5 || suhu_tubuh > 39.5) {
                                console.log('kirim notif');
                                notifSend(
                                    // FIXME : kd_dokter masih belum benar
                                    kd_dokter,
                                    'Notifikasi Kondisi Pasien',
                                    'Suhu tubuh ' + suhu_tubuh + '°, pasien atas nama : ' + nm_pasien,
                                    $('#nomor_rawat').val(),
                                    'Ranap',
                                    'detail'
                                );
                            }
                        } else {
                            console.log('bukan anak');
                            if (suhu_tubuh < 36 || suhu_tubuh > 38) {
                                console.log('kirim notif');
                                notifSend(
                                    // FIXME : kd_dokter masih belum benar
                                    kd_dokter,
                                    'Notifikasi Kondisi Pasien',
                                    'Suhu tubuh ' + suhu_tubuh + '°, pasien atas nama : ' + nm_pasien,
                                    $('#nomor_rawat').val(),
                                    'Ranap',
                                    'detail'
                                );
                            }
                        }


                    } else {
                        Swal.fire({
                            icon: 'danger',
                            title: 'GAGAL !',
                            text: 'Data Gagal Ditambah',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                },
                error: (request) => {
                    alertErrorAjax(request);
                }
            })
        }

        function setFormData(data) {
            for (let key in data) {
                if (data.hasOwnProperty(key)) {
                    let fields = document.querySelectorAll(`[name="${key}"]`);

                    if (fields.length > 0) {
                        fields.forEach(field => {
                            if (field.type === 'checkbox' || field.type === 'radio') {
                                field.checked = data[key] == field.value;
                            } else {
                                field.value = data[key];
                            }
                        });
                    }
                }
            }
        }
    </script>
@endpush
