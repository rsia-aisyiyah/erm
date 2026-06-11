<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $table = "rsia_audit_logs";
    protected $guarded = [];
    protected $casts = [
        'entity_keys' => 'array',
    ];
    protected array $ignoredFields = [
        'updated_at',
        'created_at'
    ];


    public function details()
    {
        return $this->hasMany(
            AuditLogDetail::class
        );
    }
}