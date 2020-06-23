<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductReviewStore;
use App\Http\Requests\ProductReviewUpdate;
use App\Models\Product;
use App\Models\ProductReview;

class ProductReviewController extends Controller
{
    /**
     * @param  Product  $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Product $product)
    {
        return view('front.product_reviews.create', compact('product'));
    }

    /**
     * @param  ProductReviewStore  $request
     * @param  Product  $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ProductReviewStore $request, Product $product)
    {
        ProductReview::create(array_merge(
            $request->validated(),
            [
                'user_id' => auth()->user()->id,
                'product_id' => $product->id,
            ]
        ));
        return redirect(route('front.products.show', $product->id));
    }

    /**
     * @param  Product  $product
     * @param  ProductReview  $productReview
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Product $product, ProductReview $productReview)
    {
        $this->authorize('update', $productReview);
        return view('front.product_reviews.edit', compact(
            'product',
            'productReview'
        ));
    }

    /**
     * @param  ProductReviewUpdate  $request
     * @param  Product  $product
     * @param  ProductReview  $productReview
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(ProductReviewUpdate $request, Product $product, ProductReview $productReview)
    {
        $this->authorize('update', $productReview);
        $productReview->update($request->validated());
        return redirect(route('front.products.show', $product->id));
    }
}
