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

    public function caleg(){
        return $this->hasMany(Caleg::class);
    }

    public function variable(){
        return $this->hasMany(Variabel::class);
    }

}
