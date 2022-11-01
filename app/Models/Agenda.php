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

    public function scopeSearch($query, $search) {
        return $query->where("tanggal", "LIKE", "%$search%")
        ->orWhere("jam", "LIKE", "%$search%")
        ->orWhere("nama_agenda", "LIKE", "%$search%")
        ->orWhere("lokasi", "LIKE", "%$search%")
        ->orWhereHas("caleg", function($caleg) use ($search) {
            $caleg->where("nama_caleg", "LIKE", "%$search%");
        })
        ->orWhere("status", "LIKE", "%$search%")
        ->orWhere("jenis", $search);
    }

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }
}
