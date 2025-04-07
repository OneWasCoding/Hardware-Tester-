<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    public $primaryKey="item_id";
    public $table="item_category";

    public $fillable=["item_id", "category_id"];
}
