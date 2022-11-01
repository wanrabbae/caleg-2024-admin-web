<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Dapil extends Model
{
    use HasFactory;

    protected $guarded = ["id_detail"];
    protected $table = "detail_dapil";
    protected $primaryKey = "id_detail";
    public $timestamps = false;

    public function dapil() {
        return $this->belongsTo(Dapil::class, "id_dapil");
    }

    public function provinsi() {
        return $this->belongsTo(Provinsi::class, "id_provinsi");
    }
}
