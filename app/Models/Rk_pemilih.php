<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rk_pemilih extends Model
{
    use HasFactory;

    protected $table = "rk_pemilih";

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
