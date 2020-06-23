<div class="col-md-4">
    <div class="card mb-4">
        <a href="{{ route('front.products.show', $product->id) }}" target="_blank">
            <img class="card-img-top bd-placeholder-img" src="{{ $product->getImage() }}">
        </a>
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">¥{{ number_format($product->price) }}</p>
            @auth
                @include('front.partials.product_wish', compact('product'))
            @endauth
        </div>
    </div>
</div>
