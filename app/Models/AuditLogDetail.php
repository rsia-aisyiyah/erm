<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLogDetail extends Model
{
    protected $guarded = [];
    protected $table = "rsia_audit_log_details";
    protected array $ignoredFields = [
        'updated_at',
        'created_at'
    ];

    public function audit()
    {
        return $this->belongsTo(
            AuditLog::class
        );
    }
}