<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAturan extends Model
{
    use HasFactory;
    protected $table = 'master_aturan_pakai';
    protected $guarded = [];
    public $timestamps = false;
}
