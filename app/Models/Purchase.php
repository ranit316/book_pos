<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'to_store',
        'supplier_id',
        'requisition_no',
        'po_no',
        'po_date',
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
        return $this->hasMany(PurchaseDetails::class,'purchase_id','id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function to_store()
    {
        return $this->belongsTo(Store::class,'to_store');
    }
    public function store2()
    {
        return $this->belongsTo(Store::class,'to_store');
    }

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }
}
