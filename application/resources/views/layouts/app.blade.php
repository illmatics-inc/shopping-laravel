<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('front.home') }}">{{ config('app.name', 'Laravel') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0" action="{{ route('front.products.index') }}">
            <select class="custom-select mr-sm-2" name="product_category_id">
                <option value="" {{ is_null(request('product_category_id')) ? 'selected' : null }}>すべてのカテゴリー</option>
                @foreach($productCategorySelectBox as $productCategory)
                    <option value="{{ $productCategory->id }}" {{ request('product_category_id') == $productCategory->id ? 'selected' : null }}>{{ $productCategory->name }}</option>
                @endforeach
            </select>
            <input class="form-control mr-sm-2" type="search" name="keyword" value="{{ request('keyword') }}" placeholder="商品検索">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索</button>
        </form>
        <ul class="navbar-nav ml-auto">
            @guest
                <li class="nav-item">
                    <a href="{{ route('front.register') }}" class="nav-link">新規登録</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('front.login') }}" class="nav-link">ログイン</a>
                </li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('front.users.edit', auth()->user()->id) }}">ユーザー情報編集</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('front.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
                        <form id="logout-form" action="{{ route('front.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <main role="main" class="col-sm-12 px-4 py-2">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
