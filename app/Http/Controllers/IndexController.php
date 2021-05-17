<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Display the index page.
     *
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('layout.page', [
            'title' => 'Home',
            'header' => 'Home',
            'message' => "This is the index page."
        ]);
    }
}
