<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('front.home');
    }
}
