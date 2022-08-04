<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caleg extends Model
{
    use HasFactory;

    protected $table = 'caleg';
    public $timestamps = false;

    protected $guarded = [];

    public function legislatif()
    {
        return $this->belongsTo(Legislatif::class, 'id_legislatif');
    }

    public function partai()
    {
        return $this->belongsTo(Partai::class, 'id_partai');
    }
}
