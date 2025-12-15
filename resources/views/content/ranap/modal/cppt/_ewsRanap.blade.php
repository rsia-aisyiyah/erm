<button class="btn btn-primary btn-sm m-auto" type="button" onclick="showFormEws()"><i class="bi bi-plus"></i> Tambah EWS</button>
<button class="btn btn-success btn-sm m-auto" type="button" onclick="renderToImageEwsRanap()"><i class="bi bi-save"></i> Export EWS</button>
<div id="sectionEws">


<table class="table table-sm table-borderless d-none" style="margin: 0 auto; width: auto;table-layout: auto;" id="tbInfoPasienEWS">
    <tr>
        <td colspan="4" style="text-align: center; font-weight: bold; font-size: 16px;">
            RUMAH SAKIT IBU DAN ANAK AISYIYAH<br>
            PEKAJANGAN – PEKALONGAN
        </td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: center;">
            Jl. Raya Pekajangan No. 610 Pekajangan – Pekalongan, 51172<br>
            Telp. (0285) 785909 &nbsp; Email: rba610@gmail.com<br>
            Website: www.rsiaaisyiyah.com
        </td>
    </tr>

    <tr><td colspan="4" style="height: 10px;"></td></tr>

    <tr>
        <td style="width: 25%;"><strong>No. Rawat</strong></td>
        <td style="width: 25%;" id="noRawatPasienEWS">: ...........</td>
        <td style="width: 25%;"><strong>Nama</strong></td>
        <td style="width: 25%;" id="nmPasienEws">: ................................</td>
    </tr>
    <tr>
        <td><strong>Tgl. Lahir</strong></td>
        <td id="tglLahirPasienEws">: ................................</td>
        <td ><strong>No. RM</strong></td>
        <td id="noRmPasienEWS"> : ................................</td>
    </tr>
    <tr>
        <td><strong>Ruang / Kelas</strong></td>
        <td id="kamarPasienEWS">: ................................</td>
        <td colspan="2"></td>
    </tr>
</table>

<h6 class="text-center mt-3" style="margin-bottom:0px">EARLY WARNING SCORE (EWS)</h6>
<h6 style="" class="kategori mb-3 text-center"></h6>

<table class="" id="table-ews" style="margin: 0 auto; width: auto;table-layout: auto;">
    <thead>
        <tr class="tr-tanggal">
            <th width="" colspan="2">Tanggal</th>
        </tr>
        <tr class="tr-jam">
            <th colspan="2">Jam</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
        <tr>
            <td class="hasil-ews"></td>
        </tr>

    </tfoot>

</table>
{{--<div class="hasil-ews mt-3">--}}

{{--</div>--}}

</div>

