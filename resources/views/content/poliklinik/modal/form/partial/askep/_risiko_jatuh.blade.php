<div class="card mb-3">
    <div class="card-header">
        Risiko Jatuh (Metode Get Up And Go)
    </div>
    <div class="card-body">
        <div class="row g-3">

            <div class="col-md-12">
                <strong class="fs-8 d-block">A. Cara Berjalan Pasien</strong>
                <div class="row">

                    <div class="col-md-6">
                        <label class="d-block">1. Perlu bantuan saat duduk ke berdiri?</label>
                        <div class="d-flex gap-3">
                            <x-input-radio id="berjalan_a_ya" name="berjalan_a" value="Ya" label="Ya" />
                            <x-input-radio id="berjalan_a_tidak" name="berjalan_a" value="Tidak" label="Tidak"
                                checked />
                        </div>

                    </div>
                    <div class="col-md-6">
                        <label class="d-block">2. Kesulitan berjalan / sempoyongan?</label>
                        <div class="d-flex gap-3">
                            <x-input-radio id="berjalan_b_ya" name="berjalan_b" value="Ya" label="Ya" />
                            <x-input-radio id="berjalan_b_tidak" name="berjalan_b" value="Tidak" label="Tidak"
                                checked />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <strong class="fs-8 d-block">B. Pegangan pada benda saat berjalan?</strong>
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
@push('script')
    <script>
        function hitungResikoJatuh(formParent) {
            const a = formParent
                .find('input[name="berjalan_a"]:checked')
                .val();
            const b = formParent
                .find('input[name="berjalan_b"]:checked')
                .val();
            const c = formParent
                .find('input[name="berjalan_c"]:checked')
                .val();

            let hasil = '';

            if (a === 'Ya' && c === 'Ya') {
                hasil = 'Resiko Tinggi (Ditemukan A Dan B)';
                formParent
                    .find('input[name="lapor"][value="Ya"]')
                    .prop('checked', true)
                    .trigger('change');

            } else if (a === 'Ya' || b === 'Ya') {

                hasil = 'Resiko Rendah (Ditemukan A/B)';


            } else {

                hasil = 'Tidak Beresiko (Tidak Ditemukan A Dan B)';
                formParent
                    .find('input[name="lapor"][value="Tidak"]')
                    .prop('checked', true)
                    .trigger('change');
            }

            formParent
                .find('select[name="hasil"]')
                .val(hasil);
        }
    </script>
@endpush