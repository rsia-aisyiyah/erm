<div class="modal fade" id="modalSoapRanap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="border-radius:0px">
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
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanSoapRanap()"
                    style="font-size: 12px"><i class="bi bi-save"></i> Simpan</button>
                <span id="ubah_soap"></span>
                <span id="reset_soap"></span>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        var no_rawat_soap = '';
        var tgl_pertama = '';
        var tgl_kedua = '';

        $('#modalSoapRanap').on('shown.bs.modal', () => {
            const canvasSuhu = $('#grafik-suhu');
        })

        function ambilSoap(no, tgl, jam) {
            $.ajax({
                url: 'soap/ambil',
                data: {
                    'no_rawat': no,
                    'tgl_perawatan': tgl,
                    'jam_rawat': jam
                },

                success: function(response) {
                    let hidden = '<input type="hidden" name="tgl_perawatan" id="tgl_perawatan" value="' + response.tgl_perawatan + '">';
                    hidden += '<input type="hidden" name="jam_rawat" id="jam_rawat" value="' + response.jam_rawat + '">';
                    hidden += '<input type="hidden" name="no_rawat" id="no_rawat" value="' + response.no_rawat + '">';

                    $('.form-soap').append(hidden);
                    $('#suhu').val(response.suhu_tubuh);
                    $('#nik').val(response.petugas.nip);
                    $('#nama').val(response.petugas.nama);
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
                    if ($('#btn-ubah').length == 0) {
                        $('#ubah_soap').append(
                            '<button type="button" class="btn btn-success btn-sm" onclick="editSoap()" id="btn-ubah" style="font-size:12px"><i class="bi bi-pencil-square"></i> Ubah</button>'
                        )
                        $('#reset_soap').append(
                            '<button type="button" class="btn btn-warning btn-sm" id="btn-reset" style="font-size:12px"><i class="bi bi-arrow-clockwise"></i> Baru</button>'
                        )
                    }
                    $('#btn-reset').on('click', function(event) {
                        $('#suhu').val("-");
                        $('#tinggi').val("-");
                        $('#berat').val("-");
                        $('#tensi').val("-");
                        $('#respirasi').val("-");
                        $('#nadi').val("-");
                        $('#spo2').val("-");
                        $('#gcs').val("-");
                        $('#alergi').val("-");
                        $('#asesmen').val("-");
                        $('#plan').val("-");
                        $('#instruksi').val("-");
                        $('#evaluasi').val("-");
                        $('#subjek').val("-");
                        $('#objek').val("-");
                        $('#btn-reset').remove();
                        $('#btn-ubah').remove();
                        return false;
                    });

                    console.log('RESPONSE', response)

                }
            }).done(() => {
                var sel = document.querySelector('#tab-soap-ranap li:first-child button')
                bootstrap.Tab.getInstance(sel).show()
            })
        }

        function hapusSoap(no, tgl, jam) {
            Swal.fire({
                title: 'Yakin ?',
                text: "Data yang dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus saja!'
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
                                Swal.fire(
                                    'BERHASIL !',
                                    'Data berhasil dihapus',
                                    'success'
                                );
                                $('#tbSoap').DataTable().destroy();
                                tbSoapRanap(no_rawat_soap, tgl_pertama, tgl_kedua);
                                grafikPemeriksaan.destroy();
                                buildGrafik(no_rawat_soap)
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
                            text: 'Data Berhasil Diubah',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#tbSoap').DataTable().destroy();
                        tbSoapRanap(no_rawat_soap, tgl_pertama, tgl_kedua);
                        grafikPemeriksaan.destroy();
                        buildGrafik(no_rawat_soap)
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
