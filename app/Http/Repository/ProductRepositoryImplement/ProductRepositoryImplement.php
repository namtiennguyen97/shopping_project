<?php


namespace App\Http\Repository\ProductRepositoryImplement;


use App\Http\Repository\EloquentImplement\EloquentImplement;
use App\Http\Repository\ProductRepository;
use App\Models\Product;

class ProductRepositoryImplement extends EloquentImplement implements ProductRepository
{

    public function getModel()
    {
        $product = Product::class;
        return $product;
    }
}
