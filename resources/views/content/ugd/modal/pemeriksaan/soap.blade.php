<form action="" method="POST" class="" id="formSoapUgd">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6">
            <table class="borderless">
                <tr>
                    <td width="10%" style="font-size:11px">Pasien:</td>
                    <td width="15%">
                        <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat"
                            placeholder="" readonly>
                    </td>
                    <td width="30%" colspan="3">
                        <input type="text" class="form-control form-control-sm" id="nm_pasien" name="nm_pasien"
                            placeholder="" readonly>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:11px">Dilakukan Oleh :</td>
                    <td width="15%">
                        <input type="text" class="form-control form-control-sm" id="nik" name="nik" placeholder=""
                            readonly>
                    </td>
                    <td colspan="2" width="40%">
                        <input class="form-control form-control-sm" id="nama" name="nama" placeholder=""
                            autocomplete="off" readonly>

                    </td>
                </tr>
                <tr>
                    <td style="font-size:11px">Subjek : </td>
                    <td colspan="3">
                        <textarea class="form-control" name="subjek" id="subjek" cols="30" rows="5"
                            onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:11px">Objek : </td>
                    <td colspan="3">
                        <textarea class="form-control" name="objek" id="objek" cols="30" rows="5"
                            onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        <table>
                            <td width="12%" style="font-size:11px">
                                Suhu (<sup>0</sup>C) : <input type="text" class="form-control form-control-sm" id="suhu"
                                    name="suhu" placeholder="" maxlength="5" value="-" onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%" style="font-size:11px">
                                Tinggi (Cm): <input type="text" class="form-control form-control-sm" id="tinggi"
                                    name="tinggi" placeholder="" maxlength="5" onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%" style="font-size:11px">
                                Berat (Kg) : <input type="text" class="form-control form-control-sm" id="berat"
                                    name="berat" placeholder="" maxlength="5" onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        <table>
                            <td width="12%" style="font-size:11px">
                                Tensi : <input type="text" class="form-control form-control-sm" id="tensi" name="tensi"
                                    placeholder="" maxlength="8" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                    value="-" autocomplete="off">
                            </td>
                            <td width="12%" style="font-size:11px">
                                Respirasi (/mnt): <input type="text" class="form-control form-control-sm" id="respirasi"
                                    name="respirasi" placeholder="" maxlength="3" onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%" style="font-size:11px">
                                Nadi (/mnt) : <input type="text" class="form-control form-control-sm" id="nadi"
                                    name="nadi" placeholder="" maxlength="3" onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        <table>
                            <td width="12%" style="font-size:11px">
                                SpO2 (%): <input type="text" class="form-control form-control-sm" id="spo2" name="spo2"
                                    placeholder="" maxlength="3" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                    value="-" autocomplete="off">
                            </td>
                            <td width="12%" style="font-size:11px">
                                GCS (E,V,M): <input type="text" class="form-control form-control-sm" id="gcs" name="gcs"
                                    placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                    value="-" autocomplete="off">
                            </td>
                            <td width="12%" style="font-size:11px">
                                O2: <input type="text" class="form-control form-control-sm" id="o2" name="o2"
                                    placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                    value="-" autocomplete="off">
                            </td>
                            <td width="12%" style="font-size:11px">
                                Kesadaran :
                                <select class="form-select" name="kesadaran" id="kesadaran">
                                    <option value="Compos Mentis">Compos Mentis</option>
                                    <option value="Apatis">Apatis</option>
                                    <option value="Somnolence">Somnolence</option>
                                    <option value="Sopor">Sopor</option>
                                    <option value="Coma">Coma</option>
                                </select>
                            </td>
                        </table>
                    </td>
                </tr>
                <tr class="formEws">
                    <td></td>
                    <td colspan="3">
                        <table>
                            <td width="12%" style="font-size:11px">
                                Keluaran Urin : <select class="form-select" name="keluaran_urin" id="keluaran_urin">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="Y">Y</option>
                                    <option value="T">T</option>
                                </select>
                            </td>
                            <td width="12%" style="font-size:11px">
                                Proteinuria : <select class="form-select" name="proteinuria" id="proteinuria">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="++">++</option>
                                    <option value="+++">+++</option>
                                </select>
                            </td>
                            <td width="12%" style="font-size:11px">
                                Air Ketuban : <select class="form-select" name="air_ketuban" id="air_ketuban">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="Jernih">Jernih/Pink</option>
                                    <option value="Hijau">Hijau</option>
                                </select>
                            </td>
                            <td width="12%" style="font-size:11px">
                                Skala Nyeri : <select class="form-select" name="skala_nyeri" id="skala_nyeri">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </td>
                            <td width="12%" style="font-size:11px">
                                Lochia : <select class="form-select" name="lochia" id="lochia">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Banyak">Banyak</option>
                                </select>
                            </td>
                            <td width="12%" style="font-size:11px">
                                Tidak Sehat: <select class="form-select" name="terlihat_tidak_sehat"
                                    id="terlihat_tidak_sehat">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="Tidak">Tidak</option>
                                    <option value="Ya">Ya</option>
                                </select>
                            </td>

                        </table>
                    </td>
                </tr>
            </table>

        </div>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <!-- 1. Alergi -->
            <div class="mb-2">
                <div class="d-flex align-items-center gap-2">
                    <label for="alergi" class="form-label mb-0 fw-bold text-danger text-nowrap" style="font-size: 11.5px; min-width: 60px;">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>Alergi :
                    </label>
                    <input type="text" class="form-control form-control-sm" id="alergi" name="alergi" placeholder="Riwayat alergi obat / makanan..."
                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
            </div>

            <!-- 2. Asesmen -->
            <div class="mb-2">
                <label for="asesmen" class="form-label mb-1 fw-bold text-dark" style="font-size: 12px;">
                    Asesmen (Diagnosis / Masalah) :
                </label>
                <textarea class="form-control" name="asesmen" id="asesmen" rows="4"
                    style="font-size: 12px; min-height: 90px; resize: vertical;"
                    placeholder="Diagnosis kerja / masalah klinis..." onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
            </div>

            <!-- 3. Instruksi Medis -->
            <div class="mb-2">
                <label for="instruksi" class="form-label mb-1 fw-bold text-dark" style="font-size: 12px;">
                    Instruksi Medis / Tindakan :
                </label>
                <textarea class="form-control" name="instruksi" id="instruksi" rows="3"
                    style="font-size: 12px; min-height: 75px; resize: vertical;"
                    placeholder="Instruksi dokter / tindakan segera..." onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
            </div>

            <!-- 4. Plan (Rencana Terapi) -->
            @php
                $isUserDokter = session()->get('role') === 'dokter' || 
                                !empty(session()->get('pegawai')->dokter) || 
                                session()->get('pegawai')->bidang === 'Spesialis' || 
                                str_contains(session()->get('pegawai')->jbtn ?? '', 'Dokter') ||
                                str_contains(session()->get('pegawai')->jnj_jabatan ?? '', 'Dokter');
            @endphp
            <div class="mb-2">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label for="plan" class="form-label mb-0 fw-bold text-dark" style="font-size: 12px;">
                        Plan (Rencana Penatalaksanaan) :
                    </label>
                    @if ($isUserDokter)
                        <span class="text-muted" style="font-size: 10.5px;">
                            <i class="bi bi-arrow-repeat text-primary me-1"></i>Otomatis tersinkron dari resep di bawah
                        </span>
                    @else
                        <div class="d-flex align-items-center gap-1">
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle" style="font-size: 10px;" title="Akun Petugas/Perawat: Isi Plan dengan rencana asuhan keperawatan / monitoring">
                                <i class="bi bi-person-heart me-1 text-danger"></i>Plan Keperawatan
                            </span>
                            <button type="button" class="btn btn-xs btn-outline-primary py-0 px-2 fw-semibold" onclick="salinResepKePlanUgd()" style="font-size: 10.5px;" title="Salin resep obat dokter DPJP ke kolom Plan ini sebagai catatan kolaborasi">
                                <i class="bi bi-clipboard-plus me-1"></i>Salin Terapi Dokter
                            </button>
                        </div>
                    @endif
                </div>
                <textarea class="form-control" name="plan" id="plan" rows="4"
                    style="font-size: 12px; min-height: 95px; resize: vertical;"
                    placeholder="{{ $isUserDokter ? 'Terapi, rencana tindak lanjut, edukasi...' : 'Rencana asuhan keperawatan, monitoring, observasi...' }}" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
            </div>

            <!-- 5. Resep Obat Terintegrasi (Non-Racikan, Racikan, Riwayat Resep) -->
            <div class="mb-3">
                @include('content.poliklinik.modal.pemeriksaan.resepRalan')
            </div>

            <!-- 6. Tombol Aksi SOAP -->
            <div class="d-flex justify-content-start align-items-center gap-2 mt-2 pt-2 border-top">
                <input type="hidden" name="jam_rawat" id="jam_rawat" value="{{ date('H:i:s') }}">
                <input type="hidden" name="tgl_perawatan" id="tgl_perawatan" value="{{ date('Y-m-d') }}">
                <input type="hidden" name="lingkar_perut" id="lingkar_perut" value="-">
                <input type="hidden" name="spesialis" id="spesialis">
                <button type="button" class="btn btn-primary btn-sm btn-simpan shadow-sm px-3" onclick="simpanSoapRalan()">
                    <i class="bi bi-save me-1"></i> Simpan SOAP
                </button>
                <button type="button" class="btn btn-warning btn-sm shadow-sm" id="btn-reset" style="font-size:12px; display: none">
                    <i class="bi bi-arrow-clockwise me-1"></i> Baru
                </button>
                <button type="button" class="btn btn-success btn-sm shadow-sm" onclick="editSoapRalan()" id="btn-ubah" style="font-size:12px; display: none">
                    <i class="bi bi-pencil-square me-1"></i> Ubah
                </button>
            </div>
        </div>
    </div>

</form>

<script>
    function salinResepKePlanUgd() {
        const teks = (window.teksResepAktif || '').trim();
        if (!teks || teks === '-') {
            Swal.fire('Info', 'Belum ada resep obat dokter yang tersimpan untuk kunjungan ini.', 'info');
            return;
        }
        const $plan = $('#formSoapUgd').find('textarea[name=plan]');
        const currentVal = $plan.val().trim();
        if (currentVal && currentVal !== '-') {
            $plan.val(currentVal + '\n\n[Terapi Dokter DPJP]:\n' + teks);
        } else {
            $plan.val('[Terapi Dokter DPJP]:\n' + teks);
        }
        if (typeof swalToast === 'function') {
            swalToast('Terapi dokter disalin ke Plan');
        }
    }
</script>