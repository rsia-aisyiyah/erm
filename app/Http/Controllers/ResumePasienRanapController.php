<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumePasienRanapRequest;
use App\Models\BridgingSep;
use App\Models\RegPeriksa;
use App\Models\RencanaKontrol;
use App\Models\ResumePasienRanap;
use App\Models\RsiaOrderSuratKontrolRanap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResumePasienRanapController extends Controller
{

    protected $resume;
    protected $track;
    public function __construct()
    {
        $this->resume = new ResumePasienRanap();
        $this->track = new TrackerSqlController();
    }

    function get(Request $request)
    {
        $resume = $this->resume->where('no_rawat', $request->no_rawat)->with([
            'regPeriksa.pasien', 'dokter.spesialis', 'regPeriksa.penjab', 'regPeriksa.poliklinik',
            'regPeriksa.kamarInap' => function ($query) {
                return $query->where('stts_pulang', '!=', 'Pindah Kamar')->with(['kamar.bangsal']);
            }, 'bayiGabung.kamarIbu' => function ($query) {
                return $query->where('stts_pulang', '!=', 'Pindah Kamar')->with(['kamar.bangsal']);
            }
        ])->first();

        return response()->json($resume);
    }

    function insert(ResumePasienRanapRequest $request)
    {
        try {
            $data = $request->validated();
			$isAvailResume = $this->resume->where('no_rawat', $data['no_rawat'])->first();
			if($isAvailResume){
				return $this->edit($request);
			}
            $resume = $this->resume->create($data);
            if ($resume) {
                $this->track->insertSql($this->resume, $data);
                $this->syncOrderSuratKontrol($data);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
        return response()->json('Sukses');
    }

    function edit(ResumePasienRanapRequest $request)
    {
        try {
	    $data = $request->validated();
            $update = $this->resume->where('no_rawat', $data['no_rawat'])->update($data);
            if ($update) {
                $this->track->updateSql($this->resume, $data, ['no_rawat', $data['no_rawat']]);
                $this->syncOrderSuratKontrol($data);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json('Sukses');
    }

    /**
     * Sinkronisasi otomatis antrean order Surat Kontrol BPJS dari Resume Medis Ranap.
     */
    protected function syncOrderSuratKontrol(array $data): void
    {
        $noRawat = $data['no_rawat'] ?? null;
        if (!$noRawat) {
            return;
        }

        $dilanjutkan = $data['dilanjutkan'] ?? '';
        $kontrolRaw = $data['kontrol'] ?? '';
        $tglKontrol = $kontrolRaw ? date('Y-m-d', strtotime($kontrolRaw)) : null;

        $existingOrder = RsiaOrderSuratKontrolRanap::where('no_rawat', $noRawat)->first();

        // Jika tidak dilanjutkan Kembali Ke RS atau tanggal kontrol tidak valid
        if ($dilanjutkan !== 'Kembali Ke RS' || !$tglKontrol || $tglKontrol === '1970-01-01' || str_starts_with($kontrolRaw, '0000-00-00')) {
            if ($existingOrder && !in_array($existingOrder->status_order, ['TERBIT', 'BATAL'])) {
                $existingOrder->update(['status_order' => 'BATAL']);
            }
            return;
        }

        // Cek SEP Rawat Inap (jnspelayanan = 1) atau SEP aktif untuk no_rawat ini
        $sep = BridgingSep::where('no_rawat', $noRawat)
            ->orderByRaw("CASE WHEN jnspelayanan = '1' THEN 0 ELSE 1 END")
            ->orderBy('tglsep', 'desc')
            ->first();

        if (!$sep) {
            return; // Pasien non-BPJS atau belum punya SEP
        }

        $regPeriksa = RegPeriksa::where('no_rawat', $noRawat)->first();

        // Ambil DPJP Ranap atau dokter di Resume
        $dpjpRanap = DB::table('dpjp_ranap')->where('no_rawat', $noRawat)->value('kd_dokter');
        $kdDokter = $dpjpRanap ?: ($data['kd_dokter'] ?? ($regPeriksa->kd_dokter ?? null));

        // Mapping Dokter BPJS
        $mapDokter = $kdDokter
            ? DB::table('maping_dokter_dpjpvclaim')->where('kd_dokter', $kdDokter)->first()
            : null;

        // Ambil Poli Praktek Dokter dari tabel jadwal (prioritas selain IGDK/UGD) atau poli asal
        $kdPoliRs = null;
        if ($kdDokter) {
            $kdPoliRs = DB::table('jadwal')
                ->where('kd_dokter', $kdDokter)
                ->whereNotIn('kd_poli', ['IGDK', 'UGD', '-'])
                ->value('kd_poli');
        }
        if (!$kdPoliRs && $regPeriksa && !in_array($regPeriksa->kd_poli, ['IGDK', 'UGD', '-'])) {
            $kdPoliRs = $regPeriksa->kd_poli;
        }

        $mapPoli = $kdPoliRs
            ? DB::table('maping_poli_bpjs')->where('kd_poli_rs', $kdPoliRs)->first()
            : null;

        // Cek status update tanggal pulang di bridging_sep
        $tglPulangRaw = $sep->tglpulang ?? null;
        $hasTglPulang = $tglPulangRaw && !str_starts_with($tglPulangRaw, '0000-00-00');
        $tglPulangSep = $hasTglPulang ? date('Y-m-d', strtotime($tglPulangRaw)) : null;
        $batasMaksimalH1 = $tglPulangSep ? date('Y-m-d', strtotime($tglPulangSep . ' +1 day')) : null;

        // Cek apakah sudah ada surat kontrol di bridging_surat_kontrol_bpjs
        $existingSkrj = RencanaKontrol::where('no_sep', $sep->no_sep)->first();

        if ($existingSkrj) {
            $skrjSama = ($existingSkrj->tgl_rencana === $tglKontrol);
            $statusOrder = $skrjSama ? 'TERBIT' : 'PERLU_UPDATE_SKRJ';
            $noSuratKontrol = $existingSkrj->no_surat;
        } elseif ($existingOrder && $existingOrder->status_order === 'TERBIT') {
            $statusOrder = ($existingOrder->tgl_kontrol_resume === $tglKontrol) ? 'TERBIT' : 'PERLU_UPDATE_SKRJ';
            $noSuratKontrol = $existingOrder->no_surat_kontrol;
        } else {
            $statusOrder = $hasTglPulang ? 'SIAP_TERBIT' : 'BELUM_PULANG_SEP';
            $noSuratKontrol = null;
        }

        RsiaOrderSuratKontrolRanap::updateOrCreate(
            ['no_rawat' => $noRawat],
            [
                'no_rkm_medis' => $regPeriksa->no_rkm_medis ?? $sep->nomr,
                'no_sep' => $sep->no_sep,
                'tgl_kontrol_resume' => $tglKontrol,
                'kd_dokter_dpjp' => $kdDokter,
                'kd_dokter_bpjs' => $mapDokter->kd_dokter_bpjs ?? null,
                'nm_dokter_bpjs' => $mapDokter->nm_dokter_bpjs ?? null,
                'kd_poli_rs' => $kdPoliRs,
                'kd_poli_bpjs' => $mapPoli->kd_poli_bpjs ?? null,
                'nm_poli_bpjs' => $mapPoli->nm_poli_bpjs ?? null,
                'tgl_pulang_sep' => $tglPulangSep,
                'batas_maksimal_h1' => $batasMaksimalH1,
                'status_order' => $statusOrder,
                'no_surat_kontrol' => $noSuratKontrol,
                'created_by' => session()->get('pegawai.nik') ?? ($kdDokter ?: 'Dokter'),
            ]
        );
    }
}
