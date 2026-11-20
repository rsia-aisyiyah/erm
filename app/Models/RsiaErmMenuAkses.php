<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsiaErmMenuAkses extends Model
{
    use HasFactory;

    protected $table = 'rsia_erm_menu_akses';
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(RsiaErmMenu::class, 'menu_id');
    }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'target_id', 'dep_id');
    }
}
