@extends('layouts.app')

@section('content')
@auth
    <div class="row">
        <div class="col-md">
            <h3 class="border-bottom mb-3">ほしいものリスト</h3>
        </div>
    </div>
    <div class="row">
        @each('front.partials.product_box', auth()->user()->wishProducts, 'product')
    </div>
@endauth
@endsection
