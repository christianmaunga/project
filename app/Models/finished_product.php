<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class finished_product extends Model
{
    use HasFactory;

    protected $table='_finshed_product_status';
    protected $fillable = [
        'stock_id',
        'product_id',
        'status',
        
    ];
}
