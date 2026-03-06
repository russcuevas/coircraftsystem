<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'product_id',
        'user_id',
        'quantity',
        'price',
        'payment_method',
        'payment_proof',
        'payment_status',
        'delivery_method',
        'status',
        'created_at',
        'updated_at',
    ];
}
