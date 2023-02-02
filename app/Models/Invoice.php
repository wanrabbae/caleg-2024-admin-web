<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = "invoice";
    protected $primaryKey = "id_invoice";
    protected $guarded = ["id_invoice"];

    public function scopeSearch($query, $search) {
        return $query->where("no_invoice", "LIKE", "%$search%")
        ->orWhereHas("caleg", function($caleg) use ($search) {
            $caleg->where("nama_caleg", "LIKE", "%$search%");
        })
        ->orWhere("created_at", "LIKE", "%$search%");
    }
    
    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }
}