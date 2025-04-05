<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class items extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $primaryKey="item_id";
    public $table="items";
    public $fillable=['item_name','item_price','item_desc','item_status'];
    
}
