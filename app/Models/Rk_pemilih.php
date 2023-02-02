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
    
    public function scopeSearch($query, $search) {
        return $query->where("nik", "LIKE", "%$search%")
        ->orWhere("nama", "LIKE", "%$search%")
        ->orWhere("tempat_lahir", "LIKE", "%$search%")
        ->orWhere("tgl_lahir", "LIKE", "%$search%")
        ->orWhere("jk", "LIKE", "%$search%")
        ->orWhereHas("desa.kecamatan", function($desa) use ($search) {
            $desa->where("nama_desa", "LIKE", "%$search%")->orWhere("nama_kecamatan", "LIKE", "%$search%");
        })
        ->orWhere("tgl_data", "LIKE", "%$search%");
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }
}
