<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variabel extends Model
{
    use HasFactory;

    protected $table = 'variabel';

    protected $primaryKey = 'id_variabel';

    public $timestamps = false;

    protected $guarded = [];

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class, "id_survey");
    }
}
