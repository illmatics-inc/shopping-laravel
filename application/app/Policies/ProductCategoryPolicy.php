<?php

namespace App\Policies;

use App\Models\AdminUser;
use App\Models\ProductCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * @param  AdminUser  $user
     * @param  ProductCategory  $productCategory
     * @return bool
     */
    public function delete(AdminUser $user, ProductCategory $productCategory)
    {
        return $productCategory->products()->doesntExist();
    }
}
