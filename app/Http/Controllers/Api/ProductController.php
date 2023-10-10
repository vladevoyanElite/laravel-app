<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    public function __construct(public ProductService $productService)
    {
    }

    /**
     * @return ProductCollection
     */
    public function index(): ProductCollection
    {
        $data = $this->productService->getList();
        return new ProductCollection($data);
    }

    /**
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        $data = $product->load('feedbacks');
        return new ProductResource($data);
    }

    /**
     * @param CreateProductRequest $request
     * @return ProductResource
     */
    public function store(CreateProductRequest $request): ProductResource
    {
        $product = $this->productService->create($request->validated());
        return new ProductResource($product);
    }

    /**
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product): Response
    {
        $product->delete();
        return response()->noContent();
    }
}
