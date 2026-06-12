<div class="card mb-3">
    <div class="card-header">
        VI. Skrining Nyeri
    </div>
    <div class="card-body">
        <div class="row g-2">

            <div class="col-md-3">
                <label for="nyeri">Jenis Nyeri</label>
                <x-select name="nyeri">
                    <x-option>Tidak Ada Nyeri</x-option>
                    <x-option>Nyeri Akut</x-option>
                    <x-option>Nyeri Kronis</x-option>
                </x-select>
            </div>

            <div class="col-md-3">
                <label for="lokasi">Lokasi Nyeri</label>
                <x-input name="lokasi" placeholder="Lokasi nyeri" />
            </div>

            <div class="col-md-3">
                <label for="provokes">Penyebab Nyeri (P)</label>
                <x-select name="provokes">
                    <x-option>Proses Penyakit</x-option>
                    <x-option>Benturan</x-option>
                    <x-option>Lain-Lain</x-option>
                </x-select>
            </div>

            <div class="col-md-3">
                <label for="ket_provokes">Keterangan Penyebab</label>
                <x-input name="ket_provokes" placeholder="Keterangan" />
            </div>

            <div class="col-md-3">
                <label for="quality">Karakteristik Nyeri (Q)</label>
                <x-select name="quality">
                    <x-option>Seperti Tertusuk</x-option>
                    <x-option>Berdenyut</x-option>
                    <x-option>Teriris</x-option>
                    <x-option>Tertindih</x-option>
                    <x-option>Tertiban</x-option>
                    <x-option>Lain-Lain</x-option>
                </x-select>
            </div>

            <div class="col-md-3">
                <label for="ket_quality">Keterangan Karakteristik</label>
                <x-input name="ket_quality" placeholder="Keterangan" />
            </div>

            <div class="col-md-4">
                <label class="d-block">Nyeri Menyebar (R)</label>
                <div class="d-flex gap-3 mt-2">
                    <x-input-radio id="menyebar_tidak" name="menyebar" value="Tidak" label="Tidak" checked />
                    <x-input-radio id="menyebar_ya" name="menyebar" value="Ya" label="Ya" />
                </div>
            </div>

            <div class="col-md-12 p-3">
                <img src="{{ asset('img/skala_nyeri_wong_baker.png') }}" style="width:100%;height:auto" />
                <p class="text-center fw-bold mb-0">
                    Skala Nyeri: <span id="nilai_skala_nyeri">0</span>
                </p>
                <input type="range" class="form-range m-0" min="0" max="10" step="1" id="skala_nyeri" name="skala_nyeri"
                    value="0">
            </div>

            <div class="col-md-2">
                <label for="durasi">Durasi Nyeri</label>
                <x-input-group class="input-group-sm">
                    <x-input name="durasi" />
                    <x-input-group-text>mnt</x-input-group-text>
                </x-input-group>
            </div>

            <div class="col-md-3">
                <label for="nyeri_hilang">Nyeri Berkurang Dengan</label>
                <x-select name="nyeri_hilang">
                    <x-option>Istirahat</x-option>
                    <x-option>Mendengar Musik</x-option>
                    <x-option>Minum Obat</x-option>
                </x-select>
            </div>

            <div class="col-md-2">
                <label for="ket_nyeri">Ket. Tambahan</label>
                <x-input name="ket_nyeri" placeholder="Keterangan nyeri" />
            </div>

            <div class="col-md-3">
                <label for="pada_dokter" class="d-block">Dilaporkan ke Dokter ?</label>
                <div class="d-flex gap-3 mt-2">
                    <x-input-radio name="pada_dokter" id="pada_dokter_ya" label="Ya" value="Ya" />
                    <x-input-radio name="pada_dokter" id="pada_dokter_tidak" label="Tidak" value="Tidak" checked />
                </div>
            </div>
            <div class="col-md-2">
                <label for="ket_dokter">Jam </label>
                <x-input type="time" name="ket_dokter" value="00:00:00" disabled />
            </div>

        </div>
    </div>
</div>