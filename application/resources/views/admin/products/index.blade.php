@extends('layouts.admin')

@section('content')
<form class="shadow p-3 mt-3" action="{{ route('admin.products.index') }}">
    <div class="row">
        <div class="col-md-4 mb-3">
            <select class="custom-select" id="product_category_id" name="product_category_id">
                <option value="" {{ request('product_category_id') == '' ? 'selected' : null }}>すべてのカテゴリー</option>
                @foreach ($productCategorySelectBox as $productCategory)
                    <option value="{{ $productCategory->id }}" {{ request('product_category_id') == $productCategory->id ? 'selected' : null }}>{{ $productCategory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-8 mb-3">
            <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}" placeholder="名称">
        </div>
    </div>
    <div class="row">
        <div class="col-md mb-3">
            <div class="input-group">
                <input type="number" class="form-control" id="price" name="price" value="{{ request('price') }}" min="0" placeholder="価格">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="price_compare" id="price-compare-gteq" value="{{ App\Models\Product::COMPARE_GTEQ }}" {{ request('price_compare', 'gteq') == App\Models\Product::COMPARE_GTEQ ? 'checked' : null }}>
                            <label class="form-check-label" for="price-compare-gteq">以上</label>
                        </div>
                        <div class="form-check form-check-inline mr-0">
                            <input class="form-check-input" type="radio" name="price_compare" id="price-compare-lteq" value="{{ App\Models\Product::COMPARE_LTEQ }}" {{ request('price_compare', 'gteq') == App\Models\Product::COMPARE_LTEQ ? 'checked' : null }}>
                            <label class="form-check-label" for="price-compare-lteq">以下</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <select class="custom-select" name="sort_column">
                <option value="id" {{ request('sort_column', 'id') == 'id' ? 'selected' : null }}>並び替え: ID</option>
                <option value="product_category" {{ request('sort_column', 'id') == 'product_category' ? 'selected' : null }}>並び替え: 商品カテゴリ</option>
                <option value="name" {{ request('sort_column', 'id') == 'name' ? 'selected' : null }}>並び替え: 名称</option>
                <option value="price" {{ request('sort_column', 'id') == 'price' ? 'selected' : null }}>並び替え: 価格</option>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <select class="custom-select" name="sort_direction">
                <option value="asc" {{ request('sort_direction', 'asc') == 'asc' ? 'selected' : null }}>並び替え方向: 昇順</option>
                <option value="desc" {{ request('sort_direction', 'asc') == 'desc' ? 'selected' : null }}>並び替え方向: 降順</option>
            </select>
        </div>
        <div class="col-md-2 mb-3">
            <select class="custom-select" name="page_unit">
                <option value="10" {{ request('page_unit', 10) == 10 ? 'selected' : null }}>表示: 10件</option>
                <option value="20" {{ request('page_unit', 10) == 20 ? 'selected' : null }}>表示: 20件</option>
                <option value="50" {{ request('page_unit', 10) == 50 ? 'selected' : null }}>表示: 50件</option>
                <option value="100" {{ request('page_unit', 10) == 100 ? 'selected' : null }}>表示: 100件</option>
            </select>
        </div>
        <div class="col-sm mb-3">
            <button type="submit" class="btn btn-block btn-primary">検索</button>
        </div>
    </div>
</form>
<ul class="list-inline pt-3">
    <li class="list-inline-item">
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">新規</a>
    </li>
</ul>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品カテゴリ</th>
                <th>名称</th>
                <th>価格</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->productCategory->name }}</td>
                    <td><a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a></td>
                    <td>¥{{ number_format($product->price) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</div>
@endsection
