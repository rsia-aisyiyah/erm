<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskepRanapAnakRequest;
use Illuminate\Http\Request;
use App\Models\AskepRanapAnak;
use App\Models\MasalahAskepRanap;
use App\Models\RencanaAskepRanap;
use Illuminate\Support\Facades\DB;

class AskepRanapAnakController extends Controller
{
    protected $askep;
    protected $track;
    public function __construct()
    {
        $this->askep = new AskepRanapAnak();
        $this->track = new TrackerSqlController();
    }

    function get(Request $request)
    {
        return $this->askep->where('no_rawat', $request->no_rawat)->with('regPeriksa.pasien.bahasa', 'regPeriksa.pasien.riwayatImunisasi.masterImunisasi', 'regPeriksa.penjab', 'masalahKeperawatan.masterMasalah', 'masalahKeperawatan.rencanaKeperawatan.masterRencana', 'pengkaji1', 'pengkaji2', 'dokter')->first();
    }

    function insert(AskepRanapAnakRequest $request)
    {
        $data = $request->validated();
        $insert = $this->askep->create($data);
        $this->track->insertSql($this->askep, $data);
        return response()->json($insert);
    }

    function createOrUpdate(AskepRanapAnakRequest $request)
    {
        $data = $request->validated();
        $dataMasalah = $request->input('masalah', []);
        $dataRencana = $request->input('rencana', []);

        try {

            DB::transaction(function () use ($data, $dataMasalah, $dataRencana) {
                $askep = $this->askep->updateOrCreate(
                    ['no_rawat' => $data['no_rawat']],
                    $data
                );

                // Hapus masalah dan rencana yang lama
                MasalahAskepRanap::where('no_rawat', $data['no_rawat'])->delete();
                RencanaAskepRanap::where('no_rawat', $data['no_rawat'])->delete();

                // Simpan masalah yang baru
                foreach ($dataMasalah as $masalah) {
                    MasalahAskepRanap::create([
                        'no_rawat' => $data['no_rawat'],
                        'kode_masalah' => $masalah['kode_masalah'],
                    ]);
                }

                // Simpan rencana yang baru
                foreach ($dataRencana as $rencana) {
                    RencanaAskepRanap::create([
                        'no_rawat' => $data['no_rawat'],
                        'kode_rencana' => $rencana['kode_rencana'],
                    ]);
                }

                if ($askep->wasRecentlyCreated) {
                    $this->track->insertSql($this->askep, $data);
                } else {
                    $this->track->updateSql($this->askep, $data, ['no_rawat' => $data['no_rawat']]);
                }
            });

            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan',], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $th->getMessage(),
            ], 500);
        }
    }
}
