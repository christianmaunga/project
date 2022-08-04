<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table ='table_of_products';

    protected $fillable = [
      
        'product_name',
        'manufacturer_name',
         
    ];
}

