<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductIndex;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Services\HeaderProductSearchService;

class ProductController extends Controller
{
    const PER_PAGE = 15;

    /**
     * @param  ProductIndex  $request
     * @param  HeaderProductSearchService  $headerProductSearchService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(ProductIndex $request, HeaderProductSearchService $headerProductSearchService)
    {
        if (is_null($request->productCategoryId()) && is_null($request->keyword)) {
            return redirect(route('front.home'));
        }

        $products = $headerProductSearchService($request);

        $searchProductCategoryDisplay = optional(ProductCategory::find($request->productCategoryId()))->name;

        return view('front.products.index', compact(
            'products',
            'searchProductCategoryDisplay'
        ));
    }

    /**
     * @param  Product  $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('front.products.show', compact('product'));
    }
}
