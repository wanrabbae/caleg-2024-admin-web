<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCallback extends Model
{
    use HasFactory;

    protected $table = "callback";

    protected $primaryKey = "id";

    public $timestamps = false;

    protected $guarded = [""];
}
