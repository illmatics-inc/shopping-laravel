@extends('layouts.admin')

@section('content')
<div class="row pt-3">
    <div class="col-sm">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="product_category_id">商品カテゴリ</label>
                <select class="custom-select @error('product_category_id') is-invalid @enderror" id="product_category_id" name="product_category_id">
                    @foreach ($productCategorySelectBox as $productCategory)
                        <option value="{{ $productCategory->id }}" {{ old('product_category_id', $product->productCategory->id) == $productCategory->id ? 'selected' : null }}>{{ $productCategory->name }}</option>
                    @endforeach
                </select>
                @error('product_category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">名称</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="名称" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">価格</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" min="0" placeholder="価格">
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">説明</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="説明">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image_path">イメージ</label>
                <input type="file" class="form-control-file @error('image_path') is-invalid @enderror" id="image_path" name="image_path">
                @error('image_path')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            @if($product->image_path)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="delete_image" name="delete_image" value="1">
                    <label for="delete_image">削除</label>
                </div>
                <div>
                    <img class="img-thumbnail" src="{{ $product->getImage() }}">
                </div>
            @endif

            <hr class="mb-3">

            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">キャンセル</a>
                </li>
                <li class="list-inline-item">
                    <button type="submit" class="btn btn-primary">更新</button>
                </li>
            </ul>
        </form>
    </div>
</div>
@endsection
