<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kecamatan;
use App\Models\Relawan;

class Daftar_Isu extends Model
{
    use HasFactory;
    protected $table = "daftar_isu";
    protected $primaryKey = "id_isu";
    public $timestamps = false;
    protected $guarded = [""];

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }

    public function kecamatan() {
        return $this->belongsTo(Kecamatan::class, "id_kecamatan");
    }

    public function relawan() {
        return $this->belongsTo(Relawan::class, "id_relawan", "id_relawan");
    }
}