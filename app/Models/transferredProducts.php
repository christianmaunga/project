<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transferredProducts extends Model
{
    use HasFactory;

    protected $table ='transferred_products';

    protected $fillable = [
        'id',
        'product_id',
        'stock_id',
        'stock_id',
        'destination',
        'comment',
        
    ];
    
}
