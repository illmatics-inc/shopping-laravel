<?php

namespace App\Services;

use App\Http\Requests\Admin\UserIndex;
use App\Models\User;

/**
 * Class UserSearchService
 * @package App\Services
 */
class UserSearchService
{
    /**
     * @param  UserIndex  $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function __invoke(UserIndex $request)
    {
        $users = User::query();

        if (filled($request->name())) {
            $users->fuzzySearch('name', $request->name());
        }

        if (filled($request->email())) {
            $users->forwardMatch('email', $request->email());
        }

        return $users->sort($request->sortColumn(), $request->sortDirection())
            ->paginate($request->pageUnit())
            ->appends($request->query());
    }
}
