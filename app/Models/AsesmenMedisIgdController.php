<?php

namespace App\Models;

use App\Http\Controllers\TrackerSqlController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PDF;

class AsesmenMedisIgdController extends Model
{
    use HasFactory;
    protected $asesmen;
    protected $rsiaAsmed;
    protected $track;

    public function __construct()
    {
        $this->asesmen = new AsesmenMedisIgd();
        $this->rsiaAsmed = new RsiaPenilaianMedisIgd();
        $this->track = new TrackerSqlController();
    }

    public function get($noRawat)
    {
        $id = str_replace('-', '/', $noRawat);
        $asmed = $this->asesmen->where('no_rawat', $id)
            ->with(['regPeriksa.pasien', 'dokter', 'rsiaAsmed.dpjp'])
            ->first();
        return response()->json($asmed);
    }

    public function create(Request $request)
    {
        $data = $request->except(['_token', 'pasien', 'tgl_lahir', 'dokter']);
        $no_rawat = $data['no_rawat'];

        if (isset($data['terapi_kategori']) && is_array($data['terapi_kategori'])) {
            $data['terapi_kategori'] = implode(',', $data['terapi_kategori']);
        }
        if (isset($data['rujuk_alasan']) && is_array($data['rujuk_alasan'])) {
            $data['rujuk_alasan'] = implode(',', $data['rujuk_alasan']);
        }

        $asmedFields = [
            'no_rawat', 'tanggal', 'kd_dokter', 'anamnesis', 'hubungan', 'keluhan_utama',
            'rps', 'rpd', 'rpk', 'rpo', 'alergi', 'keadaan', 'gcs', 'kesadaran',
            'td', 'nadi', 'rr', 'suhu', 'spo', 'bb', 'tb', 'kepala', 'mata', 'gigi',
            'leher', 'thoraks', 'abdomen', 'genital', 'ekstremitas', 'ket_fisik',
            'ket_lokalis', 'lab', 'rad', 'ekg', 'diagnosis', 'tata'
        ];

        $rsiaFields = [
            'no_rawat', 'terapi_kategori', 'terapi_farmakologis', 'terapi_non_farmakologis',
            'tindak_lanjut', 'kontrol_ke', 'ranap_indikasi', 'ranap_dpjp', 'ranap_smf', 'ranap_ruang',
            'rujuk_tujuan', 'rujuk_nama_faskes', 'rujuk_alasan', 'rujuk_transport',
            'kondisi_pulang', 'tgl_meninggal', 'jam_meninggal',
            'selesai_layanan_tgl', 'selesai_layanan_jam', 'nama_keluarga_ttd', 'ttd_pasien'
        ];

        // Format text summary into 'tata' for Khanza legacy compatibility
        $terapiRingkas = [];
        if (!empty($data['terapi_kategori'])) {
            $terapiRingkas[] = "Kategori: " . $data['terapi_kategori'];
        }
        if (!empty($data['terapi_farmakologis']) && $data['terapi_farmakologis'] !== '-') {
            $terapiRingkas[] = "Farmakologis:\n" . $data['terapi_farmakologis'];
        }
        if (!empty($data['terapi_non_farmakologis']) && $data['terapi_non_farmakologis'] !== '-') {
            $terapiRingkas[] = "Non Farmakologis:\n" . $data['terapi_non_farmakologis'];
        }
        if (!empty($terapiRingkas)) {
            $data['tata'] = implode("\n", $terapiRingkas);
        }

        $dataAsmed = array_intersect_key($data, array_flip($asmedFields));
        $dataRsia = array_intersect_key($data, array_flip($rsiaFields));

        $dataAsmed['tanggal'] = $data['tanggal'] ?? date('Y-m-d H:i:s');

        $isExist = $this->asesmen->where('no_rawat', $no_rawat)->first();
        if ($isExist) {
            return $this->edit($request);
        }

        try {
            $created = $this->asesmen->create($dataAsmed);
            if ($created) {
                $this->track->insertSql($this->asesmen, $dataAsmed);
            }

            if (!empty($dataRsia)) {
                $dataRsia['no_rawat'] = $no_rawat;
                $this->rsiaAsmed->updateOrCreate(['no_rawat' => $no_rawat], $dataRsia);
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }

        return response()->json('Berhasil membuat asesmen medis ugd', 201);
    }

    public function edit(Request $request)
    {
        $data = $request->except(['_token', 'pasien', 'tgl_lahir', 'dokter']);
        $no_rawat = $data['no_rawat'];

        if (isset($data['terapi_kategori']) && is_array($data['terapi_kategori'])) {
            $data['terapi_kategori'] = implode(',', $data['terapi_kategori']);
        }
        if (isset($data['rujuk_alasan']) && is_array($data['rujuk_alasan'])) {
            $data['rujuk_alasan'] = implode(',', $data['rujuk_alasan']);
        }

        $asmedFields = [
            'no_rawat', 'tanggal', 'kd_dokter', 'anamnesis', 'hubungan', 'keluhan_utama',
            'rps', 'rpd', 'rpk', 'rpo', 'alergi', 'keadaan', 'gcs', 'kesadaran',
            'td', 'nadi', 'rr', 'suhu', 'spo', 'bb', 'tb', 'kepala', 'mata', 'gigi',
            'leher', 'thoraks', 'abdomen', 'genital', 'ekstremitas', 'ket_fisik',
            'ket_lokalis', 'lab', 'rad', 'ekg', 'diagnosis', 'tata'
        ];

        $rsiaFields = [
            'no_rawat', 'terapi_kategori', 'terapi_farmakologis', 'terapi_non_farmakologis',
            'tindak_lanjut', 'kontrol_ke', 'ranap_indikasi', 'ranap_dpjp', 'ranap_smf', 'ranap_ruang',
            'rujuk_tujuan', 'rujuk_nama_faskes', 'rujuk_alasan', 'rujuk_transport',
            'kondisi_pulang', 'tgl_meninggal', 'jam_meninggal',
            'selesai_layanan_tgl', 'selesai_layanan_jam', 'nama_keluarga_ttd', 'ttd_pasien'
        ];

        $terapiRingkas = [];
        if (!empty($data['terapi_kategori'])) {
            $terapiRingkas[] = "Kategori: " . $data['terapi_kategori'];
        }
        if (!empty($data['terapi_farmakologis']) && $data['terapi_farmakologis'] !== '-') {
            $terapiRingkas[] = "Farmakologis:\n" . $data['terapi_farmakologis'];
        }
        if (!empty($data['terapi_non_farmakologis']) && $data['terapi_non_farmakologis'] !== '-') {
            $terapiRingkas[] = "Non Farmakologis:\n" . $data['terapi_non_farmakologis'];
        }
        if (!empty($terapiRingkas)) {
            $data['tata'] = implode("\n", $terapiRingkas);
        }

        $dataAsmed = array_intersect_key($data, array_flip($asmedFields));
        $dataRsia = array_intersect_key($data, array_flip($rsiaFields));

        try {
            $clause = ['no_rawat' => $no_rawat];
            $updated = $this->asesmen->where($clause)->update($dataAsmed);
            if ($updated) {
                $this->track->updateSql($this->asesmen, $dataAsmed, $clause);
            }

            if (!empty($dataRsia)) {
                $dataRsia['no_rawat'] = $no_rawat;
                $this->rsiaAsmed->updateOrCreate(['no_rawat' => $no_rawat], $dataRsia);
            }
        } catch (QueryException $e) {
            return response()->json($e->errorInfo, 500);
        }
        return response()->json('Berhasil mengubah asesmen medis', 200);
    }

    public function print(Request $request)
    {
        $id = str_replace('-', '/', $request->no_rawat);
        $asmed = $this->asesmen->where('no_rawat', $id)
            ->with(['regPeriksa.pasien', 'regPeriksa.poliklinik', 'dokter', 'rsiaAsmed.dpjp'])
            ->first();

        if (!$asmed) {
            return abort(404, 'Data Asesmen Medis IGD tidak ditemukan');
        }

        $pdf = PDF::loadView('content.print.asmed_igd', ['data' => $asmed])
            ->setPaper('a4', 'portrait');
        return $pdf->stream('Asesmen_Medis_IGD_' . $request->no_rawat . '.pdf');
    }
}
