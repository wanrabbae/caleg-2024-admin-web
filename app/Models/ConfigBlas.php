<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigBlas extends Model
{
    use HasFactory;

    protected $table = "config";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $guarded = [""];

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }
}
