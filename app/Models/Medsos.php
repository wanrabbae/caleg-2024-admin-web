<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medsos extends Model
{
    use HasFactory;
    protected $table = "medsos";
    protected $primaryKey = "id_medsos";
    public $timestamps = false;

    protected $guarded = [];
    
    public function scopeSearch($query, $search) {
        return $query->where("type", "LIKE", "%$search%")
        ->orWhere("nama_medsos", "LIKE", "%$search%")
        ->orWhereHas("caleg", function($caleg) use ($search) {
                $caleg->where("nama_caleg", "LIKE", "%$search%");
        });
    }

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }

}
