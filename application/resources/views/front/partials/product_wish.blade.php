<a class="toggle_wish" data-product-id="{{ $product->id }}" data-wished="{{ auth()->user()->can('createWishProduct', $product) ? 'false' : 'true' }}">
    <i class="{{ auth()->user()->can('createWishProduct', $product) ? 'far' : 'fas' }} fa-heart"></i>
</a>
