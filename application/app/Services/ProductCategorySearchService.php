<?php

namespace App\Services;

use App\Http\Requests\Admin\ProductCategoryIndex;
use App\Models\ProductCategory;

/**
 * Class ProductCategorySearchService
 * @package App\Services
 */
class ProductCategorySearchService
{
    /**
     * @param  ProductCategoryIndex  $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function __invoke(ProductCategoryIndex $request)
    {
        $productCategories = ProductCategory::query();

        if (filled($request->name())) {
            $productCategories->fuzzySearch('name', $request->name());
        }

        return $productCategories->sort($request->sortColumn(), $request->sortDirection())
            ->paginate($request->pageUnit())
            ->appends($request->query());
    }
}
