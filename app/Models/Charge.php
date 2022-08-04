<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $table ='charges';

    protected $fillable = [
        'poulailler_id',
        'poulailler_stock_id ',
        'charge_name',
        'price',
        'details',
        
    ];

}
