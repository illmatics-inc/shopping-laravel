@extends('layouts.admin')

@section('content')
<ul class="list-inline pt-3">
    <li class="list-inline-item">
        <a href="{{ route('admin.users.index') }}" class="btn btn-light">一覧</a>
    </li>
    <li class="list-inline-item">
        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-success">編集</a>
    </li>
    <li class="list-inline-item">
        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
    </li>
</ul>

<table class="table">
    <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>名称</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>イメージ</th>
            <td>
                @if($user->image_path)
                    <img class="img-thumbnail" src="{{ $user->getImage() }}">
                @endif
            </td>
        </tr>
    </tbody>
</table>
@endsection
