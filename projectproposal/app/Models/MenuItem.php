<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'image', 
        'category_id', 
        'available'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}