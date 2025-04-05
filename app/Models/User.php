<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    public $table = "users";
    public $primaryKey = "user_id";
    public $fillable = ["account_id", "fname", "lname", "age", "gender", "img", "contact", "created_at", "updated_at"];

    // Define the relationship to the Account model
    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    // Override the method to fetch email from the accounts table
    public function getEmailForPasswordReset()
    {
        return $this->account->email;
    }
}