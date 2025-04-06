<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'account_id',
        'item_id',
        'quantity',
        'total_price',
        'order_date',
        'status'
    ];

}
