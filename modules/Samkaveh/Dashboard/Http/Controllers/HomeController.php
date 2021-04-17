<?php

namespace Samkaveh\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function dashboard()
    {
        return view('Dashboard::index');
    }




}
