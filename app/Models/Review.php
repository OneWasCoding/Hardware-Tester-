<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews'; // Name of the table in the database
    protected $primaryKey = 'review_id'; // Primary key for the order table
    public $timestamps = true; // Enable created_at and updated_at fields
    protected $fillable = ['id', 'user_id','item_id', 'rating', 'create_at','updated_at'];}
