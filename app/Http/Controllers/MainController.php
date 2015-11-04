<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class MainController extends Controller
{
    
    public function index()
    {
        $title = "Login Page";
        return view('login')->with(compact('title'));
    }

    public function show()
    {
        echo "ok";

    }
}
