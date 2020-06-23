@extends('layouts.admin')

@section('content')
<form class="shadow p-3 mt-3" action="{{ route('admin.admin_users.index') }}">
    <div class="row">
        <div class="col-md-6 mb-3">
            <input type="text" class="form-control" id="name" name="name" value="{{ request('name') }}" placeholder="名称">
        </div>
        <div class="col-md mb-3">
            <input type="text" class="form-control" id="email" name="email" value="{{ request('email') }}" placeholder="メールアドレス">
        </div>
    </div>

    <div class="row">
        <div class="col-md mb-3">
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="authority-all" name="authority" value="all" {{ request('authority', 'all') === 'all' ? 'checked' : '' }}>
                <label class="form-check-label" for="authority-all">すべての権限</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="authority-owner" name="authority" value="owner" {{ request('authority', 'all') === 'owner' ? 'checked' : '' }}>
                <label class="form-check-label" for="authority-owner">オーナー</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id="authority-general" name="authority" value="general" {{ request('authority', 'all') === 'general' ? 'checked' : '' }}>
                <label class="form-check-label" for="authority-general">一般</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <select class="custom-select" name="sort_column">
                <option value="id" {{ request('sort_column', 'id') == 'id' ? 'selected' : null }}>並び替え: ID</option>
                <option value="name" {{ request('sort_column', 'id') == 'name' ? 'selected' : null }}>並び替え: 名称</option>
                <option value="email" {{ request('sort_column', 'id') == 'email' ? 'selected' : null }}>並び替え: メールアドレス</option>
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
        <a href="{{ route('admin.admin_users.create') }}" class="btn btn-success">新規</a>
    </li>
</ul>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>メールアドレス</th>
                <th>権限</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adminUsers as $adminUser)
                <tr>
                    <td>{{ $adminUser->id }}</td>
                    <td><a href="{{ route('admin.admin_users.show', $adminUser->id) }}">{{ $adminUser->name }}</a></td>
                    <td>{{ $adminUser->email }}</td>
                    <td>{{ $adminUser->is_owner ? 'オーナー' : '一般' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $adminUsers->links() }}
</div>
@endsection
