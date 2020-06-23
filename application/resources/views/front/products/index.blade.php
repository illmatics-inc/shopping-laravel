@extends('layouts.app')

@section('content')
@if($products->isEmpty())
    <div class="row">
        <div class="col-md shadow-sm p-3 mb-5 bg-white rounded">
            {{ request('keyword') }}の検索に一致する商品はありませんでした。
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md border shadow-sm py-2 d-flex">
            <div>検索結果 {{ number_format($products->total()) }} のうち {{ $products->firstItem() }}-{{ $products->lastItem() }}件 @if($searchProductCategoryDisplay)<span class="font-weight-bold">{{ $searchProductCategoryDisplay }}</span>@endif @if(request('keyword')): <span class="text-danger">"{{ request('keyword') }}"</span>@endif</div>
            <form class="ml-auto" action="{{ route('front.products.index') }}">
                <input type="hidden" name="product_category_id" value="{{ request('product_category_id') }}">
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                <select class="custom-select" name="sort" onchange="event.preventDefault();$(this).parent('form').submit();">
                    <option value="review_rank-desc" {{ request('sort', 'review_rank') == 'review_rank-desc' ? 'selected' : null }}>並び替え: レビューの評価順</option>
                    <option value="price-asc" {{ request('sort', 'review_rank') == 'price-asc' ? 'selected' : null }}>並び替え: 価格の安い順</option>
                    <option value="price-desc" {{ request('sort', 'review_rank') == 'price-desc' ? 'selected' : null }}>並び替え: 価格の高い順</option>
                    <option value="updated_at-desc" {{ request('sort', 'review_rank') == 'updated_at-desc' ? 'selected' : null }}>並び替え: 最新商品</option>
                </select>
            </form>
        </div>
    </div>
    <div class="row pt-2">
        @each('front.partials.product_box', $products, 'product')
    </div>
    <div class="row">
        <div class="col-md">
            {{ $products->links() }}
        </div>
    </div>
@endif
@endsection
