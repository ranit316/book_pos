<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Publisher;
class CustomerWishlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'customer_id',
        'publisher_id',
        'status',
        'store_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class,'publisher_id','id');
    }
}
