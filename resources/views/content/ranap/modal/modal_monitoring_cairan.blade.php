<div class="modal fade" id="modalMonitoringCairan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Monitoring Keseimbangan Cairan Pasien </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formMonitoringCairan">
                    <div class="row gy-2">
                        <div class="col-lg-4">
                            <div class="input-group">
                                <label for="no_rawat" class="form-label">No. Rawat</label>
                                <input type="text" class="form-control br-full" id="no_rawat" name="no_rawat" readonly>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="input-group">
                                <label for="nm_pasien">Pasien</label>
                                <input type="text" class="form-control br-full" id="nm_pasien" name="nm_pasien" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <label for="keluarga">Keluarga</label>
                                <input type="text" class="form-control br-full" id="keluarga" name="keluarga" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <label for="kamar">Kamar</label>
                                <input type="text" class="form-control br-full" id="kamar" name="kamar" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <label for="diagnosa">Diagnosa Awal</label>
                                <input type="text" class="form-control br-full" id="diagnosa" name="diagnosa" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <label for="dokter">DPJP</label>
                                <input type="text" class="form-control br-full" id="dokter" name="dokter" readonly>
                                <input type="hidden" id="kd_dokter" name="kd_dokter" readonly>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row gy-2 sectionMonitoring">
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="suhu_tubuh">Suhu Tubuh <a href="javascript:void(0);" id="searchPemeriksaanRanap"><i class="bi bi-search"></i></a></label>
                            <x-input-group class="input-group-sm">
                                <x-input id="suhu_tubuh" name="suhu_tubuh" />
                                <x-input-group-text label="°C" />
                            </x-input-group>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="nadi">Nadi</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="nadi" name="nadi" />
                                <x-input-group-text label="x/mnt" />
                            </x-input-group>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="tensi">Tekanan Darah</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="tensi" name="tensi" />
                                <x-input-group-text label="mmHg" />
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="jumlah_carian_infus">Jml. Cairan Infus yang Diberikan</label>
                            <x-input id="jumlah_carian_infus" name="jumlah_carian_infus" />
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="jumlah_tetes_permenit">Jml. Tetes Permenit</label>
                            <x-input id="jumlah_tetes_permenit" name="jumlah_tetes_permenit" />
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="jumlah_urine">Jumlah Urine</label>
                            <x-input id="jumlah_urine" name="jumlah_urine" />
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="cairan_lambung">Cairan Lambung</label>
                            <x-input id="cairan_lambung" name="cairan_lambung" />
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="cairan_drain">Cairan Drain</label>
                            <x-input id="cairan_drain" name="cairan_drain" />
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="lainnya">Lain-lain</label>
                            <x-input id="lainnya" name="lainnya" />
                            @csrf()
                        </div>
                    </div>
                </form>
                <div class="table-responsive mt-5">
                    <table class="table table-bordered table-striped" id="tbMonitoringCairanPasien" width="100%">

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 12px" id="btnSimpanMonitoringCairanPasien">
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
<div class="modal fade" id="modalPemeriksaanRapanCairan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Data Pemeriksaan Rawat Inap </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped" id="tbPemeriksaanRanapCairan">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tgl. & Jam</th>
                            <th>Suhu</th>
                            <th>Nadi</th>
                            <th>Tensi</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        const modalMonitoringCairan = $('#modalMonitoringCairan');
        const formMonitoringCairan = $('#formMonitoringCairan');
        const tbMonitoringCairanPasien = $('#tbMonitoringCairanPasien');
        const btnSimpanMonitoringCairanPasien = $('#btnSimpanMonitoringCairanPasien')
        const searchPemeriksaanRanap = $('#searchPemeriksaanRanap');
        const modalPemeriksaanRapanCairan = $('#modalPemeriksaanRapanCairan');
        const tbPemeriksaanRanapCairan = $('#tbPemeriksaanRanapCairan');


        modalMonitoringCairan.on('hidden.bs.modal', () => {
            formMonitoringCairan.trigger('reset')
        })

        searchPemeriksaanRanap.on('click', () => {
            const no_rawat = formMonitoringCairan.find('input[name=no_rawat]').val();
            getPemeriksaanRanap(no_rawat).done((response) => {
                modalPemeriksaanRapanCairan.modal('show')

                const content = response.map((item, index) => {
                    return `<tr class="cursor-pointer" onclick="setPemeriksaanCairan('${index}')" data-id="${index}">
                        <td>${splitTanggal(item.tgl_perawatan)}</td>
                        <td>${item.jam_rawat}</td>
                        <td>${item.suhu_tubuh} °C</td>
                        <td>${item.nadi} x/mnt</td>
                        <td>${item.tensi} mmHG</td>
                        <td>${item.petugas.nama}</td>
                        </tr>`
                }).join('')

                tbPemeriksaanRanapCairan.find('tbody').empty().html(content)
            })



        })

        function setPemeriksaanCairan(id) {
            const data = tbPemeriksaanRanapCairan.find(`tr[data-id=${id}]`)
            const suhu = data.find('td:nth-child(3)').text()
            const nadi = data.find('td:nth-child(4)').text()
            const tensi = data.find('td:nth-child(5)').text()

            formMonitoringCairan.find('input[name=suhu_tubuh]').val(suhu.split(' °C')[0]);
            formMonitoringCairan.find('input[name=nadi]').val(nadi.split(' x/mnt')[0]);
            formMonitoringCairan.find('input[name=tensi]').val(tensi.split(' mmHG')[0]);

            modalPemeriksaanRapanCairan.modal('hide')

        }




        function showModalMonitoringCairan(no_rawat) {
            getRegPeriksa(no_rawat).done((response) => {
                loadTbMonitoringCairan(no_rawat)
                const {
                    pasien,
                    kamar_inap,
                    dokter
                } = response;

                const kamar = response.kamar_inap.map((item) => {
                    const valKamar = item.stts_pulang != 'Pindah Kamar' ? item.kamar.bangsal.nm_bangsal : '-';
                    return [valKamar, item.diagnosa_awal];
                }).join(',');

                formMonitoringCairan.find('input[name=no_rawat]').val(no_rawat);
                formMonitoringCairan.find('input[name=nm_pasien]').val(`${pasien.nm_pasien} (${response.umurdaftar} ${response.sttsumur})`);
                formMonitoringCairan.find('input[name=keluarga]').val(response.p_jawab)
                formMonitoringCairan.find('input[name=kamar]').val(kamar.split(',')[0]);
                formMonitoringCairan.find('input[name=diagnosa]').val(kamar.split(',')[1]);
                formMonitoringCairan.find('input[name=dokter]').val(dokter.nm_dokter);

                modalMonitoringCairan.modal('show')


            })

        }

        btnSimpanMonitoringCairanPasien.on('click', (e) => {
            const data = getDataForm('#formMonitoringCairan', ['input']);

            $.post(`${url}/monitoring/cairan/pasien`, data).done((response) => {
                alertSuccessAjax().then(() => {
                    loadTbMonitoringCairan(data.no_rawat)
                    $('.sectionMonitoring').find('input').val('-');
                    $('.sectionMonitoring').find('input[name=_token]').val('{{ csrf_token() }}');
                })

            })

        })

        function loadTbMonitoringCairan(no_rawat) {
            tbMonitoringCairanPasien.DataTable({
                destroy: true,
                ajax: {
                    url: `${url}/monitoring/cairan/pasien`,
                    data: {
                        'no_rawat': no_rawat,
                    },
                },
                columns: [{
                        data: 'tgl_perawatan',
                        title: 'Tanggal',
                        name: 'tgl_perawatan'
                    },
                    {
                        data: 'jam_rawat',
                        title: 'Jam',
                        name: 'Jam'
                    },
                    {
                        data: 'petugas.nama',
                        title: 'Petugas',
                        name: 'no_rawat'
                    },
                    {
                        data: 'suhu_tubuh',
                        title: 'Suhu',
                        render: (data, type, row) => {
                            return `${row.suhu_tubuh} °C`
                        },
                        name: 'suhu_tubuh'
                    },
                    {
                        data: 'nadi',
                        title: 'Nadi',
                        render: (data, type, row) => {
                            return `${row.nadi} x/mnt`
                        },
                        name: 'nadi'
                    },
                    {
                        data: 'tensi',
                        title: 'Tensi',
                        render: (data, type, row) => {
                            return `${row.tensi} mmHG`
                        },
                        name: 'tensi'
                    },
                    {
                        data: 'jumlah_carian_infus',
                        title: 'Jml Cairan Infus',
                        name: 'jumlah_carian_infus'
                    },
                    {
                        data: 'jumlah_tetes_permenit',
                        title: 'Jml Tetes /mnt',
                        name: 'jumlah_tetes_permenit'
                    },
                    {
                        data: 'jumlah_urine',
                        title: 'Jml Urine',
                        name: 'jumlah_urine'
                    },
                    {
                        data: 'cairan_lambung',
                        title: 'Cairan Lambung',
                        name: 'cairan_lambung'
                    },
                    {
                        data: 'cairan_drain',
                        title: 'Cairan Drain',
                        name: 'cairan_drain'
                    },
                    {
                        data: 'lainnya',
                        title: 'Lain-Lain',
                        name: 'lainnya'
                    },
                    {
                        title: '',
                        name: 'action',
                        render: (data, type, row) => {
                            return `<button class="btn btn-danger btn-sm" type="button" onclick="deleteMonitorCairanPasien('${row.no_rawat}', '${row.tgl_perawatan}', '${row.jam_rawat}')"><i class="bi bi-trash"></i></button>`
                        }
                    },
                ]
            })
        }

        function deleteMonitorCairanPasien(no_rawat, tgl, jam) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data monitoring cairan pasien akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`${url}/monitoring/cairan/pasien/delete`, {
                        no_rawat: no_rawat,
                        tgl_perawatan: tgl,
                        jam_rawat: jam,
                        _token: '{{ csrf_token() }}'
                    }).done((response) => {
                        alertSuccessAjax().then(() => {
                            loadTbMonitoringCairan(no_rawat)
                        })
                    })
                }
            })
        }
    </script>
@endpush
