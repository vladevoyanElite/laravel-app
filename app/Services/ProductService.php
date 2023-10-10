<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ProductService
{
    /**
     * @return Collection
     */
    public function getList(): Collection
    {
        return Product::query()->orderBy('quantity', 'DESC')->get();
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return Product::query()->create($attributes);
    }
}
