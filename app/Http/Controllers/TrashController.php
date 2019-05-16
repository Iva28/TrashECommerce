<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Trash;

class TrashController extends Controller
{
    public function index() {
        $totalCoins = 0;
        $trashes = Auth::user()->trashs;
        foreach ($trashes as $trash) {
           $totalCoins += $trash->coins;
        }
        return view('my-trash')->with([
            'trashes' => $trashes,
            'totalCoins' => $totalCoins
        ]);
    }

    public function getTrashDetails(Trash $trash) {
        //dd($trash);
        return view('trash-details')->with([
            'trash' => $trash,
        ]);
    }
}
