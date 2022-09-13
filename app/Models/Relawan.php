<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relawan extends Model
{
    use HasFactory;
    protected $table = 'relawan';
    public $timestamps = false;
    protected $primaryKey = 'id_relawan';
    public $incrementing = false;
    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    // public function kecamatan()
    // {
    //     return $this->belongsTo(Kecamatan::class, "id_kecamatan");
    // }

    public function caleg()
    {
        return $this->belongsTo(Caleg::class, 'id_caleg');
    }
}
