<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil_Survey extends Model
{
    use HasFactory;

    protected $table = "hasil_survey";
    public $timestamps = false;
    protected $guarded = [""];
    protected $primaryKey = "id_jawaban";

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }

    public function survey() {
        return $this->belongsTo(Survey::class, "id_survey");
    }

    public function relawan() {
        return $this->belongsTo(Relawan::class, "id_relawan");
    }
}