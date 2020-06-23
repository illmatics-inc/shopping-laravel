<?php

namespace App\Services;

use App\Http\Requests\Admin\AdminUserIndex;
use App\Models\AdminUser;

/**
 * Class AdminUserSearchService
 * @package App\Services
 */
class AdminUserSearchService
{
    /**
     * @param  AdminUserIndex  $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function __invoke(AdminUserIndex $request)
    {
        $adminUsers = AdminUser::query();

        if (filled($request->name())) {
            $adminUsers->fuzzySearch('name', $request->name());
        }

        if (filled($request->email())) {
            $adminUsers->forwardMatch('email', $request->email());
        }

        if (filled($request->isOwner())) {
            $adminUsers->whereIsOwner($request->isOwner());
        }

        return $adminUsers->sort($request->sortColumn(), $request->sortDirection())
            ->paginate($request->pageUnit())
            ->appends($request->query());
    }
}
