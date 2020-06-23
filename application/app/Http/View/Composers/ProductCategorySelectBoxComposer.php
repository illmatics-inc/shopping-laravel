<?php

namespace App\Http\View\Composers;

use App\Models\ProductCategory;
use Illuminate\View\View;

/**
 * Class ProductCategorySelectBoxComposer
 * @package App\Http\View\Composers
 */
class ProductCategorySelectBoxComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with([
            'productCategorySelectBox' => ProductCategory::orderBy('order_no', 'asc')->get()
        ]);
    }
}
