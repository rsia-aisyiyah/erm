<div class="row" id="listAsmedAnak">
</div>
@push('script')
    <script>
        function getListAsmedRajalAnak(no_rkm_medis) {
            const asmed = $.ajax({
                url: `/erm/poliklinik/asmed/anak/riwayat/${no_rkm_medis}`,
                method: 'GET',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return asmed;
        }

        function listAsmedAnak(data) {
            $('#listAsmedAnak').empty()
            $.map(data, (a) => {
                html = `<div class="mb-3 col-lg-3 col-md-4 col-sm-12">
                       <div class="card card-shadow">
                        <p class="card-header" style="font-size:12px">Tgl. Asesmen ${formatTanggal(a.tanggal)} ${a.tanggal.split(' ')[1]} </p>
                        <div class="card-body">
                            <h6 class="card-title">${a.dokter.nm_dokter}</h6>
                            <p class="card-text"><b>(${a.reg_periksa.no_rkm_medis} ) - ${a.reg_periksa.pasien.nm_pasien} </b> <br> ${a.no_rawat} <br/> Tgl. Periksa ${formatTanggal(a.reg_periksa.tgl_registrasi)}</p>
                            <a href="/erm/poliklinik/asmed/anak/print/${textRawat(a.no_rawat, '-')}" target="_blank" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i> Lihat</a>
                            <a href="javascript:void(0)" onclick="setAsmedRajalAnak('${a.no_rawat}')" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                            </div>
                            </div>
                         </div>`
                $('#listAsmedAnak').append(html)
            })
        }

        function setAsmedRajalAnak(no_rawat) {
            getAsmedAnak(no_rawat).done((asmed) => {
                const sel = document.querySelector('#tab-soap-rajal button[data-bs-target="#tab-asmed-ana"]')
                bootstrap.Tab.getOrCreateInstance(sel).show();
                $('.form-asmed-anak button[name="simpan"]').css('display', 'none')
                $('.form-asmed-anak button[name="edit"]').css('display', 'inline')
                $('.form-asmed-anak select[name="anamnesis"]').val(asmed.anamnesis).change()
                $('.form-asmed-anak input[name="hubungan"]').val(asmed.hubungan)
                $('.form-asmed-anak input[name="no_rawat"]').val(asmed.no_rawat)
                $('.form-asmed-anak textarea[name="keluhan_utama"]').val(asmed.keluhan_utama)
                $('.form-asmed-anak textarea[name="rps"]').val(asmed.rps)
                $('.form-asmed-anak textarea[name="rpk"]').val(asmed.rpk)
                $('.form-asmed-anak textarea[name="rpd"]').val(asmed.rpd)
                $('.form-asmed-anak textarea[name="rpo"]').val(asmed.rpo)
                $('.form-asmed-anak input[name="alergi"]').val(asmed.alergi)
                $('.form-asmed-anak select[name="keadaan"]').val(asmed.keadaan).change()
                $('.form-asmed-anak select[name="kesadaran"]').val(asmed.kesadaran).change()
                $('.form-asmed-anak input[name="gcs"]').val(asmed.gcs)
                $('.form-asmed-anak input[name="tb"]').val(asmed.tb)
                $('.form-asmed-anak input[name="bb"]').val(asmed.bb)
                $('.form-asmed-anak input[name="td"]').val(asmed.td)
                $('.form-asmed-anak input[name="nadi"]').val(asmed.nadi)
                $('.form-asmed-anak input[name="rr"]').val(asmed.rr)
                $('.form-asmed-anak input[name="suhu"]').val(asmed.suhu)
                $('.form-asmed-anak input[name="spo"]').val(asmed.spo)
                $('.form-asmed-anak select[name="kepala"]').val(asmed.kepala).change()
                $('.form-asmed-anak select[name="mata"]').val(asmed.mata).change()
                $('.form-asmed-anak select[name="genital"]').val(asmed.genital).change()
                $('.form-asmed-anak select[name="gigi"]').val(asmed.gigi).change()
                $('.form-asmed-anak select[name="ekstremitas"]').val(asmed.ekstremitas).change()
                $('.form-asmed-anak select[name="tht"]').val(asmed.tht).change()
                $('.form-asmed-anak select[name="kulit"]').val(asmed.kulit).change()
                $('.form-asmed-anak select[name="thoraks"]').val(asmed.thoraks).change()
                $('.form-asmed-anak select[name="kontraksi"]').val(asmed.kontraksi).change()
                $('.form-asmed-anak textarea[name="ket_fisik"]').val(asmed.ket_fisik)
                $('.form-asmed-anak textarea[name="ket_lokalis"]').val(asmed.ket_lokalis)
                $('.form-asmed-anak textarea[name="penunjang"]').val(asmed.penunjang)
                $('.form-asmed-anak textarea[name="diagnosis"]').val(asmed.diagnosis)
                $('.form-asmed-anak textarea[name="tata"]').val(asmed.tata)
                $('.form-asmed-anak textarea[name="konsul"]').val(asmed.konsul)
            })
        }
    </script>
@endpush
