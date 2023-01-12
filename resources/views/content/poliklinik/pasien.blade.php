@extends('index')

@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">PASIEN HARI INI</h5>
                    <p style="background-color: #0067dd;color:white;padding:5px">Poli :
                        <strong>{{ $poli->nm_poli }}</strong>
                    </p>
                    <p style="">Dokter : <strong>{{ $dokter->nm_dokter }}</strong></p>
                    <table>
                        <tr>
                            <td>Jumlah Pasien</td>
                            <td>:</td>
                            <td> <strong id="count-pasien">{{ $jumlah }}</strong></td>

                        </tr>
                        <tr>
                            <td>Selesai</td>
                            <td>:</td>
                            <td><strong id="count-selesai" class="text-success"></strong></td>
                        </tr>
                        <tr>
                            <td>Terupload</td>
                            <td>:</td>
                            <td><strong id="count-uploaded" class="text-success"></strong></td>
                        </tr>
                    </table>

                    <input type="hidden" class="hitung-panggil" value="">

                    <table class="table table-striped table-responsive text-sm table-sm" id="tb_pasien" width="100%">
                        <thead>
                            <tr role="row">
                                <th style="width: 5%"></th>
                                <th style="width: 10%">Aksi</th>
                                <th>Nama</th>
                                <th>Upload</th>
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
    <div class="modal fade" id="modalSoap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">PEMERIKSAAN S.O.A.P</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="borderless">
                                    <tr>
                                        <td width="15%">No Rawat : </td>
                                        <td width="30%">
                                            <input type="text" class="form-control form-control-sm" id="nomor_rawat"
                                                name="nomor_rawat" placeholder=""
                                                style="font-size:12px;min-height:12px;border-radius:0;">
                                        </td>
                                        <td width="20%">
                                            <input type="text" class="form-control form-control-sm" id="no_rm"
                                                name="no_rm" placeholder=""
                                                style="font-size:12px;min-height:12px;border-radius:0;">
                                        </td>
                                        <td width="30%">
                                            <input type="text" class="form-control form-control-sm" id="nama_pasien"
                                                name="nama_pasien" placeholder=""
                                                style="font-size:12px;min-height:12px;border-radius:0;">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            {{-- <div class="col-sm-6">
                                <table class="borderless">
                                    <tr>
                                        <td width="5%">Tanggal : </td>
                                        <td width="20%">
                                            <input type="text" class="form-control form-control-sm" id="tgl_perawatan"
                                                name="tgl_perawatan" placeholder=""
                                                style="font-size:12px;min-height:12px;border-radius:0;">
                                        </td>
                                    </tr>
                                </table>
                            </div> --}}
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="borderless">
                                    <tr>
                                        <td width="20%">Dilakukan Oleh :</td>
                                        <td width="30%">
                                            <input type="text" class="form-control form-control-sm" id="nik"
                                                name="nik" placeholder=""
                                                style="font-size:12px;min-height:12px;border-radius:0;">
                                        </td>
                                        <td width="45%">
                                            <input type="text" class="form-control form-control-sm" id="nama"
                                                name="nama" placeholder=""
                                                style="font-size:12px;min-height:12px;border-radius:0">

                                        </td>
                                        <td width="5%">
                                            <button class="btn btn-secondary"
                                                style="border-radius:0;--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                type="button"><i class="bi bi-paperclip"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Profesi / Jabatan / Departmen : </td>
                                        <td width="30%">
                                            <input type="text" class="form-control form-control-sm" id="jabatan"
                                                name="jabatan" placeholder=""
                                                style="font-size:12px;min-height:12px;border-radius:0;">
                                        </td>
                                        <td width="5%">
                                            <button class="btn btn-secondary"
                                                style="border-radius:0;--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;"
                                                type="button"><i class="bi bi-paperclip"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Subjek : </td>
                                        <td colspan="3">
                                            <textarea class="form-control" name="subjek" id="subjek" cols="30" rows="4"
                                                style="font-size:12px;min-height:12px;border-radius:0;resize:none"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Objek : </td>
                                        <td colspan="3">
                                            <textarea class="form-control" name="objek" id="objek" cols="30" rows="4"
                                                style="font-size:12px;min-height:12px;border-radius:0;resize:none"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="3">
                                            <table>
                                                <td width="12%">
                                                    Suhu (<sup>0</sup>C) : <input type="text"
                                                        class="form-control form-control-sm" id="suhu"
                                                        name="suhu" placeholder=""
                                                        style="font-size:12px;min-height:12px;border-radius:0;">
                                                </td>
                                                <td width="12%">
                                                    Tinggi (Cm): <input type="text"
                                                        class="form-control form-control-sm" id="tinggi"
                                                        name="tinggi" placeholder=""
                                                        style="font-size:12px;min-height:12px;border-radius:0;">
                                                </td>
                                                <td width="12%">
                                                    Berat (Kg) : <input type="text"
                                                        class="form-control form-control-sm" id="berat"
                                                        name="berat" placeholder=""
                                                        style="font-size:12px;min-height:12px;border-radius:0;">
                                                </td>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="3">
                                            <table>
                                                <td width="12%">
                                                    Tensi : <input type="text" class="form-control form-control-sm"
                                                        id="tensi" name="tensi" placeholder=""
                                                        style="font-size:12px;min-height:12px;border-radius:0;">
                                                </td>
                                                <td width="12%">
                                                    Respirasi (/menit): <input type="text"
                                                        class="form-control form-control-sm" id="respirasi"
                                                        name="respirasi" placeholder=""
                                                        style="font-size:12px;min-height:12px;border-radius:0;">
                                                </td>
                                                <td width="12%">
                                                    Nadi (/menit) : <input type="text"
                                                        class="form-control form-control-sm" id="nadi"
                                                        name="nadi" placeholder=""
                                                        style="font-size:12px;min-height:12px;border-radius:0;">
                                                </td>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="3">
                                            <table>
                                                <td width="12%">
                                                    SpO2 : <input type="text" class="form-control form-control-sm"
                                                        id="spo2" name="spo2" placeholder=""
                                                        style="font-size:12px;min-height:12px;border-radius:0;">
                                                </td>
                                                <td width="12%">
                                                    GCS (E,V,M): <input type="text"
                                                        class="form-control form-control-sm" id="gcs"
                                                        name="gcs" placeholder=""
                                                        style="font-size:12px;min-height:12px;border-radius:0;">
                                                </td>
                                                <td width="12%">
                                                    Kesadaran :
                                                    <select class="form-select" name="kesadaran" id="kesadaran"
                                                        style="font-size:12px;min-height:12px;border-radius:0;>">
                                                        <option value="Compos Mentis">Compos Mentis</option>
                                                        <option value="Somnolence">Somnolence</option>
                                                        <option value="Sopor">Sopor</option>
                                                        <option value="Coma">Coma</option>
                                                    </select>
                                                </td>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="borderless">
                                    <tr>
                                        <td width="5%">Alergi :</td>
                                        <td width="20%">
                                            <input type="text" class="form-control form-control-sm" id="alergi"
                                                name="alergi" placeholder=""
                                                style="font-size:12px;min-height:12px;border-radius:0;width:150px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Asesmen : </td>
                                        <td colspan="3">
                                            <textarea class="form-control" name="asesmen" id="asesmen" cols="30" rows="4"
                                                style="font-size:12px;min-height:12px;border-radius:0;resize:none"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Plan : </td>
                                        <td colspan="3">
                                            <textarea class="form-control" name="plan" id="plan" cols="30" rows="4"
                                                style="font-size:12px;min-height:12px;border-radius:0;resize:none"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Instruksi : </td>
                                        <td colspan="3">
                                            <textarea class="form-control" name="instruksi" id="instruksi" cols="30" rows="4"
                                                style="font-size:12px;min-height:12px;border-radius:0;resize:none"></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                            class="bi bi-x-circle"></i> Keluar</button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="simpanSoap()"><i
                            class="bi bi-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        var id = '';
        $(document).ready(function() {
            var kd_poli = '{{ $poli->kd_poli }}';
            var kd_dokter = '{{ $dokter->kd_dokter }}';
            tb_pasien();
            hitungUpload();
            hitungSelesai();
            hitungPasien();

            setInterval(function() {
                $('#tb_pasien').DataTable().destroy();
                tb_pasien();
                hitungUpload();
                hitungSelesai();
                hitungPasien();
                $.toast({
                    heading: 'MEMUAT ULANG DATA',
                    icon: 'success',
                    loaderBg: '#13653f',
                    position: 'bottom-center',
                    bgColor: '#198754',
                    textColor: 'white',
                    stack: false,
                })
            }, 20000);
        })

        function hitungPasien() {
            console.log(kd_poli, ' dari gobal variabel');
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

        $('#modalSoap').on('shown.bs.modal', function() {
            modalsoap(id);
        })

        function ambilNoRawat(no_rawat) {
            id = no_rawat;
        }

        function simpanSoap() {
            $.ajax({
                url: '/erm/pemeriksaan/simpan',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    no_rawat: id,
                    suhu_tubuh: $('#suhu').val(),
                    tensi: $('#tensi').val(),
                    nadi: $('#nadi').val(),
                    respirasi: $('#respirasi').val(),
                    tinggi: $('#tinggi').val(),
                    berat: $('#berat').val(),
                    spo2: $('#spo2').val(),
                    gcs: $('#gcs').val(),
                    kesadaran: $('#kesadaran').val(),
                    rtl: $('#plan').val(),
                    keluhan: $('#subjek').val(),
                    penilaian: $('#asesmen').val(),
                    pemeriksaan: $('#objek').val(),
                    alergi: $('#alergi').val(),
                    instruksi: $('#instruksi').val(),
                    evaluasi: '-',
                },
                success: function(response) {
                    $.toast({
                        heading: 'Sukses',
                        heading: 'SOAP telah disimpan',
                        icon: 'success',
                        loaderBg: '#13653f',
                        position: 'bottom-center',
                        bgColor: '#198754',
                        textColor: 'white',
                        stack: false,
                    })
                }
            })
        }

        function modalsoap(no_rawat) {
            jbtn = "{{ session()->get('pegawai')->jbtn }}";
            nik = "{{ session()->get('pegawai')->nik }}";
            nama = "{{ session()->get('pegawai')->nama }}";
            $.ajax({
                url: '/erm/pemeriksaan',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    no_rawat: no_rawat,
                },
                success: function(response) {
                    console.log(response)

                    $('input').val('');
                    $('textarea').val('');
                    $('#nama').val(nama);
                    $('#nik').val(nik);
                    $('#jabatan').val(jbtn);
                    if (response.tgl_perawatan) {
                        $('#no_rm').val(response.reg_periksa.no_rkm_medis)
                        $('#nomor_rawat').val(response.no_rawat)
                        $('#nama_pasien').val(response.reg_periksa.pasien.nm_pasien)
                        $('#tgl_perawatan').val(response.tgl_perawatan)
                        $('#subjek').val(response.keluhan)
                        $('#objek').val(response.pemeriksaan)
                        $('#asesmen').val(response.penilaian)
                        $('#plan').val(response.rtl)
                        $('#instruksi').val(response.instruksi)
                        $('#suhu').val(response.suhu_tubuh)
                        $('#tensi').val(response.tensi)
                        $('#tinggi').val(response.tinggi)
                        $('#berat').val(response.berat)
                        $('#gcs').val(response.gcs)
                        $('#respirasi').val(response.respirasi)
                        $('#alergi').val(response.alergi)
                        $('#nadi').val(response.nadi)
                        $('#spo2').val(response.spo2)
                    } else {

                        $('#nomor_rawat').val(response.no_rawat)
                        $('#nama_pasien').val(response.pasien.nm_pasien)
                        $('#no_rm').val(response.no_rkm_medis)
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error)
                }
            })
        }

        function hitungSelesai() {

            $.ajax({
                url: '/erm/registrasi/selesai',
                method: 'GET',
                data: {
                    'kd_poli': kd_poli,
                    'kd_dokter': kd_dokter,
                },
                dataType: 'JSON',
                success: function(response) {
                    $('#count-selesai').text(response)
                }
            });
        }

        function hitungUpload() {
            $.ajax({
                url: 'count/{{ $poli->kd_poli }}?dokter={{ $dokter->kd_dokter }}',
                method: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    $('#count-uploaded').text(data)
                }
            })
        }

        function tb_pasien() {
            var table = $('#tb_pasien').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                ajax: {
                    url: "table/{{ Request::segment(2) }}?dokter={{ Request::get('dokter') }}",
                },
                columns: [{
                        className: 'dt-control',
                        orderable: false,
                        data: null,
                        defaultContent: '',
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                    {
                        data: 'nm_pasien',
                        name: 'nm_pasien'

                    },
                    {
                        data: 'upload',
                        name: 'upload',
                    }

                ],
                order: [
                    [1, 'asc']
                ],
            });

            $('#tb_pasien tbody').on('click', 'td.dt-control', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var dataPeriksa = [];

                console.log(row);

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    $.ajax({
                        url: '/erm/test/' + row.data().no_rkm_medis,
                        method: 'GET',
                        dataType: 'JSON',
                        success: function(data) {
                            data.forEach(function(response) {
                                row.child(resume(response)).show();
                                tr.addClass('shown');
                                tr.removeClass('shown');
                            })
                        }
                    })
                }
            });
        }
    </script>
@endpush
