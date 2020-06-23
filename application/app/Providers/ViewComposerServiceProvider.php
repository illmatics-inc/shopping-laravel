<?php

namespace App\Providers;

use App\Http\View\Composers\ProductCategorySelectBoxComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer([
            'layouts.app',
            'admin.products.index',
            'admin.products.create',
            'admin.products.edit',
        ], ProductCategorySelectBoxComposer::class);
    }
}
