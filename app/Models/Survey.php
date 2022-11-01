<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'survey';

    protected $primaryKey = 'id_survey';

    public $timestamps = false;

    protected $guarded = [];

    public function scopeSearch($query, $search) {
        return $query->where("nama_survey","LIKE", "%$search%")
        ->orWhere("mulai_tanggal", "LIKE", "%$search%")
        ->orWhere("sampai_tanggal", "LIKE", "%$search%")
        ->orWhereHas("caleg", function($caleg) use ($search) {
            $caleg->where("nama_caleg", "LIKE", "%$search%");
        })
        ->orWhere("aktif", $search);
    }

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }

    public function variable() {
        return $this->hasMany(Variabel::class, "id_survey");
    }
    
    public static function boot() {
        parent::boot();

        static::deleting(function($survey) {
            $survey->variable()->each(function($variable) {
                $variable->delete();
            });
        });
    }
}
