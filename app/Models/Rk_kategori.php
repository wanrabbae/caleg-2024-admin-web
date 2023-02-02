<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rk_kategori extends Model
{
    use HasFactory;

    protected $table = "rk_kategori";
    public $timestamps = false;
    protected $primaryKey = "id_kategori";
    protected $guarded = ["id"];
    
    public function scopeSearch($query, $search) {
        return $query->where("kode_kategori", "LIKE", "%$search%")
        ->orWhere("nama_kategori", "LIKE", "%$search%")
        ->orWhere("jenis_transaksi", "LIKE", "%$search%");
    }

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }

    public function transaksi() {
        return $this->hasMany(Rk_transaksi::class, "id_kategori");
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($kategori) {
            $kategori->transaksi()->each(function($value) {
                $value->delete();
            });
        });
    }
}
