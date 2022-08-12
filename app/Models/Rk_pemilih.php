<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rk_pemilih extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';

    protected $table = "rk_pemilih";

    protected $primaryKey = "id_pemilih";

    public $timestamps = false;

    protected $guarded = [];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

}
