<?php

namespace App\Services;

use App\Http\Requests\ProductIndex;
use App\Models\Product;

/**
 * Class HeaderProductSearchService
 * @package App\Services
 */
class HeaderProductSearchService
{
    const PER_PAGE = 15;

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

        if (filled($request->keyword())) {
            $products->fuzzySearch('name', $request->keyword());
        }

        return $products->sort(...explode('-', $request->sort()))
            ->paginate(self::PER_PAGE)
            ->appends($request->query());
    }
}
