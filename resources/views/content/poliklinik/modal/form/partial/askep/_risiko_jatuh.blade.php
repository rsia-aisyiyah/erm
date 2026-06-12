<div class="card mb-3">
    <div class="card-header">
        IV. Risiko Jatuh (Metode Get Up And Go)
    </div>
    <div class="card-body">
        <div class="row g-3">

            <div class="col-md-4">
                <label class="d-block">A. Perlu bantuan saat duduk ke berdiri?</label>
                <div class="d-flex gap-3">
                    <x-input-radio id="berjalan_a_ya" name="berjalan_a" value="Ya" label="Ya" />
                    <x-input-radio id="berjalan_a_tidak" name="berjalan_a" value="Tidak" label="Tidak" checked />
                </div>
            </div>

            <div class="col-md-4">
                <label class="d-block">B. Kesulitan berjalan / sempoyongan?</label>
                <div class="d-flex gap-3">
                    <x-input-radio id="berjalan_b_ya" name="berjalan_b" value="Ya" label="Ya" />
                    <x-input-radio id="berjalan_b_tidak" name="berjalan_b" value="Tidak" label="Tidak" checked />
                </div>
            </div>

            <div class="col-md-4">
                <label class="d-block">C. Pegangan pada benda saat berjalan?</label>
                <div class="d-flex gap-3">
                    <x-input-radio id="berjalan_c_ya" name="berjalan_c" value="Ya" label="Ya" />
                    <x-input-radio id="berjalan_c_tidak" name="berjalan_c" value="Tidak" label="Tidak" checked />
                </div>
            </div>

        </div>

        <div class="row mt-3">

            <div class="col-md-6">
                <label for="hasil">Hasil Penilaian</label>
                <x-select name="hasil">
                    <x-option>Tidak Beresiko (Tidak Ditemukan A Dan B)</x-option>
                    <x-option>Resiko Rendah (Ditemukan A/B)</x-option>
                    <x-option>Resiko Tinggi (Ditemukan A Dan B)</x-option>
                </x-select>
            </div>

            <div class="col-md-3">
                <label class="d-block">Dilaporkan ke Dokter</label>
                <div class="d-flex gap-3 mt-2">
                    <x-input-radio id="lapor_ya" name="lapor" value="Ya" label="Ya" />
                    <x-input-radio id="lapor_tidak" name="lapor" value="Tidak" label="Tidak" checked />
                </div>
            </div>

            <div class="col-md-3">
                <label for="ket_lapor">Jam Lapor</label>
                <x-input-group class="input-group-sm">
                    <x-input name="ket_lapor" type="time" value="00:00:00" disabled />
                    <x-input-group-text>WIB</x-input-group-text>
                </x-input-group>
            </div>

        </div>
    </div>
</div>