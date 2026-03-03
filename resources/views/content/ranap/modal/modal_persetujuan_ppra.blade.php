<div class="modal fade" id="modalDetailPpra" tabindex="-1" aria-labelledby="modalDetailPpraLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailPpraLabel">Form Persetujuan PPRA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formPpra">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="no_rawat">No Rawat</label>
                            <x-input id="no_rawat" name="no_rawat" readonly></x-input>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="no_resep">No Resep</label>
                            <x-input id="no_resep" name="no_resep" readonly></x-input>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="kode_brng">Nama Obat</label>
                            <x-input type="hidden" name="kode_brng" id="kode_brng"></x-input>
                            <x-input id="nama_obat" name="nama_obat" readonly></x-input>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="jumlah">Jumlah</label>
                            <x-input id="jumlah" name="jumlah" readonly></x-input>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="aturan_pakai">Aturan Pakai</label>
                            <x-input id="aturan_pakai" name="aturan_pakai" readonly></x-input>
                        </div>
                    </div>

                    <label for="indikasi_penggunaan">Indikasi Penggunaan</label>
                    <x-input-group>
                        <x-radio-group name="indikasi_penggunaan" :radios="[
        ['value' => 'Profilaksis Bedah', 'label' => 'Profilaksis Bedah'],
        ['value' => 'Profilaksis Non Bedah', 'label' => 'Profilaksis Non Bedah'],
        ['value' => 'Terapi Empiris', 'label' => 'Terapi Empiris'],
        ['value' => 'Terapi Definitif', 'label' => 'Terapi Definitif'],
        ['value' => 'Lainnya', 'label' => 'Lainnya'],
    ]">
                        </x-radio-group>
                    </x-input-group>
                    <label for="catatan_klinis">Catatan Klinis</label>
                    <x-textarea id="catatan_klinis" name="catatan_klinis"></x-textarea>

                    <ul class="nav nav-tabs mt-3" id="tabKlinisPpra" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tabPemeriksaan" data-bs-toggle="tab"
                                data-bs-target="#tabPemeriksaan-pane" type="button" role="tab"
                                aria-controls="tabPemeriksaan-pane" aria-selected="true">Pemeriksaan
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tabLaboratorium" data-bs-toggle="tab"
                                data-bs-target="#tabLaboratorium-pane" type="button" role="tab"
                                aria-controls="tabLaboratorium-pane" aria-selected="false">Laboratorium
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content p-2" id="klinisPpraContent">
                        <div class="tab-pane fade" id="tabPemeriksaan-pane" role="tabpanel"
                            aria-labelledby="tabPemeriksaan">
                            <div class="hasilRiwayatPemeriksaan" style="max-height:300px; overflow:auto"></div>

                        </div>
                        <div class="tab-pane fade" id="tabLaboratorium-pane" role="tabpanel"
                            aria-labelledby="tabLaboratorium">

                            <div class="hasilRiwayatLaboratorium" style="max-height:300px; overflow:auto">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onclick="createPpra()">Simpan</button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>

        $('#modalDetailPpra').on('show.bs.modal', function (e) {
            // 1. Ambil data dari form induk
            const no_resep = $('#formPpra').find('input[name=no_resep]').val();
            const kode_brng = $('#formPpra').find('input[name=kode_brng]').val();
            const no_rawat = $('#formPpra').find('input[name=no_rawat]').val();

            const tabTrigger = $('button[data-bs-target="#tabPemeriksaan-pane"]');


            if (tabTrigger.length > 0) {
                const bootstrapTab = new bootstrap.Tab(tabTrigger[0]);
                bootstrapTab.show();
            }

            getPpra().done((response) => {
                if (response.data !== null) {
                    const data = response.data;
                    $('#formPpra').find(`input[name=indikasi_penggunaan][value="${data.indikasi_penggunaan}"]`).prop('checked', true);
                    $('#formPpra').find('textarea[name=catatan_klinis]').val(data.catatan_klinis);
                } else {
                    $('#formPpra').find(`input[name=indikasi_penggunaan]`).prop('checked', false);
                    $('#formPpra').find('textarea[name=catatan_klinis]').val('');
                }

            })
        });

        $('button[data-bs-target="#tabLaboratorium-pane"]').on('shown.bs.tab', function (e) {
            const no_rawat = $('#formPpra').find('input[name=no_rawat]').val();
            $.get(`/erm/lab/permintaan`, {
                no_rawat: no_rawat
            }).done((response) => {
                let table = '';
                response.forEach((item, index) => {
                    table += `<div id="tablePenunjangLab${item.noorder}">

                <div class="d-none d-flex align-items-center justify-content-between p-1 border infoPasien" style="font-size:11px">
                    <div class="p-2 bd-highlight fw-bold">No. Rawat : ${item.no_rawat} </div>
                    <div class="p-2 bd-highlight fw-bold">Nama : ${item.pasien.no_rkm_medis} -  ${item.pasien.nm_pasien}</div>
                    <div class="p-2 bd-highlight fw-bold">JK. : ${item.pasien.jk === 'L' ? 'Laki-laki' : 'Perempuan'}</div>
                    <div class="p-2 bd-highlight fw-bold">Tgl. Lahir : ${formatTanggal(item.pasien.tgl_lahir)}</div>
                </div>
                <div class="d-flex align-items-center justify-content-between bg-warning p-1" style="font-size:12px" onclick="renderToImagePenunjangLab('${item.noorder}')">
                    <div class="p-2 bd-highlight fw-bold">No. Order : ${item.noorder}</div>
                    <div class="p-2 bd-highlight fw-bold">Diagnosa Klinis : ${item.diagnosa_klinis}</div>
                    <div class="p-2 bd-highlight fw-bold">Informasi : ${item.informasi_tambahan}</div>
                    <div class="p-2 bd-highlight fw-bold">Tgl. Permintaan : ${splitTanggal(item.tgl_permintaan)} ${item.jam_permintaan}</div>    
                </div>
                <table class='table table-bordered table-hover'>
                    <thead>
                        <tr>
                            <td width="">Pemeriksaan</td>    
                            <td width="20%">Hasil</td>    
                            <td width="30%">Nilai Rujukan</td>    
                            <td width="20%">Keterangan</td>    
                        </tr>
                    </thead>
                    <tbody>
                            ${renderHasilPermintaanLab(item.hasil)}
                            <tr>
                                <td colspan="4" class="">Dokter PJ. Lab : <strong>${item.hasil[0]?.dokter.nm_dokter}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="">Saran : <strong>${item.saran_kesan ? item.saran_kesan.saran : '-'}</strong></td>    
                                <td colspan="2" class="">Kesan : <strong>${item.saran_kesan ? item.saran_kesan.kesan : '-'}</strong></td>    
                            </tr>
                    </tbody>
                </table>
                </div>`

                })

                $('.hasilRiwayatLaboratorium').html(table)
            })
        })
        $('button[data-bs-target="#tabLaboratorium-pane"]').on('hidden.bs.tab', function (e) {
            $('.hasilRiwayatLaboratorium').html('')
        })
        $('button[data-bs-target="#tabPemeriksaan-pane"]').on('shown.bs.tab', function (e) {
            const no_rawat = $('#formPpra').find('input[name=no_rawat]').val();
            const container = $('.hasilRiwayatPemeriksaan'); // Pastikan class container ini ada di HTML kamu

            // Tampilkan loading spinner
            container.html('<div class="text-center p-3"><div class="spinner-border spinner-border-sm text-primary"></div> Memuat data...</div>');

            getPemeriksaanRanap(no_rawat).done((response) => {
                let table = '';

                if (response.length > 0) {
                    table = `
                            <table class="table table-bordered table-sm table-hover align-middle" style="font-size:12px">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th width="10%" class="text-center">Tgl & Jam</th>
                                        <th width="15%">TTV</th>
                                        <th>Subyek</th>
                                        <th>Obyek</th>
                                        <th>Asesmen</th>
                                        <th>Plan</th>
                                        <th>Instruksi</th>
                                        <th>Petugas/Dokter</th>
                                    </tr>

                                </thead>
                                <tbody>`;

                    response.forEach((item) => {
                        let suhuValue = item.suhu_tubuh.replace(',', '.');
                        let badgeSuhu = (parseFloat(suhuValue) >= 38) ? 'bg-danger text-white' : 'bg-success';
                        let badgeSumber = (item.sumber === 'SOAP') ? 'bg-success' : 'bg-warning text-dark';

                        table += `
                                <tr>
                                    <td class="text-center">${formatTanggal(item.tgl_perawatan)}<br><small class="text-muted">${item.jam_rawat}</small></td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            <li>Suhu: <span class="badge ${badgeSuhu}">${item.suhu_tubuh} °C</span></li>
                                            <li>Nadi: ${item.nadi} x/menit</li>
                                            <li>Respirasi: ${item.respirasi} x/menit</li>
                                            <li>Tensi: ${item.tensi} mmHg</li>
                                            <li>SpO2: ${item.spo2} %</li>
                                            <li>GCS: ${item.gcs}</li>
                                            <li>O2: ${item.o2 || '-'}</li>
                                            <li>Kesadaran: ${item.kesadaran || '-'}</li>

                                        </ul>    
                                    </td>
                                    <td>${stringPemeriksaan(item.keluhan)}</td>
                                    <td>${stringPemeriksaan(item.pemeriksaan)}</td>
                                    <td>${stringPemeriksaan(item.penilaian)}</td>
                                    <td>${stringPemeriksaan(item.rtl)}</td>
                                    <td>${stringPemeriksaan(item.instruksi)}</td>
                                    <td class="text-center">${item.petugas.nama}<br/><small class="text-muted">${stringPemeriksaan(item.nip)}</small></td>
                                </tr>`;
                    });

                    table += `</tbody></table>`;
                    container.html(table);
                } else {
                    container.html('<div class="alert alert-info text-center">Tidak ada data grafik harian.</div>');
                }
            }).fail(() => {
                container.html('<div class="alert alert-danger text-center">Gagal mengambil data pemeriksaan.</div>');
            });
        });

        $('button[data-bs-target="#tabPemeriksaan-pane"]').on('hidden.bs.tab', function (e) {
            $('.hasilRiwayatPemeriksaan').html('')
        })

        function createPpra() {
            const form = $('#formPpra');
            const data = {
                no_resep: form.find('input[name=no_resep]').val(),
                no_rawat: form.find('input[name=no_rawat]').val(),
                kode_brng: form.find('input[name=kode_brng]').val(),
                indikasi_penggunaan: form.find('input[name=indikasi_penggunaan]:checked').val(),
                catatan_klinis: form.find('textarea[name=catatan_klinis]').val()
            }

            $.post('/erm/resep/ppra', data).done((response) => {
                if (response.success) {
                    swalToast(response.message, 'success');
                    $('#modalDetailPpra').modal('hide');
                } else {
                    swalToast(response.message, 'error');
                }
            }).fail(() => {
                swalToast('Gagal menyimpan data PPRA', 'error');
            })
        }

        function getPpra() {
            const no_rawat = $('#formPpra').find('input[name=no_rawat]').val();
            const no_resep = $('#formPpra').find('input[name=no_resep]').val();
            const kode_brng = $('#formPpra').find('input[name=kode_brng]').val();
            return $.get('/erm/resep/ppra', {
                no_rawat: no_rawat,
                no_resep: no_resep,
                kode_brng: kode_brng
            })

        }
    </script>
@endpush