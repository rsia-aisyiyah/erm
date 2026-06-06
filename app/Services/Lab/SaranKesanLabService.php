<?php

namespace App\Services\Lab;

use App\Models\RsiaSaranKesan;
use App\Models\SaranKesanLab;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaranKesanLabService
{

    protected $model;
    public function __construct(SaranKesanLab $model)
    {
        $this->model = $model;
    }
    public function get(Request $request)
    {
        $query = $this->model->where('no_rawat', $request->no_rawat);

        if ($request->tgl_periksa && $request->jam) {
            $record = $query->where('tgl_periksa', $request->tgl_periksa)
                ->where('jam', $request->jam)
                ->first();
        } else {
            $record = $query->get();
        }

        return $record;
    }
    public function show(Request $request)
    {
        $record = $this->model->where('no_rawat', $request->no_rawat)
            ->where('tgl_periksa', $request->tgl_periksa)
            ->where('jam', $request->jam)
            ->first();
        return $record;
    }

    public function create(Request $request)
    {
        // 1. Masukkan semua field yang dibutuhkan ke dalam validasi
        $validated = $request->validate([
            'no_rawat' => 'required',
            'tgl_periksa' => 'required',
            'jam' => 'required',
            'saran' => 'required',
            'kesan' => 'required',

        ]);

        $validatedDetail = $request->validate([
            'noorder' => 'required',
            'kd_dokter' => 'required',
        ]);

        try {
            // Gunakan DB::transaction agar jika salah satu gagal, semua dibatalkan
            return DB::transaction(function () use ($validated, $validatedDetail) {
                $this->model->create($validated);

                RsiaSaranKesan::create([
                    'noorder' => $validatedDetail['noorder'],
                    'kd_dokter' => $validatedDetail['kd_dokter'],
                    'saran' => $validated['saran'],
                    'kesan' => $validated['kesan'],
                ]);
            });

        } catch (QueryException $e) {
            // JANGAN cuma return $e->errorInfo, tapi return sebagai response JSON dengan status 500
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan data ke database',
                'error' => $e->errorInfo
            ], 500);
        }
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'no_rawat' => 'required',
            'tgl_periksa' => 'required',
            'jam' => 'required',
            'saran' => 'required',
            'kesan' => 'required'
        ]);

        $validatedDetail = $request->validate([
            'noorder' => 'required',
            'kd_dokter' => 'required',
        ]);

        try {
            // Gunakan DB::transaction agar jika salah satu gagal, semua di-rollback
            return DB::transaction(function () use ($validated, $validatedDetail) {

                // Update tabel utama ($this->model)
                $this->model->where([
                    'no_rawat' => $validated['no_rawat'],
                    'tgl_periksa' => $validated['tgl_periksa'],
                    'jam' => $validated['jam'],

                ])
                    ->update([
                        'no_rawat' => $validated['no_rawat'],
                        'tgl_periksa' => $validated['tgl_periksa'],
                        'jam' => $validated['jam'],
                        'saran' => $validated['saran'],
                        'kesan' => $validated['kesan'],
                    ]);

                RsiaSaranKesan::where('noorder', $validatedDetail['noorder'])
                    ->update([
                        'noorder' => $validatedDetail['noorder'],
                        'kd_dokter' => $validatedDetail['kd_dokter'],
                        'saran' => $validated['saran'],
                        'kesan' => $validated['kesan'],
                    ]);

                return true;
            });

        } catch (QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengubah data di database',
                'error' => $e->errorInfo
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $key = [
            'no_rawat' => $request->no_rawat,
            'tgl_periksa' => $request->tgl_periksa,
            'jam' => $request->jam,
        ];
        try {
            DB::transaction(function () use ($key, $request) {
                $this->model->where($key)->delete();
                RsiaSaranKesan::where([
                    'noorder' => $request->noorder
                ])->delete();
            });

            return 'success';

        } catch (QueryException $e) {
            return $e->errorInfo;
        }
    }

}