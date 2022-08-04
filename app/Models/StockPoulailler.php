<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockPoulailler extends Model
{
    
    protected $fillable = [
        'number_of_chicken',
        'poulailler_id_fk ',
        ' prix_unitaire',
        'poules_restantes',
        'morts',
        'created_at',
    ];
}
