<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInStockCounter extends Model
{
    use HasFactory;

    protected $table='product_in_stock_counter';
    protected $fillable = [
        'product_id',
        'stock_id',
        'totalInStock',
        'selling_price',
    ];
}
