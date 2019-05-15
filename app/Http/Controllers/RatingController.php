<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Trash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Collective\Html\FormFacade;
use Collective\Html\FormBuilder;

class RatingController extends Controller
{

    public function index() {
        return $this->_getIndexPage();
    }
    
    private function _getIndexPage(User $userCity = null, string $city = null)
    {
        $arr = array();
        $userMonth = null;

       $currentMonth = date('m');

       $trashes = DB::table('trashes')->whereRaw('MONTH(created_at) =?',[$currentMonth])->get();
       if ($trashes->isNotEmpty()) {
           $users = $trashes->pluck('user_id');
           foreach ($users as $user) {
               $coins = $trashes->where('user_id', $user)->sum('coins');
               $arr[$user] = $coins;
            }
            $max = array_keys($arr, max($arr));
            $userMonth = User::find($max[0]);
        }

        $cities = DB::table('trashes')->distinct('city')->pluck('city');
        $totalTrashes = Trash::count();
       
        return view('rating')->with([
            'totalTrashes'=> $totalTrashes,
            'userMonth' => $userMonth,
            'cities' => $cities->combine($cities)->toArray(),
            'city' => $city,
            'userCity' => $userCity
        ]);
    }

    public function getUserbyCity(Request $request) {
        $city = $request->input("city");
        $trashes = DB::table('trashes')->whereRaw('city =?', [$city])->get();

        if ($trashes->isNotEmpty()) {
            $users = $trashes->pluck('user_id')->unique()->values();
            foreach ($users as $user) {
                $coins = $trashes->where('user_id', $user)->sum('coins');
                $arr[$user] = $coins;
            }
            $max = array_keys($arr, max($arr));
            $userCity = User::find($max[0]);
         }
         return $this->_getIndexPage($userCity, $city);
    }
}