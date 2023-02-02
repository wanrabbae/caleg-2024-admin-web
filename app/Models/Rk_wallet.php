<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rk_wallet extends Model
{
    use HasFactory;

    protected $table = "rk_wallet";
    protected $primaryKey = "id_wallet";
    public $timestamps = false;
    protected $guarded = ["id"];
    
    public function scopeSearch($query, $search) {
        return $query->where("nama_wallet", "LIKE", "%$search%")
        ->orWhere("nomor_wallet", "LIKE", "%$search%")
        ->orWhere("pemilik_wallet", "LIKE", "%$search%")
        ->orWhere("saldo_wallet", "LIKE", "%$search%");
    }

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }
    
    public function transaksi() {
        return $this->hasMany(Rk_transaksi::class, "id_wallet");
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($wallet) {
            $wallet->transaksi()->each(function($value) {
                $value->delete();
            });
        });
    }
}
