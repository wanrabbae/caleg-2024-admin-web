<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rk_bank extends Model
{
    use HasFactory;
    protected $table = "rk_bank";
    protected $primaryKey = "id_bank";
    public $timestamps = false;
    protected $guarded = [];
    
    public function scopeSearch($query, $search) {
        return $query->where("nama_bank", "LIKE", "%$search%")
        ->orWhere("nomor_bank", "LIKE", "%$search%")
        ->orWhere("pemilik_bank", "LIKE", "%$search%")
        ->orWhere("saldo_bank", "LIKE", "%$search%");
    }

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }
    
    public function transaksi() {
        return $this->hasMany(Rk_transaksi::class, "id_bank");
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($rekening) {
            $rekening->transaksi()->each(function($value) {
                $value->delete();
            });
        });
    }
}
