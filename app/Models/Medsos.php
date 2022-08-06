<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medsos extends Model
{
    use HasFactory;
    protected $table = "medsos";
    protected $primaryKey = "id_medsos";
    public $timestamps = false;

    protected $guarded = [];

    

}
