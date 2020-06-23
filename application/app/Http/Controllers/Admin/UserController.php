<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserIndex;
use App\Http\Requests\Admin\UserStore;
use App\Http\Requests\Admin\UserUpdate;
use App\Models\User;
use App\Services\UserSearchService;

class UserController extends Controller
{
    /**
     * @param  UserIndex  $request
     * @param  UserSearchService  $userSearchService
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(UserIndex $request, UserSearchService $userSearchService)
    {
        return view('admin.users.index', [
            'users' => $userSearchService($request),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * @param  UserStore  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UserStore $request)
    {
        $user = User::create($request->validated());
        return redirect(route('admin.users.show', $user->id));
    }

    /**
     * @param  User  $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * @param  User  $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * @param  UserUpdate  $request
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UserUpdate $request, User $user)
    {
        $parameters = $request->validated();
        if ($request->filled('delete_image')) {
            $parameters = array_merge($parameters, [
                'image_path' => null,
            ]);
        }
        $user->update($parameters);
        return redirect(route('admin.users.show', $user->id));
    }

    /**
     * @param  User  $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('admin.users.index'));
    }
}
