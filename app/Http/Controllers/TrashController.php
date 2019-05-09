<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Trash;

class TrashController extends Controller
{
    public function index()
    {
        $trashes = Auth::user()->trashs;
        return view('my-trash')->with('trashes', $trashes);
    }
}
