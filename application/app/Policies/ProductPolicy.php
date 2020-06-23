<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * @param  User  $user
     * @param  Product  $product
     * @return mixed
     */
    public function createWishProduct(User $user, Product $product)
    {
        return $product->wishedUsers()->whereUserId($user->id)->doesntExist();
    }

    /**
     * @param  User  $user
     * @param  Product  $product
     * @return mixed
     */
    public function deleteWishProduct(User $user, Product $product)
    {
        return $product->wishedUsers()->whereUserId($user->id)->exists();
    }
}
