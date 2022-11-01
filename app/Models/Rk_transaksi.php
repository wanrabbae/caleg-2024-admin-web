<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rk_transaksi extends Model
{
    use HasFactory;
    protected $table = "rk_transaksi";
    public $timestamps = false;
    protected $primaryKey = "id_transaksi";
    protected $guarded = ["id"];

    public function scopeSearch($query, $search) {
        return $query->where("tgl_transaksi", "LIKE", "%$search%")
        ->orWhereHas("bank", function($bank) use ($search) {
            $bank->where("nama_bank", "LIKE", "%$search%");
        })
        ->orWhereHas("wallet", function($wallet) use ($search) {
            $wallet->where("nama_wallet", "LIKE", "%$search%");
        })
        ->orWhereHas("kategori", function($kategori) use ($search) {
            $kategori->where("nama_kategori", "LIKE", "%$search%")->orWhere("jenis_transaksi", "LIKE", "%$search%");
        })
        ->orWhere("jumlah", "LIKE", "%$search%")
        ->orWhere("deskripsi", "LIKE", "%$search%");
    }

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }

    public function kategori() {
        return $this->belongsTo(Rk_kategori::class, "id_kategori");
    }

    public function bank() {
        return $this->belongsTo(Rk_bank::class, "id_bank");
    }

    public function wallet() {
        return $this->belongsTo(Rk_wallet::class, "id_wallet");
    }
}
