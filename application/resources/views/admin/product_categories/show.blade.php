@extends('layouts.admin')

@section('content')
<ul class="list-inline pt-3">
    <li class="list-inline-item">
        <a href="{{ route('admin.product_categories.index') }}" class="btn btn-light">一覧</a>
    </li>
    <li class="list-inline-item">
        <a href="{{ route('admin.product_categories.edit', $productCategory->id) }}" class="btn btn-success">編集</a>
    </li>
    @can('delete', $productCategory)
        <li class="list-inline-item">
            <form action="{{ route('admin.product_categories.destroy', $productCategory->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">削除</button>
            </form>
        </li>
    @endcan
</ul>

<table class="table">
    <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $productCategory->id }}</td>
        </tr>
        <tr>
            <th>名称</th>
            <td>{{ $productCategory->name }}</td>
        </tr>
        <tr>
            <th>並び順番号</th>
            <td>{{ $productCategory->order_no }}</td>
        </tr>
    </tbody>
</table>
@endsection
