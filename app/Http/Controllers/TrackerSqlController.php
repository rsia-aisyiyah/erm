<?php

namespace App\Http\Controllers;

use App\Models\TrackerSql;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackerSqlController extends Controller
{
    protected $tracker;
    public function __construct()
    {
        $this->tracker = new TrackerSql();
    }
    public function insertSql($table, $values)
    {
        $table = $table->getTable();
        $values = implode('|', $values);
        $str = "insert into $table values(|$values))";
        return $this->create($str);
    }

    function stringClause($clause)
    {
        $count = 1;
        $stringClause = '';
        foreach ($clause as $cls) {
            if ($count < count($clause)) {
                $and = ' AND ';
                $count++;
            } else {
                $and = '';
            }
            $keyClasue = array_keys($clause, $cls, true);
            $stringClause .= "$keyClasue[0]" . '=' . "'$cls'" . $and;
        }

        return $stringClause;
    }

    function deleteSql($table, $clause)
    {
        $table = $table->getTable();
        $stringClause = $this->stringClause($clause);
        $str = "delete from $table where $stringClause";
        return $this->create($str);
    }
    function updateSql($table, $values, $clause)
    {
        $table = $table->getTable();
        $keys = [];
        foreach ($values as $vals => $index) {
            $keys[] = "$vals='$index'";
        }
        $stringKeys = implode(",", $keys);
        $stringClause = $this->stringClause($clause);
        $str =  "update $table set $stringKeys where $stringClause";
        return $this->create($str);
    }

    public function create($sql)
    {
        $data = [
            'tanggal' => date('Y-m-d H:i:s'),
            'sqle' => $sql,
            'usere' => session()->get('pegawai')->nik,
        ];
        try {
            $result = $this->tracker->create($data);
        } catch (\Illuminate\Database\QueryException $e) {
            $result = $e->errorInfo;
        }

        return $result;
    }

//	public function get(Request $request)
//	{
//		$string = $request->input('keywords', []);
//
//		if (!is_array($string)) {
//			$string = [$string];
//		}
//
//		$query = DB::table('trackersql')
//			->join('pegawai', 'pegawai.nik', '=', 'trackersql.usere')
//			->select(['pegawai.nik', 'pegawai.nama', 'trackersql.sqle','tanggal']);
//
//		foreach ($string as $keyword) {
//			$query->whereRaw("trackersql.sqle REGEXP ?", [$keyword]);
//		}
//
//		$results = $query->orderBy('tanggal', 'DESC')->get();
//
//		return response()->json($results);
//	}

}
