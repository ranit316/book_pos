<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'exchange_id',
        'product_id',
        'price',
        'batch_no',
        'lot_number',
        'qty',
        'tax_percentage',
        'tax_amount',
        'taxeble_amount',
        'total_amount',
    ];
}
