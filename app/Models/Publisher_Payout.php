<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher_Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'ref_no',
        'status',
        'bank_name',
        'card_no',
        'upi_no',
        'amount',
        'user_id',
        'payament_mode',
        'payament_ss',
        'payaments_type',
        'remarks',
        'publisher_id',
        'created_at',
        'updated_at'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class,);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class,'publisher_id','id');
    }
    public function user_publisher_payout()
    {
        return $this->belongsTo(User::class,'');
    }

    
}
