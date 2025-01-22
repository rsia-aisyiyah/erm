<div class="card position-relative mt-2">
    <div class="card-header" aria-controls="collapseHasilLab" data-bs-toggle="collapse" data-bs-target="#collapseHasilLab">
        <div class="card-text">
            <span>Hasil Laborat</span>
        </div>

    </div>
    <div class="card-body card-text collapse show" id="collapseHasilLab">

    </div>
</div>
@push('script')
    <script>
        function setRiwayatLaborat(no_rawat) {
            const cardRiwayatObat = document.getElementById('hasilLab')
            const bodyCardHasilLab = document.getElementById('collapseHasilLab')
            let listHasilLab = '';
            getHasilLab(no_rawat).done((lab) => {
                if (lab.length) {
                    lab.forEach((item, index) => {
                        if (item.detail.length) {
                            const detailLab = item.detail.map((detail, index) => {
                                return `<tr class="${setWarnaPemeriksaan(detail.keterangan)}">
                                <td>${detail.template.Pemeriksaan}</td>
                                <td>${detail.nilai} ${detail.template.satuan}</td>
                                <td>${detail.nilai_rujukan} ${detail.template.satuan}</td>
                                <td>${detail.keterangan}</td></tr>`
                            }).join('');
                            listHasilLab += `<div class="card position-relative mt-2">
                                                <div class="card-header">
                                                    <p class="card-text">
                                                        ${formatTanggal(item.tgl_periksa)} ${item.jam}
                                                    </p>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-responsive">
                                                        <thead>
                                                            <tr style="background-color : #e9ecef">
                                                                <td colspan=3> <strong>${item.jns_perawatan_lab.nm_perawatan}</strong></td>
                                                                <td>Petugas : ${item.petugas.nama}</td>
                                                            </tr>
                                                            <tr>
                                                                <th width="30%">
                                                                   Pemeriksaan
                                                                </th>
                                                                <th width="30%">
                                                                    Hasil
                                                                </th>
                                                                <th>
                                                                    Nilai Rujukan
                                                                </th>
                                                                <th>
                                                                    Keterangan
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                       <tbody>
                                                            
                                                            ${detailLab}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>`;
                        }
                    });
                    bodyCardHasilLab.innerHTML = listHasilLab;
                    $('#hasilLab').show().fadeIn();
                    $('#hasilLab').removeClass('d-none')
                } else {
                    $('#hasilLab').addClass('d-none')
                }
            })
        }
    </script>
@endpush
