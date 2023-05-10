<div class="modal fade" id="modalSoapRanap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="border-radius:0px">
            {{-- <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">PEMERIKSAAN S.O.A.P</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            <div class="modal-body">
                @include('content.ranap.modal._form_soap')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanSoap()"><i class="bi bi-save"></i>
                    Simpan</button>
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

        function ambilSoap(no, tgl, jam) {
            $.ajax({
                url: 'soap/ambil',
                data: {
                    'no_rawat': no,
                    'tgl_perawatan': tgl,
                    'jam_rawat': jam
                },
                success: function(response) {
                    let hidden = '<input type="hidden" name="tgl_perawatan" id="tgl_perawatan" value="' +
                        response.tgl_perawatan +
                        '">';
                    hidden += '<input type="hidden" name="jam_rawat" id="jam_rawat" value="' + response
                        .jam_rawat + '">'
                    hidden += '<input type="hidden" name="no_rawat" id="no_rawat" value="' + response
                        .no_rawat + '">'
                    $('.form-soap').append(hidden);
                    $('#suhu').val(response.suhu_tubuh);
                    $('#tinggi').val(response.tinggi);
                    $('#berat').val(response.berat);
                    $('#tensi').val(response.tensi);
                    $('#respirasi').val(response.respirasi);
                    $('#nadi').val(response.nadi);
                    $('#spo2').val(response.spo2);
                    $('#gcs').val(response.gcs);
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
                            '<button type="button" class="btn btn-success btn-sm" onclick="editSoap()" id="btn-ubah"><i class="bi bi-pencil-square"></i>Ubah</button>'
                        )
                        $('#reset_soap').append(
                            '<button type="button" class="btn btn-warning btn-sm" id="btn-reset"><i class="bi bi-arrow-clockwise"></i>Baru</button>'
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

                }
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
                    'no_rawat': $('#no_rawat').val(),
                    'jam_rawat': $('#jam_rawat').val(),
                    'tgl_perawatan': $('#tgl_perawatan').val(),
                    'tinggi': $('#tinggi').val(),
                    'berat': $('#berat').val(),
                    'respirasi': $('#respirasi').val(),
                    'tensi': $('#tensi').val(),
                    'nadi': $('#nadi').val(),
                    'spo2': $('#spo2').val(),
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
            $('#tbSoap').DataTable().destroy();
            tbSoapRanap(no_rawat_soap, tgl_pertama, tgl_kedua);
        }

        function tbSoapRanap(no_rawat = '', tgl_pertama = '', tgl_kedua = '') {
            no_rawat_soap = no_rawat;
            var tbSoapRanap = $('#tbSoap').DataTable({
                processing: true,
                scrollX: true,
                scrollY: 610,
                serverSide: true,
                stateSave: true,
                searching: false,
                lengthChange: false,
                ordering: false,
                paging: false,
                info: false,
                autoWidth: false,
                ajax: {
                    url: "soap",
                    data: {
                        'no_rawat': no_rawat,
                        'tgl_pertama': tgl_pertama,
                        'tgl_kedua': tgl_kedua,
                    },
                },
                fixedColumns: {
                    left: 1,
                },
                scrollCollapse: true,
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            button =
                                '<button type="button" class="btn btn-primary btn-sm mb-2" onclick="ambilSoap(\'' +
                                row.no_rawat + '\',\'' + row.tgl_perawatan +
                                '\', \'' + row.jam_rawat +
                                '\')"><i class="bi bi-pencil-square"></i></button>';
                            button +=
                                '<br/><button type="button" class="btn btn-danger btn-sm" onclick="hapusSoap(\'' +
                                row.no_rawat + '\',\'' + row.tgl_perawatan +
                                '\', \'' + row.jam_rawat +
                                '\')"><i class="bi bi-trash3-fill"></i></button>';

                            return button;
                        },
                        name: 'tgl_perawatan',
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {

                            list = '<li><strong>' + formatTanggal(row.tgl_perawatan) + ' ' + row.jam_rawat +
                                '</strong></li>';
                            list += '<li> Kesadaran : ' + row.kesadaran + '</li>';
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
                            return html;
                        },
                        name: 'ttv',
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            console.log(row)
                            baris = '<tr><td>Petugas </td><td>:</td><td>' + row.petugas.nama + '</td></tr>'
                            baris += '<tr><td>Subjek </td><td>:</td><td>' + row.keluhan + '</td></tr>'
                            baris += '<tr><td>Objek </td><td>:</td><td>' + row.pemeriksaan + '</td></tr>'
                            baris += '<tr><td>Assesment</td><td>:</td><td>' + row.penilaian + '</td></tr>'
                            baris += '<tr><td>Plan</td><td>:</td><td>' + row.rtl + '</td></tr>'
                            baris += '<tr><td>Instruksi</td><td>:</td><td>' + row.instruksi + '</td></tr>'
                            baris += '<tr><td>Evaluasi</td><td>:</td><td>' + row.evaluasi + '</td></tr>'
                            html = '<table class="table table-striped">' + baris + '</table>'
                            return html;
                        },
                        name: 'soap',
                    },
                ],
                "language": {
                    "zeroRecords": "Tidak ada data pasien terdaftar",
                    "infoEmpty": "Tidak ada data pasien terdaftar",
                }
            });
        }

        function simpanSoap() {
            let pasien = $('#nomor_rawat').val();
            let splitPasien = pasien.split(' - ');
            let no = splitPasien[0];

            $.ajax({
                url: 'soap/simpan',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'suhu_tubuh': $('#suhu').val(),
                    'nip': "{{ session()->get('pegawai')->nik }}",
                    'no_rawat': no,
                    'jam_rawat': $('#jam_rawat').val(),
                    'tgl_perawatan': $('#tgl_perawatan').val(),
                    'tinggi': $('#tinggi').val(),
                    'berat': $('#berat').val(),
                    'respirasi': $('#respirasi').val(),
                    'nadi': $('#nadi').val(),
                    'tensi': $('#tensi').val(),
                    'spo2': $('#spo2').val(),
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
                            text: 'Data Berhasil Ditambah',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#tbSoap').DataTable().destroy();
                        tbSoapRanap(no_rawat_soap, tgl_pertama, tgl_kedua);
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
