<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;

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
       
     // denies dashboard access to unauthorized users
    if(Gate::denies('manage-users')){
        return redirect(route('task.index'));
    }
     // return view('home');
    return view('admin.dashboard');

    }
}
