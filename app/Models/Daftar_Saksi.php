<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar_Saksi extends Model
{
    use HasFactory;
    protected $table = "saksi";
    protected $primaryKey = "id_saksi";
    public $timestamps = false;
    protected $guarded = [""];
    
    public function scopeSearch($query, $search) {
        return $query->whereHas("relawan.desa.kecamatan", function($relawan) use ($search) {
            $relawan->where("nama_relawan", "LIKE", "%$search%")->orWhere("jk", "LIKE", "%$search%")->orWhere("tps", "LIKE", "%$search%")->orWhere("nama_desa", "LIKE", "%$search%")->orWhere("nama_kecamatan", "LIKE", "%$search%");
        })
        ->orWhereHas("caleg", function($caleg) use ($search) {
            $caleg->where("nama_caleg", "LIKE", "%$search%");
        });
    }

    public function relawan() {
        return $this->belongsTo(Relawan::class, "id_relawan")->withDefault();
    }

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }
}
