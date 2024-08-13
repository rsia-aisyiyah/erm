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
    </script>
@endpush
