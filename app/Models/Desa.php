<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa';

    protected $primaryKey = 'id_desa';

    public $timestamps = false;

    protected $guarded = [];
    
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }

    public function relawan()
    {
        return $this->hasMany(Relawan::class, "id_desa");
    }

    public function rk_pemilih()
    {
        return $this->hasMany(Rk_pemilih::class);
    }
}