@push('script')
    <script>
        const tabEws = $('#tab-ews');

        tabEws.on('click', () => {
            const formInfoPasien = $('#formInfoPasien');
            const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
            const spesialis = formInfoPasien.find('input[name="kd_sps_dokter"]').val();
            const pasien = formInfoPasien.find('input[name="pasien"]').val();
            const tgl_lahir = formInfoPasien.find('input[name="tgl_lahir"]').val();
            const kamar = formInfoPasien.find('input[name="kamar"]').val();
            const no_rkm_medis = formInfoPasien.find('input[name="no_rkm_medis"]').val();
            const stts = 'ranap';

            $('#nmPasienEws').text(`: ${pasien}`)
            $('#noRawatPasienEWS').text(`: ${no_rawat}`)
            $('#tglLahirPasienEws').text(`: ${tgl_lahir}`)
            $('#kamarPasienEWS').text(`: ${kamar}`)
            $('#noRmPasienEWS').text(`: ${no_rkm_medis}`)

            setEws(no_rawat, stts, spesialis)



        })
        /**
         * Fungsi untuk merender elemen 'sectionEws' ke dokumen PDF
         * menggunakan html2pdf.js, yang memberikan hasil rendering terbaik
         * untuk struktur tabel yang kompleks.
         */
        function renderToImageEwsRanap() {
            const content = document.getElementById(`sectionEws`);
            document.getElementById('tbInfoPasienEWS').classList.remove('d-none');

            // Proses html2canvas
            html2canvas(content, {
                useCORS: true,
                allowTaint: false,
                scale: 2, // Meningkatkan skala untuk gambar beresolusi lebih tinggi
                ignoreElements: (element) => {
                    // Abaikan elemen yang tidak perlu (misalnya, tombol unduh jika ada)
                    return element.tagName === 'BUTTON';
                }
            }).then(function(canvas) {
                const imageDataURL = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = imageDataURL;
                const randomNumber = Math.floor(Math.random() * (99999999 - 1000000 + 1)) + 1000000;
                link.download = `early-warning-score-${randomNumber}.png`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);


                // Bisa kasih notifikasi sukses
                Swal.fire({
                    icon: 'success',
                    text: 'Gambar berhasil diunduh',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    document.getElementById('tbInfoPasienEWS').classList.add('d-none');
                });

            }).catch(function(error) {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    text: error.message
                });
            });
        }

        function showFormEws() {
            const formEwsRanap = $('#formEwsRanap')

            // Ambil waktu lokal dari browser
            const now = new Date()

            // Format YYYY-MM-DD
            const tgl = now.toISOString().slice(0, 10)

            // Format HH:MM:SS dengan leading-zero
            const jam = now.toLocaleTimeString('en-GB', { hour12: false })

            formEwsRanap.find('input[name=tgl_perawatan]').val(tgl)
            formEwsRanap.find('input[name=jam_rawat]').val(jam)
            formEwsRanap.find('input[name=jam_rawat]').val(jam)

            const kdSps = formInfoPasien.find('input[name="kd_sps_dokter"]').val()
            if(kdSps==='S0001'){
                formEwsRanap.find('#maternal').removeClass('d-none')
                formEwsRanap.find('select[name=keluaran_urin]').val('-').change()
                formEwsRanap.find('select[name=proteinuria]').val('-').change()
                formEwsRanap.find('select[name=air_ketuban]').val('-').change()
                formEwsRanap.find('select[name=skala_nyeri]').val('-').change()
                formEwsRanap.find('select[name=lochia]').val('-').change()
                formEwsRanap.find('select[name=terlihat_tidak_sehat]').val('-').change()
                formEwsRanap.find('select[name=kesadaran_maternal]').val('-').change()
            }else{
                formEwsRanap.find('#maternal').addClass('d-none')
                formEwsRanap.find('select[name=keluaran_urin]').val('').change()
                formEwsRanap.find('select[name=proteinuria]').val('').change()
                formEwsRanap.find('select[name=air_ketuban]').val('').change()
                formEwsRanap.find('select[name=skala_nyeri]').val('').change()
                formEwsRanap.find('select[name=lochia]').val('').change()
                formEwsRanap.find('select[name=terlihat_tidak_sehat]').val('').change()
                formEwsRanap.find('select[name=kesadaran_maternal]').val('').change()
            }
            $('#modalEwsRanap').modal('show')

        }

        function createEwsRanap(){
            const data = getDataForm('#formEwsRanap', ['input', 'select'])
            data['no_rawat'] = formInfoPasien.find('input[name="no_rawat"]').val()
            data['sumber'] = 'EWS'
            delete data['nm_pegawai'];
            const formEwsRanap = $('#formEwsRanap')

            $.post('/erm/soap/grafik/store', data).done((response)=>{
                const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
                const spesialis = formInfoPasien.find('input[name="kd_sps_dokter"]').val();
                const stts = 'ranap';
                setEws(no_rawat, stts, spesialis)
                swalToast('Berhasil Menambah Data EWS')
                formEwsRanap.find('.parameterEws').find('select').val('').change();
                formEwsRanap.find('.parameterEws').find('input').val('').change();
                $('#modalEwsRanap').modal('hide')
            }).fail(function(xhr, status, error) {
                swalToast('Terjadi Kesalahan', error)
                console.error("Error:", status, error); // Tampilkan detail error
                console.log("XHR Response:", xhr.responseText); // Tampilkan respons server
            })
        }

        function deleteEwsRanap(no_rawat, tgl_perawatan, jam_rawat){
            Swal.fire({
                title: 'Yakin ingin data EWS ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/erm/soap/grafik/delete',
                        data: {
                            no_rawat,
                            tgl_perawatan,
                            jam_rawat,
                        },
                        method: 'DELETE',
                        success: (response) => {
                            swalToast('Berhasil Hapus EWS')
                            const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
                            const spesialis = formInfoPasien.find('input[name="kd_sps_dokter"]').val();
                            const stts = 'ranap';
                            setEws(no_rawat, stts, spesialis)
                        },
                        error: (request) => {
                            alertSessionExpired(request.status)
                        },
                    })
                }
            })

        }

        function getEws(params, stts) {
            const urlEws = stts == 'ranap' ? '/erm/ews/ranap/' + textRawat(params, '-') : '/erm/ews/ralan/' + textRawat(params, '-');
            const ews = $.ajax({
                url: urlEws,
                dataType: 'JSON',
                method: 'GET',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })

            return ews;
        }


        function setEws(no_rawat, stts, spesialis) {
            if (spesialis == 'S0003') {
                setEwsAnak(no_rawat, stts)
            } else if (spesialis == 'S0001') {
                setEwsMaternal(no_rawat, stts)
            }else{
                setEwsAnak(no_rawat, 'ralan', '')
            }
        }

        function setEwsAnak(params, stts) {
            getRegPeriksa(params).done((rawat) => {
                let jk = rawat.pasien.jk == 'L' ? 'Laki-laki' : 'Perempuan';
                $('#no_rawat_ews').html(rawat.no_rawat);
                $('#nama_pasien_ews').html(rawat.pasien.nm_pasien);
                $('#umur_ews').html(rawat.umurdaftar + ' ' + rawat.sttsumur + ' / ' + jk);
            });
            getEws(params, stts).done(function(response) {
                $('#table-ews tbody').empty()
                $('.td-jam').remove()
                $('.td-tanggal').remove()
                let no = '';
                let j = '';
                tanggal = '';
                html = '';
                style = '';
                let rowspan = '';


                $.map(response, (res) => {
                    $('#kategori-' + res.kategori).empty()

                    rowspan = res.data.length + 1

                    let rowCount = 0;
                    const totalRowsInGroup = res.data.length;
                    $.map(res.data, (data) => {
                        $('.kategori').text(data.kategori);
                        let hasilPemeriksaan = '';


                        rowCount++;

                        // Menentukan class untuk estetika border pengelompokan
                        let groupClass = '';
                        if (rowCount === 1) {
                            groupClass = 'ews-group-start'; // Baris pertama di grup
                        } else if (rowCount === totalRowsInGroup) {
                            groupClass = 'ews-group-end';   // Baris terakhir di grup
                        } else {
                            groupClass = 'ews-group-middle';// Baris tengah
                        }

                        if (data.hasil == 3) {
                            style = "style='background-color:red;color:#fff'";
                        } else if (data.hasil == 2) {
                            style = "style='background-color:orange;color:#fff'";
                        } else if (data.hasil == 1) {
                            style = "style='background-color:yellow;color:#000'";
                        } else {
                            style = "";
                        }

                        html += '<tr class="ews-' + data.id + ' ' + groupClass + '" ' + style + ' id="kategori-' + res.kategori + '">'

                        if (rowCount === 1) {
                            html += '<td style="padding:10px; text-align:center;background-color: #fff !important;" class="criteria-cell">' + res.judul + '</td>'
                        } else {
                            html += '<td style="padding:10px;background-color: #fff !important;" class="criteria-cell-hidden"></td>'
                        }
                        html += '<td style="padding:5px" data-nilai1="' + data.nilai1 + '" data-nilai2="' + data.nilai2 + '" >' + data.parameter + '</td>'

                        let inputHasil = '';
                        no = 1;
                        $.map(data.hp, (hp) => {

                            if (hp) {
                                inputHasil = '<input type="hidden" value="' + data.hasil + '" class="baris-' + no + ' " name="baris[' + no + '] "/>'
                                html += '<td style="border-top:1px solid black !important;">' + inputHasil + '<strong>' + hp + '</strong></td>'
                            } else {
                                html += '<td style="border-top:1px solid black !important;"></td>';
                            }
                            no++;

                        })
                        tanggal = data.tanggal
                            .map((tgl, index) => {
                                const id = index + 1;
                                const jamVal = data.jam[index] ?? '';
                                const sumber = data.sumber[index] ?? '';
                                let btnDelete = '';
                                if(sumber === 'EWS'){
                                    btnDelete = ` <a
                                                    href="javascript:void(0)"
                                                    onclick="deleteEwsRanap('${params}', '${tgl}', '${jamVal}')">
                                                    <i class="bi bi-x text-danger"></i>
                                                </a>`
                                }

                                return `
                                        <td class="td-tanggal" id="tanggal${id}">
                                                <span>${splitTanggal(tgl)}</span>
                                                ${btnDelete}

                                        </td>
                                 `;
                            })
                            .join('');

                        j = data.jam
                            .map((jam, index) => {
                                const id = index + 1;
                                return `
            <td  class="td-jam jam${id}">
                ${jam}
            </td>
        `;
                            })
                            .join('');


                        html += '<td style="padding:5px" class="hasil">' + data.hasil + '</td>'
                        html += '</tr>'

                    })



                })
                $('#table-ews tbody').append(html)
                $('#table-ews tfoot').removeClass('d-none')
                $('.tr-jam').append(j)
                $('.tr-tanggal').append(tanggal)
                hitungNilaiEws(no)
            })
        }
        function hitungNilaiEws(no) {
            html = '<tr>'
            html += '<th colspan=2>NILAI EWS TOTAL</th>'
            let index = 1;
            for (index; index < no; index++) {
                let total = 0;
                let classNilai = '';
                $('.baris-' + index).each(function(index, element) {
                    total = total + parseFloat($(element).val());
                });

                if (total >= 7) {
                    classNilai = `background-color:red`;
                } else if (total >= 5 && total <= 6) {
                    classNilai = `background-color:yellow`;
                } else if (total >= 1 && total <= 4) {
                    classNilai = `background-color:yellow`;
                    // cekArray = arrNilai.find((o) => {
                    //     if (o == 3) {
                    //         ews = `<div class="alert alert-warning" role="alert" style="padding:12px">Monitoring ulang minimal tiap 3-4 jam, <strong>Panggil dokter jaga</strong> <br/> Monitoring ulang minimal tiap 6-8 jam</div>`;
                    //     }
                    // });
                }

                html += '<td onclick="tindakanEws(' + total + ', ' + index + ')" class="nilai-' + index +'" style="cursor:pointer;'+ ' ' + classNilai + '" id="total-ews">'
                html += total
                html += '</td>'
                tindakanEws(total, index)
            }
            html += '</tr>'
            $('#table-ews tbody').append(html)
        }

        function tindakanEws(total, index) {
            let nilai = total;
            $('.hasil-ews').empty();
            ews = '';
            let arrNilai = [];

            $('.baris-' + index).each(function(i, element) {
                arrNilai[i] = $(element).val();
            });

            if (nilai >= 7) {
                ews = `Monitoring ulang tiap jam, <strong class=""><i>call code blue</i></strong>, Pindahkan perawatan ke level 2/3 (HCU)`;
                $('.hasil-ews').prop('style', 'background-color:red')
            } else if (nilai >= 5 && nilai <= 6) {
                ews = `Monitoring ulang minimal tiap 3-4 jam, Panggil dokter jaga`;
                $('.hasil-ews').prop('style', 'background-color:yellow')
            } else if (nilai >= 1 && nilai <= 4) {
                ews = `Monitoring ulang minimal tiap 6-8 jam`;

                if (arrNilai.find(o => o == 3)) {
                    ews = `Monitoring ulang minimal tiap 3-4 jam, <strong>Panggil dokter jaga</strong><br>`;
                }

                $('.hasil-ews').prop('style', 'background-color:yellow')

            } else if (nilai == 0) {
                ews = `Monitoring ulang minimal tiap 12 jam`;
                $('.hasil-ews').prop('style', 'background-color:white')
            }


            // Tempelkan hasil
            $('.hasil-ews').html(ews);

            // Update colspan berdasarkan jumlah tanggal
            let jumlahTanggal = $('.td-tanggal').length+3;

            // Set colspan pada hasil-ews (footer)
            $('.hasil-ews')
                .attr('colspan', jumlahTanggal)
                .css('text-align', 'center');
        }


        function getEwsMaternal(params, stts) {
            const urlEws = stts == 'ranap' ? '/erm/ews/maternal/ranap/' + textRawat(params, '-') : '/erm/ews/maternal/ralan/' + textRawat(params, '-');
            const ews = $.ajax({
                url: urlEws,
                dataType: 'JSON',
                method: 'GET',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })

            return ews;
        }


        function setEwsMaternal(params, stts) {
            getRegPeriksa(params).done((rawat) => {
                let jk = rawat.pasien.jk == 'L' ? 'Laki-laki' : 'Perempuan';
                $('#no_rawat_ews').html(rawat.no_rawat);
                $('#nama_pasien_ews').html(rawat.pasien.nm_pasien);
                $('#umur_ews').html(rawat.umurdaftar + ' ' + rawat.sttsumur + ' / ' + jk);
            });
            getEwsMaternal(params, stts).done(function(response) {
                $('#table-ews tbody').empty()
                $('.td-jam').remove()
                $('.td-tanggal').remove()
                let no = '';
                let j = '';
                tanggal = '';
                html = '';
                style = '';
                let rowspan = '';
                $.map(response, (res) => {
                    $('#kategori-' + res.kategori).empty()

                    rowspan = res.data.length + 1

                    let rowCount = 0;
                    const totalRowsInGroup = res.data.length;
                    $.map(res.data, (data) => {

                        $('.kategori').text(data.kategori);
                        let hasilPemeriksaan = '';
                        rowCount++;
                        if (data.hasil == 'Merah') {
                            style = "style='background-color:red;color:#fff'";
                        } else if (data.hasil == 'Kuning') {
                            style = "style='background-color:yellow;color:#000'";
                        } else {
                            style = "style='background-color:#fff;color:#000'";
                        }


                        // Menentukan class untuk estetika border pengelompokan
                        let groupClass = '';
                        if (rowCount === 1) {
                            groupClass = 'ews-group-start'; // Baris pertama di grup
                        } else if (rowCount === totalRowsInGroup) {
                            groupClass = 'ews-group-end';   // Baris terakhir di grup
                        } else {
                            groupClass = 'ews-group-middle';// Baris tengah
                        }

                        html += '<tr class="ews-' + data.id + ' '+groupClass+'" ' + style + ' id="kategori-' + res.kategori + '">'

                        if (rowCount === 1) {
                            html += '<td style="padding:10px; text-align:center;background-color: #fff !important;" class="criteria-cell">' + res.judul + '</td>'
                        } else {
                            html += '<td style="padding:10px;background-color: #fff !important;" class="criteria-cell-hidden"></td>'
                        }

                        html += '<td style="padding:5px" data-nilai1="' + data.nilai1 + '" data-nilai2="' + data.nilai2 + '" width="10%">' + data.parameter + '</td>'

                        let inputHasil = '';
                        no = 1;
                        $.map(data.hp, (hp) => {
                            if (hp) {
                                inputHasil = '<input type="hidden" value="' + data.hasil + '" class="baris-' + no + ' " name="baris[' + no + '] "/>'
                                html += '<td >' + inputHasil + '<strong>' + hp + '</strong></td>'
                            } else {
                                html += '<td ></td>';
                            }
                            no++;

                        })
                        tanggal = data.tanggal
                            .map((tgl, index) => {
                                const id = index + 1;
                                const jamVal = data.jam[index] ?? '';
                                const sumber = data.sumber[index] ?? '';
                                let btnDelete = '';

                                if(sumber === 'EWS'){
                                    btnDelete = ` <a
                                                    href="javascript:void(0)"
                                                    onclick="deleteEwsRanap('${params}', '${tgl}', '${jamVal}')">
                                                    <i class="bi bi-x text-danger"></i>
                                                </a>`
                                }

                                return `
                                        <td class="td-tanggal" id="tanggal${id}">
                                                <span>${splitTanggal(tgl)}</span>
                                                ${btnDelete}

                                        </td>
                                 `;
                            })
                            .join('');

                        j = data.jam
                            .map((jam, index) => {
                                const id = index + 1;
                                return `
            <td  class="td-jam jam${id}">
                ${jam}
            </td>
        `;
                            })
                            .join('');

                        html += '<td style="padding:5px" class="hasil">' + data.hasil + '</td>'
                        html += '</tr>'

                    })



                })
                $('#table-ews tbody').append(html)
                $('#table-ews tfoot').addClass('d-none')
                $('.tr-jam').append(j)
                $('.tr-tanggal').append(tanggal)
                hitungNilaiEwsMaternal(no)

            })
        }

        function hitungNilaiEwsMaternal(no) {
            let merah = '';
            let kuning = '';
            $('.hasil-ews').empty();
            let kolom = 0;
            html = '<tr style="background:yellow;" id="rowKuning">'
            html += '<th colspan=2>JUMLAH KUNING</th>'
            for (let index = 1; index < no; index++) {
                let total = 0;
                $('.baris-' + index).each(function(index, element) {
                    warna = $(element).val();
                    if (warna == 'Kuning') {
                        total++
                    }
                    kolom++;
                });
                html += `<td class="kuning-${index}" id="" onclick="tindakanEwsMaternal(${index})">`
                kuning = total;
                html += total;
                html += '</td>'
            }
            html += '</tr>'
            html += '<tr style="background:red;color:#fff" id="rowMerah">'
            html += '<th colspan=2>JUMLAH MERAH</th>'
            for (let index = 1; index < no; index++) {
                let total = 0;
                $('.baris-' + index).each(function(index, element) {
                    warna = $(element).val();
                    if (warna == 'Merah') {
                        total++
                    }
                });
                html += `<td class="merah-${index}" id="" onclick="tindakanEwsMaternal(${index})">`
                merah = total;
                html += total;
                html += '</td>'
            }


            // if (merah >= 1 || kuning >= 2) {
            //     tindakan = `<span><strong>LAPOR DPJP : Terdapat nilai <span class="text-danger">merah ${merah}</span> dan <span class="text-warning">kuning ${kuning}</span></strong></span>`
            // } else {
            //     tindakan = `-`
            // }

            tindakan = `<span><strong>Keterangan : Lapor DPJP Bila Terdapat <span class="badge bg-danger text-white" style="font-size:12px">1 Skor Merah</span> dan <span class="badge bg-warning text-dark" style="font-size:12px">2 Skor Kuning</span></strong></span>`
            html += '</tr>'
            html += '<tr>'
            html += `<th colspan=2>TINDAKAN</th>`
            html += `<td class="tindakan" colspan=${kolom+1}>${tindakan}</td>`
            html += '</tr>'

            $('#table-ews tbody').append(html)
        }

        function tindakanEwsMaternal(index) {


            const merah = $('.merah-' + index).text();
            const kuning = $('.kuning-' + index).text();
            const tanggal = $(`#tanggal${index}`).text();
            const jam = $(`.jam${index}`).text();
            // if (merah >= 1 || kuning >= 2) {
            //     tindakan = `<span><strong>Keterangan : Lapor DPJP Bila Terdapat <span class="badge bg-danger text-white" style="font-size:12px">1 Skor Merah</span> dan <span class="badge bg-warning text-dark" style="font-size:12px">2 Skor Kuning</span></strong></span>`
            // } else {
            //     tindakan = `<span><strong>Keterangan : Lapor DPJP Bila Terdapat <span class="badge bg-danger text-white" style="font-size:12px">1 Skor Merah</span> dan <span class="badge bg-warning text-dark" style="font-size:12px">2 Skor Kuning</span></strong></span>`
            // }
            tindakan = `<span><strong>Keterangan : Lapor DPJP Bila Terdapat <span class="badge bg-danger text-white" style="font-size:12px">1 Skor Merah</span> dan <span class="badge bg-warning text-dark" style="font-size:12px">2 Skor Kuning</span></strong></span>`
            $('.tindakan').html(tindakan)

        }
    </script>
@endpush
