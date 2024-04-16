<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'position', 'store_id', 'storage_site_id', 'storage_location_id', 'description', 'status', 'created_by', 'updated_by', 'deleted_by','flag'];
    public function storage_location()
    {
        return $this->belongsTo(StorageLocation::class,'storage_location_id','id');
    }
    public function storage_site()
    {
        return $this->belongsTo(StorageSite::class,'storage_site_id','id');
    }
}
