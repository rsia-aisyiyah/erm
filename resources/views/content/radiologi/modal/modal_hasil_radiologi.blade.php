<div class="modal fade" id="modalHasilRadiologi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-6">PEMERIKSAAN RADIOLOGI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="image-set">
                            {{-- <a class="btn btn-success btn-sm mb-2" id="btnMagnifyImage" data-magnify="gallery" data-src="">
                                <i class="bi bi-eye"></i> LAYAR PENUH
                            </a>
                            <a class="btn btn-primary btn-sm mb-2" id="btnDownloadImage" download="" data-src="">
                                <i class="bi bi-download"></i> UNDUH GAMBAR
                            </a>
                            <br />
                            <img id="gambarRadiologi" class="img-thumbnail position-relative" style="padding: 10px" width="100%"> --}}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h3 class="fs-6">Identitas Pasien</h3>
                        <form action="" id="formHasilRadiologi">
                            <div class="row gy-2">
                                <div class="col-sm-12 col-md-12 col-lg-3">
                                    <label for="no_rawat">No. Rawat</label>
                                    <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat" placeholder="" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-5">
                                    <label for="nm_pasien">Pasien</label>
                                    <input type="text" class="form-control form-control-sm" id="nm_pasien" name="nm_pasien" placeholder="" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="tgl_lahir">Tanggal Lahir/Umur</label>
                                    <input type="text" class="form-control form-control-sm" id="tgl_lahir" name="tgl_lahir" placeholder="" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-3">
                                    <label for="poliklinik">Poliklinik Asal</label>
                                    <input type="text" class="form-control form-control-sm" id="poliklinik" name="poliklinik" placeholder="" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-5">
                                    <label for="kamarInap">Kamar Inap</label>
                                    <input type="text" class="form-control form-control-sm" id="kamarInap" name="kamarInap" placeholder="" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="penjab">Pembiayaan</label>
                                    <input type="text" class="form-control form-control-sm" id="penjab" name="penjab" placeholder="" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-2">
                                    <label for="tgl_sampel">Tgl. & Jam Sampling</label>
                                    <input type="text" class="form-control form-control-sm" id="tgl_sampel" name="tgl_sampel" placeholder="" readonly>
                                    <input type="hidden" id="tgl_sampel" name="tgl_sampel">
                                    <input type="hidden" id="jam_sampel" name="jam_sampel">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-2">
                                    <label for="tgl_pemeriksaan">Tgl. & Jam Pemeriksaan</label>
                                    <input type="text" class="form-control form-control-sm" id="tgl_pemeriksaan" name="tgl_pemeriksaan" placeholder="" readonly>
                                    <input type="hidden" id="tgl_periksa" name="tgl_periksa">
                                    <input type="hidden" id="jam" name="jam">
                                    <input type="hidden" id="noorder" name="noorder">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-3">
                                    <label for="dokter_radiologi">Dokter Radiografi</label>
                                    <input type="text" class="form-control form-control-sm" id="dokter_radiologi" name="dokter_radiologi" placeholder="" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-3">
                                    <label for="petugas">Petugas Radiografer</label>
                                    <input type="text" class="form-control form-control-sm" id="petugas" name="petugas" placeholder="" readonly>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-2">
                                    <label for="proyeksi">Proyeksi</label>
                                    <input type="text" class="form-control form-control-sm" id="proyeksi" name="proyeksi" placeholder="" readonly autocomplete="off">
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-2">
                                    <label for="kv">KV</label>
                                    <input type="text" class="form-control form-control-sm" id="kv" name="kv" placeholder="" readonly autocomplete="off">
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-2">
                                    <label for="inak">Inak</label>
                                    <input type="text" class="form-control form-control-sm" id="inak" name="inak" placeholder="" readonly autocomplete="off">
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-2">
                                    <label for="jml_penyinaran">Jml. Penyinaran</label>
                                    <input type="text" class="form-control form-control-sm" id="jml_penyinaran" name="jml_penyinaran" placeholder="" readonly autocomplete="off">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-2">
                                    <label for="dosis">Dosis</label>
                                    <input type="text" class="form-control form-control-sm" id="dosis" name="dosis" placeholder="" readonly autocomplete="off">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label for="Hasil Radiologi">Hasil Radiologi</label>
                                    <textarea class="form-control" id="hasil" name="hasil" cols="8" rows="18" name="hasil"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i>
                    Keluar</button>
                <button type="button" id="btnSimpanHasil" class="btn btn-success btn-sm"><i
                        class="bi bi-download"></i>
                    Simpan</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        function modalHasilRadiologi(no_rawat, tgl_periksa, jam, idOrder) {
            const departemen = "{{ session()->get('pegawai')->departemen }}"
            getPeriksaRadiologi(no_rawat, tgl_periksa, jam).done((response) => {

                console.log('RESPONSE ===', response);

                let gambar = ''
                const tglPeriksa = response.permintaan_radiologi ? response.permintaan_radiologi.tgl_sampel : response.tgl_periksa
                const jamPeriksa = response.permintaan_radiologi ? response.permintaan_radiologi.jam_sampel : response.jam
                $('#formHasilRadiologi input[name=no_rawat]').val(response.no_rawat);
                $('#formHasilRadiologi input[name=petugas]').val(response.petugas.nama);
                $('#formHasilRadiologi input[name=jam]').val(response.jam);
                $('#formHasilRadiologi input[name=tgl_periksa]').val(response.tgl_periksa);
                $('#formHasilRadiologi input[name=nm_pasien]').val(`${response.reg_periksa.pasien.nm_pasien} (${response.reg_periksa.no_rkm_medis})`);
                $('#formHasilRadiologi input[name=tgl_lahir]').val(`${formatTanggal(response.reg_periksa.pasien.tgl_lahir)} (${response.reg_periksa.umurdaftar} ${response.reg_periksa.sttsumur})`);
                $('#formHasilRadiologi input[name=poliklinik]').val(`${response.reg_periksa.poliklinik.nm_poli}`);
                $('#formHasilRadiologi input[name=penjab]').val(`${response.reg_periksa.penjab.png_jawab}`);
                $('#formHasilRadiologi input[name=tgl_pemeriksaan]').val(`${splitTanggal(tglPeriksa)} ${jamPeriksa}`);
                $('#formHasilRadiologi input[name=proyeksi]').val(`${response.proyeksi}`);
                $('#formHasilRadiologi input[name=kv]').val(`${response.kV}`);
                $('#formHasilRadiologi input[name=inak]').val(`${response.inak}`);
                $('#formHasilRadiologi input[name=jml_penyinaran]').val(`${response.jml_penyinaran}`);
                $('#formHasilRadiologi input[name=dosis]').val(`${response.dosis}`);
                $('#formHasilRadiologi input[name=noorder]').val(`${idOrder}`);

                if (departemen == 'RAD') {
                    $('#formHasilRadiologi textarea[name=hasil]').attr('readonly', 'readonly');
                    $('#formHasilRadiologi input[name=inak]').attr('readonly', false);
                    $('#formHasilRadiologi input[name=proyeksi]').attr('readonly', false);
                    $('#formHasilRadiologi input[name=dosis]').attr('readonly', false);
                    $('#formHasilRadiologi input[name=jml_penyinaran]').attr('readonly', false);
                    $('#formHasilRadiologi input[name=kv]').attr('readonly', false);
                }

                if (response.permintaan.length) {
                    response.permintaan.map((permintaan, index) => {
                        if (tgl_periksa == permintaan.tgl_hasil && jam == permintaan.jam_hasil) {
                            $('#formHasilRadiologi input[name=tgl_sampel]').val(`${splitTanggal(permintaan.tgl_sampel)} ${permintaan.jam_sampel}`)
                        }
                    })
                }
                if (Object.keys(response.reg_periksa.kamar_inap).length) {
                    response.reg_periksa.kamar_inap.map((kamarInap) => {
                        $('#formHasilRadiologi input[name=kamarInap]').val(`${kamarInap.kamar.bangsal.nm_bangsal}`)
                    })
                } else {
                    $('#formHasilRadiologi input[name=kamarInap]').val(`-`)
                }
                response.hasil_radiologi.map((hsx) => {
                    if (tgl_periksa == hsx.tgl_periksa && jam == hsx.jam) {
                        $('#formHasilRadiologi textarea[name=hasil]').val(`${hsx ? hsx.hasil : ''}`);
                    }
                })
                let htmlImage = ''
                if (Object.keys(response.gambar_radiologi).length) {
                    response.gambar_radiologi.map((imgx, index) => {
                        if (tgl_periksa == imgx.tgl_periksa) {
                            gambar = `${getBaseUrl()}/webapps/radiologi/${imgx.lokasi_gambar}`
                            htmlImage += `
                                 <a class="btn btn-success btn-sm m-2" id="btnMagnifyImage" class="magnifyImg${index}" data-magnify="gallery" data-src="${gambar}">
                                    <i class="bi bi-eye"></i> LAYAR PENUH
                                </a>
                                <a class="btn btn-primary btn-sm m-2" id="btnDownloadImage" class="downloadImg${index}" download="${textRawat(no_rawat)}" href="${gambar}" target="_blank">
                                    <i class="bi bi-download"></i> UNDUH GAMBAR
                                </a>
                                <img id="gambarRadiologi" loading="lazy" class="img-thumbnail position-relative thumbnailImg${index}" src="${gambar}" style="padding: 10px" width="100%">
                            `;
                        } else {
                            gambar = "{{ asset('/img/default.png') }}";
                            htmlImage += `<img id="gambarRadiologi" loading="lazy" class="img-thumbnail position-relative " src="${gambar}" style="padding: 10px" width="100%">`
                        }
                    })
                    $('#gambarRadiologi').attr('src', `${gambar}`);
                    $('#btnMagnifyImage').attr('href', `${gambar}`);
                    $('.image-set').append(htmlImage);

                } else {
                    gambar = "{{ asset('/img/default.png') }}";
                    htmlImage += `<img id="gambarRadiologi" loading="lazy" class="img-thumbnail position-relative src="${gambar}" style="padding: 10px" width="100%">`
                    $('#gambarRadiologi').attr('src', `${gambar}`);
                    $('#btnMagnifyImage').attr('href', `${gambar}`);
                    $('.image-set').append(htmlImage);

                }
            })
            $('#btnSimpanHasil').attr('onclick', `simpanHasilRadiologi('${no_rawat}')`);
            $('#modalHasilRadiologi').modal('show')
        }
    </script>
@endpush
