<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'storage_site_id',
        'storage_location_id',
        'rack_id',
        'store_id',
        'sale_price',
        'price',
        'lot_number',
    ];
}
