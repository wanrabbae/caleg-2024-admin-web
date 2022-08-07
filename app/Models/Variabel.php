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

    public function survey(){
        return $this->hasMany(Survey::class);
    }
}
