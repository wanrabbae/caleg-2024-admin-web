<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $tables = 'news';

    public $timestamps = false;

    protected $primaryKey = 'id_news';

    protected $guarded = [];

    public function caleg(){
        return $this->belongsTo(Caleg::class);
    }

}
