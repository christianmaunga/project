<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retrait extends Model

{
    use HasFactory;

    protected $table ='retraits';

    protected $fillable = [
        'poulailler_id',
        'stock_poulailler_id ',
        'number',
        'details',
        
    ];
}
