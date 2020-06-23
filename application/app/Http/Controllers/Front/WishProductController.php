<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class WishProductController extends Controller
{
    /**
     * @param  Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Product $product)
    {
        $this->authorize('createWishProduct', $product);

        auth()->user()->wishProducts()->attach($product);

        return response()->json(null);
    }

    /**
     * @param  Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $this->authorize('deleteWishProduct', $product);

        auth()->user()->wishProducts()->detach($product);

        return response()->json(null);
    }
}
