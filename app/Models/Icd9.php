<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Icd9 extends Model
{
    use HasFactory;
    protected $table = 'icd9';

    public function prosedurPasien()
    {
        return $this->hasOne(ProsedurPasien::class, 'kode', 'kode');
    }
}
