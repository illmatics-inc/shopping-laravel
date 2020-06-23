<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUserIndex;
use App\Http\Requests\Admin\AdminUserStore;
use App\Http\Requests\Admin\AdminUserUpdate;
use App\Models\AdminUser;
use App\Services\AdminUserSearchService;

class AdminUserController extends Controller
{
    /**
     * AdminUserController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(AdminUser::class);
    }

    /**
     * @param  AdminUserIndex  $request
     * @param  AdminUserSearchService  $adminUserSearchService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(AdminUserIndex $request, AdminUserSearchService $adminUserSearchService)
    {
        return view('admin.admin_users.index', [
            'adminUsers' => $adminUserSearchService($request),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.admin_users.create');
    }

    /**
     * @param  AdminUserStore  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AdminUserStore $request)
    {
        $adminUser = AdminUser::create($request->validated());
        return redirect(route('admin.admin_users.show', $adminUser->id));
    }

    /**
     * @param  AdminUser  $adminUser
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(AdminUser $adminUser)
    {
        return view('admin.admin_users.show', compact('adminUser'));
    }

    /**
     * @param  AdminUser  $adminUser
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(AdminUser $adminUser)
    {
        return view('admin.admin_users.edit', compact('adminUser'));
    }

    /**
     * @param  AdminUserUpdate  $request
     * @param  AdminUser  $adminUser
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(AdminUserUpdate $request, AdminUser $adminUser)
    {
        $adminUser->update($request->validated());
        return redirect(route('admin.admin_users.show', $adminUser->id));
    }

    /**
     * @param  AdminUser  $adminUser
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(AdminUser $adminUser)
    {
        $adminUser->delete();
        return redirect(route('admin.admin_users.index'));
    }
}
