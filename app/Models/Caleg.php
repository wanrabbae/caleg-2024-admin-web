<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\Node\FunctionNode;

class Caleg extends Model
{
    use HasFactory;

    protected $table = 'caleg';
    public $timestamps = false;
    protected $primaryKey = 'id_caleg';

    protected $guarded = [];

    public function legislatif()
    {
        return $this->belongsTo(Legislatif::class, 'id_legislatif');
    }

    public function partai()
    {
        return $this->belongsTo(Partai::class, 'id_partai');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'id_caleg');
    }

    public function relawan()
    {
        return $this->hasMany(Relawan::class);
    }

    public function survey(){
        return $this->hasMany(Survey::class);
    }
}
