<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        //echo "2025/5/11";
        \Log::info('HomeController.php発火');
        return view('home.index');
    }
}
