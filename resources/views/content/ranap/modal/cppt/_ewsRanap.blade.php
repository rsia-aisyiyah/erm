<h5 class="text-center" style="margin-bottom:0px">EARLY WARNING SYSTEM (EWS)</h5>
<h5 style="" class="kategori mb-3 text-center"></h5>
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

<button class="btn btn-primary btn-sm" type="button" onclick="showFormEws()"><i class="bi bi-plus"></i> Tambah EWS</button>

@push('script')
    <script>
        const tabEws = $('#tab-ews');

        tabEws.on('click', () => {
            const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
            const spesialis = formInfoPasien.find('input[name="kd_sps_dokter"]').val();
            const stts = 'ranap';
            setEws(no_rawat, stts, spesialis)

        })

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

            $.post('/erm/soap/grafik/store', data).done((response)=>{
                const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
                const spesialis = formInfoPasien.find('input[name="kd_sps_dokter"]').val();
                const stts = 'ranap';
                setEws(no_rawat, stts, spesialis)
                $('#modalEwsRanap').modal('hide')
                swalToast('Berhasil Menambah Data EWS')
                formEwsRanap.find('select').val('').change();
                formEwsRanap.find('input').val('').change();
            }).fail(function(xhr, status, error) {
                swalToast('Terjadi Kesalahan', error)
                console.error("Error:", status, error); // Tampilkan detail error
                console.log("XHR Response:", xhr.responseText); // Tampilkan respons server
            })
        }

        function deleteEwsRanap(no_rawat, tgl_perawatan, jam_rawat){
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
                    html += '<tr style="text-align:center" class="judul-ews">'
                    html += '<td rowspan="' + rowspan + '" style="padding:10px">' + res.judul + '</td>'
                    $.map(res.data, (data) => {
                        $('.kategori').text(data.kategori);
                        let hasilPemeriksaan = '';

                        if (data.hasil == 3) {
                            style = "style='background-color:red;color:#fff'";
                        } else if (data.hasil == 2) {
                            style = "style='background-color:orange;color:#fff'";
                        } else if (data.hasil == 1) {
                            style = "style='background-color:yellow;color:#000'";
                        } else {
                            style = "";
                        }

                        html += '<tr class="ews-' + data.id + '" ' + style + ' id="kategori-' + res.kategori + '">'
                        html += '<td style="padding:5px" data-nilai1="' + data.nilai1 + '" data-nilai2="' + data.nilai2 + '" width="5%">' + data.parameter + '</td>'

                        let inputHasil = '';
                        no = 1;
                        $.map(data.hp, (hp) => {

                            if (hp) {
                                inputHasil = '<input type="hidden" value="' + data.hasil + '" class="baris-' + no + ' " name="baris[' + no + '] "/>'
                                html += '<td width="5%">' + inputHasil + '<strong>' + hp + '</strong></td>'
                            } else {
                                html += '<td width="5%"></td>';
                            }
                            no++;

                        })
                        tanggal = data.tanggal
                            .map((tgl, index) => {
                                const id = index + 1;
                                const jamVal = data.jam[index] ?? '';
                                const sumber = data.sumber[index] ?? '';
                                let btnDelete = '';

                                console.log(sumber)
                                if(sumber === 'EWS'){
                                    btnDelete = ` <a
                                                    href="javascript:void(0)"
                                                    onclick="deleteEwsRanap('${params}', '${tgl}', '${jamVal}')">
                                                    <i class="bi bi-x text-danger"></i>
                                                </a>`
                                }

                                return `
                                        <td width="6%" class="td-tanggal" id="tanggal${id}">
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
            <td width="5%" class="td-jam jam${id}">
                ${jam}
            </td>
        `;
                            })
                            .join('');


                        html += '<td style="padding:5px" class="hasil">' + data.hasil + '</td>'
                        html += '</tr>'

                    })
                    html += '</tr>'


                })
                $('#table-ews tbody').append(html)
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
                    classNilai = `bg-danger`;
                } else if (total >= 5 && total <= 6) {
                    classNilai = `bg-warning`;
                } else if (total >= 1 && total <= 4) {
                    classNilai = `bg-warning`;
                    // cekArray = arrNilai.find((o) => {
                    //     if (o == 3) {
                    //         ews = `<div class="alert alert-warning" role="alert" style="padding:12px">Monitoring ulang minimal tiap 3-4 jam, <strong>Panggil dokter jaga</strong> <br/> Monitoring ulang minimal tiap 6-8 jam</div>`;
                    //     }
                    // });
                }

                html += '<td onclick="tindakanEws(' + total + ', ' + index + ')" class="nilai-' + index + ' ' + classNilai + '" style="cursor:pointer" id="total-ews">'
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
            $('.baris-' + index).each(function(index, element) {
                a = $(element).val();
                arrNilai[index] = a;
            });
            if (nilai >= 7) {
                ews = `<div class="alert alert-danger" role="alert" style="padding:12px"> Monitoring ulang tiap jam, <span class="text-danger"><i>call code blue</i></span>, Pindahkan perawatan ke level 2/3 (HCU)</div>`;
            } else if (nilai >= 5 && nilai <= 6) {
                ews = `<div class="alert alert-warning" role="alert" style="padding:12px">Monitoring ulang minimal tiap 3-4 jam, Panggil dokter jaga</div>`;
            } else if (nilai >= 1 && nilai <= 4) {
                ews = `<div class="alert alert-warning" role="alert" style="padding:12px">Monitoring ulang minimal tiap 6-8 jam</div>`;
                cekArray = arrNilai.find((o) => {
                    if (o == 3) {
                        ews = `<div class="alert alert-warning" role="alert" style="padding:12px">Monitoring ulang minimal tiap 3-4 jam, <strong>Panggil dokter jaga</strong> <br/> Monitoring ulang minimal tiap 6-8 jam</div>`;
                    }
                });
            } else if (nilai == 0) {
                ews = `<div class="alert alert-primary" role="alert" style="padding:12px">Monitoring ulang minimal tiap 12 jam </div>`;
            } else {
                $('.hasil-ews').empty(ews);
            }

            $('.hasil-ews').append(ews);
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
                    html += '<tr style="text-align:center" class="judul-ews">'
                    html += '<td rowspan="' + rowspan + '" style="padding:10px">' + res.judul + '</td>'
                    $.map(res.data, (data) => {

                        $('.kategori').text(data.kategori);
                        let hasilPemeriksaan = '';

                        if (data.hasil == 'Merah') {
                            style = "style='background-color:red;color:#fff'";
                        } else if (data.hasil == 'Kuning') {
                            style = "style='background-color:yellow;color:#000'";
                        } else {
                            style = "style='background-color:#fff;color:#000'";
                        }

                        html += '<tr class="ews-' + data.id + '" ' + style + ' id="kategori-' + res.kategori + '">'
                        html += '<td style="padding:5px" data-nilai1="' + data.nilai1 + '" data-nilai2="' + data.nilai2 + '" width="10%">' + data.parameter + '</td>'

                        let inputHasil = '';
                        no = 1;
                        $.map(data.hp, (hp) => {
                            if (hp) {
                                inputHasil = '<input type="hidden" value="' + data.hasil + '" class="baris-' + no + ' " name="baris[' + no + '] "/>'
                                html += '<td width="5%">' + inputHasil + '<strong>' + hp + '</strong></td>'
                            } else {
                                html += '<td width="5%"></td>';
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
                                        <td width="6%" class="td-tanggal" id="tanggal${id}">
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
            <td width="5%" class="td-jam jam${id}">
                ${jam}
            </td>
        `;
                            })
                            .join('');

                        html += '<td style="padding:5px" class="hasil">' + data.hasil + '</td>'
                        html += '</tr>'

                    })
                    html += '</tr>'


                })
                $('#table-ews tbody').append(html)
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
