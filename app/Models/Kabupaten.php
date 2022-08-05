<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'kabupaten';

    protected $primary_key = 'id_kabupaten';

    protected $guarded = [];

    public function kecamatan(){
        return $this->hasMany(Kecamatan::class);
    }

}
