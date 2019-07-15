<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Customer;

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
        $title = 'Escritorio';
        $sellers = User::where('role','=','seller')->get();
        $customers = Customer::all();
        return view('home',['title' => $title, 'sellers' => $sellers, 'customers' => $customers]);
    }
}
