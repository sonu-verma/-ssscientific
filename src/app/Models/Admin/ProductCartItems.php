<?php

namespace App\Models\Admin;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCartItems extends BaseModel
{
    use HasFactory;

    const CURRENCY = [
        'INR'  => '₹',
        'USD'  => '$',
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function quote(){
        return $this->belongsTo(Quote::class,'quote_id','id')->with('user');
    }
}
