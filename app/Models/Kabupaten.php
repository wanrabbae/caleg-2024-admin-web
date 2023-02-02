<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'kabupaten';
    protected $primaryKey = 'id_kabupaten';
    protected $guarded = ["id_kabupaten"];
    public $timestamps = false;
    
    public function scopeSearch($query, $search) {
        return $query->where("nama_kabupaten", "LIKE", "%$search%")
        ->orWhereHas("provinsi", function($provinsi) use ($search) {
            $provinsi->where("nama_provinsi", "LIKE", "%$search%");
        })->orWhere("dapil", $search)
        ->orWhere("jumlah_dapil", $search);
    }

    public function kecamatan(){
        return $this->hasMany(Kecamatan::class, "id_kabupaten");
    }
    
    public function provinsi() {
        return $this->belongsTo(Provinsi::class, "id_provinsi");
    }
    
    public function caleg(){
        return $this->belongsTo(Caleg::class, "dapil", "dapil");
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($kabupaten) {
            $kabupaten->kecamatan()->each(function($kecamatan) {
                $kecamatan->delete();
            });
        });
    }
}
