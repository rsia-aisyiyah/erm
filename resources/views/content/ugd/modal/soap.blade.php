<div class="modal fade" id="modalSoapUgd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">PEMERIKSAAN PASIEN UGD</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="tab-soap-ugd" role="tablist">
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
                        <button class="nav-link" id="tab-ews" data-bs-toggle="tab" data-bs-target="#tab-ews-pane"
                            type="button" role="tab" aria-controls="tab-ews-pane" aria-selected="false">EWS</button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="tab-soap-pane" role="tabpanel"
                        aria-labelledby="home-tab" tabindex="0">
                        <form action="" method="POST" class="" id="formSoapUgd">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <table class="borderless">
                                        <tr>
                                            <td width="10%" style="font-size:11px">Pasien:</td>
                                            <td width="15%">
                                                <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat" placeholder="" readonly>
                                            </td>
                                            <td width="30%" colspan="3">
                                                <input type="text" class="form-control form-control-sm" id="nm_pasien" name="nm_pasien" placeholder="" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px">Dilakukan Oleh :</td>
                                            <td width="15%">
                                                <input type="text" class="form-control form-control-sm" id="nik" name="nik" placeholder="" readonly>
                                            </td>
                                            <td colspan="2" width="40%">
                                                <input type="search" class="form-control form-control-sm" id="nama" name="nama" placeholder="" onkeyup="cariPetugas(this)" autocomplete="off">
                                                <div class="list_petugas"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px">Subjek : </td>
                                            <td colspan="3">
                                                <textarea class="form-control" name="subjek" id="subjek" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px">Objek : </td>
                                            <td colspan="3">
                                                <textarea class="form-control" name="objek" id="objek" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">
                                                <table>
                                                    <td width="12%" style="font-size:11px">
                                                        Suhu (<sup>0</sup>C) : <input type="text" class="form-control form-control-sm"
                                                            id="suhu" name="suhu" placeholder="" maxlength="5"
                                                            value="-"
                                                            onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                    <td width="12%" style="font-size:11px">
                                                        Tinggi (Cm): <input type="text" class="form-control form-control-sm" id="tinggi"
                                                            name="tinggi" placeholder="" maxlength="5"
                                                            onfocus="removeZero(this)"
                                                            onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                    <td width="12%" style="font-size:11px">
                                                        Berat (Kg) : <input type="text" class="form-control form-control-sm" id="berat"
                                                            name="berat" placeholder="" maxlength="5"
                                                            onfocus="removeZero(this)"
                                                            onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">
                                                <table>
                                                    <td width="12%" style="font-size:11px">
                                                        Tensi : <input type="text" class="form-control form-control-sm" id="tensi"
                                                            name="tensi" placeholder="" maxlength="8"
                                                            onfocus="removeZero(this)"
                                                            onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                    <td width="12%" style="font-size:11px">
                                                        Respirasi (/mnt): <input type="text" class="form-control form-control-sm"
                                                            id="respirasi" name="respirasi" placeholder="" maxlength="3"
                                                            onfocus="removeZero(this)"
                                                            onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                    <td width="12%" style="font-size:11px">
                                                        Nadi (/mnt) : <input type="text" class="form-control form-control-sm"
                                                            id="nadi" name="nadi" placeholder="" maxlength="3"
                                                            onfocus="removeZero(this)"
                                                            onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">
                                                <table>
                                                    <td width="12%" style="font-size:11px">
                                                        SpO2 (%): <input type="text" class="form-control form-control-sm" id="spo2"
                                                            name="spo2" placeholder="" maxlength="3"
                                                            onfocus="removeZero(this)"
                                                            onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                    <td width="12%" style="font-size:11px">
                                                        GCS (E,V,M): <input type="text" class="form-control form-control-sm"
                                                            id="gcs" name="gcs" placeholder="" maxlength="10"
                                                            onfocus="removeZero(this)"
                                                            onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                    <td width="12%" style="font-size:11px">
                                                        O2: <input type="text" class="form-control form-control-sm"
                                                            id="o2" name="o2" placeholder="" maxlength="10"
                                                            onfocus="removeZero(this)"
                                                            onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                    <td width="12%" style="font-size:11px">
                                                        Kesadaran :
                                                        <select class="form-select" name="kesadaran" id="kesadaran">
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
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <table class="borderless">
                                        <tr>
                                            <td width="5%" style="font-size:11px">Alergi :</td>
                                            <td width="65%">
                                                <input type="text" class="form-control form-control-sm" id="alergi" name="alergi"
                                                    placeholder=""
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px" width="5%">Asesmen : </td>
                                            <td colspan="3" width="5%">
                                                <textarea class="form-control" name="asesmen" id="asesmen" cols="30" rows="5"
                                                    onfocus="removeZero(this)"
                                                    onblur="cekKosong(this)">-</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px">Plan : </td>
                                            <td colspan="3">
                                                <textarea class="form-control" name="plan" id="plan" cols="30" rows="5"
                                                    onfocus="removeZero(this)"
                                                    onblur="cekKosong(this)">-</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px">Instruksi : </td>
                                            <td colspan="3">
                                                <textarea class="form-control" name="instruksi" id="instruksi" cols="30" rows="5"
                                                    style="font-size:11px;min-height:20px;;resize:none" onfocus="removeZero(this)"
                                                    onblur="cekKosong(this)">-</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="hidden" name="jam_rawat" id="jam_rawat">
                                                <input type="hidden" name="tgl_perawatan" id="tgl_perawatan">
                                                <button type="button" class="btn btn-primary btn-sm btn-simpan" onclick="simpanSoapRalan()"><i class="bi bi-save"></i> Simpan</button>
                                                <button type="button" class="btn btn-success btn-sm" onclick="editSoapRalan()" id="btn-ubah" style="font-size:12px;display: none"><i class="bi bi-pencil-square"></i> Ubah</button>
                                                <button type="button" class="btn btn-warning btn-sm" id="btn-reset" style="font-size:12px;display: none"><i class="bi bi-arrow-clockwise"></i> Baru</button>

                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="tab-pane fade p-3" id="tab-tabel-pane" role="tabpanel" aria-labelledby="tab-tabel" tabindex="0">
                        <table class="table table-striped table-bordered table-responsive text-sm table-sm" id="tbSoapUgd" width="100%">
                            <thead>
                                <tr role="row">
                                    <th width="5%">Aksi</th>
                                    <th width="15%">TTV & Fisik</th>
                                    <th width="80%">S.O.A.P</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade p-3" id="tab-ews-pane" role="tabpanel" aria-labelledby="tab-ews" tabindex="0">
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
    <script type="text/javascript">
        function tbSoapUgd(noRawat) {
            $('#tbSoapUgd').DataTable({
                processing: true,
                scrollX: false,
                serverSide: true,
                stateSave: true,
                ordering: false,
                paging: false,
                info: false,
                searching: false,
                ajax: {
                    url: '/erm/ugd/soap/table',
                    data: {
                        no_rawat: noRawat
                    },
                },
                columns: [{
                        data: null,
                        render: (data, type, row, meta) => {
                            button = `<button type="button" class="btn btn-primary btn-sm mb-2" onclick="ambilSoapRalan('${row.no_rawat}', '${row.tgl_perawatan}', '${row.jam_rawat}')"><i class="bi bi-pencil-square"></i></button>`;
                            button += `<br/><button type="button" class="btn btn-danger btn-sm" onclick="hapusSoapRalan('${row.no_rawat}', '${row.tgl_perawatan}', '${row.jam_rawat}')"><i class="bi bi-trash3-fill"></i></button>`;
                            return button;
                        },
                    },
                    {
                        data: null,
                        render: (data, type, row, meta) => {
                            list = '<li><strong>' + formatTanggal(row.tgl_perawatan) + ' ' + row.jam_rawat +
                                '</strong></li>';
                            list += '<li> Kesadaran : ' + row.kesadaran + '</li>';
                            $.map(row.grafik_harian, function(grafik) {
                                if (row.tgl_perawatan == grafik.tgl_perawatan && row.jam_rawat == grafik.jam_rawat) {
                                    list += '<li> O2 : ' + grafik.o2 + '</li>';
                                }
                            })
                            console.log(row)
                            list += '<li> GCS : ' + row.gcs + '</li>';
                            list += '<li> Tensi : ' + row.tensi + ' mmHg</li>';
                            list += '<li> Nadi : ' + row.nadi + ' /mnt</li>';
                            list += '<li> SpO2 : ' + row.spo2 + ' %</li>';
                            list += '<li> Respirasi : ' + row.respirasi + ' /mnt</li>';

                            $.map(row.grafik, (grafik) => {
                                if (row.tgl_perawatan == grafik.tgl_perawatan && row.jam_rawat == grafik.jam_rawat) {
                                    list += '<li> Oksigen : ' + grafik.o2 + ' /mnt</li>';
                                }
                            })
                            list += '<li> Suhu Tubuh : ' + row.suhu_tubuh + '  (<sup>o</sup>C)</li>';
                            list += '<li> Tinggi : ' + row.tinggi + ' Cm</li>';
                            list += '<li> Berat : ' + row.berat + ' Kg</li>';
                            list += '<li> Alergi : ' + row.alergi + '</li>';
                            html = '<ul>' + list + '</ul>';
                            return html;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            baris = '<tr><td width="5%">Petugas </td><td width="5%">:</td><td>' + row
                                .pegawai.nama + '</td></tr>'
                            baris += '<tr><td>Subjek </td><td>:</td><td>' + row.keluhan + '</td></tr>'
                            baris += '<tr><td>Objek </td><td>:</td><td>' + row.pemeriksaan + '</td></tr>'
                            baris += '<tr><td>Assesment</td><td>:</td><td>' + row.penilaian + '</td></tr>'
                            baris += '<tr><td>Plan</td><td>:</td><td>' + row.rtl + '</td></tr>'
                            baris += '<tr><td>Instruksi</td><td>:</td><td>' + row.instruksi + '</td></tr>'
                            html = '<table class="table table-striped">' + baris + '</table>'
                            return html;
                        },
                        name: 'soap',
                    }

                ]
            });
        }

        function ambilSoapRalan(no_rawat, tgl_pemeriksaan, jam_rawat) {
            $.ajax({
                url: '/erm/pemeriksaan/get',
                data: {
                    no_rawat: no_rawat,
                    tgl_perawatan: tgl_pemeriksaan,
                    jam_rawat: jam_rawat,
                },
            }).done((response) => {
                console.log(response)
                $('#formSoapUgd input[name="nik"]').val(response.pegawai.nik)
                $('#formSoapUgd input[name="nama"]').val(response.pegawai.nama)
                $('#formSoapUgd textarea[name="subjek"]').val(response.keluhan)
                $('#formSoapUgd textarea[name="objek"]').val(response.pemeriksaan)
                $('#formSoapUgd input[name="suhu"]').val(response.suhu_tubuh)
                $('#formSoapUgd input[name="tinggi"]').val(response.tinggi)
                $('#formSoapUgd input[name="berat"]').val(response.berat)
                $('#formSoapUgd input[name="tensi"]').val(response.tensi)
                $('#formSoapUgd input[name="respirasi"]').val(response.respirasi)
                $('#formSoapUgd input[name="nadi"]').val(response.nadi)
                $('#formSoapUgd input[name="spo2"]').val(response.spo2)
                $('#formSoapUgd input[name="gcs"]').val(response.gcs)
                $('#formSoapUgd select[name="kesadaran"] option:selected').val(response.kesadaran)
                $('#formSoapUgd textarea[name="alergi"]').val(response.alergi)
                $('#formSoapUgd textarea[name="asesmen"]').val(response.penilaian)
                $('#formSoapUgd textarea[name="plan"]').val(response.rtl)
                $('#formSoapUgd textarea[name="instruksi"]').val(response.instruksi)
                $('#jam_rawat').val(response.jam_rawat)
                $('#tgl_perawatan').val(response.tgl_perawatan)
                $('#btn-ubah').css('display', 'inline');
                $('#btn-reset').css('display', 'inline');
                $('#btn-reset').attr('onclick', `resetSoap('${response.no_rawat}')`);

                $.map(response.grafik, (grafik) => {
                    if (grafik.tgl_perawatan == tgl_pemeriksaan && grafik.jam_rawat == jam_rawat) {
                        $('#formSoapUgd input[name="o2"]').val(grafik.o2)
                    }
                })

                var sel = document.querySelector('#tab-soap-ugd li:first-child button')
                bootstrap.Tab.getInstance(sel).show()
            })
        }

        function resetSoap(param) {
            $('#formSoapUgd input').each((index, element) => {
                $(element).val('-');
                $('#jam_rawat').val('');
                $('#tgl_perawatan').val('');
            })
            $('#formSoapUgd textarea').each((index, element) => {
                $(element).val('-')
            });
            getRegPeriksa(param).done((response) => {
                $('#formSoapUgd input[name="no_rawat"]').val(response.no_rawat)
                $('#formSoapUgd input[name="nm_pasien"]').val(response.pasien.nm_pasien)
                $('#formSoapUgd input[name="nama"]').val("{{ session()->get('pegawai')->nama }}")
                $('#formSoapUgd input[name="nik"]').val("{{ session()->get('pegawai')->nik }}")
            })


            $('#btn-reset').css('display', 'none')
            $('#btn-ubah').css('display', 'none')

        }

        function editSoapRalan() {
            $.ajax({
                url: '/erm/pemeriksaan/edit',
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: $('#formSoapUgd input[name="no_rawat"]').val(),
                    nip: $('#formSoapUgd input[name="nik"]').val(),
                    keluhan: $('#formSoapUgd textarea[name="subjek"]').val(),
                    pemeriksaan: $('#formSoapUgd textarea[name="objek"]').val(),
                    suhu_tubuh: $('#formSoapUgd input[name="suhu"]').val(),
                    tinggi: $('#formSoapUgd input[name="tinggi"]').val(),
                    berat: $('#formSoapUgd input[name="berat"]').val(),
                    tensi: $('#formSoapUgd input[name="tensi"]').val(),
                    respirasi: $('#formSoapUgd input[name="respirasi"]').val(),
                    nadi: $('#formSoapUgd input[name="nadi"]').val(),
                    spo2: $('#formSoapUgd input[name="spo2"]').val(),
                    gcs: $('#formSoapUgd input[name="gcs"]').val(),
                    o2: $('#formSoapUgd input[name="o2"]').val(),
                    kesadaran: $('#formSoapUgd select[name="kesadaran"] option:selected').val(),
                    alergi: $('#formSoapUgd input[name="alergi"]').val(),
                    penilaian: $('#formSoapUgd textarea[name="asesmen"]').val(),
                    rtl: $('#formSoapUgd textarea[name="plan"]').val(),
                    instruksi: $('#formSoapUgd textarea[name="instruksi"]').val(),
                    tgl_perawatan: $('#formSoapUgd input[name="tgl_perawatan"]').val(),
                    jam_rawat: $('#formSoapUgd input[name="jam_rawat"]').val(),
                    evaluasi: '-',
                    kd_poli: 'IGDK',
                },
                beforeSend: () => {
                    swal.fire({
                        title: 'Sedang mengirim data',
                        text: 'Mohon Tunggu',
                        showConfirmButton: false,
                        didOpen: () => {
                            swal.showLoading();
                        }
                    })
                },
                error: () => {
                    swal.fire({
                        title: 'Gagal',
                        text: 'Tidak berhasil mengirim data',
                        icon: 'error',
                        timer: 1500,
                    })

                },
            }).done((response) => {
                $('#tbSoapUgd').DataTable().destroy();
                no_rawat = $('#formSoapUgd input[name="no_rawat"]').val();
                setEws(no_rawat, 'ralan')
                tbSoapUgd(no_rawat);
                let sel = document.querySelector('#tab-soap-ugd button[data-bs-target="#tab-tabel-pane"]')
                bootstrap.Tab.getInstance(sel).show()
                swal.fire({
                    title: 'Berhasil',
                    text: 'Data berhasil dikirim',
                    icon: 'success',
                    timer: 1500,
                })
                resetSoap(no_rawat);

            })
        }

        function simpanSoapRalan() {
            $.ajax({
                url: '/erm/pemeriksaan/simpan',
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: $('#formSoapUgd input[name="no_rawat"]').val(),
                    nip: $('#formSoapUgd input[name="nik"]').val(),
                    keluhan: $('#formSoapUgd textarea[name="subjek"]').val(),
                    pemeriksaan: $('#formSoapUgd textarea[name="objek"]').val(),
                    suhu_tubuh: $('#formSoapUgd input[name="suhu"]').val(),
                    tinggi: $('#formSoapUgd input[name="tinggi"]').val(),
                    berat: $('#formSoapUgd input[name="berat"]').val(),
                    tensi: $('#formSoapUgd input[name="tensi"]').val(),
                    respirasi: $('#formSoapUgd input[name="respirasi"]').val(),
                    nadi: $('#formSoapUgd input[name="nadi"]').val(),
                    spo2: $('#formSoapUgd input[name="spo2"]').val(),
                    gcs: $('#formSoapUgd input[name="gcs"]').val(),
                    o2: $('#formSoapUgd input[name="o2"]').val(),
                    kesadaran: $('#formSoapUgd select[name="kesadaran"] option:selected').val(),
                    alergi: $('#formSoapUgd input[name="alergi"]').val(),
                    penilaian: $('#formSoapUgd textarea[name="asesmen"]').val(),
                    rtl: $('#formSoapUgd textarea[name="plan"]').val(),
                    instruksi: $('#formSoapUgd textarea[name="instruksi"]').val(),
                    evaluasi: '-',
                    kd_poli: 'IGDK',
                },
                beforeSend: () => {
                    swal.fire({
                        title: 'Sedang mengirim data',
                        text: 'Mohon Tunggu',
                        showConfirmButton: false,
                        didOpen: () => {
                            swal.showLoading();
                        }
                    })
                },
                error: () => {
                    swal.fire({
                        title: 'Gagal',
                        text: 'Tidak berhasil mengirim data',
                        icon: 'error',
                        timer: 1500,
                    })

                },
            }).done((response) => {
                $('#tbSoapUgd').DataTable().destroy();
                no_rawat = $('#formSoapUgd input[name="no_rawat"]').val();
                setEws(no_rawat, 'ralan')
                tbSoapUgd(no_rawat);
                swal.fire({
                    title: 'Berhasil',
                    text: 'Data berhasil dikirim',
                    icon: 'success',
                    timer: 1500,
                })
                resetSoap(no_rawat);
            })
        }

        function hapusSoapRalan(no_rawat, tgl_perawatan, jam_rawat) {
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
                        url: '/erm/pemeriksaan/delete',
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_rawat: no_rawat,
                            tgl_perawatan: tgl_perawatan,
                            jam_rawat: jam_rawat,
                        },
                        method: 'DELETE',
                        error: () => {
                            swal.fire({
                                title: 'Gagal',
                                text: 'Tidak berhasil menghapus data',
                                icon: 'error',
                                timer: 1500,
                            })

                        }
                    }).done(() => {
                        setEws(no_rawat, 'ralan')
                        $('#tbSoapUgd').DataTable().destroy();
                        tbSoapUgd(no_rawat);
                        swal.fire({
                            title: 'Berhasil',
                            text: 'Data berhasil dihapus',
                            icon: 'success',
                            timer: 1500,
                        })
                    })
                }
            })
        }
    </script>
@endpush
