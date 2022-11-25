<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soldProduct extends Model
{
    use HasFactory;

    protected $table ='sold_products';

    protected $fillable = [
        'pharma_id',
        'product_id ',
        'number',
        'price',
        'totalprice',
        'status',
        'comment',
        
    ];
}
