<?php

namespace App\Http\Controllers;

use App\Models\RsiaDataTriaseUgdDetailSkala1;
use App\Models\RsiaDataTriaseUgdDetailSkala2;
use App\Models\RsiaDataTriaseUgdDetailSkala3;
use App\Models\RsiaDataTriaseUgdDetailSkala4;
use App\Models\RsiaDataTriaseUgdDetailSkala5;
use App\Models\RsiaTriaseUgd;
use Illuminate\Http\Request;

class TriasePemeriksaanUgd extends Controller
{

    protected $track;
    protected $triase;

    public function __construct()
    {
        $this->track = new \App\Http\Controllers\TrackerSqlController;
        $this->triase = new \App\Models\RsiaTriaseUgd;
    }

    function simpan(Request $request)
    {

        $data = $request->all();
        $triaseModels = [
            "skala1" => RsiaDataTriaseUgdDetailSkala1::class,
            "skala2" => RsiaDataTriaseUgdDetailSkala2::class,
            "skala3" => RsiaDataTriaseUgdDetailSkala3::class,
            "skala4" => RsiaDataTriaseUgdDetailSkala4::class,
            "skala5" => RsiaDataTriaseUgdDetailSkala5::class,
        ];

        // if data not empty
        if (!empty($data)) {
            // get data based on triase model keys
            foreach ($triaseModels as $key => $value) {
                // get data from request
                $dataTriase = $data[$key];
                // if data not empty
                if (!empty($dataTriase)) {
                    $no_rawat = $dataTriase[0]['no_rawat'];
                    // delete data
                    $value::where('no_rawat', $no_rawat)->delete();

                    foreach ($dataTriase as $keyTriase => $valueTriase) {
                        [$no_rawat, $skala] = array_keys($valueTriase);

                        if ($valueTriase[$skala] == null) continue;

                        $check = $value::where('no_rawat', $valueTriase[$no_rawat])
                            ->where($skala, $valueTriase[$skala])
                            ->first();

                        if ($check) {
                            // update data
                            $check->update($valueTriase);
                        } else {
                            // create data
                            $value::create($valueTriase);
                        }

                        $checkTriase = RsiaTriaseUgd::where('no_rawat', $valueTriase[$no_rawat])->first();
                        if (!$checkTriase) {
                            RsiaTriaseUgd::create([
                                'no_rawat' => $valueTriase[$no_rawat],
                                'tgl_kunjungan' => date('Y-m-d H:i:s'),
                            ]);

                            $this->track->insertSql(new RsiaTriaseUgd(), [
                                'no_rawat' => $valueTriase[$no_rawat],
                                'tgl_kunjungan' => date('Y-m-d H:i:s'),
                            ]);
                        } else {
                            $this->track->updateSql(new RsiaTriaseUgd(), [
                                'no_rawat' => $valueTriase[$no_rawat],
                                'tgl_kunjungan' => date('Y-m-d H:i:s'),
                            ], [
                                'no_rawat' => $valueTriase[$no_rawat],
                            ]);
                        }
                    }
                }
            }

            return response()->json(['message' => 'Data berhasil disimpan']);
        }

        return response()->json(['message' => 'Tidak ada data yang disimpan']);
    }

    public function getIndikator(Request $request)
    {
        $master = \App\Models\RsiaMasterTriasePemeriksaan::with([
            'skala1' => function ($query) use ($request) {
                $query->with(['triase' => function ($query) use ($request) {
                    if ($request->no_rawat) {
                        $query->where('no_rawat', $request->no_rawat);
                    }
                }]);
            },
            'skala2' => function ($query) use ($request) {
                $query->with(['triase' => function ($query) use ($request) {
                    if ($request->no_rawat) {
                        $query->where('no_rawat', $request->no_rawat);
                    }
                }]);
            },
            'skala3' => function ($query) use ($request) {
                $query->with(['triase' => function ($query) use ($request) {
                    if ($request->no_rawat) {
                        $query->where('no_rawat', $request->no_rawat);
                    }
                }]);
            },
            'skala4' => function ($query) use ($request) {
                $query->with(['triase' => function ($query) use ($request) {
                    if ($request->no_rawat) {
                        $query->where('no_rawat', $request->no_rawat);
                    }
                }]);
            },
            'skala5' => function ($query) use ($request) {
                $query->with(['triase' => function ($query) use ($request) {
                    if ($request->no_rawat) {
                        $query->where('no_rawat', $request->no_rawat);
                    }
                }]);
            },
        ])->get();

        // return yajra Datatable with defined columns
        return \Yajra\DataTables\DataTables::of($master)
            ->addColumn('skala1', function ($master) {
                return $master->skala1;
            })
            ->addColumn('skala2', function ($master) {
                return $master->skala2;
            })
            ->addColumn('skala3', function ($master) {
                return $master->skala3;
            })
            ->addColumn('skala4', function ($master) {
                return $master->skala4;
            })
            ->addColumn('skala5', function ($master) {
                return $master->skala5;
            })
            ->make(true);
    }
    function get(Request $request)
    {
        return $this->triase->where('no_rawat', $request->no_rawat)
            ->with(['triaseDetail1' => function ($query) {
                return $query->with(['skala1.pemeriksaan']);
            }, 'triaseDetail2' => function ($query) {
                return $query->with(['skala2.pemeriksaan']);
            }, 'triaseDetail3' => function ($query) {
                return $query->with(['skala3.pemeriksaan']);
            }, 'triaseDetail4' => function ($query) {
                return $query->with(['skala4.pemeriksaan']);
            }, 'triaseDetail5' => function ($query) {
                return $query->with(['skala5.pemeriksaan']);
            }])->first();
    }
}
