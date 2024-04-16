<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerWishlist;
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'supplier_id',
        'title',
        'author',
        'isbn',
        'price',
        'publication_date',
        'language',
        'weight',
        'dimensions',
        'image',
        'pages',
        'description',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
        'gst_slab_id',
        'volume',
        'binding_type',
        'edition',
        'series',
        'issue',
        'unit_id'
    ];

    // public function product()
    // {
    //     return $this->hasOne(CustomerWishlist::class);
    // }


    public function gst(){
        return $this->belongsTo(GstSlab::class,'gst_slab_id');
    }

    // public function publisher(){
    //     return $this->belongsTo(User::class,'supplier_id','id');
    // }
    
    public function bookpublisher(){
        return $this->belongsTo(User::class,'supplier_id','id');
    }

    public function master_stock_inventory(){
        return $this->hasMany(MasterStockInventery::class,'product_id','id');
    }
    public function bookauthor(){
        return $this->belongsTo(Author::class,'author','id');
    }
    public function bookcategory(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function publisher(){
        return $this->belongsTo(User::class,'supplier_id','id');
    }

    public function sale()
    {
        return $this->hasone(Sale::class,'publisher_id','id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class,'unit_id','id');
    }

}
