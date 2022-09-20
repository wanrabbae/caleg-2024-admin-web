<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;

    protected $table = 'galery';

    protected $guarded = [''];

    protected $primaryKey = 'id_galery';

    public $timestamps = false;

    public function caleg()
    {
        return $this->hasMany(Caleg::class, "id_caleg");
    }
}
