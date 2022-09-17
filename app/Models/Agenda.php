<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $table = "agenda";
    public $timestamps = false;
    protected $primaryKey = "id_agenda";

    protected $guarded = [];

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }
}
