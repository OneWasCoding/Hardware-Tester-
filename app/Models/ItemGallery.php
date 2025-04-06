<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemGallery extends Model
{
    public $primaryKey="item_id";
    public $table="item_gallery";
    public $fillable="img_name";


}
