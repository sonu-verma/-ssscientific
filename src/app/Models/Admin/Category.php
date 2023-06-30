<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'id_parent',
        'status'
    ];


    public function parentCategory(){
        return $this->belongsTo(Category::class,'id_parent','id');
    }
}
