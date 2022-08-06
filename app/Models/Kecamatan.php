<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';

    protected $primaryKey = 'id_kecamatan';

    protected $guarded = [];

    public $timestamps = false;

    public function kabupaten(){
        return $this->belongsTo(Kabupaten::class);
    }

}
