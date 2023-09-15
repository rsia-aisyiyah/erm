<div class="modal fade" id="modalSoapRanap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">PEMERIKSAAN PASIEN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="tab-soap-ranap" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-soap" data-bs-toggle="tab"
                            data-bs-target="#tab-soap-pane" type="button" role="tab" aria-controls="tab-soap-pane"
                            aria-selected="true">SOAP</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-tabel" data-bs-toggle="tab" data-bs-target="#tab-tabel-pane"
                            type="button" role="tab" aria-controls="tab-tabel-pane" aria-selected="false">Data
                            Pemeriksaan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-grafik" data-bs-toggle="tab" data-bs-target="#tab-grafik-pane"
                            type="button" role="tab" aria-controls="tab-grafik-pane" aria-selected="false">Grafik
                            Pasien</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-ews" data-bs-toggle="tab" data-bs-target="#tab-ews-pane"
                            type="button" role="tab" aria-controls="tab-ews-pane" aria-selected="false">EWS</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-resep" data-bs-toggle="tab" data-bs-target="#tab-resep-pane"
                            type="button" role="tab" aria-controls="tab-resep-pane" aria-selected="false">Resep</button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="tab-soap-pane" role="tabpanel"
                        aria-labelledby="home-tab" tabindex="0">
                        @include('content.ranap.modal._form_soap')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-tabel-pane" role="tabpanel" aria-labelledby="tab-tabel"
                        tabindex="0">
                        @include('content.ranap.modal._table_soap')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-ews-pane" role="tabpanel" aria-labelledby="tab-ews"
                        tabindex="0">
                        <h5 style="margin-bottom:0px">EARLY WARNING SYSTEM (EWS)</h5>
                        <h5 style="" class="kategori mb-3"></h5>
                        <table class="table table-sm table-bordered table-responsive" id="table-ews" width="100%">
                            <thead>
                                <tr class="tr-tanggal">
                                    <th width="15%" colspan="2">Tanggal</th>
                                </tr>
                                <tr class="tr-jam">
                                    <th colspan="2">Jam</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                        <div class="hasil-ews">

                        </div>
                    </div>
                    <div class="tab-pane fade p-3" id="tab-resep-pane" role="tabpanel" aria-labelledby="tab-resep"
                        tabindex="0">
                        @include('content.ranap.modal._resep')
                    </div>
                    <div class="tab-pane fade" id="tab-grafik-pane" role="tabpanel" aria-labelledby="tab-grafik"
                        tabindex="0">
                        <div class="p-3 w-full d-flex justify-content-end">
                            <button type="button" class="btn btn-success btn-sm btn-tambah-grafik-harin"
                                onclick="modalGrafikHarian()" style="font-size: 12px"><i
                                    class="bi bi-bar-chart-line"></i> Tambah Grafik</button>
                        </div>
                        <canvas id="grafik-suhu" style="max-height: 400px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px"><i
                        class="bi bi-x-circle"></i> Keluar</button>

            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        var no_rawat_soap = '';
        var tgl_pertama = '';
        var tgl_kedua = '';
        var getInstance = '';
        var sel = '';
        var jamSekarang = '';
        var departemen = "{{ session()->get('pegawai')->departemen }}";

        $('#jam_rawat_ubah').on('focus', () => {
            clearInterval(jamSekarang)
        })

        $('#jam_rawat_ubah').on('focusout', (e) => {
            if ($('#jam_rawat_ubah').val() == getJam() || $('#jam_rawat_ubah').val() == '') {
                jamSekarang = setInterval(() => {
                    $('#jam_rawat_ubah').val(getJam())
                }, 1000);
            } else {
                clearInterval(jamSekarang)
            }
            console.log($('#jam_rawat_ubah').val());
        })

        $('#jam_rawat_ubah').on('keyup', (e) => {
            clearInterval(jamSekarang)
        })

        $('#modalSoapRanap').on('shown.bs.modal', () => {

            if (departemen == 'CSM' || departemen == '-') {
                $('#tgl_perawatan_ubah').removeAttr('disabled');
                $('#jam_rawat_ubah').removeAttr('disabled');
            } else {
                $('#tgl_perawatan_ubah').attr('disabled', 'true');
                $('#jam_rawat_ubah').attr('disabled', 'true');
            }

            date = new Date()
            hari = ('0' + (date.getDate())).slice(-2);
            bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;

            const canvasSuhu = $('#grafik-suhu');
            new bootstrap.Tab('#tab-resep')
            new bootstrap.Tab('#tab-ews')
            new bootstrap.Tab('#tab-grafik')
            new bootstrap.Tab('#tab-tabel')

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
                    if (request.status == 401) {
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
            })
            return pemeriksaan;
        }


        function ambilSoap(no_rawat, tgl, jam) {
            getDetailPemeriksaanRanap(no_rawat, tgl, jam).done((response) => {
                clearInterval(jamSekarang);
                $('#formSoapRanap input[name=tgl_perawatan_ubah]').val(splitTanggal(response.tgl_perawatan));
                $('#formSoapRanap input[name=jam_rawat_ubah]').val(response.jam_rawat);
                $('#formSoapRanap input[name=tgl_perawatan]').val(response.tgl_perawatan);
                $('#formSoapRanap input[name=jam_rawat]').val(response.jam_rawat);
                $('#suhu').val(response.suhu_tubuh);
                $('#tinggi').val(response.tinggi);
                $('#berat').val(response.berat);
                $('#tensi').val(response.tensi);
                $('#respirasi').val(response.respirasi);
                $('#nadi').val(response.nadi);
                $('#spo2').val(response.spo2);
                $('#gcs').val(response.gcs);

                $.map(response.grafik_harian, function(grafik) {
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
                let tabForm = document.querySelector('#tab-soap-ranap li:first-child button')
                bootstrap.Tab.getInstance(tabForm).show()
            })
        }

        $('#btn-reset').on('click', function(event) {
            no_rawat = $('#formSoapRanap input[name="nomor_rawat"]').val();
            $('#formSoapRanap input').each((index, element) => {
                $(element).val('-');
                $(element).removeAttr('readonly');
                $('#jam_rawat').val('');
                $('#tgl_perawatan').val('');
            })
            $('#formSoapRanap textarea').each((index, element) => {
                $(element).val('-')
            });

            $('#formSoapRanap textarea').removeAttr('readonly')
            $('#formSoapRanap select').removeAttr('disabled', false)

            getRegPeriksa(no_rawat).done((response) => {

                $('#formSoapRanap input[name="nomor_rawat"]').val(response.no_rawat)
                $('#formSoapRanap input[name="nm_pasien"]').val(`${response.pasien.nm_pasien} (${hitungUmur(response.pasien.tgl_lahir)})`)
                $('#formSoapRanap input[name="nama"]').val("{{ session()->get('pegawai')->nama }}")
                $('#formSoapRanap input[name="nik"]').val("{{ session()->get('pegawai')->nik }}")

                $('#formSoapRanap input[name="nomor_rawat"]').attr('readonly', true)
                $('#formSoapRanap input[name="nm_pasien"]').attr('readonly', true)
                $('#formSoapRanap input[name="nama"]').attr('readonly', true)
                $('#formSoapRanap input[name="nik"]').attr('readonly', true)
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
                        success: function(response) {
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
                                setEws(no, 'ranap', $('#formSoapRanap input[name=spesialis]').val())
                            }
                        }
                    })

                }
            })

        }

        function editSoap() {
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
                beforeSend: function() {
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
                    console.log(request);
                    Swal.fire(
                        'Gagal !',
                        `Tidak bisa mengubah pemeriksaan<br/> Kode ${request.status} : ${request.statusText} `,
                        'error',
                    )
                },
                success: function(response) {
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
                        setEws(no_rawat_soap, 'ranap', $('#formSoapRanap input[name=spesialis]').val())
                        getInstance.show()
                        $('#formSoapRanap textarea[name=subjek]').val('-');
                        $('#formSoapRanap textarea[name=objek]').val('-');
                        $('#formSoapRanap textarea[name=asesmen]').val('-');
                        $('#formSoapRanap textarea[name=plan]').val('-');
                        $('#formSoapRanap textarea[name=instruksi]').val('-');
                        $('#formSoapRanap input[name=suhu]').val('-');
                        $('#formSoapRanap input[name=tinggi]').val('-');
                        $('#formSoapRanap input[name=berat]').val('-');
                        $('#formSoapRanap input[name=tensi]').val('-');
                        $('#formSoapRanap input[name=respirasi]').val('-');
                        $('#formSoapRanap input[name=nadi]').val('-');
                        $('#formSoapRanap input[name=spo2]').val('-');
                        $('#formSoapRanap input[name=gcs]').val('-');
                        $('#formSoapRanap input[name=o2]').val('-');
                        $('#formSoapRanap input[name=alergi]').val('-');
                        $('#formSoapRanap select[name=kesadaran]').val('Compos Mentis').change();
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
            tgl_pertama = splitTanggal($('.tgl_pertama_soap').val());
            tgl_kedua = splitTanggal($('.tgl_kedua_soap').val());
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

            let pasien = $('#nomor_rawat').val();
            let splitPasien = pasien.split(' - ');
            let no = splitPasien[0];

            $.ajax({
                url: '/erm/soap/simpan',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'suhu_tubuh': $('#suhu').val(),
                    'nip': $('#nik').val(),
                    'no_rawat': $('#nomor_rawat').val(),
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
                beforeSend: function() {
                    swal.fire({
                        title: 'Sedang mengirim data',
                        text: 'Mohon Tunggu',
                        showConfirmButton: false,
                        didOpen: () => {
                            swal.showLoading();
                        }
                    })
                },
                success: function(response) {
                    if (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'SUKSES !',
                            text: 'Data Berhasil Ditambah',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $('#tbSoap').DataTable().destroy();
                        tbSoapRanap(no_rawat_soap, tgl_pertama, tgl_kedua);
                        grafikPemeriksaan.destroy();
                        buildGrafik(no_rawat_soap)
                        setEws(no_rawat_soap, 'ranap', $('#formSoapRanap input[name=spesialis]').val())
                        $('#formSoapRanap textarea[name=subjek]').val('-');
                        $('#formSoapRanap textarea[name=objek]').val('-');
                        $('#formSoapRanap textarea[name=asesmen]').val('-');
                        $('#formSoapRanap textarea[name=plan]').val('-');
                        $('#formSoapRanap textarea[name=instruksi]').val('-');
                        $('#formSoapRanap input[name=suhu]').val('-');
                        $('#formSoapRanap input[name=tinggi]').val('-');
                        $('#formSoapRanap input[name=berat]').val('-');
                        $('#formSoapRanap input[name=tensi]').val('-');
                        $('#formSoapRanap input[name=respirasi]').val('-');
                        $('#formSoapRanap input[name=nadi]').val('-');
                        $('#formSoapRanap input[name=spo2]').val('-');
                        $('#formSoapRanap input[name=gcs]').val('-');
                        $('#formSoapRanap input[name=o2]').val('-');
                        $('#formSoapRanap input[name=alergi]').val('-');
                        $('#formSoapRanap select[name=kesadaran]').val('Compos Mentis').change();

                        getInstance.show()
                    } else {
                        Swal.fire({
                            icon: 'danger',
                            title: 'GAGAL !',
                            text: 'Data Gagal Ditambah',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            })
        }
    </script>
@endpush
