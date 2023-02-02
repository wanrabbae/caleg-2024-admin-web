<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desa';
    protected $primaryKey = 'id_desa';
    public $timestamps = false;
    protected $guarded = [];
    
    public function scopeFilter($query, array $search) {
        return $query->whereHas("kecamatan.kabupaten.provinsi", function($desa) use ($search) {
            $desa->where("kabupaten.id_provinsi", $search["id"])->where("kabupaten.dapil", $search["dapil"]);
        });
    }

    public function scopeSearch($query, $search) {
        return $query->where("nama_desa", "LIKE", "%$search%")
        ->orWhereHas("kecamatan.kabupaten.provinsi", function($kecamatan) use ($search) {
            $kecamatan->where("nama_kecamatan", "LIKE", "%$search%")->orWhere("nama_kabupaten", "LIKE", "%$search%")->orWhere("nama_provinsi", "LIKE", "%$search%");
        })->orWhere("tps", $search);
    }
    
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan')->withDefault();
    }

    public function relawan()
    {
        return $this->hasMany(Relawan::class, "id_desa");
    }

    public function rk_pemilih()
    {
        return $this->hasMany(Rk_pemilih::class, "id_desa");
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($desa) {
            $desa->relawan()->each(function($relawan) {
                $relawan->delete();
            });
        });
    }
}
