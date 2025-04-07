<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemGallery extends Model
{
    use HasFactory;
    public $primaryKey="item_id";
    public $table="item_gallery";
    public $fillable=["item_id", "img_name", "created_at", "updated_at"];


}
