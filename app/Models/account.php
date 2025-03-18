<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class account extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='accounts';
    public $timestamps = false;
    protected $fillable=['username','password'];

}
