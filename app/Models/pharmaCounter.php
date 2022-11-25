<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pharmaCounter extends Model
{
    use HasFactory;

    protected $guard='pharma_counter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'stock_id',
        'pharma_id',
        'number',
        'product_id',
    ];
}
