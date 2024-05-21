<div class="card position-relative mt-2">
    <div class="card-header" aria-controls="collapseBerkasPenunjang" data-bs-toggle="collapse" data-bs-target="#collapseBerkasPenunjang">
        <div class="card-text">
            <span>Berkas Penunjang</span>
        </div>

    </div>
    <div class="card-body card-text collapse" id="collapseBerkasPenunjang">
        <div class="row gy-2" id="containerBerkas"></div>
    </div>
</div>

@push('script')
    <script>
        var containerBerkas = $('#containerBerkas')
        var berkasPenunjang = $('#berkasPenunjang')

        function setBerkasPenunjang(no_rawat) {

            $.get('/erm/registrasi/foto', {
                no_rawat: no_rawat
            }).done((response) => {
                if (response.length) {
                    const berkas = response.map((item, index) => {
                        return `<div class="col-md-2 col-sm-12">
                                    <div class="card">
                                        <a data-magnify="gallery" data-src="" data-caption="${item.kategori.toUpperCase()} ${splitTanggal(item.tgl_masuk)}" data-group="a" href="${getBaseUrl(`/erm/public/erm/${item.file}`)}">
                                            <img src="${getBaseUrl(`/erm/public/erm/${item.file}`)}" class="card-img-top" alt="..." />
                                        </a>
                                        <div class="card-body">
                                            <p class="card-text">${item.kategori.toUpperCase()} ${splitTanggal(item.tgl_masuk)}</p>
                                        </div>
                                    </div>
                                </div>`;
                    });
                    containerBerkas.empty().append(berkas);
                    berkasPenunjang.removeClass('d-none')
                } else {
                    berkasPenunjang.addClass('d-none')
                }
            })

        }

        function setCatatanPerwatan(no_rawat) {
            $.get('/erm/catatan/perawatan', {
                no_rawat: no_rawat
            }).done((response) => {
                if (Object.values(response).length) {
                    $('#catatanPerawatan').removeClass('d-none')
                    const catatan = `<p>${response.catatan.replaceAll("\n", "<br />")}</p>`;
                    $('#contentCatatanPerawatan').empty().append(catatan)
                } else {
                    $('#catatanPerawatan').addClass('d-none')
                }
            })
        }
    </script>
@endpush
