<?php

namespace App\Services\Gizi;

use App\Models\CatatanAdimeGizi;
use App\Models\GrafikHarian;
use App\Models\PemeriksaanRanap;
use Illuminate\Support\Facades\DB;

class CatatanAdimeService
{
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $adime = CatatanAdimeGizi::create($data);

            $this->syncPemeriksaan($data);

            return $adime;
        });
    }

    public function update(array $data, string $tanggalLama)
    {
        return DB::transaction(function () use ($data, $tanggalLama) {

            // cari ADIME lama
            $adime = CatatanAdimeGizi::where('no_rawat', $data['no_rawat'])
                ->where('tanggal', $tanggalLama)
                ->firstOrFail();

            // update ADIME
            $adime->update($data);

            // update pemeriksaan ranap
            PemeriksaanRanap::where('no_rawat', $data['no_rawat'])
                ->where('tgl_perawatan', date('Y-m-d', strtotime($tanggalLama)))
                ->where('jam_rawat', date('H:i:s', strtotime($tanggalLama)))
                ->update($this->mappingPemeriksaan($data));

            // update grafik harian
            GrafikHarian::where('no_rawat', $data['no_rawat'])
                ->where('tgl_perawatan', date('Y-m-d', strtotime($tanggalLama)))
                ->where('jam_rawat', date('H:i:s', strtotime($tanggalLama)))
                ->update($this->mappingGrafik($data));

            return $adime;
        });
    }

    public function delete(string $noRawat, string $tanggal)
    {
        return DB::transaction(function () use ($noRawat, $tanggal) {

            // cari data ADIME
            $adime = CatatanAdimeGizi::where('no_rawat', $noRawat)
                ->where('tanggal', $tanggal)
                ->firstOrFail();

            // hapus pemeriksaan ranap terkait
            PemeriksaanRanap::where('no_rawat', $noRawat)
                ->where('tgl_perawatan', date('Y-m-d', strtotime($tanggal)))
                ->where('jam_rawat', date('H:i:s', strtotime($tanggal)))
                ->whereHas('adime')
                ->delete();

            // hapus grafik harian terkait
            GrafikHarian::where('no_rawat', $noRawat)
                ->where('tgl_perawatan', date('Y-m-d', strtotime($tanggal)))
                ->where('jam_rawat', date('H:i:s', strtotime($tanggal)))
                ->where('sumber', 'ADIME')
                ->delete();

            // hapus ADIME
            $adime->delete();

            return true;
        });
    }

    public function print(string $noRawat)
    {
        $adime = CatatanAdimeGizi::where('no_rawat', $noRawat)
            ->with([
                'regPeriksa.dokter',

                'pasien',
                'petugas',
            ])
            ->orderBy('tanggal')
            ->get();

        $adime->map(function ($item) {

            $item->sidik = $this->setFingerOutput(
                $item->petugas->nama,
                bcrypt($item->petugas->nik),
                $item->tanggal
            );

            return $item;
        });

        return $adime;
    }
    protected function setFingerOutput($petugas, $id, $tanggal)
    {
        $strId = sha1($id);

        return "Ditandatangani di RSIA Aisyiyah Pekajangan Kab. Pekalongan, "
            . "Ditandatangani Elektronik Oleh $petugas, "
            . "ID $strId, $tanggal";
    }

    protected function syncPemeriksaan(array $data)
    {
        PemeriksaanRanap::create(
            $this->mappingPemeriksaan($data)
        );

        GrafikHarian::create(
            $this->mappingGrafik($data)
        );
    }

    protected function mappingPemeriksaan(array $data): array
    {
        return [
            'nip' => $data['nip'],
            'no_rawat' => $data['no_rawat'],

            'tgl_perawatan' => date('Y-m-d', strtotime($data['tanggal'])),
            'jam_rawat' => date('H:i:s', strtotime($data['tanggal'])),

            'suhu_tubuh' => '-',
            'tinggi' => '-',
            'berat' => '-',
            'tensi' => '-',
            'respirasi' => '-',
            'nadi' => '-',
            'spo2' => '-',
            'gcs' => '-',
            'alergi' => '-',

            'keluhan' => $data['asesmen'],
            'pemeriksaan' => $data['diagnosis'],
            'penilaian' => $data['intervensi'],
            'rtl' => $data['monitoring'],
            'evaluasi' => $data['evaluasi'],
            'instruksi' => $data['instruksi'],

            'kesadaran' => '-',
        ];
    }

    protected function mappingGrafik(array $data): array
    {
        return [
            'nip' => $data['nip'],
            'no_rawat' => $data['no_rawat'],

            'tgl_perawatan' => date('Y-m-d', strtotime($data['tanggal'])),
            'jam_rawat' => date('H:i:s', strtotime($data['tanggal'])),

            'suhu_tubuh' => '-',
            'tensi' => '-',
            'respirasi' => '-',
            'nadi' => '-',
            'spo2' => '-',
            'gcs' => '-',
            'kesadaran' => '-',

            'keluaran_urin' => null,
            'proteinuria' => null,
            'air_ketuban' => null,
            'skala_nyeri' => null,
            'lochia' => null,
            'terlihat_tidak_sehat' => null,
            'o2' => null,

            'sumber' => 'ADIME',
        ];
    }
}