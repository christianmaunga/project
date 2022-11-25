<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tableOfProducts extends Model
{
    use HasFactory;

    protected $table ='table_of_products';

    protected $fillable = [
        'id',
        'product_name',
        'manufacturer_name',
       
        
    ];
}
