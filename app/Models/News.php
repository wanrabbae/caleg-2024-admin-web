<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $tables = 'news';

    protected $primary_key = 'id_news';

    protected $guarded = [];

}
