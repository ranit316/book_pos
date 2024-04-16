<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Author extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable =[
        'name',
        'description',
        'deleted_at',
        'created_at',
        'updated_at',
        'status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
