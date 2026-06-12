<div class="card mb-3">
    <div class="card-header">
        V. Skrining Gizi
    </div>
    <div class="card-body">
        <div class="row g-3">

            <div class="col-md-8">
                <label class="d-block">
                    Apakah pasien mengalami penurunan berat badan yang tidak direncanakan dalam 6 bulan
                    terakhir?
                </label>
                <x-select name="sg1">
                    <x-option data-nilai="0">Tidak</x-option>
                    <x-option data-nilai="1">Tidak Yakin</x-option>
                    <x-option data-nilai="2">Ya(1-5 Kg)</x-option>
                    <x-option data-nilai="3">Ya(6-10Kg)</x-option>
                    <x-option data-nilai="4">Ya(11-15Kg)</x-option>
                    <x-option value="Ya(<15Kg)" data-nilai="5">Ya(&gt;15Kg)</x-option>
                </x-select>
            </div>

            <div class="col-md-4">
                <label for="nilai1">Nilai</label>
                <x-select name="nilai1">
                    <x-option>0</x-option>
                    <x-option>1</x-option>
                    <x-option>2</x-option>
                    <x-option>3</x-option>
                    <x-option>4</x-option>
                </x-select>
            </div>

        </div>

        <div class="row mt-3">

            <div class="col-md-8">
                <label class="d-block">
                    Apakah asupan makan berkurang karena nafsu makan menurun?
                </label>
                <div class="d-flex gap-3 mt-2">
                    <x-input-radio data-nilai="1" id="sg2_ya" name="sg2" value="Ya" label="Ya" />
                    <x-input-radio data-nilai="0" id="sg2_tidak" name="sg2" value="Tidak" label="Tidak" checked />
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-2">
                    <label for="nilai2">Nilai</label>
                    <x-select name="nilai2">
                        <x-option>0</x-option>
                        <x-option>1</x-option>
                    </x-select>
                </div>
                <div>
                    <label for="total_hasil">Total Skor</label>
                    <x-input-group class="input-group-sm">
                        <x-input name="total_hasil" />
                        <x-input-group-text>Skor</x-input-group-text>
                    </x-input-group>
                </div>
            </div>

        </div>
    </div>
</div>