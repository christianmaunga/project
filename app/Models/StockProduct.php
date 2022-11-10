<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockProduct extends Model
{
    use HasFactory;

    protected $table ='product_stocks';

    protected $fillable = [
        'StockID',
        'nom',
        'fabricant',
        'prix',
        'nombre',
        'remaing',
        'prixtotal',
        'dateExpiration',
        'comment',
        'created_at	',
        'updated_at',
        
    ];
}

