<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
    'order_number', 
    'customer_name', 
    'table_number', 
    'order_type',        // ← Make sure this is here
    'total_amount', 
    'status'
];


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
