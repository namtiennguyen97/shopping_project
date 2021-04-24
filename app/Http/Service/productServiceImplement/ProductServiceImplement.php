<?php


namespace App\Http\Service\productServiceImplement;


use App\Http\Repository\ProductRepositoryImplement\ProductRepositoryImplement;
use App\Http\Service\ProductService;

class ProductServiceImplement implements ProductService
{

    protected $productRepository;
    public function __construct(ProductRepositoryImplement $productRepositoryImplement)
    {
        $this->productRepository = $productRepositoryImplement;

    }

    public function index()
    {
        return $this->productRepository->index();
    }

    public function create($request)
    {
        return $this->productRepository->create($request);
    }

    public function update($id, $request)
    {
        // TODO: Implement update() method.
    }

    public function findOrFail($id)
    {
        // TODO: Implement findOrFail() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
