@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-5">
        @if($product->image_path)
            <img class="img-thumbnail" src="{{ $product->getImage() }}">
        @endif
    </div>
    <div class="col-md-7">
        <div class="row">
            <h2 class="col-md">{{ $product->name }}</h2>
        </div>
        <hr>
        <div class="row">
            <div class="col-md">
                <span class="mr-3">価格:</span>
                <soan class="h5 text-danger">¥{{ number_format($product->price) }}</soan>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-md">
                {!! nl2br($product->description) !!}
            </div>
        </div>
        <hr>
        @auth
            <div class="row">
                <div class="col-md">
                    @include('front.partials.product_wish', compact('product'))
                </div>
            </div>
        @endauth
    </div>
</div>
@auth
    <div class="row mt-3">
        <div class="col-md">
            <a class="btn btn-primary" href="{{ route('front.products.product_reviews.create', $product->id) }}">レビューを書く</a>
        </div>
    </div>
@endauth
<div class="row mt-3">
    <div class="col-md">
        <ul class="list-unstyled">
            @foreach($product->productReviews->sortByDesc('created_at') as $productReview)
                <li class="media bg-white p-2 mb-3">
                    @if($productReview->user->getImage())
                        <img src="{{ $productReview->user->getImage() }}" width="30" height="30" class="mr-3" alt="...">
                    @endif
                    <div class="media-body">
                        <h6>{{ $productReview->user->name }}</h6>
                        <h5>
                            @if(optional(auth()->user())->can('update', $productReview))
                                <a href="{{ route('front.products.product_reviews.edit', [$product->id, $productReview->id]) }}">
                                    {{ $productReview->title }}
                                </a>
                            @else
                                {{ $productReview->title }}
                            @endif
                        </h5>
                        <div class="review_star">
                            @foreach(range(1, 5) as $rank)
                                <i class="fa-star {{ $rank <= $productReview->rank ? 'fas' : 'far' }}"></i>
                            @endforeach
                        </div>
                        {{ $productReview->body }}
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
