<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table="users";

    protected $fillable=["fname","lname","age","gender","img","contact","created_at","updated_at"];
    
}
