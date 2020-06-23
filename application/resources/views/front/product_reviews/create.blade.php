@extends('layouts.app')

@section('content')
<div class="row pt-3">
    <div class="col-sm">
        <form action="{{ route('front.products.product_reviews.store', $product->id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="タイトル" autofocus>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="body">本文</label>
                <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" value="{{ old('body') }}" placeholder="本文">
                @error('body')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            @foreach(range(1, 5) as $rank)
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="rank{{ $rank }}" name="rank" value="{{ $rank }}" {{ old('rank', 1) == $rank ? 'checked' : '' }}>
                    <label class="form-check-label" for="rank{{ $rank }}">星{{ $rank }}つ</label>
                </div>
            @endforeach

            <hr class="mb-3">

            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="{{ route('front.products.show', $product->id) }}" class="btn btn-secondary">商品へ戻る</a>
                </li>
                <li class="list-inline-item">
                    <button type="submit" class="btn btn-primary">レビュー</button>
                </li>
            </ul>
        </form>
    </div>
</div>
@endsection
