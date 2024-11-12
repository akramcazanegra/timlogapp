<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // protected $guarded = [];


    protected $fillable = [
        'product_name', 
        'category_id', 
        'supplier_id', 
        'customer_id', // Add this line
        'product_garage', 
        'product_store', 
        'buying_date', 
        'expire_date', 
        'buying_price', 
        'selling_price', 
        'product_image',
    ];


    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

  
}
