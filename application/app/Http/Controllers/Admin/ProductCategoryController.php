<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCategoryIndex;
use App\Http\Requests\Admin\ProductCategoryStore;
use App\Http\Requests\Admin\ProductCategoryUpdate;
use App\Models\ProductCategory;
use App\Services\ProductCategorySearchService;

class ProductCategoryController extends Controller
{
    /**
     * @param  ProductCategoryIndex  $request
     * @param  ProductCategorySearchService  $productCategorySearchService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ProductCategoryIndex $request, ProductCategorySearchService $productCategorySearchService)
    {
        return view('admin.product_categories.index', [
            'productCategories' => $productCategorySearchService($request),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.product_categories.create');
    }

    /**
     * @param  ProductCategoryStore  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ProductCategoryStore $request)
    {
        $productCategory = ProductCategory::create($request->validated());
        return redirect(route('admin.product_categories.show', $productCategory->id));
    }

    /**
     * @param  ProductCategory  $productCategory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View\
     */
    public function show(ProductCategory $productCategory)
    {
        return view('admin.product_categories.show', compact('productCategory'));
    }

    /**
     * @param  ProductCategory  $productCategory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product_categories.edit', compact('productCategory'));
    }

    /**
     * @param  ProductCategoryUpdate  $request
     * @param  ProductCategory  $productCategory
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ProductCategoryUpdate $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->validated());
        return redirect(route('admin.product_categories.show', $productCategory->id));
    }

    /**
     * @param  ProductCategory  $productCategory
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy(ProductCategory $productCategory)
    {
        $this->authorize('delete', $productCategory);
        $productCategory->delete();
        return redirect(route('admin.product_categories.index'));
    }
}
