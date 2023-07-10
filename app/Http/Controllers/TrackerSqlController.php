<?php

namespace App\Http\Controllers;

use App\Models\TrackerSql;
use Illuminate\Http\Request;

class TrackerSqlController extends Controller
{
    protected $tracker;
    public function __construct()
    {
        $this->tracker = new TrackerSql();
    }
    public function convertSql($table, $values)
    {
        $table = $table->getTable();
        $values = implode('|', $values);

        return "insert into $table values(|$values))";
    }
    public function create($table, $values, $user)
    {
        $data = [
            'tanggal' => date('Y-m-d H:i:s'),
            'sqle' => $this->convertSql($table, $values),
            'usere' => $user,
        ];
        try {
            $result = $this->tracker->create($data);
        } catch (\Illuminate\Database\QueryException $e) {
            $result = $e->errorInfo;
        }

        return $result;
    }
}
