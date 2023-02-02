<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rk_pemilih_2 extends Model
{
    use HasFactory;

    protected $table = "rk_pemilih";

    protected $connection = "mysql2";
    protected $primaryKey = "id_pemilih";

    public $timestamps = false;

    protected $guarded = [];
    
     public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    public function caleg() {
        return $this->belongsTo(Caleg::class, 'id_caleg');
    }
}