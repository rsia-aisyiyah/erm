<div class="modal fade" id="modalDischargePlanning" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel"><i>PERENCANAAN PASIEN PULANG (DISCHARGE PLANNING)</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formDischargePlanning">
                    <div class="row gy-2">
                        <div class="col-lg-2">
                            <label for="no_rawat" class="form-label">No. Rawat</label>
                            <input type="text" class="form-control" id="no_rawat" name="no_rawat" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="nm_pasien" class="form-label">Pasien</label>
                            <input type="text" class="form-control" id="nm_pasien" name="nm_pasien" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="keluarga" class="form-label">Keluarga</label>
                            <input type="text" class="form-control" id="keluarga" name="keluarga" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="kamar" class="form-label">Kamar</label>
                            <input type="text" class="form-control" id="kamar" name="kamar" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="tgl_registrasi" class="form-label">Tgl. Masuk</label>
                            <input type="text" class="form-control" id="tgl_registrasi" name="tgl_registrasi" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="diagnosa" class="form-label">Diag. Awal</label>
                            <input type="text" class="form-control" id="diagnosa" name="diagnosa" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="dokter" class="form-label">DPJP</label>
                            <input type="text" class="form-control" id="dokter" name="dokter" readonly>
                            <input type="hidden" id="kd_dokter" name="kd_dokter" readonly>
                        </div>

                    </div>
                    <hr>
                    <div class="row gy-2 sectionMonitoring">
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="tgl_rencana_pulang" class="form-label">Tgl. Rencana Pulang</label>
                            <x-input id="tgl_rencana_pulang" name="tgl_rencana_pulang" class="datetimepicker" />
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="rencana_rawat" class="form-label">Rencana Rawat</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="rencana_rawat" name="rencana_rawat" />
                                <x-input-group-text>
                                    Hari
                                </x-input-group-text>

                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="diagnosa_keluar" class="form-label">Diagnosa Keluar</label>
                            <select class="form-select" name="diagnosa_keluar" id="diagnosa_keluar" data-dropdown-parent="#modalDischargePlanning" style="width:100%"></select>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <label for="kondisi_pulang" class="form-label">Kondisi Pulang</label>
                            <x-input-group>
                                <x-radio-group
                                    name="kondisi_pulang"
                                    :radios="[
                                        'pulang1' => ['value' => 'Sembuh', 'label' => 'Sembuh', 'checked' => true],
                                        'pulang2' => ['value' => 'Pulang APS', 'label' => 'Pulang APS'],
                                        'pulang3' => ['value' => 'Meninggal', 'label' => 'Meninggal'],
                                    ]" />
                            </x-input-group>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <label for="mobilisasi" class="form-label">Kondisi Pulang</label>
                            <x-input-group>
                                <x-radio-group
                                    name="mobilisasi"
                                    :radios="[
                                        'mobilisasi1' => ['value' => 'Jalan', 'label' => 'Jalan', 'checked' => true],
                                        'mobilisasi2' => ['value' => 'Tongkat', 'label' => 'Tongkat'],
                                        'mobilisasi3' => ['value' => 'Kursi Roda', 'label' => 'Kursi Roda'],
                                        'mobilisasi4' => ['value' => 'Brankal', 'label' => 'Brankal'],
                                    ]" />
                            </x-input-group>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <label for="alat_terpasang" class="form-label">Alat yang Terpasang Saat Pulang</label>
                            <x-input-group>
                                <x-radio-group
                                    name="alat_terpasang"
                                    :radios="[
                                        'alat_terpasang1' => ['value' => 'Tidak Ada', 'label' => 'Tidak Ada', 'checked' => true],
                                        'alat_terpasang2' => ['value' => 'Oksigen', 'label' => 'Oksigen'],
                                        'alat_terpasang3' => ['value' => 'Infus', 'label' => 'Infus'],
                                        'alat_terpasang4' => ['value' => 'Kursi Roda', 'label' => 'Kursi Roda'],
                                        'alat_terpasang5' => ['value' => 'Brankal', 'label' => 'Brankal'],
                                    ]" />
                            </x-input-group>
                        </div>
                        <div class="col-lg-5">
                            <label for="waktu">Waktu</label>
                            <x-input-group>
                                <x-checkbox-group
                                    name="waktu"
                                    :checkboxes="[
                                        'w1' => ['value' => 'Pagi', 'label' => 'Pagi', 'checked' => true],
                                        'w2' => ['value' => 'Siang', 'label' => 'Siang'],
                                        'w3' => ['value' => 'Sore', 'label' => 'Sore'],
                                        'w4' => ['value' => 'Malam', 'label' => 'Malam'],
                                    ]" />
                            </x-input-group>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="instruksi">Instruksi Khusus</label>
                            <x-input id="instruksi" name="instruksi" />
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="keterangan">Keterangan</label>
                            <x-input id="keterangan" name="keterangan" />
                            @csrf
                        </div>


                    </div>
                </form>
                <div class="table-responsive mt-5">
                    <table class="table table-bordered table-striped" id="tableEdukasiObatPulang">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Obat</th>
                                <th>Aturan Pakai</th>
                                <th>Jumlah</th>
                                <th>Instruksi</th>
                                <th>Waktu Konsumsi</th>
                                <th>Keterangan</th>
                                <th>Petugas</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 12px" onclick="createEdukasiObatPulang()">
                    <i class="bi bi-save">
                    </i> Simpan
                </button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px">
                    <i class="bi bi-x-circle">
                    </i> Keluar
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalResepPulang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel"><i>RESEP OBAT PULANG</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="tbResepObatPulang" width="100%">
                        <thead>
                            <tr>
                                <th>Obat</th>
                                <th>Jumlah</th>
                                <th>Aturan Pakai</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        const modalDischargePlanning = $('#modalDischargePlanning');
        const formDischargePlanning = $('#formDischargePlanning');
        // const searchPemberianObat = $('#searchPemberianObat');
        // const tbResepObatPulang = $('#tbResepObatPulang');
        // const modalResepPulang = $('#modalResepPulang');
        // const tableEdukasiObatPulang = $('#tableEdukasiObatPulang');
        const selectDiagnosaKeluar = formDischargePlanning.find('select[name=diagnosa_keluar]');


        modalDischargePlanning.on('hidden.bs.modal', () => {
            formDischargePlanning.trigger('reset');
            // selectObatPulang.val(null).trigger('change');
        })

        selectDiagnosaKeluar.select2({
            placeholder: 'Pilih Diagnosa Keluar',
            allowClear: true,
            tags: true,
            ajax: {
                url: `${url}/penyakit/cari`,
                type: 'get',
                data: function(params) {
                    return {
                        nm_penyakit: params.term,
                        kd_penyakit: params.term
                    }
                },
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: `${item.kd_penyakit} - ${item.nm_penyakit}`,
                                id: item.kd_penyakit
                            }
                        })
                    };
                },
                cache: true
            }
        })

        // searchPemberianObat.on('click', () => {
        //     const no_rawat = formDischargePlanning.find('input[name=no_rawat]').val();
        //     modalResepPulang.modal('show')

        //     $.get(`${url}/resep-pulang`, {
        //         no_rawat: no_rawat
        //     }).done((response) => {
        //         const obat = response.map((item, index) => {
        //             return `<tr onclick="setObatPulang('${index}')" data-id="${index}">
    //                 <td>${item.kode_brng}</td>
    //                 <td>${item.obat.nama_brng}</td>
    //                 <td>${item.jml_barang}</td>
    //                 <td>${item.dosis}</td>
    //                 <td>${item.tanggal}</td>
    //                 <td>${item.jam}</td>
    //                 </tr>`
        //         })

        //         tbResepObatPulang.find('tbody').empty().html(obat)

        //     })
        // })

        // function setObatPulang(index) {
        //     const data = tbResepObatPulang.find(`tr[data-id=${index}]`)

        //     const kode = data.find('td:nth-child(1)').text()
        //     const obat = data.find('td:nth-child(2)').text()
        //     const jml = data.find('td:nth-child(3)').text()
        //     const aturan = data.find('td:nth-child(4)').text()


        //     var obatOption = new Option(obat, kode, true, true);

        //     selectObatPulang.append(obatOption).trigger('change');
        //     formDischargePlanning.find('input[name=jml]').val(jml);
        //     formDischargePlanning.find('input[name=aturan_pakai]').val(aturan);

        //     modalResepPulang.modal('hide')
        // }



        function showModalDischargePlanning(no_rawat) {
            modalDischargePlanning.modal('show')
            // loadTableEdukasiObat(no_rawat)
            getRegPeriksa(no_rawat).done((response) => {
                const {
                    pasien,
                    kamar_inap,
                    dokter
                } = response;

                const kamar = response.kamar_inap.map((item) => {
                    const valKamar = item.stts_pulang != 'Pindah Kamar' ? item.kamar.bangsal.nm_bangsal : '-';
                    return [valKamar, item.diagnosa_awal];
                }).join(',');

                console.log(response);


                formDischargePlanning.find('input[name=no_rawat]').val(no_rawat);
                formDischargePlanning.find('input[name=nm_pasien]').val(`${pasien.nm_pasien} (${response.umurdaftar} ${response.sttsumur})`);
                formDischargePlanning.find('input[name=keluarga]').val(response.p_jawab)
                formDischargePlanning.find('input[name=alamat]').val(`${pasien.alamat}, ${pasien.kecamatanpj}`)
                formDischargePlanning.find('input[name=kamar]').val(kamar.split(',')[0]);
                formDischargePlanning.find('input[name=tgl_registrasi]').val(`${formatTanggal(response.tgl_registrasi)} ${response.jam_reg}`);
                formDischargePlanning.find('input[name=diagnosa]').val(kamar.split(',')[1]);
                formDischargePlanning.find('input[name=dokter]').val(dokter.nm_dokter);

                modalDischargePlanning.modal('show')


            })
        }

        // function loadTableEdukasiObat(no_rawat) {
        //     $.get(`${url}/edukasi-obat-pulang`, {
        //         no_rawat: no_rawat,
        //     }).done((response) => {
        //         const data = response.map((item) => {
        //             return `<tr>
    //                     <td>${item.tgl}</td>
    //                     <td>${item.obat.nama_brng}</td>
    //                     <td>${item.aturan}</td>
    //                     <td>${item.jml}</td>
    //                     <td>${item.intruksi}</td>
    //                     <td>${item.pagi === '1' ? 'Pagi,' :''} ${item.siang === '1' ? 'Siang,' :''} ${item.sore === '1' ? 'Sore,' :''}${item.malam === '1' ? 'Malam,' :''}</td>
    //                     <td>${item.keterangan}</td>
    //                     <td>${item.petugas.nama}</td>
    //                     <td><a href="javascript:void(0)" onclick="deleteEdukasiObatPulang('${item.no_rawat}', '${item.kode_brng}', '${item.nip}')" class="text-danger" style="cursor: pointer"><i class="bi bi-trash3"></i></a></td>
    //                 </tr>`
        //         })

        //         tableEdukasiObatPulang.find('tbody').empty().html(data)
        //     })
        // }

        // function createEdukasiObatPulang() {
        //     const data = getDataForm('#formDischargePlanning', ['input', 'select', 'textarea']);
        //     $.post(`${url}/edukasi-obat-pulang`, data, (res) => {
        //         loadTableEdukasiObat(data.no_rawat)
        //         toastReload('Berhasil', 2000)

        //         formDischargePlanning.find('input[name=jml]').val('-')
        //         formDischargePlanning.find('input[name=aturan_pakai]').val('-')
        //         formDischargePlanning.find('input[name=instruksi]').val('-')
        //         formDischargePlanning.find('input[name=keterangan]').val('-')
        //         selectObatPulang.val(null).trigger('change');
        //     })

        // }

        // function deleteEdukasiObatPulang(no_rawat, kode_brng, nip) {
        //     Swal.fire({
        //         title: 'Yakin ?',
        //         text: "Anda tidak bisa mengembalikan lagi",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Ya, hapus saja!',
        //         cancelButtonText: 'Jangan',
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.post(`${url}/edukasi-obat-pulang/delete`, {
        //                 no_rawat: no_rawat,
        //                 kode_brng: kode_brng,
        //                 nip: nip,
        //                 _token: "{{ csrf_token() }}"
        //             }).done((response) => {
        //                 loadTableEdukasiObat(no_rawat)
        //                 toastReload('Berhasil', 2000)
        //             }).fail((error) => {
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Gagal !',
        //                     text: error.responseJSON,
        //                 })
        //             })
        //         }

        //     })
        // }
    </script>
@endpush
