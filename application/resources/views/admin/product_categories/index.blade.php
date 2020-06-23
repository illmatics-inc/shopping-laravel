@extends('layouts.admin')

@section('content')
<form class="shadow p-3 mt-3" action="{{ route('admin.product_categories.index') }}">
    <div class="row">
        <div class="col-md mb-3">
            <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}" placeholder="名称">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <select class="custom-select" name="sort_column">
                <option value="id" {{ request('sort_column', 'id') == 'id' ? 'selected' : null }}>並び替え: ID</option>
                <option value="name" {{ request('sort_column', 'id') == 'name' ? 'selected' : null }}>並び替え: 名称</option>
                <option value="order_no" {{ request('sort_column', 'id') == 'order_no' ? 'selected' : null }}>並び替え: 並び順番号</option>
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
        <a href="{{ route('admin.product_categories.create') }}" class="btn btn-success">新規</a>
    </li>
</ul>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>並び順番号</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productCategories as $productCategory)
                <tr>
                    <td>{{ $productCategory->id }}</td>
                    <td><a href="{{ route('admin.product_categories.show', $productCategory->id) }}">{{ $productCategory->name }}</a></td>
                    <td>{{ $productCategory->order_no }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $productCategories->links() }}
</div>
@endsection
