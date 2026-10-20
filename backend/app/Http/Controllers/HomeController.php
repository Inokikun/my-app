<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //echo "2025/5/11";
        \Log::info('HomeController.php発火');
        if (auth()->check()) {
            return redirect('/images');
        }
        return view('home.index');
    }
}
