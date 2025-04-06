<?php

// app/Models/Cart.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';

    protected $primaryKey = 'cart_id';
    protected $fillable = ['user_id', 'item_id', 'quantity'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function item()
    {
        return $this->belongsTo(items::class, 'item_id');
    }
}