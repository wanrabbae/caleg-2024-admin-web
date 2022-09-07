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
}
