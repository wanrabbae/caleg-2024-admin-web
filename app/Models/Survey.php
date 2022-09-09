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

    public function caleg() {
        return $this->belongsTo(Caleg::class, "id_caleg");
    }

    public function variable() {
        return $this->belongsTo(Variabel::class, "id_variabel");
    }

}
