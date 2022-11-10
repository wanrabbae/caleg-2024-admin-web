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

    public function scopeSearch($query, $search) {
        return $query->where("nik", "LIKE", "%$search%")
        ->orWhere("nama_relawan", "LIKE", "%$search%")
        ->orWhere("jk", "LIKE", "%$search%")
        ->orWhereHas("desa.kecamatan", function($desa) use ($search) {
            $desa->where("nama_desa", "LIKE", "%$search%")->orWhere("nama_kecamatan", "LIKE", "%$search%");
        })
        ->orWhere("saksi", $search)
        ->orWhereHas("caleg", function($caleg) use ($search) {
            $caleg->where("nama_caleg", "LIKE", "%$search%");
        })
        ->orWhere("no_hp", "LIKE", "%$search%")
        ->orWhere("email", "LIKE", "%$search%")
        ->orWhere("username", "LIKE", "%$search%")
        ->orWhere("tps", "LIKE", "%$search%")
        ->orWhere("referal", "LIKE", "%$search%")
        ->orWhere("blokir", "LIKE", "%$search%");
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    public function uplineRel()
    {
        return $this->belongsTo(Relawan::class, 'upline', 'id_relawan');
    }

    public function downlineRel() {
        return $this->hasMany(Relawan::class, "upline", "id_relawan");
    }

    public function caleg()
    {
        return $this->belongsTo(Caleg::class, 'id_caleg');
    }

    public function daftarIsu() {
        return $this->hasMany(Daftar_Isu::class, "id_relawan");
    }

    public function survey() {
        return $this->hasMany(Hasil_Survey::class, "id_relawan");
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($relawan) {
            $relawan->daftarIsu()->each(function($value) {
                $value->delete();
            });
            $relawan->survey()->each(function($value) {
                $value->delete();
            });
        });
    }


}
