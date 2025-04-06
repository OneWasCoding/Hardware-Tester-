<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stocks extends Model
{
    use HasFactory;
    public $timestamps=false;
    public $table="stocks";
    public $primaryKey="item_id";
    public $fillable=['item_id','quantity'];
}
