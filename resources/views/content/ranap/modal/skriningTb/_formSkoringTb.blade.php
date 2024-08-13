<form action="" id="formSkoringTb">
    <div class="row gy-2">
        <div class="col-lg-4"><label for="" class="form-label">Kontak TB</label></div>
        <div class="col-lg-6">
            <select name="ket_kontak" id="ket_kontak" class="form-select" onchange="setNilaiSkrining(this)" data-target="kontak">
                <option value="-">-</option>
                <option value="0">Tidak Jelas</option>
                <option value="2">Laporan Keluarha, BTA(-)/BTA Tidak jelas / Tidak Tahu</option>
                <option value="4">BTA (+)</option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="kontak" id="kontak" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-4"><label for="ket_mantoux" class="form-label">Uji Tuberkolin (Test Mantoux) Negatif</label></div>
        <div class="col-lg-6">
            <select name="ket_mantoux" id="ket_mantoux" class="form-select" onchange="setNilaiSkrining(this)" data-target="mantoux">
                <option value="-">-</option>
                <option value="0">Negatif</option>
                <option value="3">Positif (>= 10mm atau >= 5mm pada imonukompomais)</option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="mantoux" id="mantoux" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-4"><label for="ket_berat" class="form-label">Berat badan / Keadaan gizi</label></div>
        <div class="col-lg-6">
            <select name="ket_berat" id="ket_berat" class="form-select" onchange="setNilaiSkrining(this)" data-target="berat">
                <option value="0">-</option>
                <option value="1">BB/TB < 90% atau BB /u < 80% </option>
                <option value="2">Klinis Gizi buruk atau BB/TB < 70& atau BB/U < 60% </option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="berat" id="berat" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-4"><label for="ket_demam" class="form-label">Demam yang tidak diketahui penyebabnya</label></div>
        <div class="col-lg-6">
            <select name="ket_demam" id="ket_demam" class="form-select" onchange="setNilaiSkrining(this)" data-target="demam">
                <option value="0">-</option>
                <option value="1"> >= 2 Minggu </option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="demam" id="demam" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-4"><label for="ket_batul" class="form-label">Batul Kronik</label></div>
        <div class="col-lg-6">
            <select name="ket_batul" id="ket_batul" class="form-select" onchange="setNilaiSkrining(this)" data-target="batul">
                <option value="0">-</option>
                <option value="1"> >= 3 Minggu </option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="batul" id="batul" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-4"><label for="ket_pembesaran" class="form-label">Pembesaran kelenjar limfe kolli, aksila, inguinal</label></div>
        <div class="col-lg-6">
            <select name="ket_pembesaran" id="ket_pembesaran" class="form-select" onchange="setNilaiSkrining(this)" data-target="pembesaran">
                <option value="0">-</option>
                <option value="1"> >= 1cm, lebih dari 1 KGB, tidak nyeri</option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="pembesaran" id="pembesaran" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-4"><label for="ket_pembengkakan" class="form-label">Pembengkakak tulang/sendi panggul, lutut, falang </label></div>
        <div class="col-lg-6">
            <select name="ket_pembengkakan" id="ket_pembengkakan" class="form-select" onchange="setNilaiSkrining(this)" data-target="pembengkakan">
                <option value="0">-</option>
                <option value="1"> Ada pembengkakan</option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="pembengkakan" id="pembengkakan" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-4"><label for="ket_thorax" class="form-label">Thorax Normal/Kelainan tidak jelas </label></div>
        <div class="col-lg-6">
            <select name="ket_thorax" id="ket_thorax" class="form-select" onchange="setNilaiSkrining(this)" data-target="thorax">
                <option value="-">-</option>
                <option value="0">Normal/Kelainan tidak jelas</option>
                <option value="1"> Gambaran sugestif (mendukung) TB</option>
            </select>
        </div>
        <div class="col-lg-2">
            <input type="text"name="thorax" id="thorax" class="form-control" value="0" readonly />
        </div>
        <div class="col-lg-10">
            <label for="" class="">Total Nilai Skrining</label>
        </div>
        <div class="d-flex col-lg-2 ms-auto">
            <input type="text"name="total_skrining" id="total_skrining" class="form-control" value="0" readonly />
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="id" id="id" />
        </div>
        <div class="d-flex col-lg-2 ms-auto">
            <button type="button" class="btn btn-primary btn-sm w-100" style="font-size: 12px" onclick="simpanSkoringTb()">
                <i class="bi bi-save">
                </i> Simpan
            </button>
        </div>
    </div>
</form>
