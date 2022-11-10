<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil_Survey extends Model
{
    use HasFactory;

    protected $table = 'hasil_survey';

    protected $primaryKey = 'id_jawaban';

    public $timestamps = false;

    protected $guarded = [];

    public function survey() {
        return $this->belongsTo(Survey::class, "id_survey");
    }

    public function relawan() {
        return $this->hasMany(Relawan::class, "id_relawan");
    }
}
