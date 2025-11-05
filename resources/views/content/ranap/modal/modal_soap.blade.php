<div class="modal fade" id="modalSoapRanap" tabindex="-1" aria-labelledby="modalSoapRanap" aria-hidden="false">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">PEMERIKSAAN PASIEN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gy-2 mb-2" id="formInfoPasien">
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <label for="no_rawat">No. Rawat</label>
                        <input type="text" class="form-control form-control-sm"
                               id="no_rawat" name="no_rawat" placeholder="" readonly>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="">Pasien</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control form-control-sm"
                                   id="no_rkm_medis" name="no_rkm_medis" placeholder="" readonly>
                            <input type="text" class="form-control form-control-sm w-50"
                                   id="pasien" name="pasien" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label for="tgl_lahir">Tgl. Lahir</label>
                        <input type="text" class="form-control form-control-sm" id="tgl_lahir"
                               name="tgl_lahir" placeholder="" readonly>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <label for="">Keluarga</label>
                        <x-input id="p_jawab" name="p_jawab"/>

                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <label for="">Kamar</label>
                        <x-input-group class="input-group-sm">
                            <x-input id="kamar" name="kamar" readonly class="w-50"/>
                            <x-input id="lama" name="lama" readonly/>
                        </x-input-group>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="">Pebiayaan</label>
                        <x-input-group class="input-group-sm">
                            <x-input id="penjab" name="penjab" readonly class="w-50"/>
                            <x-input id="no_kartu" name="no_kartu" readonly/>
                        </x-input-group>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <label for="diagnosa_awal">Diagnosa Awal</label>
                        <x-input id="diagnosa_awal" name="diagnosa_awal" readonly/>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <label for="dokter_dpjp">Dokter DPJP</label>
                        <input type="text" class="form-control form-control-sm"
                               id="dokter_dpjp" name="dokter_dpjp" placeholder="" readonly>
                        <input type="hidden" id="kd_dokter_dpjp" name="kd_dokter_dpjp">
                        <input type="hidden" id="kd_sps_dokter" name="kd_sps_dokter">
                    </div>
                </div>

                <ul class="nav nav-tabs mt-3" id="tab-soap-ranap" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-soap" data-bs-toggle="tab"
                                data-bs-target="#tab-soap-pane" type="button" role="tab" aria-controls="tab-soap-pane"
                                aria-selected="true">SOAP
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tabSbar" data-bs-toggle="tab"
                                data-bs-target="#tabSbar-pane" type="button" role="tab" aria-controls="tabSbar-pane"
                                aria-selected="true">SBAR
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-tabel" data-bs-toggle="tab" data-bs-target="#tab-tabel-pane"
                                type="button" role="tab" aria-controls="tab-tabel-pane" aria-selected="false">Riwayat
                            S.O.A.P
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-diagnosa" data-bs-toggle="tab"
                                data-bs-target="#tab-diagnosa-pane"
                                type="button" role="tab" aria-controls="tab-diagnosa-pane" aria-selected="false">
                            Diagnosa
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-grafik" data-bs-toggle="tab" data-bs-target="#tab-grafik-pane"
                                type="button" role="tab" aria-controls="tab-grafik-pane" aria-selected="false">Grafik
                            Pasien
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tabTindakan" data-bs-toggle="tab"
                                data-bs-target="#tabTindakan-pane"
                                type="button" role="tab" aria-controls="tabTindakan-pane" aria-selected="true">Tindakan
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-ews" data-bs-toggle="tab" data-bs-target="#tab-ews-pane"
                                type="button" role="tab" aria-controls="tab-ews-pane" aria-selected="false">EWS
                        </button>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-resep" data-bs-toggle="tab" data-bs-target="#tab-resep-pane"
                            type="button" role="tab" aria-controls="tab-resep-pane" aria-selected="false">Resep
                        </button>
                    </li> --}}
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-laboratorium" data-bs-toggle="tab"
                                data-bs-target="#tab-laboratorium-pane"
                                type="button" role="tab" aria-controls="tab-laboratorium-pane" aria-selected="false">
                            Laboratorium
                        </button>
                    </li>
                    <li class="nav-item d-none" role="presentation">
                        <button class="nav-link" id="tabAsuhanGiziDewasa" data-bs-toggle="tab"
                                data-bs-target="#tabAsuhanGiziDewasa-pane"
                                type="button" role="tab" aria-controls="tabAsuhanGiziDewasa-pane" aria-selected="false">
                            Asuhan Gizi Dewasa
                        </button>
                    </li>
                    <li class="nav-item d-none" role="presentation">
                        <button class="nav-link" id="tabAsuhanGiziAnak" data-bs-toggle="tab"
                                data-bs-target="#tabAsuhanGiziAnak-pane"
                                type="button" role="tab" aria-controls="tabAsuhanGiziAnak-pane" aria-selected="false">
                            Asuhan Gizi Anak
                        </button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="tab-soap-pane" role="tabpanel"
                         aria-labelledby="home-tab" tabindex="0">
                        @include('content.ranap.modal.cppt._form_soap')
                    </div>
                    <div class="tab-pane fade p-3" id="tabSbar-pane" role="tabpanel"
                         aria-labelledby="sbar-tab" tabindex="0">
                        @include('content.ranap.modal.cppt._sbar')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-tabel-pane" role="tabpanel" aria-labelledby="tab-tabel"
                         tabindex="0">
                        @include('content.ranap.modal.cppt._table_soap')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-diagnosa-pane" role="tabpanel" aria-labelledby="tab-diagnosa"
                         tabindex="0">
                        @include('content.ranap.modal.cppt._form_diagnosa')
                    </div>
                    <div class="tab-pane fade  p-2 m-2" id="tabTindakan-pane" role="tabpanel"
                         aria-labelledby="tabTindakan" tabindex="0">
                        {{--                        @include('content.poliklinik.modal.tab-tindakan')--}}
                        <ul class="nav nav-tabs nav-tabs-expand" id="groupTindakan" role="tablist">
                            <li class="nav-item" role="presentation" id="tabTindakanDokter">
                                <button class="nav-link" id="btnTabTindakanDokterRanap" data-bs-toggle="tab"
                                        data-bs-target="#targetTindakanDokterRanap"
                                        type="button" role="tab" aria-controls="targetTindakanDokter"
                                        aria-selected="false">Tindakan
                                    Dokter
                                </button>
                            </li>
                            <li class="nav-item" role="presentation" id="tabTindakanPerawat">
                                <button class="nav-link" id="btnTabTindakanPerawatRanap" data-bs-toggle="tab"
                                        data-bs-target="#targetTindakanPerawatRanap"
                                        type="button" role="tab" aria-controls="targetTindakanPerawat"
                                        aria-selected="false">Tindakan
                                    Perawat
                                </button>
                            </li>
                            <li class="nav-item" role="presentation" id="tabTindakanDokterPerawat">
                                <button class="nav-link" id="btnTabTindakanDokterPerawatRanap" data-bs-toggle="tab"
                                        data-bs-target="#targetTindakanDokterPerawatRanap"
                                        type="button" role="tab" aria-controls="targetTindakanDokterPerawat"
                                        aria-selected="false">Tindakan
                                    Dokter & Perawat
                                </button>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col-lg-7 col-xl-6 col-md-12 col-sm-12">
                                <div class="tab-content" id="contentTabTindakan">
                                    <div class="tab-pane fade p-2" id="targetTindakanDokterRanap" role="tabpanel"
                                         aria-labelledby="tabTindakanDokterRanap" tabindex="0">
                                        @include('content.ranap.modal.tindakan.tindakan_ranap_dr')
                                    </div>
                                    <div class="tab-pane fade p-2" id="targetTindakanPerawatRanap" role="tabpanel"
                                         aria-labelledby="tabTindakanPerawatRanap" tabindex="0">
                                        @include('content.poliklinik.modal.tindakan.tindakan_ralan_pr')
                                    </div>
                                    <div class="tab-pane fade p-2" id="targetTindakanDokterPerawatRanap" role="tabpanel"
                                         aria-labelledby="tabTindakanDokterPerawatRanap" tabindex="0">
                                        @include('content.poliklinik.modal.tindakan.tindakan_ralan_drpr')
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-xl-6 col-md-12 col-sm-12">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut dolorem doloribus exercitationem fugit voluptas! A assumenda autem consequatur eaque et id incidunt iure neque, provident quaerat sit vel. Perspiciatis, quas.
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade p-3" id="tab-ews-pane" role="tabpanel" aria-labelledby="tab-ews"
                         tabindex="0">
                        @include('content.ranap.modal.cppt._ewsRanap')
                    </div>
                    {{-- <div class="tab-pane fade p-3" id="tab-resep-pane" role="tabpanel" aria-labelledby="tab-resep"
                        tabindex="0">
                        @include('content.ranap.modal.cppt._resep')
                    </div> --}}
                    <div class="tab-pane fade p-3" id="tab-laboratorium-pane" role="tabpanel"
                         aria-labelledby="tab-laboratorium"
                         tabindex="0">
                        <div id="hasilPermintaanLabSoap"></div>
                    </div>
                    <div class="tab-pane fade" id="tab-grafik-pane" role="tabpanel" aria-labelledby="tab-grafik"
                         tabindex="0">
                        @include('content.ranap.modal.cppt._grafikPemeriksaan')
                    </div>
                    <div class="tab-pane fade" id="tabAsuhanGiziDewasa-pane" role="tabpanel"
                         aria-labelledby="tabAsuhanGiziDewasa"
                         tabindex="0">
                        @include('content.ranap.modal.cppt._formAsuhanGiziDewasa')
                    </div>
                    <div class="tab-pane fade" id="tabAsuhanGiziAnak-pane" role="tabpanel"
                         aria-labelledby="tabAsuhanGiziAnak"
                         tabindex="0">
                        @include('content.ranap.modal.cppt._formAsuhanGiziAnak')
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px"><i
                            class="bi bi-x-circle"></i> Keluar
                </button>

            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        let no_rawat_soap = '';
        const tglSoap1 = '';
        const tglSoap2 = '';
        let getInstance = '';
        let sel = '';

        const formSoapRanap = $('#formSoapRanap')

        const tabSoapRanap = document.querySelector('#tab-soap-ranap li:first-child button')
        const modalSoapRanap = $('#modalSoapRanap')

        const departemen = "{{ session()->get('pegawai')->departemen }}";
        const formInfoPasien = $('#formInfoPasien')
        const tabLaboratorium = $('#tab-laboratorium')

        modalSoapRanap.on('hidden.bs.modal', () => {
            const elementInput = $('input');
            bootstrap.Tab.getInstance(tabSoapRanap).show()
            elementInput.hasClass('is-valid') && elementInput.removeClass('is-valid');
            formAsuhanGiziDewasa.trigger('reset')
            formAsuhanGiziAnak.trigger('reset')
            grafikPemeriksaan.destroy();

        })

        tabLaboratorium.on('click', () => {
            const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
            const hasilLab = $('#hasilPermintaanLabSoap');
            $.get(`/erm/lab/permintaan`, {
                no_rawat: no_rawat
            }).done((response) => {
                let table = '';

                response.forEach((item) => {
                    table += `
                    <div class="d-flex align-items-center justify-content-between bg-warning p-1" style="font-size:12px">
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
                                    <td colspan="4" class="">Dokter PJ. Lab : <strong>${item.hasil.length ? item.hasil[0].dokter.nm_dokter : ''}</strong></td>    
                                </tr>
                                <tr>
                                    <td colspan="2" class="">Saran : <strong>${item.saran_kesan ? item.saran_kesan.saran : '-'}</strong></td>
                                    <td colspan="2" class="">Kesan : <strong>${item.saran_kesan ? item.saran_kesan.kesan : '-'}</strong></td>
                                </tr>
                        </tbody>
                    </table>`

                })

                hasilLab.html(table);

            })
        })

        modalSoapRanap.on('shown.bs.modal', () => {

            if (departemen === 'CSM' || departemen === '-') {
                $('#tgl_perawatan_ubah').removeAttr('disabled');
                $('#jam_rawat_ubah').removeAttr('disabled');
            } else {
                $('#tgl_perawatan_ubah').attr('disabled', 'true');
                $('#jam_rawat_ubah').attr('disabled', 'true');
            }

            date = new Date()
            const hari = ('0' + (date.getDate())).slice(-2);
            const bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            const tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;

            const canvasSuhu = $('#grafik-suhu');

            sel = document.querySelector('#tab-tabel')
            getInstance = bootstrap.Tab.getInstance(sel);
            jamSekarang = setInterval(() => {
                $('#jam_rawat_ubah').val(getJam())
            }, 1000);

            $('#tgl_perawatan_ubah').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                setDate: dateStart,
            });

            $('#tgl_perawatan_ubah').datepicker('setDate', dateStart)
        })

        function showModalSoapRanap(no_rawat) {
            var formInfoPasien = $('#formInfoPasien')
            getRegPeriksa(no_rawat).done((response) => {
                formInfoPasien.find('input[name="no_rawat"]').val(no_rawat);
                formInfoPasien.find('input[name="tgl_lahir"]').val(`${formatTanggal(response.pasien.tgl_lahir)} / ${hitungUmur(response.pasien.tgl_lahir)}`);
                formInfoPasien.find('input[name="no_rkm_medis"]').val(response.no_rkm_medis);
                formInfoPasien.find('input[name="p_jawab"]').val(response.p_jawab);
                formInfoPasien.find('input[name="pasien"]').val(`${response.pasien.nm_pasien} (${response.pasien.jk})`);
                formInfoPasien.find('input[name="penjab"]').val(`${response.penjab.png_jawab}`);
                formInfoPasien.find('input[name="no_kartu"]').val(`${response.pasien.no_peserta}`);
                formInfoPasien.find('input[name="umur"]').val(`${response.umurdaftar} ${response.sttsumur}`);
                formInfoPasien.find('input[name="dokter_dpjp"]').val(`${response.dokter.nm_dokter}`);
                formInfoPasien.find('input[name="kd_dokter_dpjp"]').val(`${response.kd_dokter}`);
                formInfoPasien.find('input[name="kd_sps_dokter"]').val(`${response.dokter.kd_sps}`);

                const kamar = response.kamar_inap.map((item, index) => {
                    formInfoPasien.find('input[name="kamar"]').val(`${item.kamar.bangsal.nm_bangsal}`);
                    formInfoPasien.find('input[name="lama"]').val(`${hitungLamaHari(item.tgl_masuk)} Hari`)
                    formInfoPasien.find('input[name="diagnosa_awal"]').val(item.diagnosa_awal);
                })

                $('#nomor_rawat').val(response.no_rawat);
                $('#nm_pasien').val(response.pasien.nm_pasien + ' (' + hitungUmur(response.pasien.tgl_lahir) + ')');
                $('#nik').val("{{ session()->get('pegawai')->nik }}");
                $('#nama').val("{{ session()->get('pegawai')->nama }}");
                $('#formSoapRanap input[name=spesialis]').val(response.dokter.kd_sps);

                const tabAsuhanGiziAnakParent = $('#tabAsuhanGiziAnak').parent()
                const tabAsuhanGiziDewasaParent = $('#tabAsuhanGiziDewasa').parent()

                if (response.dokter.kd_sps === 'S0001') {
                    tabAsuhanGiziAnakParent.addClass('d-none')
                    tabAsuhanGiziDewasaParent.removeClass('d-none')
                    $('.formEws').removeAttr('style');
                    $('.formEws select[name=keluaran_urin]').val('-').change()
                    $('.formEws select[name=proteinuria]').val('-').change()
                    $('.formEws select[name=air_ketuban]').val('-').change()
                    $('.formEws select[name=skala_nyeri]').val('-').change()
                    $('.formEws select[name=lochia]').val('-').change()
                    $('.formEws select[name=terlihat_tidak_sehat]').val('-').change()
                } else {
                    tabAsuhanGiziDewasaParent.addClass('d-none')
                    tabAsuhanGiziAnakParent.removeClass('d-none')
                    $('.formEws').css('display', 'none');
                    $('.formEws select[name=keluaran_urin]').val('').change()
                    $('.formEws select[name=proteinuria]').val('').change()
                    $('.formEws select[name=air_ketuban]').val('')
                    $('.formEws select[name=skala_nyeri]').val('')
                    $('.formEws select[name=lochia]').val('').change()
                    $('.formEws select[name=terlihat_tidak_sehat]').val('').change()
                }

                getDokter("{{ session()->get('pegawai')->nama }}").done((response) => {
                    if (response.length) {
                        $('.btn-tambah-grafik-harin').css('display', 'none')
                    } else {
                        $('.btn-tambah-grafik-harin').css('display', 'inline')
                    }
                })
                $('.btn-tambah-grafik-harin').attr('onclick', 'modalGrafikHarian("' + response.no_rawat + '","' + response.pasien.nm_pasien + ' (' + hitungUmur(response.pasien.tgl_lahir) + ')")');


                $('#formSoapRanap .btn-simpan').attr('data-kd-dokter', response.dokter.kd_dokter);
                $('#formSoapRanap .btn-simpan').attr('data-spesialis', response.dokter.spesialis.nm_sps);
                $('#formSoapRanap .btn-simpan').attr('data-nm-pasien', response.pasien.nm_pasien);

                $('#formSaveGrafikHarian #kdDokter').attr('data-kd-dokter', response.dokter.kd_dokter);
                $('#formSaveGrafikHarian #spesialisDokter').attr('data-spesialis', response.dokter.spesialis.nm_sps);
                $('#formSaveGrafikHarian #nmPasien').attr('data-nm-pasien', response.pasien.nm_pasien);
            })

            $('#modalSoapRanap').modal('toggle')

            tbSoapRanap(no_rawat);
            buildGrafik(no_rawat);
            appendDataGrafikHarian(no_rawat);
        }

        function getDetailPemeriksaanRanap(no_rawat, tgl, jam) {
            const pemeriksaan = $.ajax({
                url: '/erm/soap/ambil',
                data: {
                    'no_rawat': no_rawat,
                    'tgl_perawatan': tgl,
                    'jam_rawat': jam
                },
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return pemeriksaan;
        }


        function checkJam() {
            cek = $('#cekJam').is(':checked')
            if (cek) {
                clearInterval(jamSekarang)
            } else {
                jamSekarang = setInterval(() => {
                    $('#jam_rawat_ubah').val(getJam())
                }, 1000);
            }
        }

        $('#cekJam').on('change', function () {
            checkJam();
        })
    </script>
@endpush
