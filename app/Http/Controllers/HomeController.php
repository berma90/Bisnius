<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mentor;

class HomeController extends Controller
{
    public function index() {
        $mentors = Mentor::inRandomOrder()->take(4)->get();
        return view('user.landingpage', compact('mentors'));
    }
}
