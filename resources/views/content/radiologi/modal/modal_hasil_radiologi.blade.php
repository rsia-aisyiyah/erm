<div class="modal fade" id="modalHasilRadiologi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-6">Hasil Pemeriksaan Radiologi</h5>
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
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-3">
                                    <label for="no_rawat">No. Rawat</label>
                                    <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat" placeholder="" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label for="nm_pasien">Pasien</label>
                                    <input type="text" class="form-control form-control-sm" id="nm_pasien" name="nm_pasien" placeholder="" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-3">
                                    <label for="tgl_lahir">Tanggal Lahir/Umur</label>
                                    <input type="text" class="form-control form-control-sm" id="tgl_lahir" name="tgl_lahir" placeholder="" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="poliklinik">Poliklinik</label>
                                    <input type="text" class="form-control form-control-sm" id="poliklinik" name="poliklinik" placeholder="" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="penjab">Pembiayaan</label>
                                    <input type="text" class="form-control form-control-sm" id="penjab" name="penjab" placeholder="" readonly>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="tgl_sampel">Tanggal & Jam Sampling</label>
                                    <input type="text" class="form-control form-control-sm" id="tgl_sampel" name="tgl_sampel" placeholder="" readonly>
                                    <input type="hidden" id="tgl_periksa" name="tgl_periksa">
                                    <input type="hidden" id="jam" name="jam">
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <label for="proyeksi">Proyeksi</label>
                                    <input type="text" class="form-control form-control-sm" id="proyeksi" name="proyeksi" placeholder="" readonly>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <label for="kv">KV</label>
                                    <input type="text" class="form-control form-control-sm" id="kv" name="kv" placeholder="" readonly>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <label for="inak">Inak</label>
                                    <input type="text" class="form-control form-control-sm" id="inak" name="inak" placeholder="" readonly>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-3">
                                    <label for="jml_penyinaran">Jml. Penyinaran</label>
                                    <input type="text" class="form-control form-control-sm" id="jml_penyinaran" name="jml_penyinaran" placeholder="" readonly>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
    <script></script>
@endpush
