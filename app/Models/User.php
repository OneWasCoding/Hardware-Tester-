<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    public $table = "users";
    public $primaryKey = "user_id";
    public $fillable = ["account_id", "fname", "lname", "age", "gender", "img", "contact", "created_at", "updated_at", "address"];

    // Define the relationship to the Account model
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    // Override the method to get the email from the related account
    public function getEmailAttribute()
    {
        return $this->account->email;
    }

    // Override the method to fetch email for authentication
    public function getAuthIdentifierName()
    {
        return 'account.email';
    }

    // Override the method to fetch email for password reset
    public function getEmailForPasswordReset()
    {
        return $this->account->email;
    }

public function carts()
{
    return $this->hasMany(Cart::class, 'user_id'); // Linking to the 'cart' model
}
}