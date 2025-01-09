<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'number',
        'price'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function name()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
