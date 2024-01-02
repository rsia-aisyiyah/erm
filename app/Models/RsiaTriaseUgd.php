<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RsiaDataTriaseUgdDetailSkala1;
use App\Models\RsiaDataTriaseUgdDetailSkala2;
use App\Models\RsiaDataTriaseUgdDetailSkala3;
use App\Models\RsiaDataTriaseUgdDetailSkala4;
use App\Models\RsiaDataTriaseUgdDetailSkala5;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RsiaTriaseUgd extends Model
{
    use HasFactory;

    protected $table = 'rsia_triase_ugd';

    public $timestamps = false;

    // fillable
    // no_rawat, tgl_kunjungan
    protected $fillable = [
        'no_rawat',
        'tgl_kunjungan'
    ];

    protected $casts = [
        'tgl_kunjungan' => 'datetime'
    ];

    function triaseDetail1()
    {
        return $this->hasMany(RsiaDataTriaseUgdDetailSkala1::class, 'no_rawat', 'no_rawat');
    }
    function triaseDetail2()
    {
        return $this->hasMany(RsiaDataTriaseUgdDetailSkala2::class, 'no_rawat', 'no_rawat');
    }
    function triaseDetail3()
    {
        return $this->hasMany(RsiaDataTriaseUgdDetailSkala3::class, 'no_rawat', 'no_rawat');
    }
    function triaseDetail4()
    {
        return $this->hasMany(RsiaDataTriaseUgdDetailSkala4::class, 'no_rawat', 'no_rawat');
    }
    function triaseDetail5()
    {
        return $this->hasMany(RsiaDataTriaseUgdDetailSkala5::class, 'no_rawat', 'no_rawat');
    }
}
