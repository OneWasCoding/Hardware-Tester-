<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class items extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Searchable;
    public $primaryKey="item_id";
    public $table="items";
    public $fillable=['item_name','item_price','item_desc','item_status', 'created_at', 'updated_at' , 'deleted_at'];

    public function itemGallery()
{
    return $this->hasMany(ItemGallery::class, 'item_id');
}
public function scopeSearch($query, $term)
{
    return $query->where('item_name', 'like', '%' . $term . '%');
}

public function categories()
{
    return $this->belongsToMany(Category::class, 'item_category', 'item_id', 'category_id');
}
public function stocks()
{
    return $this->hasOne(stocks::class, 'item_id');
    
}
public function toSearchableArray()
{
    return [
        'item_name' => $this->item_name,
        'item_desc' => $this->item_desc,
    ];
}

}
