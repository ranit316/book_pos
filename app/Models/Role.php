<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable=[
        'type',
        'name',
        'created_at',
        'updated_at'
    ];

    public function permission(){
        return $this->hasMany(Permission::class,'role_id','id');
    }

    public function checkPermission($route_name)
    {
        $check =   Permission::where('role_id', $this->id)->where('name', $route_name)->first();
        if ($check) {
            return "checked";
        }
    }
}
