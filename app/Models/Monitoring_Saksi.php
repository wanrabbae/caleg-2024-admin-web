<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring_Saksi extends Model
{
    use HasFactory;

    protected $table = "detail_suara";
    protected $primaryKey = "id_detail";
    public $timestamps = false; 
    protected $guarded = [""];

    // protected $with = ["desa", "caleg", "partai"];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa');
    }

    public function caleg()
    {
        return $this->belongsTo(Caleg::class, 'id_caleg');
    }

    public function partai()
    {
        return $this->belongsTo(Partai::class, 'id_partai');
    }

}
