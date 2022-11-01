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

    public function scopeSearch($query, $search) {
        return $query->where("judul_isu", "LIKE", "%$search%")
        ->orWhereHas("caleg", function($caleg) use ($search) {
            $caleg->where("nama_caleg", "LIKE", "%$search%");
        })
        ->orWhere("tanggal", "LIKE", "%$search%")
        ->orWhereHas("kecamatan", function($kecamatan) use ($search) {
            $kecamatan->where("nama_kecamatan", "LIKE", "%$search%");
        })
        ->orWhereHas("relawan", function($relawan) use ($search) {
            $relawan->where("nama_relawan", "LIKE", "%$search%");
        })
        ->orWhere("keterangan", "LIKE", "%$search%")
        ->orWhere("tanggapan", "LIKE", "%$search%");
    }

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