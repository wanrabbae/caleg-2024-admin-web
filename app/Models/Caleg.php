<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Caleg extends Model
{
    use HasFactory;

    protected $table = 'caleg';
    public $timestamps = false;
    protected $primaryKey = 'id_caleg';

    protected $guarded = [];

    protected $hidden = ["password"];

    public function legislatif()
    {
        return $this->belongsTo(Legislatif::class, 'id_legislatif');
    }

    public function partai()
    {
        return $this->belongsTo(Partai::class, 'id_partai');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'id_caleg');
    }

    public function relawan()
    {
        return $this->hasMany(Relawan::class, "id_caleg");
    }

    public function survey(){
        return $this->hasMany(Survey::class, "id_caleg");
    }

    public function program() {
        return $this->hasMany(Program::class, "id_caleg");
    }

    public function medsos() {
        return $this->hasMany(Medsos::class, "id_caleg");
    }

    public function daftarIsu() {
        return $this->hasMany(Daftar_Isu::class, "id_caleg");
    }

    public function agenda() {
        return $this->hasMany(Agenda::class, "id_caleg");
    }

    public function variable() {
        return $this->hasMany(Variabel::class, "id_caleg");
    }

    public function saksi() {
        return $this->hasMany(Daftar_Saksi::class, "id_caleg");
    }

    public function config() {
        return $this->belongsTo(ConfigBlas::class, "id_caleg");
    }


    public static function boot() {
        parent::boot();

        static::deleting(function($caleg) {
            $caleg->news()->each(function($value) {
                $value->delete();
            });

            $caleg->survey()->each(function($value) {
                $value->delete();
            });

            $caleg->program()->each(function($value) {
                $value->delete();
            });

            $caleg->relawan()->each(function($value) {
                $value->delete();
            });

            $caleg->medsos()->each(function($value) {
                $value->delete();
            });

            $caleg->daftarIsu()->each(function($value) {
                $value->delete();
            });

            $caleg->agenda()->each(function($value) {
                $value->delete();
            });

            $caleg->variable()->each(function($value) {
                $value->delete();
            });

            $caleg->saksi()->each(function($value) {
                $value->delete();
            });

            $caleg->config()->delete();
        });
    }
}
