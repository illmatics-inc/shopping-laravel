<?php

namespace App\Providers;

use App\Models\AdminUser;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductReview;
use App\Policies\AdminUserPolicy;
use App\Policies\ProductCategoryPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ProductReviewPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        AdminUser::class => AdminUserPolicy::class,
        ProductReview::class => ProductReviewPolicy::class,
        ProductCategory::class => ProductCategoryPolicy::class,
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
