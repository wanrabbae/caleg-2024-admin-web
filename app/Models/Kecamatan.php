<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $primaryKey = 'id_kecamatan';

    protected $guarded = [];

    public $timestamps = false;
    
    public function scopeSearch($query, $search) {
        return $query->where("nama_kecamatan", "LIKE", "%$search%")
        ->orWhere("dapil", $search)
        ->orWhereHas("kabupaten.provinsi", function($kabupaten) use ($search) {
            $kabupaten->where("nama_kabupaten", "LIKE", "%$search%")->orWhere("nama_provinsi", "LIKE", "%$search%");
        });
    }

    public function kabupaten(){
        return $this->belongsTo(Kabupaten::class, "id_kabupaten");
    }

    public function desa() {
        return $this->hasMany(Desa::class, "id_kecamatan");
    }
    
     public function caleg(){
        return $this->belongsTo(Caleg::class, "dapil", "dapil");
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($kecamatan) {
            $kecamatan->desa()->each(function($desa) {
                $desa->delete();
            });
        });
    }

}
