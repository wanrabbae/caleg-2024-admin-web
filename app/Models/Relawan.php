<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Relawan extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'relawan';
    public $timestamps = false;
    protected $primaryKey = 'id_relawan';
    public $incrementing = false;
    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    public function simpatisan()
    {
        return $this->hasMany(Relawan::class, 'upline', 'upline');
    }

    public function caleg()
    {
        return $this->belongsTo(Caleg::class, 'id_caleg');
    }

    public function daftarIsu() {
        return $this->hasMany(Daftar_Isu::class, "id_relawan");
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($relawan) {
            $relawan->daftarIsu()->each(function($value) {
                $value->check();
            });
        });
    }


}
