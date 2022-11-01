<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legislatif extends Model
{
    use HasFactory;

    protected $table = "legislatif";
    public $timestamps = false;
    protected $primaryKey = "id_legislatif";
    protected $guarded = [];

    public function scopeSearch($query, $search) {
        return $query->where("nama_legislatif", "LIKE", "%$search%")
        ->orWhere("type", "LIKE", "%$search%");
    }

    public function caleg()
    {
        return $this->hasMany(Caleg::class, "id_legislatif");
    }

    public function dapil() {
        return $this->hasMany(Dapil::class, "id_legislatif");
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($legislatif) {
            $legislatif->caleg()->each(function($value) {
                $value->delete();
            });

            $legislatif->dapil()->each(function($value) {
                $value->delete();
            });
        });

    }

}
