<div class="card mb-3">
    <div class="card-body">
        <p class="fw-bold border-bottom pb-1">Status Fungsional</p>
        <div class="row g-2">

            <div class="col-md-2">
                <label class="d-block">Alat Bantu</label>
                <div class="d-flex gap-3 mt-2">
                    <x-input-radio id="alat_bantu_tidak" name="alat_bantu" value="Tidak" label="Tidak" checked />
                    <x-input-radio id="alat_bantu_ya" name="alat_bantu" value="Ya" label="Ya" />
                </div>
            </div>

            <div class="col-md-2">
                <label for="ket_bantu">Jenis Alat Bantu</label>
                <x-input name="ket_bantu" />
            </div>

            <div class="col-md-2">
                <label class="d-block">Prothesa</label>
                <div class="d-flex gap-3 mt-2">
                    <x-input-radio id="prothesa_tidak" name="prothesa" value="Tidak" label="Tidak" checked />
                    <x-input-radio id="prothesa_ya" name="prothesa" value="Ya" label="Ya" />
                </div>
            </div>

            <div class="col-md-3">
                <label for="ket_pro">Jenis Prothesa</label>
                <x-input name="ket_pro" />
            </div>

            <div class="col-md-3 d-none cacatFisik">
                <label for="cacat_fisik">Cacat Fisik</label>
                <x-input name="cacat_fisik" />
            </div>
            <div class="col-md-3">
                <label for="adl">Aktivitas Sehari-hari (ADL)</label>
                <x-select name="adl">
                    <x-option>Mandiri</x-option>
                    <x-option>Dibantu</x-option>
                </x-select>
            </div>


        </div>
    </div>
</div>