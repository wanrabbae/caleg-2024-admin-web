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
}