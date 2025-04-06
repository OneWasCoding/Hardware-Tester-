<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = 'orders'; // Name of the table in the database
    protected $primaryKey = 'order_id'; // Primary key for the order table
    public $timestamps = true; // Enable created_at and updated_at fields
    protected $fillable = ['account_id', 'total_amount', 'order_status'];

}
