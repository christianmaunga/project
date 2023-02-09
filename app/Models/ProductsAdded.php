<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsAdded extends Model
{
    use HasFactory;

    protected $table ='product_added';

    protected $fillable = [
        'product_id',
        'stock_id',
        'price',
        'nombre',
        'prixtotal',
        'dateExpiration',
        'type',
        'comment',
        'created_at	',
        'updated_at',
        
    ];
}

