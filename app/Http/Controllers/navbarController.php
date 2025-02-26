<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class navbarController extends Controller
{
    public function home(){
        return view('layouts.navbar.navbaruser');
    }
    public function class(){
        return view('class.class');
    }
}
