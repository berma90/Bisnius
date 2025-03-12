<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Materi;
use App\Models\Mentor;
use App\Models\Cover;


class SeeController extends Controller
{
    public function seeMen(){
        $mentors=Mentor::all();

        return view('user.mentor', compact('mentors'));
    }
}
