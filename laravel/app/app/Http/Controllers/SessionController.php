<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display the session page.
     *
     *
     * @return \Illuminate\View\View
     */
    public function session(Request $request)
    {
        return view('layout.session', [
            'title' => 'Session',
            'request' => $request
        ]);
    }

    /**
     * Destroy the session.
     *
     *
     * @return \Illuminate\View\View
     */
    public function destroy(Request $request)
    {
        $request->session()->flush();
        return redirect('session');
    }
}
