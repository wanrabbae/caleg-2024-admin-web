<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $primary_key = 'id_kecamatan';

    protected $guarded = [];

    public function desa(){
        return $this->hasMany(Desa::class);
    }

}
