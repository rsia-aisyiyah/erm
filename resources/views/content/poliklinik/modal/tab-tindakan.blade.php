<form action="" class="formInfoTindakan mb-2">
    <div class="row">
        <div class="col-lg-2 col-md-6 col-sm-12">
            <label for="no_rawat">No. Rawat</label>
            <x-input name="no_rawat" id="no_rawat" readonly/>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <label for="pasien">Pasien</label>
            <x-input-group class="input-group-sm">
                <x-input name="no_rkm_medis" id="no_rkm_medis" readonly/>
                <x-input name="nm_pasien" id="nm_pasien" class="w-50" readonly/>
            </x-input-group>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <label for="tgl_lahir"> Tgl. Lahir / Umur</label>
            <x-input name="tgl_lahir" id="tgl_lahir" readonly/>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-12">
            <label for="pembiayaan">Pembiayaan</label>
            <x-input name="pembiayaan" id="pembiayaan" readonly/>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-12">
            <label for="keluarga">Keluarga</label>
            <x-input name="keluarga" id="keluarga" readonly/>
            <x-input name="dokter" id="dokter" readonly type="hidden"/>
            <x-input name="nm_dokter" id="nm_dokter" readonly type="hidden"/>
        </div>
    </div>
</form>
<ul class="nav nav-tabs nav-tabs-expand" id="groupTindakan" role="tablist">
    <li class="nav-item" role="presentation" id="tabTindakanDokter">
        <button class="nav-link" id="btnTabTindakanDokter" data-bs-toggle="tab"
                data-bs-target="#targetTindakanDokter"
                type="button" role="tab" aria-controls="targetTindakanDokter" aria-selected="false">Tindakan
            Dokter
        </button>
    </li>
    <li class="nav-item" role="presentation" id="tabTindakanPerawat">
        <button class="nav-link" id="btnTabTindakanPerawat" data-bs-toggle="tab"
                data-bs-target="#targetTindakanPerawat"
                type="button" role="tab" aria-controls="targetTindakanPerawat" aria-selected="false">Tindakan
            Perawat
        </button>
    </li>
    <li class="nav-item" role="presentation" id="tabTindakanDokterPerawat">
        <button class="nav-link" id="btnTabTindakanDokterPerawat" data-bs-toggle="tab"
                data-bs-target="#targetTindakanDokterPerawat"
                type="button" role="tab" aria-controls="targetTindakanDokterPerawat" aria-selected="false">Tindakan
            Dokter & Perawat
        </button>
    </li>
</ul>
<div class="tab-content" id="contentTabTindakan">
    <div class="tab-pane fade p-2" id="targetTindakanDokter" role="tabpanel"
         aria-labelledby="tabTindakanDokter" tabindex="0">
       @include('content.poliklinik.modal.tindakan.tindakan_ralan_dr')
    </div>
    <div class="tab-pane fade p-2" id="targetTindakanPerawat" role="tabpanel"
         aria-labelledby="tabTindakanDokter" tabindex="0">
       @include('content.poliklinik.modal.tindakan.tindakan_ralan_pr')
    </div>
    <div class="tab-pane fade p-2" id="targetTindakanDokterPerawat" role="tabpanel"
         aria-labelledby="tabTindakanDokter" tabindex="0">
       @include('content.poliklinik.modal.tindakan.tindakan_ralan_drpr')
    </div>
</div>

@push('script')
    <script>
        $('#tabTindakan').on('shown.bs.tab', function (){
            const no_rawat = $('#no_rawat').val();
            const formInfoTindakan = $('.formInfoTindakan')
            $.get(`/erm/periksa/detail`, {
                no_rawat: no_rawat
            }).done((response)=>{
                const {pasien, penjab, dokter} = response

                formInfoTindakan.find('#no_rawat').val(no_rawat)
                formInfoTindakan.find('#no_rkm_medis').val(response.no_rkm_medis)
                formInfoTindakan.find('#nm_pasien').val(`${pasien.nm_pasien} (${pasien.jk})`)
                formInfoTindakan.find('#tgl_lahir').val(`${formatTanggal(pasien.tgl_lahir)} / ${hitungUmur(pasien.tgl_lahir)}`)
                formInfoTindakan.find('#pembiayaan').val(penjab.png_jawab)
                formInfoTindakan.find('#keluarga').val(`${response.p_jawab} / ${response.hubunganpj}`)
                formInfoTindakan.find('#nm_dokter').val(dokter.nm_dokter)
                formInfoTindakan.find('#dokter').val(dokter.kd_dokter)
                $('#btnTabTindakanDokter').trigger('click')
            })

            $('.btn-asmed-ranap').addClass('d-none')
            $('.btn-asmed').addClass('d-none')
            $('.btn-soap').addClass('d-none')



        })


    </script>
@endpush