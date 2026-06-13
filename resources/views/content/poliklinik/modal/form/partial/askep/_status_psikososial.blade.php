<div class="card mb-3">
    <div class="card-header">
        Psikososial, Spiritual, Sosial Ekonomi
    </div>
    <div class="card-body">
        <div class="row g-2">

            <div class="col-md-3">
                <label for="status_psiko">Status Psikologis</label>
                <x-input-group>
                    <x-select name="status_psiko">
                        <x-option>Tenang</x-option>
                        <x-option>Takut</x-option>
                        <x-option>Cemas</x-option>
                        <x-option>Depresi</x-option>
                        <x-option>Lain-Lain</x-option>
                    </x-select>
                    <x-input name="ket_psiko" class="w-25" />
                </x-input-group>
            </div>

            <div class="col-md-3">
                <label for="hub_keluarga">Hubungan Keluarga</label>
                <x-select name="hub_keluarga">
                    <x-option>Baik</x-option>
                    <x-option>Tidak Baik</x-option>
                </x-select>
            </div>
            <div class="col-md-4 d-none pengasuhAnak">
                <label for="pengasuh">Pengasuh</label>
                <x-input-group>
                    <x-select name="pengasuh">
                        <x-option>Orang Tua</x-option>
                        <x-option>Kakek/Nenek</x-option>
                        <x-option>Keluarga Lainnya</x-option>
                    </x-select>
                    <x-input name="ket_pengasuh" class="w-25" />
                </x-input-group>
            </div>
            <div class="col-md-4 d-none tinggalDengan">
                <label for="tinggal_dengan">Tinggal Dengan</label>
                <x-input-group>
                    <x-select name="tinggal_dengan">
                        <x-option>Sendiri</x-option>
                        <x-option>Orang Tua</x-option>
                        <x-option>Suami / Istri</x-option>
                        <x-option>Lainnya</x-option>
                    </x-select>
                    <x-input name="ket_tinggal" class="w-25" />
                </x-input-group>
            </div>

            <div class="col-md-2">
                <label for="ekonomi">Status Ekonomi</label>
                <x-select name="ekonomi">
                    <x-option>Baik</x-option>
                    <x-option>Cukup</x-option>
                    <x-option>Kurang</x-option>
                </x-select>
            </div>

            <div class="col-md-3">
                <label for="budaya">Nilai Budaya</label>
                <x-input-group>
                    <x-select name="budaya">
                        <x-option>Tidak Ada</x-option>
                        <x-option>Ada</x-option>
                    </x-select>
                    <x-input name="ket_budaya" class="w-25" />
                </x-input-group>
            </div>

            <div class="col-md-4">
                <label for="edukasi">Edukasi Diberikan Kepada</label>
                <x-input-group>
                    <x-select name="edukasi">
                        <x-option>Pasien</x-option>
                        <x-option>Keluarga</x-option>
                    </x-select>
                    <x-input name="ket_edukasi" class="w-25" />
                </x-input-group>
            </div>

        </div>
    </div>
</div>