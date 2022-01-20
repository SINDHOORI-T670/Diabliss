<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
dd('Home');
    }
    public function adminlogin(){
        // dd("Admin login");
        return view('Auth.pages-login-boxed');
    }
}
