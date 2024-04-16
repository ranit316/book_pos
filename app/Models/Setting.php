<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable=[ 
    'key',
    'value',
    'store_id',
    'status',
    'created_at',
    'updated_at'];

    public function store()
    {
        return $this->belongsTo(Store::class,);
    }
}
