<div class="modal fade" id="modalEdukasiObatPulang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel"><i>EDUKASI OBAT PULANG</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formEdukasiObatPulang">
                    <div class="row gy-2">
                        <div class="col-lg-2">
                            <label for="no_rawat">No. Rawat</label>
                            <input type="text" class="form-control" id="no_rawat" name="no_rawat" readonly>

                        </div>
                        <div class="col-lg-4">
                            <label for="nm_pasien">Pasien</label>
                            <input type="text" class="form-control" id="nm_pasien" name="nm_pasien" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="tgl_lahir">Tgl. Lahir/Umur</label>
                            <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="keluarga">Keluarga</label>
                            <input type="text" class="form-control" id="keluarga" name="keluarga" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="kamar">Kamar</label>
                            <input type="text" class="form-control" id="kamar" name="kamar" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="diagnosa">Diagnosa Awal</label>
                            <input type="text" class="form-control" id="diagnosa" name="diagnosa" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="dokter">DPJP</label>
                            <input type="text" class="form-control" id="dokter" name="dokter" readonly>
                            <input type="hidden" id="kd_dokter" name="kd_dokter" readonly>
                        </div>

                    </div>
                    <hr>
                    <div class="row gy-2 sectionMonitoring">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="kode_brng">Obat yang diberiksan <a href="javascript:void(0);" id="searchPemberianObat" onclick="showModalResepPulang()"><i class="bi bi-search"></i></a></label>
                            <select name="kode_brng" id="selectObatPulang" data-dropdown-parent="#modalEdukasiObatPulang" class="form-select" style="width: 100%"></select>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="jml">Jumlah</label>
                            <x-input id="jml" name="jml" />
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="aturan_pakai">Aturan Pakai</label>
                            <x-input id="aturan_pakai" name="aturan_pakai" />
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

@push('script')
    <script>
        const modalEdukasiObatPulang = $('#modalEdukasiObatPulang');
        const formEdukasiObatPulang = $('#formEdukasiObatPulang');

        const tbResepObatPulang = $('#tbResepObatPulang');

        const tableEdukasiObatPulang = $('#tableEdukasiObatPulang');
        const selectObatPulang = $('#selectObatPulang');


        modalEdukasiObatPulang.on('hidden.bs.modal', () => {
            formEdukasiObatPulang.trigger('reset');
            selectObatPulang.val(null).trigger('change');
        })
        selectObatPulang.select2({
            placeholder: 'Pilih Obat',
            allowClear: true,
            ajax: {
                url: `${url}/obat/cari`,
                type: 'get',
                data: function(params) {
                    return {
                        nama: params.term
                    }
                },
                dataType: 'json',
                processResults: function(data) {
                    return {
                        results: $.map(data.data, function(item) {
                            return {
                                text: item.nama_brng,
                                id: item.kode_brng
                            }
                        })
                    };
                },
                cache: true
            }
        })

        function setObatPulang(index) {
            const data = tbResepObatPulang.find(`tr[data-id=${index}]`)

            const kode = data.find('td:nth-child(1)').text()
            const obat = data.find('td:nth-child(2)').text()
            const jml = data.find('td:nth-child(3)').text()
            const aturan = data.find('td:nth-child(4)').text()

            var obatOption = new Option(obat, kode, true, true);

            selectObatPulang.append(obatOption).trigger('change');
            formEdukasiObatPulang.find('input[name=jml]').val(jml);
            formEdukasiObatPulang.find('input[name=aturan_pakai]').val(aturan);

            modalResepPulang.modal('hide')
        }

        function showModalObatPulang(no_rawat) {
            modalEdukasiObatPulang.modal('show')
            loadTableEdukasiObat(no_rawat)
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

                formEdukasiObatPulang.find('input[name=no_rawat]').val(no_rawat);
                formEdukasiObatPulang.find('input[name=nm_pasien]').val(`${response.no_rkm_medis} - ${pasien.nm_pasien} (${pasien.jk})`);
                formEdukasiObatPulang.find('input[name=tgl_lahir]').val(`${formatTanggal(pasien.tgl_lahir)} / ${response.umurdaftar} ${response.sttsumur}`);
                formEdukasiObatPulang.find('input[name=keluarga]').val(response.p_jawab)
                formEdukasiObatPulang.find('input[name=kamar]').val(kamar.split(',')[0]);
                formEdukasiObatPulang.find('input[name=diagnosa]').val(kamar.split(',')[1]);
                formEdukasiObatPulang.find('input[name=dokter]').val(dokter.nm_dokter);

                modalEdukasiObatPulang.modal('show')


            })
        }

        function loadTableEdukasiObat(no_rawat) {
            $.get(`${url}/edukasi-obat-pulang`, {
                no_rawat: no_rawat,
            }).done((response) => {
                const data = response.map((item) => {
                    return `<tr>
                            <td>${item.tgl}</td>
                            <td>${item.obat.nama_brng}</td>
                            <td>${item.aturan}</td>
                            <td>${item.jml}</td>
                            <td>${item.intruksi}</td>
                            <td>${item.pagi === '1' ? 'Pagi,' :''} ${item.siang === '1' ? 'Siang,' :''} ${item.sore === '1' ? 'Sore,' :''}${item.malam === '1' ? 'Malam,' :''}</td>
                            <td>${item.keterangan}</td>
                            <td>${item.petugas.nama}</td>
                            <td><a href="javascript:void(0)" onclick="deleteEdukasiObatPulang('${item.no_rawat}', '${item.kode_brng}', '${item.nip}')" class="text-danger" style="cursor: pointer"><i class="bi bi-trash3"></i></a></td>
                        </tr>`
                })

                tableEdukasiObatPulang.find('tbody').empty().html(data)
            })
        }

        function createEdukasiObatPulang() {
            const data = getDataForm('#formEdukasiObatPulang', ['input', 'select', 'textarea']);
            $.post(`${url}/edukasi-obat-pulang`, data, (res) => {
                loadTableEdukasiObat(data.no_rawat)
                toastReload('Berhasil', 2000)

                formEdukasiObatPulang.find('input[name=jml]').val('-')
                formEdukasiObatPulang.find('input[name=aturan_pakai]').val('-')
                formEdukasiObatPulang.find('input[name=instruksi]').val('-')
                formEdukasiObatPulang.find('input[name=keterangan]').val('-')
                selectObatPulang.val(null).trigger('change');
            })

        }

        function deleteEdukasiObatPulang(no_rawat, kode_brng, nip) {
            Swal.fire({
                title: 'Yakin ?',
                text: "Anda tidak bisa mengembalikan lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!',
                cancelButtonText: 'Jangan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`${url}/edukasi-obat-pulang/delete`, {
                        no_rawat: no_rawat,
                        kode_brng: kode_brng,
                        nip: nip,
                        _token: "{{ csrf_token() }}"
                    }).done((response) => {
                        loadTableEdukasiObat(no_rawat)
                        toastReload('Berhasil', 2000)
                    }).fail((error) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal !',
                            text: error.responseJSON,
                        })
                    })
                }

            })
        }
    </script>
@endpush
