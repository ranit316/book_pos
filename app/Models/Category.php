<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'icon', 'code', 'shortname', 'description', 'status', 'created_by', 'updated_by', 'deleted_by'];
}
