<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaErmMenuUser extends Model
{
    use HasFactory;

    protected $table = 'rsia_erm_menu_user';
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(RsiaErmMenu::class, 'menu_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nik', 'nik');
    }
}

