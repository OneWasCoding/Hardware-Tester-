<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_lines extends Model
{
    protected $table = 'order_lines'; // Name of the table in the database
    protected $primaryKey = 'order_line_id'; // Primary key for the order_lines table
    public $timestamps = true; // Enable created_at and updated_at fields
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];
}
