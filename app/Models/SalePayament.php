<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePayament extends Model
{
    use HasFactory;
    protected $fillable=[
        'ref_no',
        'sale_id',
        'payment_status',
        'bank_name',
        'card_no',
        'upi_no',
        'amount',
        'created_at',
        'updated_at',
        'trancaction_no',
        'payament_mode',
        'payaments_type',
        'status',
        'user_id',

    ];
    public function customername(){
       return $this->belongsTo(Sale::class,'sale_id');
    }
}
