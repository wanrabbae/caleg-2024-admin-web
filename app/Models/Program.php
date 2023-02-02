<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'program';
    protected $primaryKey = 'id_program';
    public $timestamps = false;

    protected $guarded = [];
    
    public function scopeSearch($query, $search) {
        return $query->where("judul_program", "LIKE", "%$search%")
        ->orWhereHas("caleg", function($caleg) use ($search) {
            $caleg->where("nama_caleg", "LIKE", "%$search%");
        })
        ->orWhere("deskripsi", "LIKE", "%$search%");
    }

    public function caleg()
    {
        return $this->belongsTo(Caleg::class, 'id_caleg');
    }
}
