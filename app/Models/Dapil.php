<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dapil extends Model
{
    use HasFactory;

    protected $guarded = ["id_dapil"];
    protected $table = "dapil";
    protected $primaryKey = "id_dapil";
    public $timestamps = false;

    public function detailDapil() {
        return $this->hasMany(Detail_Dapil::class, "id_dapil");
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($dapil) {
            $dapil->detailDapil()->each(function($detailDapil) {
                $detailDapil->delete();
            });
        });
    }
}
