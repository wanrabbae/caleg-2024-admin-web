<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $tables = 'news';
    protected $primaryKey = 'id_news';
    protected $guarded = [];
    public $timestamps = false;

    public function scopeSearch($query, $search) {
        return $query->where("judul", "LIKE", "%$search%")
        ->orWhere("isi_berita", "LIKE", "%$search%")
        ->orWhere("tgl_publish", "LIKE", "%$search%")
        ->orWhereHas("caleg", function($caleg) use ($search) {
            $caleg->where("nama_caleg", "LIKE", "%$search%");
        })
        ->orWhere("aktif", $search);
    }

    public function caleg(){
        return $this->belongsTo(Caleg::class, "id_caleg");
    }

}
