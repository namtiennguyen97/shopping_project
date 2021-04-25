<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $table = 'production';
    public $fillable = [
        'name',
        'desc',
        'price',
        'vendor',
        'image',
        'category_id',
        'previewImage1',
        'previewImage2'
    ];
    public function productCategory(){
        return $this->belongsTo(Categories::class,'category_id','id','categories');
    }
}
