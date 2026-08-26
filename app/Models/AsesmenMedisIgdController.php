<?php

namespace App\Models;

use App\Http\Controllers\TrackerSqlController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    protected function handleSignature(string $noRawat, ?string $signatureData): ?string
    {
        if (empty($signatureData)) {
            return null;
        }

        // Jika sudah merupakan path file tersimpan (bukan data Base64 baru), pertahankan
        if (!str_starts_with($signatureData, 'data:image')) {
            return $signatureData;
        }

        @list($type, $data) = explode(';', $signatureData);
        @list(, $data) = explode(',', $data);

        if (empty($data)) {
            return null;
        }

        $binary = base64_decode($data);
        if ($binary === false) {
            return null;
        }

        $cleanNoRawat = str_replace(['/', ' '], ['-', '_'], $noRawat);
        $folder = 'signatures/penilaian_medis_igd';

        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        $fileName = 'ttd_' . $cleanNoRawat . '.png';
        $filePath = $folder . '/' . $fileName;

        Storage::disk('public')->put($filePath, $binary);

        return $filePath;
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
            'tht', 'jantung', 'paru', 'neurologis', 'muskuloskeletal',
            'ket_kepala', 'ket_mata', 'ket_tht', 'ket_gigi', 'ket_leher', 'ket_jantung',
            'ket_paru', 'ket_thoraks', 'ket_abdomen', 'ket_genital', 'ket_ekstremitas',
            'ket_neurologis', 'ket_muskuloskeletal',
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

        // Format summary into 'ket_fisik' for Khanza legacy compatibility
        $abnormalNotes = [];
        $organLabels = [
            'kepala' => 'Kepala', 'mata' => 'Mata', 'tht' => 'THT', 'gigi' => 'Mulut',
            'leher' => 'Leher', 'jantung' => 'Jantung', 'paru' => 'Paru-paru', 'thoraks' => 'Dada & Payudara',
            'abdomen' => 'Perut', 'genital' => 'Urogenital', 'ekstremitas' => 'Anggota Gerak',
            'neurologis' => 'Status Neurologis', 'muskuloskeletal' => 'Muskuloskeletal'
        ];
        foreach ($organLabels as $orgKey => $orgLbl) {
            $ketKey = 'ket_' . $orgKey;
            if (!empty($data[$ketKey]) && $data[$ketKey] !== '-') {
                $abnormalNotes[] = $orgLbl . ': ' . $data[$ketKey];
            }
        }
        if (!empty($data['ket_fisik']) && $data['ket_fisik'] !== '-') {
            $abnormalNotes[] = $data['ket_fisik'];
        }
        if (!empty($abnormalNotes)) {
            $data['ket_fisik'] = implode("\n", array_unique($abnormalNotes));
        }

        $dataAsmed = array_intersect_key($data, array_flip($asmedFields));
        $dataRsia = array_intersect_key($data, array_flip($rsiaFields));

        if (empty($dataAsmed['tanggal']) || $dataAsmed['tanggal'] === '0000-00-00 00:00:00' || !preg_match('/^\d{4}-\d{2}-\d{2}/', $dataAsmed['tanggal'])) {
            $dataAsmed['tanggal'] = date('Y-m-d H:i:s');
        }

        // Validasi Otorisasi: kd_dokter harus terdaftar sebagai Dokter di tabel dokter
        $kdDokterCheck = $dataAsmed['kd_dokter'] ?? session()->get('pegawai')->nik;
        $dokterValid = \DB::table('dokter')->where('kd_dokter', $kdDokterCheck)->first();
        if (!$dokterValid) {
            return response()->json([
                'message' => 'Akun Anda bukan Dokter (tidak terdaftar sebagai Dokter). Anda tidak memiliki akses untuk menyimpan Asesmen Medis UGD.'
            ], 403);
        }

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
                if (!empty($data['ttd_pasien'])) {
                    $dataRsia['ttd_pasien'] = $this->handleSignature($no_rawat, $data['ttd_pasien']);
                }
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
            'tht', 'jantung', 'paru', 'neurologis', 'muskuloskeletal',
            'ket_kepala', 'ket_mata', 'ket_tht', 'ket_gigi', 'ket_leher', 'ket_jantung',
            'ket_paru', 'ket_thoraks', 'ket_abdomen', 'ket_genital', 'ket_ekstremitas',
            'ket_neurologis', 'ket_muskuloskeletal',
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

        // Format summary into 'ket_fisik' for Khanza legacy compatibility
        $abnormalNotes = [];
        $organLabels = [
            'kepala' => 'Kepala', 'mata' => 'Mata', 'tht' => 'THT', 'gigi' => 'Mulut',
            'leher' => 'Leher', 'jantung' => 'Jantung', 'paru' => 'Paru-paru', 'thoraks' => 'Dada & Payudara',
            'abdomen' => 'Perut', 'genital' => 'Urogenital', 'ekstremitas' => 'Anggota Gerak',
            'neurologis' => 'Status Neurologis', 'muskuloskeletal' => 'Muskuloskeletal'
        ];
        foreach ($organLabels as $orgKey => $orgLbl) {
            $ketKey = 'ket_' . $orgKey;
            if (!empty($data[$ketKey]) && $data[$ketKey] !== '-') {
                $abnormalNotes[] = $orgLbl . ': ' . $data[$ketKey];
            }
        }
        if (!empty($data['ket_fisik']) && $data['ket_fisik'] !== '-') {
            $abnormalNotes[] = $data['ket_fisik'];
        }
        if (!empty($abnormalNotes)) {
            $data['ket_fisik'] = implode("\n", array_unique($abnormalNotes));
        }

        $dataAsmed = array_intersect_key($data, array_flip($asmedFields));
        $dataRsia = array_intersect_key($data, array_flip($rsiaFields));

        if (empty($dataAsmed['tanggal']) || $dataAsmed['tanggal'] === '0000-00-00 00:00:00' || !preg_match('/^\d{4}-\d{2}-\d{2}/', $dataAsmed['tanggal'])) {
            $dataAsmed['tanggal'] = date('Y-m-d H:i:s');
        }

        // Validasi Otorisasi: kd_dokter harus terdaftar sebagai Dokter di tabel dokter
        $kdDokterCheck = $dataAsmed['kd_dokter'] ?? session()->get('pegawai')->nik;
        $dokterValid = \DB::table('dokter')->where('kd_dokter', $kdDokterCheck)->first();
        if (!$dokterValid) {
            return response()->json([
                'message' => 'Akun Anda bukan Dokter (tidak terdaftar sebagai Dokter). Anda tidak memiliki akses untuk menyimpan Asesmen Medis UGD.'
            ], 403);
        }

        try {
            $clause = ['no_rawat' => $no_rawat];
            $updated = $this->asesmen->where($clause)->update($dataAsmed);
            if ($updated) {
                $this->track->updateSql($this->asesmen, $dataAsmed, $clause);
            }

            if (!empty($dataRsia)) {
                $dataRsia['no_rawat'] = $no_rawat;
                if (!empty($data['ttd_pasien'])) {
                    $dataRsia['ttd_pasien'] = $this->handleSignature($no_rawat, $data['ttd_pasien']);
                }
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
