<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grn extends Model
{
    use HasFactory;
    protected $fillable=[
        'store_id',
        'to_store',
        'supplier_id',
        'po_no',
        'dispatch_no',
        'grn_no',
        'grn_date',
        'recieved_date',
        'expected_delivery_date',
        'transport_details',
        'transport_charge',
        'cgst',
        'sgst',
        'igst',
        'tax_amount',
        'taxeble_amount',
        'round_off_amount',
        'total_amount',
        'paid_amount',
        'description',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'dispatch_by',
        'received_by',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function details()
    {
        return $this->hasMany(PurchaseDetails::class);
    }

    public function grn_details()
    {
        return $this->hasMany(GrnDetail::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function to_store()
    {
        return $this->belongsTo(Store::class,'to_store','id');
    }
    public function store2()
    {
        return $this->belongsTo(Store::class,'to_store','id');
    }

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }
}
