<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'brand',
        'model',
        'price',
        'toyyibpay_bill_code',
        'api_token',
    ];
}
