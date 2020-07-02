<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->type == 'admin') {
            return redirect('/administrateur');
        }
        if (Auth::user()->type == 'chef de filiere') {
            return redirect('/chefDeFilière');
        }
        if (Auth::user()->type == 'enseignant') {
            return redirect('/enseignant');
        }
        return view('home');
        
    }
    public function nonAutorisé(){
        return view('nonAutorisé');
    }
}
