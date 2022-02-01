<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'pick',
        'drop',
        'distance',
        'weight',
        'carrier',
        'tracking_id',
        'total',
        'status'
       
    ];
}