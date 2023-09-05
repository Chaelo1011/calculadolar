<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DollarUserController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $dollar_user = new DollarUserController();

        $dollar_usera = $dollar_user->getDollarUser();

        return view('home',[
            'dollar_user' => $dollar_usera
        ]);
    }
}
