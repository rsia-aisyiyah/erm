<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ANTRIAN RESEP</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>
</head>

<body>
    <div class="w-full h-[100vh] flex items-center align-items-center">
        <div class="w-[98%] h-auto m-auto flex flex-col gap-0">
            <div>
                <p class="font-bold text-blue-600 text-[2.5rem] leading-9 text-center">
                    LOKET ANTRIAN FARMASI
                </p>
            </div>
            {{-- separtor horizontal --}}
            <div class="w-full my-2 h-[3px] rounded-full bg-blue-600"></div>
            {{-- separtor horizontal --}}
            <div class="p-1 flex flex-col md:flex-row gap-1">
                <div class="w-full md:w-[35%] h-full">
                    {{-- <iframe class="w-full rounded-xl h-[450px]" src="https://www.youtube.com/embed/rTu824dilZo"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe> --}}
                    <video autoplay="" muted="" class="rounded-xl" loop>
                        <source src="http://192.168.100.31/antrian/image/dinamic/1910070001.mp4" type="video/mp4">
                    </video>
                    <div class="w-full mt-1.5">
                        <div class="flex justify-center rounded-xl border-2 bg-emerald-100 border-emerald-500 mb-2 items-center p-2 h-[161px] max-h-[161px] overflow-y-scroll no-scrollbar"
                            id="name_active_position">
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
                                    <p class="text-base font-mono text-right" id="cnon_racik">0</p>
                                </div>
                            </div>
                            <div
                                class="flex justify-between items-center rounded-t-xl p-1.5 px-2 border-2 bg-yellow-100 border-yellow-500">
                                <div class="w-full">
                                    <p class="text-base font-bold font-mono">Racikan</p>
                                </div>
                                <div class="w-[30%]">
                                    <p class="text-base font-mono text-right" id="cracik">0</p>
                                </div>
                            </div>

                            <div
                                class="flex justify-between items-center rounded-b-xl p-1.5 px-2 border-2 border-t-0 bg-green-100 border-green-500">
                                <div class="w-full">
                                    <p class="text-base font-bold font-mono">Selesai
                                    </p>
                                </div>
                                <div class="w-[30%]">
                                    <p class="text-base font-mono text-right" id="nrselesai">0</p>
                                </div>
                            </div>

                            <div
                                class="flex justify-between items-center rounded-b-xl p-1.5 px-2 border-2 border-t-0 bg-yellow-100 border-yellow-500">
                                <div class="w-full">
                                    <p class="text-base font-bold leading-5 font-mono">Selesai</p>
                                </div>
                                <div class="w-[30%]">
                                    <p class="text-base leading-5 font-mono text-right" id="rselesai">0</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="mt-2 flex flex-col items-center justify-center w-full bg-pink-200 border-2 border-pink-500 rounded-lg p-2 font-mono">
                            <div class="font-bold text-2xl" id="tglnow"></div>
                            <div class="font-bold text-3xl" id="jamnow"></div>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div
                        class="h-[543px] 2xl:h-[590px] border-2 border-blue-300 rounded-xl overflow-y-scroll no-scrollbar">
                        <table class="table-auto w-full">
                            <thead class="sticky top-0 bg-blue-100">
                                <tr>
                                    <th class="p-3 px-5 border-2 border-blue-300 text-center text-2xl text-blue-600">No
                                        Resep</th>
                                    <th class="p-3 px-5 border-2 border-blue-300 text-center text-2xl text-blue-600">
                                        Nama</th>
                                    <th class="p-3 px-5 border-2 border-blue-300 text-center text-2xl text-blue-600">Jam
                                        Resep</th>
                                    <th class="p-3 px-5 border-2 border-blue-300 text-center text-2xl text-blue-600">
                                        Kategori</th>
                                    <th class="p-3 px-5 border-2 border-blue-300 text-center text-2xl text-blue-600">
                                        Status</th>
                                    <th class="p-3 px-5 border-2 border-blue-300 text-center text-2xl text-blue-600">Jam
                                        Selesai</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="w-full h-[50px] bg-green-100 border-2 border-green-500 rounded-xl flex items-center justify-center">
                <marquee behavior="" direction="" class="font-bold text-2xl">
                    WAKTU TUNGGU KATEGORI RESEP <span class="text-rose-500">RACIKAN</span> MAKSIMAL <span
                        class="text-blue-500">1 JAM</span>, UNTUK RESEP <span class="text-rose-500">NON
                        RACIKAN</span> MAKSIMAL <span class="text-blue-50">30 MENIT</span>
                </marquee>
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

            // if name_active_position can be scroll, then scroll to center position
            var nap = document.getElementById("name_active_position");
            if (nap.scrollHeight > nap.clientHeight) {
                nap.scrollIntoView({
                    behavior: "smooth",
                    block: "center",
                    inline: "nearest"
                });
            }
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