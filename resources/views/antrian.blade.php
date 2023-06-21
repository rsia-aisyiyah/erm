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
    <div class="w-full h-[100vh] bg-green-100 flex items-center align-items-center">
        <div class="w-[95%] m-auto flex flex-col gap-0">
            <div class="p-3 border-2 border-b-0 border-green-600 border-gray-400">
                <p class="font-bold text-green-700 text-5xl text-center">
                    LOKET ANTRIAN
                </p>
            </div>
            <div class="p-1 border-2 border-green-600 border-gray-400 flex flex-col md:flex-row gap-1">
                <div class="w-full md:w-[45%]">
                    <iframe class="w-full h-[345px]" src="https://www.youtube.com/embed/rTu824dilZo"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                    <div class="w-full border-2 border-green-600 mt-1.5">
                        <div class="flex justify-center items-center p-2">
                            <div class="w-full text-center">
                                <p class="text-xl text-green-700 font-bold underline"><span id="nm_pasien"></span></p>
                                <p class="text-base text-green-700 leading-5 font-mono">
                                    No Resep : <span id="no_resep">-</span>
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2">
                            <div
                                class="flex justify-between items-center my-1 p-1.5 px-2 border-r-2 border-y-2 border-green-600">
                                <div class="w-full">
                                    <p class="text-sm font-bold text-green-700 leading-5 font-mono">Non Racikan</p>
                                </div>
                                <div class="w-[30%]">
                                    <p class="text-sm text-green-700 leading-5 font-mono text-right" id="cnon_racik">0</p>
                                </div>
                            </div>

                            <div
                                class="flex justify-between items-center my-1 p-1 px-2 border-x-0 border-y-2 border-green-600">
                                <div class="w-full">
                                    <p class="text-sm font-bold text-green-700 leading-5 font-mono">Racikan</p>
                                </div>
                                <div class="w-[30%]">
                                    <p class="text-sm text-green-700 leading-5 font-mono text-right" id="cracik">0</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center my-1 px-2">
                            <div class="w-full">
                                <p class="text-sm font-bold text-green-700 leading-5 font-mono">Selesai</p>
                            </div>
                            <div class="w-[30%]">
                                <p class="text-sm text-green-700 leading-5 font-mono text-right" id="cselesai">0</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full bg-green-200">
                    <div class="h-[480px] overflow-y-scroll">
                        <table class="table-auto w-full">
                            <thead class="sticky top-0 bg-green-300">
                                <tr class="border-2 border-green-100">
                                    <th class="p-3 px-5 border-2 border-green-100 text-left text-xl text-green-600">No Resep</th>
                                    <th class="p-3 px-5 border-2 border-green-100 text-left text-xl text-green-600">Nama</th>
                                    <th class="p-3 px-5 border-2 border-green-100 text-left text-xl text-green-600">Jam Resep</th>
                                    <th class="p-3 px-5 border-2 border-green-100 text-left text-xl text-green-600">Kategori</th>
                                    <th class="p-3 px-5 border-2 border-green-100 text-left text-xl text-green-600">Status</th>
                                    <th class="p-3 px-5 border-2 border-green-100 text-left text-xl text-green-600">Jam Selesai</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
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
                    $(this).removeClass("bg-yellow-300");
                }
            });
            
            
            var no_resep = localStorage.getItem('no_panggil');
            var element = document.getElementById(no_resep);
            
            $("#" + no_resep).addClass("bg-yellow-300");
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
                    var cselesai = 0,
                        non_racikan = 0,
                        racikan = 0;
                    $.each(data, function(key, value) {

                        if (value.no_resep == localStorage.getItem('no_panggil')) {
                            html += "<tr id='" + value.no_resep + "' class='bg-yellow-300'>";
                        } else {
                            html += "<tr id='" + value.no_resep + "' class=''>";
                        }

                        html += "<td class='p-1 px-5 border-2 border-green-100 text-left text-base text-green-600'>" + value.no_resep + "</td>";
                        html += "<td class='p-1 px-5 border-2 border-green-100 text-left text-base text-green-600'>" + value.nm_pasien + "</td>";
                        html += "<td class='p-1 px-5 border-2 border-green-100 text-left text-base text-green-600'>" + value.jam_peresepan + "</td>";
                        html += "<td class='p-1 px-5 border-2 border-green-100 text-left text-base text-green-600'>" + value.category_obat + "</td>";
                        html += "<td class='p-1 px-5 border-2 border-green-100 text-left text-base text-green-600'>" + value.status_obat + "</td>";
                        html += "<td class='p-1 px-5 border-2 border-green-100 text-left text-base text-green-600'>" + value.jam_penyerahan + "</td>";
                        html += "</tr>";

                        if (value.status_obat == "SELESAI") {
                            cselesai++;
                        }

                        if (value.category_obat == 'RACIKAN') {
                            racikan++;
                        } else {
                            non_racikan++;
                        }
                    });

                    $("tbody").html(html);
                    $("#cnon_racik").html(non_racikan);
                    $("#cselesai").html(cselesai);
                    $("#cracik").html(racikan);
                }
            });
        }
    </script>

</body>

</html>
