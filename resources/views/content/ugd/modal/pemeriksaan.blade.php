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
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-resep" data-bs-toggle="tab" data-bs-target="#tab-resep-pane"
                            type="button" role="tab" aria-controls="tab-resep-pane" aria-selected="false">Resep</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="tab-soap-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        @include('content.ugd.modal.pemeriksaan.soap')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-tabel-pane" role="tabpanel" aria-labelledby="tab-tabel" tabindex="0">
                        @include('content.ugd.modal.pemeriksaan.data')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-ews-pane" role="tabpanel" aria-labelledby="tab-ews" tabindex="0">
                        @include('content.ugd.modal.pemeriksaan.ews')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-resep-pane" role="tabpanel" aria-labelledby="tab-resep" tabindex="0">
                        @include('content.ugd.modal.pemeriksaan.resep')
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
                            if (row.pegawai.nip == "{{ session()->get('pegawai')->nik }}") {
                                button += `<br/><button type="button" class="btn btn-danger btn-sm" onclick="hapusSoapRalan('${row.no_rawat}', '${row.tgl_perawatan}', '${row.jam_rawat}')"><i class="bi bi-trash3-fill"></i></button>`;
                            }
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
                if (response.pegawai.nik != "{{ session()->get('pegawai')->nik }}") {
                    $("#formSoapUgd :input").prop('readonly', true);
                    $("#formSoapUgd select").prop('disabled', true);
                    $("#formSoapUgd textarea").prop('readonly', true);
                    $('#btn-ubah').css('display', 'none');
                    $('#btn-reset').css('display', 'inline');
                    $('#btn-reset').attr('onclick', `resetSoap('${response.no_rawat}')`);
                    // $('.btn-simpan').css('display', 'none');
                    // $('#formSoapUgd input[name="nik"]').val(response.pegawai.nik)
                } else {
                    $('#btn-ubah').css('display', 'inline');
                    $('#btn-reset').css('display', 'inline');
                    $('#btn-reset').attr('onclick', `resetSoap('${response.no_rawat}')`);
                    $('#formSoapUgd input[name="nik"]').val(response.pegawai.nik)
                    $('#formSoapUgd input[name="nama"]').val(response.pegawai.nama)
                }
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
