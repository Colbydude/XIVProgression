<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
        return view('pages/home');
    }

    public function progression(Request $request)
    {
        $name = $request->input('name');
        $server = $request->input('server');

        return view('pages/progression')->with(compact('name', 'server'));
    }
}
