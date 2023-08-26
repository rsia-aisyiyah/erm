<div class="row" id="listAsmed">

</div>
@push('script')
    <script>
        function getListAsmedRajalKandungan(no_rkm_medis) {
            const asmed = $.ajax({
                url: `/erm/poliklinik/asmed/kandungan/riwayat/${no_rkm_medis}`,
                method: 'GET',
            })
            return asmed;
        }

        function listAsmedKandungan(data) {
            $('#listAsmed').empty()
            $.map(data, (a) => {
                html = `<div class="mb-3 col-lg-3 col-md-4 col-sm-12">
                       <div class="card card-shadow">
                        <p class="card-header" style="font-size:12px">Tgl. Asesmen ${formatTanggal(a.tanggal)} ${a.tanggal.split(' ')[1]} </p>
                        <div class="card-body">
                            <h6 class="card-title">${a.dokter.nm_dokter}</h6>
                            <p class="card-text"><b>(${a.reg_periksa.no_rkm_medis} ) - ${a.reg_periksa.pasien.nm_pasien} </b> <br> ${a.no_rawat} <br/> Tgl. Periksa ${formatTanggal(a.reg_periksa.tgl_registrasi)}</p>
                            <a href="/erm/poliklinik/asmed/kandungan/print/${textRawat(a.no_rawat, '-')}" target="_blank" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i> Lihat</a>
                            <a href="javascript:void(0)" onclick="setAsmedRajalKandungan('${a.no_rawat}')" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</a>
                            </div>
                            </div>
                         </div>`
                $('#listAsmed').append(html)
            })
        }

        function setAsmedRajalKandungan(no_rawat) {
            getAsmedKandungan(no_rawat).done((asmed) => {
                const sel = document.querySelector('#tab-soap-rajal button[data-bs-target="#tab-asmed-pane"]')
                bootstrap.Tab.getOrCreateInstance(sel).show()
                $('.form-asmed-kandungan button[name="simpan"]').css('display', 'none')
                $('.form-asmed-kandungan button[name="edit"]').css('display', 'inline')
                $('.form-asmed-kandungan select[name="anamnesis"]').val(asmed.anamnesis).change()
                $('.form-asmed-kandungan input[name="hubungan"]').val(asmed.hubungan)
                $('.form-asmed-kandungan input[name="no_rawat"]').val(asmed.no_rawat)
                $('.form-asmed-kandungan textarea[name="keluhan_utama"]').val(asmed.keluhan_utama)
                $('.form-asmed-kandungan textarea[name="rps"]').val(asmed.rps)
                $('.form-asmed-kandungan textarea[name="rpk"]').val(asmed.rpk)
                $('.form-asmed-kandungan textarea[name="rpd"]').val(asmed.rpd)
                $('.form-asmed-kandungan textarea[name="rpo"]').val(asmed.rpo)
                $('.form-asmed-kandungan input[name="alergi"]').val(asmed.alergi)
                $('.form-asmed-kandungan select[name="keadaan"]').val(asmed.keadaan).change()
                $('.form-asmed-kandungan select[name="kesadaran"]').val(asmed.kesadaran).change()
                $('.form-asmed-kandungan input[name="gcs"]').val(asmed.gcs)
                $('.form-asmed-kandungan input[name="tb"]').val(asmed.tb)
                $('.form-asmed-kandungan input[name="bb"]').val(asmed.bb)
                $('.form-asmed-kandungan input[name="td"]').val(asmed.td)
                $('.form-asmed-kandungan input[name="nadi"]').val(asmed.nadi)
                $('.form-asmed-kandungan input[name="rr"]').val(asmed.rr)
                $('.form-asmed-kandungan input[name="suhu"]').val(asmed.suhu)
                $('.form-asmed-kandungan input[name="spo"]').val(asmed.spo)
                $('.form-asmed-kandungan select[name="kepala"]').val(asmed.kepala).change()
                $('.form-asmed-kandungan select[name="mata"]').val(asmed.mata).change()
                $('.form-asmed-kandungan select[name="genital"]').val(asmed.genital).change()
                $('.form-asmed-kandungan select[name="gigi"]').val(asmed.gigi).change()
                $('.form-asmed-kandungan select[name="ekstremitas"]').val(asmed.ekstremitas).change()
                $('.form-asmed-kandungan select[name="tht"]').val(asmed.tht).change()
                $('.form-asmed-kandungan select[name="kulit"]').val(asmed.kulit).change()
                $('.form-asmed-kandungan select[name="thoraks"]').val(asmed.thoraks).change()
                $('.form-asmed-kandungan select[name="kontraksi"]').val(asmed.kontraksi).change()
                $('.form-asmed-kandungan textarea[name="ket_fisik"]').val(asmed.ket_fisik)
                $('.form-asmed-kandungan input[name="tfu"]').val(asmed.tfu)
                $('.form-asmed-kandungan input[name="tbj"]').val(asmed.tbj)
                $('.form-asmed-kandungan input[name="his"]').val(asmed.his)
                $('.form-asmed-kandungan input[name="djj"]').val(asmed.djj)
                $('.form-asmed-kandungan input[name="inspeksi"]').val(asmed.inspeksi)
                $('.form-asmed-kandungan input[name="vt"]').val(asmed.vt)
                $('.form-asmed-kandungan input[name="inspekulo"]').val(asmed.inspekulo)
                $('.form-asmed-kandungan input[name="rt"]').val(asmed.rt)
                $('.form-asmed-kandungan textarea[name="ultra"]').val(asmed.ultra)
                $('.form-asmed-kandungan textarea[name="kardio"]').val(asmed.kardio)
                $('.form-asmed-kandungan textarea[name="lab"]').val(asmed.lab)
                $('.form-asmed-kandungan textarea[name="diagnosis"]').val(asmed.diagnosis)
                $('.form-asmed-kandungan textarea[name="tata"]').val(asmed.tata)
                $('.form-asmed-kandungan textarea[name="konsul"]').val(asmed.konsul)
            })
        }
    </script>
@endpush
