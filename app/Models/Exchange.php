<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'storage_site_id',
        'store_id',
        'exchange_by',
        'publisher_id',
        'invoice_number',
        'exchange_mode',
        'description',
        'type',
        'exchange_date',
        'total_percentage',
        'total_tax',
        'shipping_charges',
        'discount_type',
        'discount_percentage',
        'discount',
        'round_off',
        'sub_total',
        'total',
        'transaction_no',
        'status',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function storage()
    {
        return $this->belongsTo(StorageSite::class,'storage_site_id','id');
    }

    public function exchange()
    {
        return $this->belongsTo(User::class,'exchange_by','id');
    }

    public function publisher()
    {
        return $this->belongsTo(User::class,'publisher_id','id');
    }

    public function exchange_change()
    {
        return $this->hasMany(ExchangeDetails::class,'exchange_id','id');
    }

}
