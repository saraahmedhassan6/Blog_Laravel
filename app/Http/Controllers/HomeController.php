<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Blogs = Blog::where('published', 1)
            ->orderByDesc('id')
            ->take(5)
            ->get();        return view('index',compact('Blogs'));
    }

    public function Dash()
    {
        return view('Dashboard.index');
    }


}
