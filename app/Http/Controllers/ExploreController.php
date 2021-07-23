<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function show()
    {
        return view('explore',[
            'users'=> User::paginate(50),
        ]);
    }
}
