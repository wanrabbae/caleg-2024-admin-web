<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar_Saksi extends Model
{
    use HasFactory;
    protected $table = "saksi";
    protected $primaryKey = "nik";
    protected $with = ["relawan"];

    public function relawan() {
        return $this->belongsTo(Relawan::class, "nik", "nik");
    }

    public function getRouteKeyName() {
        return "nik";
    }
}