<?php

namespace App\Policies;

use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductReviewPolicy
{
    use HandlesAuthorization;

    /**
     * @param  User  $user
     * @param  ProductReview  $productReview
     * @return bool
     */
    public function update(User $user, ProductReview $productReview)
    {
        return $user->id === $productReview->user_id;
    }
}
