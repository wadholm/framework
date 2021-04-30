<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * Display the test page.
     *
     *
     * @return \Illuminate\View\View
     */
    public function test()
    {
        return view('layout.test', [
            'title' => 'Test',
            'header' => 'Test',
            'message' => "This is the page to test Dice and DiceHand."
        ]);
    }
}
