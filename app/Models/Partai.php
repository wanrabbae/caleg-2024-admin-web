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

    public function caleg()
    {
        return $this->hasMany(Caleg::class);
    }
}
