<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ConfigBlas;


class Caleg extends Model
{
    use HasFactory;

    protected $table = 'caleg';
    public $timestamps = false;
    protected $primaryKey = 'id_caleg';

    protected $guarded = [];

    protected $hidden = ["password"];

    public function scopeSearch($query, $search) {
        return $query->where("demo", $search)
        ->orWhere("dapil", $search)
        ->orWhere("nama_caleg", "LIKE", "%$search%")
        ->orWhere("nama_lengkap", "LIKE", "%$search%")
        ->orWhereHas("legislatif", function($legislatif) use ($search) {
            $legislatif->where("nama_legislatif", "LIKE", "%$search%");
        })
        ->orWhereHas("provinsi", function($provinsi) use ($search) {
            $provinsi->where("nama_provinsi", "LIKE", "%$search%");
        })
        ->orWhereHas("kabupaten", function($kabupaten) use ($search) {
            $kabupaten->where("nama_kabupaten", "LIKE", "%$search%");
        })
        ->orWhere("level", "LIKE", "%$search%")
        ->orWhere("alamat", "LIKE", "%$search%")
        ->orWhere("no_hp", "LIKE", "%$search%")
        ->orWhere("email", "LIKE", "%$search%")
        ->orWhereHas("partai", function($partai) use ($search) {
            $partai->where("nama_partai", "LIKE", "%$search%");
        })
        ->orWhere("username", $search);
    }

    public function legislatif()
    {
        return $this->belongsTo(Legislatif::class, 'id_legislatif')->withDefault();
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
        return $this->belongsTo(ConfigBlas::class, "id_caleg", "id_caleg");
    }

    public function rekening() {
        return $this->hasOne(Rk_bank::class, "id_caleg");
    }

    public function wallet() {
        return $this->hasMany(Rk_wallet::class, "id_caleg");
    }

    public function kategori() {
        return $this->hasMany(Rk_kategori::class, "id_caleg");
    }

    public function transaksi() {
        return $this->hasMany(Rk_transaksi::class, "id_caleg");
    }

    public function provinsi() {
        return $this->belongsTo(Provinsi::class, "id_provinsi")->withDefault();
    }

    public function kabupaten() {
        return $this->belongsTo(Kabupaten::class, "id_kabupaten")->withDefault();
    }

    public function invoice() {
        return $this->belongsTo(Invoice::class, "id_caleg", "id_caleg");
    }

    public static function boot() {
        parent::boot();

        static::created(function($caleg) {
            ConfigBlas::create(["id_caleg" => $caleg->id_caleg]);
        });

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
            
            $caleg->rekening()->delete();

            $caleg->wallet()->each(function($value) {
                $value->delete();
            });

            $caleg->kategori()->each(function($value) {
                $value->delete();
            });

            $caleg->transaksi()->each(function($value) {
                $value->delete();
            });

            $caleg->invoice()->delete();
        });
    }
}
