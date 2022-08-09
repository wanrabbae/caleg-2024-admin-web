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

    public function caleg()
    {
        return $this->belongsTo(Caleg::class, 'id_caleg');
    }
}
