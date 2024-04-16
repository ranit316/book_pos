<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
