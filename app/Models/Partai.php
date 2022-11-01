<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partai extends Model
{
    use HasFactory;

    protected $table = "partai";
    protected $primaryKey = "id_partai";
    public $timestamps = false;
    protected $guarded = [];

    public function scopeSearch($query, $search) {
        return $query->where("nama_partai", "LIKE", "%$search%")
        ->orWhere("nama_pendek", "LIKE", "%$search%")
        ->orWhere("no_urut", $search);
    }

    public function caleg()
    {
        return $this->hasMany(Caleg::class, "id_partai");
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($partai) {
            $partai->caleg()->each(function($value) {
                $value->delete();
            });
        });
    }
}
