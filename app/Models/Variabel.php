<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variabel extends Model
{
    use HasFactory;

    protected $table = 'variabel';

    protected $primaryKey = 'id_variabel';

    public $timestamps = false;

    protected $guarded = [];

    public function scopeSearch($query, $search) {
        return $query->where("pertanyaan", "LIKE", "%$search%")
        ->orWhereHas("caleg", function($caleg) use ($search) {
            $caleg->where("nama_caleg", "LIKE", "%$search%");
        })
        ->orWhereHas("survey", function($survey) use ($search) {
            $survey->where("nama_survey", "LIKE", "%$search%");
        });
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class, "id_survey");
    }

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }
}
