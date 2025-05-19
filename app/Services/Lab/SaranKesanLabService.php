<?php

namespace App\Services\Lab;

use App\Models\SaranKesanLab;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'no_rawat' => 'required',
            'tgl_periksa' => 'required',
            'jam' => 'required',
            'saran' => 'required',
            'kesan' => 'required',
        ]);

        try {
            $result = $this->model->create($validated);
            return $result;
        } catch (QueryException $e) {
            return $e->errorInfo;
        }
    }
    public function update(Request $request)
    {
        $validated = $request->validate([
            'no_rawat' => 'required',
            'tgl_periksa' => 'required',
            'jam' => 'required',
            'saran' => 'required',
            'kesan' => 'required',
        ]);
        try {
            $result = $this->model->where('no_rawat', $request->no_rawat)
                ->where('tgl_periksa', $request->tgl_periksa)
                ->where('jam', $request->jam)
                ->update($validated);
            return $result;
        } catch (QueryException $e) {
            return $e->errorInfo;
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
            $result = $this->model->where($key)->delete();
        } catch (QueryException $e) {
            return $e->errorInfo;
        }
        return $result;
    }

}