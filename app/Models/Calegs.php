<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Caleg as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Calegs extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'caleg';
    protected $primaryKey = 'id_caleg';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_caleg',
        'nama_lengkap',
        'id_legislatif',
        'alamat',
        'no_hp',
        'email',
        'id_partai',
        'aktif',
        'username',
        'foto'
    ];

    // protected $guarded = [];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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

    public function config()
    {
        return $this->belongsTo(ConfigBlas::class, 'id_caleg', "id_caleg");
    }

    public function rekening() {
        return $this->belongsTo(Rk_bank::class, "id_caleg");
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
        return $this->belongsTo(Invoice::class, "id_caleg");
    }

    public function getRememberTokenName() {
        return "id_session";
    }

}
