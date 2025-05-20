<div class="p-3 w-full d-flex justify-content-end">
    <button type="button" class="btn btn-success btn-sm btn-tambah-grafik-harin"
        onclick="modalGrafikHarian()" style="font-size: 12px"><i
            class="bi bi-bar-chart-line"></i> Tambah Grafik</button>
</div>
<div class="table-responsive">
    <div class="chart-container">
        <canvas id="grafik-suhu" class="grafikPemeriksaan"></canvas>
    </div>
</div>
@push('script')
    <script>
        var ctx = document.getElementById('grafik-suhu').getContext('2d');
        var grafikPemeriksaan;
        var tableGrafikHarian;

        function buildGrafik(no_rawat) {
            $.ajax({
                url: 'soap/chart',
                data: {
                    'no_rawat': no_rawat
                },
                success: function(response) {
                    grafikPemeriksaan = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: response.map(function(e) {
                                return e.tgl_perawatan + ' ' + e.jam_rawat;
                            }),
                            datasets: [{
                                label: 'Suhu Tubuh',
                                yAxisID: 'yAxis1',
                                data: response.map(function(e) {
                                    if (e.suhu_tubuh.includes(',')) {
                                        e.suhu_tubuh = e.suhu_tubuh.replace(',', '.');
                                    }
                                    return parseFloat(e.suhu_tubuh);
                                }),
                                backgroundColor: 'rgba(54, 162, 235, 1)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                pointBackgroundColor: '#fff',
                                hoverRadius: 10,
                                borderWidth: 3,
                                lineTension: 0,
                                radius: 5,
                            }, {
                                label: 'Nadi',
                                yAxisID: 'yAxis2',
                                data: response.map(function(e) {
                                    return e.nadi;
                                }),
                                backgroundColor: 'rgba(255, 99, 132, 1)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                pointBackgroundColor: '#fff',
                                hoverRadius: 10,
                                borderWidth: 3,
                                lineTension: 0,
                                radius: 5,
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'chartArea',
                                    align: 'end',
                                },
                            },
                            scales: {
                                xAxes: {
                                    ticks: {
                                        display: false,
                                        minRotation: 90,
                                        maxRotation: 90,
                                    }
                                },
                                yAxis1: {
                                    min: 35,
                                    max: 42,
                                    beginAtZero: true,
                                },
                                yAxis2: {
                                    beginAtZero: true,
                                    min: 40,
                                    max: 180,
                                },
                            }
                        },
                        onAnimationComplete: function() {
                            var sourceCanvas = this.chart.ctx.canvas;
                            var copyWidth = this.scale.xScalePaddingLeft - 5;
                            var copyHeight = this.scale.endPoint + 5;
                            var targetCtx = document.getElementById("grafik-suhu").getContext("2d");
                            targetCtx.canvas.width = copyWidth;
                            targetCtx.drawImage(sourceCanvas, 0, 0, copyWidth, copyHeight, 0, 0, copyWidth, copyHeight);
                        }
                    });
                }
            });
        }

        function appendDataGrafikHarian(no_rawat) {

            tableGrafikHarian = $("#tableGrafikHarian").dataTable({
                processing: true,
                serverSide: true,
                paging: true,
                lengthChange: true,
                lengthMenu: [
                    [7, 10, 25],
                    [7, 10, 25]
                ],
                pageLength: 7,
                stateSave: false,
                searching: false,
                ordering: false,
                info: true,
                autoWidth: false,
                responsive: true,
                ajax: {
                    url: 'soap/grafik/data',
                    type: 'GET',
                    data: function(data) {
                        data.no_rawat = no_rawat;
                    },
                    "language": {
                        "emptyTable": "data grafik harian kosong"
                    }
                },
                columns: [
                    // waktu perawatan, suhu, tensi, nadi, respirasi, spo2, o2, GCS, kesadaran
                    {
                        data: null,
                        render: function(data, type, row) {
                            return data.tgl_perawatan + ' ' + data.jam_rawat;
                        },
                        name: 'tgl_perawatan'
                    },
                    {
                        data: 'suhu_tubuh',
                        name: 'suhu_tubuh'
                    },
                    {
                        data: 'tensi',
                        name: 'tensi'
                    },
                    {
                        data: 'nadi',
                        name: 'nadi'
                    },
                    {
                        data: 'respirasi',
                        name: 'respirasi'
                    },
                    {
                        data: 'spo2',
                        name: 'spo2'
                    },
                    {
                        data: 'o2',
                        name: 'o2'
                    },
                    {
                        data: 'gcs',
                        name: 'gcs'
                    },
                    {
                        data: 'kesadaran',
                        name: 'kesadaran'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            var htmlButton = `<button type="button" class="btn btn-sm btn-danger btn-hapus-grafik-harian" onClick="deleteGrafikHarian('` + data.no_rawat + `','` + data.tgl_perawatan + `','` + data.jam_rawat + `')"><i class="bi bi-trash"></i></button>`;
                            htmlButton += `<button type="button" class="btn btn-sm btn-warning btn-edit-grafik-harian" onClick="editGrafikHarian('` + data.no_rawat + `','` + data.tgl_perawatan + `','` + data.jam_rawat + `','` + data.suhu_tubuh + `','` + data.tensi + `','` + data.nadi + `','` + data.respirasi + `','` + data.spo2 + `','` + data.o2 + `','` + data.gcs + `','` + data.kesadaran + `')"><i class="bi bi-pencil-square"></i></button>`;

                            return htmlButton;
                        },
                        name: 'aksi'
                    }
                ],
            });
        }

        $('#modalSoapRanap').on('hidden.bs.modal', function() {
            $('#ubah_soap').empty();
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
            $('#btn-reset').css('display', 'none');
            $('#btn-ubah').css('display', 'none');
            $('#table-ews tbody').empty();
            $('.td-jam').remove();
            $('.td-tanggal').remove();
        });


        // modal tambah grafik harian
        function modalGrafikHarian(no_rawat, nm_pasien) {
            $('#modalGrafikHarian').modal('toggle');

            // set data to modal
            $('#formSaveGrafikHarian input[name="no_rawat"]').val(no_rawat);
            $('#formSaveGrafikHarian input[name="nm_pasien"]').val(nm_pasien);
        }

        // form tambah grafik harian submit
        $('#formSaveGrafikHarian').on('submit', function(e) {
            e.preventDefault();

            var kd_dokter = $('#formSaveGrafikHarian #kdDokter').data('kd-dokter');
            var spesialis = $('#formSaveGrafikHarian #spesialisDokter').data('spesialis');
            var nm_pasien = $('#formSaveGrafikHarian #nmPasien').data('nm-pasien');

            var suhu_tubuh = $('#formSaveGrafikHarian input[name="suhu_tubuh"]').val();
            var no_rawat = $('#formSaveGrafikHarian input[name="no_rawat"]').val();

            $.ajax({
                url: '/erm/soap/grafik/store',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'no_rawat': $('#formSaveGrafikHarian input[name="no_rawat"]').val(),
                    'suhu_tubuh': $('#formSaveGrafikHarian input[name="suhu_tubuh"]').val(),
                    'tensi': $('#formSaveGrafikHarian input[name="tensi"]').val(),
                    'nadi': $('#formSaveGrafikHarian input[name="nadi"]').val(),
                    'respirasi': $('#formSaveGrafikHarian input[name="respirasi"]').val(),
                    'spo2': $('#formSaveGrafikHarian input[name="spo2"]').val(),
                    'o2': $('#formSaveGrafikHarian input[name="o2"]').val(),
                    'gcs': $('#formSaveGrafikHarian input[name="gcs"]').val(),
                    'kesadaran': $('#formSaveGrafikHarian select[name="kesadaran"]').val(),
                    'action': $('#formSaveGrafikHarian input[name="action"]').val(),
                    'tgl_perawatan': $('#formSaveGrafikHarian input[name="tgl_perawatan"]').val(),
                    'jam_rawat': $('#formSaveGrafikHarian input[name="jam_rawat"]').val(),
                },
                type: 'POST',
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
                    if (response.success) {
                        if (suhu_tubuh.includes(',')) {
                            suhu_tubuh = suhu_tubuh.replace(',', '.')
                        }
                        if (spesialis.toLowerCase().includes('anak')) {
                            if (suhu_tubuh < 35.5 || suhu_tubuh > 39.5) {
                                notifSend(
                                    kd_dokter,
                                    'Notifikasi Kondisi Pasien',
                                    'Suhu tubuh ' + suhu_tubuh + '°, pasien atas nama : ' + nm_pasien,
                                    no_rawat,
                                    'Ranap',
                                    'detail'
                                );
                            }
                        } else {
                            if (suhu_tubuh < 36 || suhu_tubuh > 38) {
                                notifSend(
                                    kd_dokter,
                                    'Notifikasi Kondisi Pasien',
                                    'Suhu tubuh ' + suhu_tubuh + '°, pasien atas nama : ' + nm_pasien,
                                    no_rawat,
                                    'Ranap',
                                    'detail'
                                );
                            }
                        }

                        $('#modalGrafikHarian').modal('toggle');
                        grafikPemeriksaan.destroy();

                        swal.fire({
                            title: 'Berhasil',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $("#tableGrafikHarian").DataTable().destroy();

                        buildGrafik(response.no_rawat);
                        appendDataGrafikHarian(response.no_rawat);
                        clearFormGrafikHarian();
                    }

                },
                error: function(request, status, error) {
                    alertErrorAjax(request)
                }
            })
        });

        $('#modalGrafikHarian').on('hidden.bs.modal', function() {
            clearFormGrafikHarian();

            $('#formSaveGrafikHarian input[name="action"]').remove();
            $('#formSaveGrafikHarian input[name="tgl_perawatan"]').remove();
            $('#formSaveGrafikHarian input[name="jam_rawat"]').remove();

            // reset data-*
            $('#formSaveGrafikHarian #kdDokter').attr('data-kd-dokter', '');
            $('#formSaveGrafikHarian #spesialisSpesialis').attr('data-spesialis', '');
        });

        function deleteGrafikHarian(no_rawat, tgl_perawatan, jam_rawat) {
            swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data grafik harian akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'soap/grafik/delete',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'no_rawat': no_rawat,
                            'tgl_perawatan': tgl_perawatan,
                            'jam_rawat': jam_rawat
                        },
                        type: 'DELETE',
                        beforeSend: function() {
                            $("#tableGrafikHarian").DataTable().destroy();
                            swal.fire({
                                title: 'Sedang menghapus data',
                                text: 'Mohon Tunggu',
                                showConfirmButton: false,
                                didOpen: () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        success: function(response) {
                            if (response.success) {
                                tableGrafikHarian.fnDestroy();
                                grafikPemeriksaan.destroy();
                                grafikPemeriksaan = null;
                                swal.fire({
                                    title: 'Berhasil',
                                    text: response.message,
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $("#tableGrafikHarian").DataTable().destroy();
                                buildGrafik(no_rawat);
                                appendDataGrafikHarian(no_rawat);
                                clearFormGrafikHarian();
                            } else {
                                console.log(response);
                            }
                        },
                        error: function(request, status, error) {
                            console.log(request.responseText);
                        }
                    });
                }
            });
        }

        function editGrafikHarian(no_rawat, tgl_perawatan, jam_rawat, suhu_tubuh, tensi, nadi, respirasi, spo2, o2, gcs, kesadaran) {
            $('#formSaveGrafikHarian input[name="suhu_tubuh"]').val(suhu_tubuh);
            $('#formSaveGrafikHarian input[name="tensi"]').val(tensi);
            $('#formSaveGrafikHarian input[name="nadi"]').val(nadi);
            $('#formSaveGrafikHarian input[name="respirasi"]').val(respirasi);
            $('#formSaveGrafikHarian input[name="spo2"]').val(spo2);
            $('#formSaveGrafikHarian input[name="o2"]').val(o2);
            $('#formSaveGrafikHarian input[name="gcs"]').val(gcs);
            $('#formSaveGrafikHarian select[name="kesadaran"]').val(kesadaran);

            var htmlEdit = `<input type="hidden" name="action" value="update">
            <input type="hidden" name="tgl_perawatan" value="${tgl_perawatan}">
            <input type="hidden" name="jam_rawat" value="${jam_rawat}">`;

            // clear hidden input
            $('#formSaveGrafikHarian input[name="action"]').remove();
            $('#formSaveGrafikHarian input[name="tgl_perawatan"]').remove();
            $('#formSaveGrafikHarian input[name="jam_rawat"]').remove();

            $('#formSaveGrafikHarian').append(htmlEdit);
        }

        function clearFormGrafikHarian() {
            $('#formSaveGrafikHarian input[name="suhu_tubuh"]').val('-');
            $('#formSaveGrafikHarian input[name="tensi"]').val('-');
            $('#formSaveGrafikHarian input[name="nadi"]').val('-');
            $('#formSaveGrafikHarian input[name="respirasi"]').val('-');
            $('#formSaveGrafikHarian input[name="spo2"]').val('-');
            $('#formSaveGrafikHarian input[name="o2"]').val('-');
            $('#formSaveGrafikHarian input[name="gcs"]').val('-');
        }
    </script>
@endpush
