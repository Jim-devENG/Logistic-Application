<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chinedu extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'status',
        'account',
        'logic',
        'password'
       
    ];
}
