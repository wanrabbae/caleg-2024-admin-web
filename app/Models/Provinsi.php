<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = "provinsi";
    protected $primaryKey = "id_provinsi";
    public $timestamps = false;
    protected $guarded = ["id_provinsi"];

    public function scopeSearch($query, $search) {
        return $query->where("nama_provinsi", "LIKE", "%$search%")->orWhere("jumlah_dapil", $search);
    }

    public function kabupaten() {
        return $this->hasMany(Kabupaten::class, "id_provinsi");
    }

    public function caleg() {
        return $this->hasMany(Caleg::class, "id_provinsi");
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($provinsi) {
            $provinsi->kabupaten()->each(function($kabupaten) {
                $kabupaten->delete();
            });
        });
    }
}