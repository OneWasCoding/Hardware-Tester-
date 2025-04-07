<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    public $table="category";
    public $primaryKey="category_id";
    public $fillable=['category_name','created_at', 'updated_at' ];
    public $timestamps=true;
}
