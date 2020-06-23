<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductIndex;
use App\Http\Requests\Admin\ProductStore;
use App\Http\Requests\Admin\ProductUpdate;
use App\Models\Product;
use App\Services\ProductSearchService;

class ProductController extends Controller
{
    /**
     * @param  ProductIndex  $request
     * @param  ProductSearchService  $productSearchService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ProductIndex $request, ProductSearchService $productSearchService)
    {
        return view('admin.products.index', [
            'products' => $productSearchService($request),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * @param  ProductStore  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ProductStore $request)
    {
        $product = Product::create($request->validated());
        return redirect(route('admin.products.show', $product->id));
    }

    /**
     * @param  Product  $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * @param  Product  $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * @param  ProductUpdate  $request
     * @param  Product  $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ProductUpdate $request, Product $product)
    {
        $parameters = $request->validated();
        if ($request->filled('delete_image')) {
            $parameters = array_merge($parameters, [
                'image_path' => null,
            ]);
        }
        $product->update($parameters);
        return redirect(route('admin.products.show', $product->id));
    }

    /**
     * @param  Product  $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('admin.products.index'));
    }
}
