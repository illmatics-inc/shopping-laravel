<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdate;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @param  User  $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('front.users.edit', compact('user'));
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
        return redirect(route('front.home'));
    }
}
