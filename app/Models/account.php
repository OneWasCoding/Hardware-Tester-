<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'accounts';
    public $primaryKey = 'account_id';
    public $timestamps = false;
    public $fillable = ['username', 'email', 'password'];

    // Define the relationship to the User model
    public function user()
    {
        return $this->hasOne(User::class, 'account_id');
    }
}