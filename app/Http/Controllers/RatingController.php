<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Trash;

class RatingController extends Controller
{
    public function index()
    {
        $users = User::all();
        $totalTrashes = Trash::count();
        return view('rating')->with('totalTrashes', $totalTrashes);
    }
}
