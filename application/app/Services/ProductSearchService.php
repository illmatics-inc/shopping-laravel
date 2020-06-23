<?php

namespace App\Services;

use App\Http\Requests\Admin\ProductIndex;
use App\Models\Product;

/**
 * Class ProductSearchService
 * @package App\Services
 */
class ProductSearchService
{
    /**
     * @param  ProductIndex  $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function __invoke(ProductIndex $request)
    {
        $products = Product::query();

        if (filled($request->productCategoryId())) {
            $products->whereProductCategoryId($request->productCategoryId());
        }

        if (filled($request->name())) {
            $products->fuzzySearch('name', $request->name());
        }

        if (filled($request->priceCompare()) && filled($request->price())) {
            $products->whereComparePrice($request->priceCompare(), $request->price());
        }

        return $products->sort($request->sortColumn(), $request->sortDirection())
            ->paginate($request->pageUnit())
            ->appends($request->query());
    }
}
