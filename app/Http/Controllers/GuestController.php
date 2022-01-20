<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('guestt');
    }
    public function index(){
        dd("Hello Guestt");
    }
}
