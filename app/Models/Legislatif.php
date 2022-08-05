<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legislatif extends Model
{
    use HasFactory;

    protected $table = "legislatif";
    public $timestamps = false;
    protected $primaryKey = "id_legislatif";
    protected $guarded = [];

    public function caleg()
    {
        return $this->hasMany(Caleg::class);
    }
}
