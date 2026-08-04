<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function get(Request $request)
    {
        $keys = $request->query('keys', []);
        $query = \App\Models\AuditLog::query();

        if (!empty($keys)) {
            $query->where('entity_keys', json_encode($keys))
                ->where('table_name', $request->query('table'));
        }

        return $query->with('details')->get();
    }
}
