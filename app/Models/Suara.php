<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suara extends Model
{
    use HasFactory;

    protected $table = "suara";

    protected $primaryKey = "id_suara";

    public $timestamps = false;

    protected $guarded = [];

    public function relawan()
    {
        return $this->belongsTo(Relawan::class, 'id_relawan');
    }
 }
