<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stocks extends Model
{
    use HasFactory;
    public $timestamps=false;
    public $fillable=['item_id','quantity'];
}
