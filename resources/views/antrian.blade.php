<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ANTRIAN RESEP</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>

<body>
    <div class="w-full h-[100vh] flex items-center align-items-center">
        <div class="w-[95%] h-auto m-auto flex flex-col gap-0">
            <div class="p-3 border-2 xl:border-4 xl:border-b-0 border-b-0 border-blue-500">
                <p class="font-bold text-blue-600 text-5xl text-center">
                    LOKET ANTRIAN FARMASI
                </p>
            </div>
            <div class="p-1 border-2 xl:border-4 border-blue-500 flex flex-col md:flex-row gap-1">
                <div class="w-full md:w-[45%]">
                    <iframe class="w-full rounded-xl h-[450px]" src="https://www.youtube.com/embed/rTu824dilZo"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                    <div class="w-full mt-1.5">
                        <div class="flex justify-center rounded-xl border-2 bg-blue-100 border-blue-500 mb-2 items-center p-2">
                            <div class="w-full text-center">
                                <p class="text-2xl font-bold underline"><span id="nm_pasien"></span></p>
                                <p class="text-lg leading-5 font-mono">
                                    No Resep : <span id="no_resep">-</span>
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 text-slate-900 gap-x-2">
                            <div
                                class="flex justify-between items-center rounded-t-xl p-1.5 px-2 border-2 bg-green-100 border-green-500">
                                <div class="w-full">
                                    <p class="text-base font-bold font-mono">Non Racikan
                                    </p>
                                </div>
                                <div class="w-[30%]">
                                    <p class="text-base font-mono text-right"
                                        id="cnon_racik">0</p>
                                </div>
                            </div>
                            <div
                                class="flex justify-between items-center rounded-t-xl p-1.5 px-2 border-2 bg-yellow-100 border-yellow-500">
                                <div class="w-full">
                                    <p class="text-base font-bold font-mono">Racikan</p>
                                </div>
                                <div class="w-[30%]">
                                    <p class="text-base font-mono text-right"
                                        id="cracik">0</p>
                                </div>
                            </div>

                            <div
                                class="flex justify-between items-center rounded-b-xl p-1.5 px-2 border-2 border-t-0 bg-green-100 border-green-500">
                                <div class="w-full">
                                    <p class="text-base font-bold font-mono">Selesai
                                    </p>
                                </div>
                                <div class="w-[30%]">
                                    <p class="text-base font-mono text-right"
                                        id="nrselesai">0</p>
                                </div>
                            </div>

                            <div
                                class="flex justify-between items-center rounded-b-xl p-1.5 px-2 border-2 border-t-0 bg-yellow-100 border-yellow-500">
                                <div class="w-full">
                                    <p class="text-base font-bold leading-5 font-mono">Selesai</p>
                                </div>
                                <div class="w-[30%]">
                                    <p class="text-base leading-5 font-mono text-right"
                                        id="rselesai">0</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="h-[610px] border-2 border-blue-300 rounded-xl overflow-y-scroll">
                        <table class="table-auto w-full">
                            <thead class="sticky top-0 bg-blue-100">
                                <tr>
                                    <th class="p-3 px-5 border-2 border-blue-300 text-center text-2xl text-blue-600">No Resep</th>
                                    <th class="p-3 px-5 border-2 border-blue-300 text-center text-2xl text-blue-600"> Nama</th>
                                    <th class="p-3 px-5 border-2 border-blue-300 text-center text-2xl text-blue-600">Jam Resep</th>
                                    <th class="p-3 px-5 border-2 border-blue-300 text-center text-2xl text-blue-600"> Kategori</th>
                                    <th class="p-3 px-5 border-2 border-blue-300 text-center text-2xl text-blue-600"> Status</th>
                                    <th class="p-3 px-5 border-2 border-blue-300 text-center text-2xl text-blue-600">Jam Selesai</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="p-3 border-2 xl:border-4 xl:border-t-0 border-t-0 bg-blue-100 border-blue-500">
                <p class="font-bold text-slate-900 text-3xl text-center">
                    <code><span id="tglnow"></span> | <span id="jamnow"></span></code>
                </p>
            </div>
        </div>
    </div>


    <script src="https://code.responsivevoice.org/responsivevoice.js?key=bJDDvdyZ"></script>
    <script>
        $(document).ready(function() {
            getData();

            responsiveVoice.speak("Welcome", "Indonesian Female", {
                pitch: 1,
                rate: .85,
                volume: 1
            });

            $("#no_resep").html(localStorage.getItem('no_panggil'));
            $("#nm_pasien").html(localStorage.getItem('nm_pasien'));

            setInterval(() => {
                getData();
            }, 4000);

            appendTglWaktu();
            
            setInterval(() => {
                appendTglWaktu();
            }, 1000);
        });

        setInterval(() => {
            if (localStorage.getItem('panggil') == "yes") {
                $("#no_resep").html(localStorage.getItem('no_panggil'));
                $("#nm_pasien").html(localStorage.getItem('nm_pasien'));

                setTimeout(() => {
                    var nm_pasien = localStorage.getItem('nm_pasien').toLowerCase();
                    var splitname = nm_pasien.split(",");

                    responsiveVoice.speak(splitname[0] + ". silahkan menuju loket penyerahan obat", "Indonesian Female", {
                        pitch: 1,
                        rate: .85,
                        volume: 1
                    });
                }, 1000);
            }

            $("tr").each(function() {
                if ($(this).attr('id') != localStorage.getItem('no_panggil')) {
                    $(this).removeClass("bg-yellow-400");
                }
            });
            
            
            var no_resep = localStorage.getItem('no_panggil');
            var element = document.getElementById(no_resep);
            
            $("#" + no_resep).addClass("bg-yellow-400");
            element.scrollIntoView({
                behavior: "smooth",
                block: "center",
                inline: "nearest"
            });
        }, 3000);

        function getData() {
            $.ajax({
                url: "<?= url('/get/antrian') ?>",
                type: "GET",
                success: function(data) {
                    var html = "";
                    var rselesai = 0,
                        nrselesai = 0,
                        non_racikan = 0,
                        racikan = 0;
                    $.each(data, function(key, value) {

                        if (value.no_resep == localStorage.getItem('no_panggil')) {
                            html += "<tr id='" + value.no_resep + "' class='bg-yellow-300 font-bold'>";
                        } else {
                            html += "<tr id='" + value.no_resep + "' class='text-blue-700 font-medium'>";
                        }

                        html += "<td class='py-3 px-5 border-2 border-blue-300 text-center text-base xl:text-xl'>" + value.no_resep + "</td>";
                        html += "<td class='py-3 px-5 border-2 border-blue-300 text-left text-base xl:text-xl'>" + value.nm_pasien + "</td>";
                        html += "<td class='py-3 px-5 border-2 border-blue-300 text-center text-base xl:text-xl'>" + value.jam_peresepan + "</td>";
                        html += "<td class='py-3 px-5 border-2 border-blue-300 text-center text-base xl:text-xl'>" + value.category_obat + "</td>";
                        html += "<td class='py-3 px-5 border-2 border-blue-300 text-center text-base xl:text-xl'>" + value.status_obat + "</td>";
                        html += "<td class='py-3 px-5 border-2 border-blue-300 text-center text-base xl:text-xl'>" + value.jam_penyerahan + "</td>";
                        html += "</tr>";

                        if (value.category_obat == 'RACIKAN') {
                            racikan++;
                            if (value.status_obat == 'SELESAI') {
                                rselesai++;
                            }
                        } else {
                            non_racikan++;
                            if (value.status_obat == 'SELESAI') {
                                nrselesai++;
                            }
                        }
                    });

                    $("tbody").html(html);
                    $("#cnon_racik").html(non_racikan);
                    $("#cracik").html(racikan);
                    $("#nrselesai").html(nrselesai);
                    $("#rselesai").html(rselesai);
                }
            });
        }

        function appendTglWaktu() {
            // tglnow realtime date for today indonesian format
            var d = new Date();
            var day = d.getDay();
            var date = d.getDate();
            var month = d.getMonth();
            var year = d.getFullYear();

            var dayname = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

            var monthname = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
                "Agustus", "September", "Oktober", "November", "Desember"
            ];

            $("#tglnow").html(dayname[day] + ", " + date + " " + monthname[month] + " " + year);

            // jam now realtime time indonesia format
            var h = d.getHours();
            var m = d.getMinutes();
            var s = d.getSeconds();

            if (h < 10) {
                h = "0" + h;
            }

            if (m < 10) {
                m = "0" + m;
            }

            if (s < 10) {
                s = "0" + s;
            }

            $("#jamnow").html(h + ":" + m + ":" + s);
        }
    </script>

</body>

</html>