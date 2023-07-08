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
    public function convertSql($query)
    {
        return $query = vsprintf(str_replace(array('?'), array('\'%s\''), $query->toSql()), $query->getBindings());
    }
    public function create($query, $user)
    {
        $data = [
            'tanggal' => date('Y-m-d H:i:s'),
            'sqle' => $this->convertSql($query),
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
