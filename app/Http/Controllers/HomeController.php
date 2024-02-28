<?php

namespace App\Http\Controllers;

use App\Models\Chicken;
use App\Models\Egg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype === 'farmer') {
                $bidder = auth()->user();


                $chicken=Chicken::all();
                $Count=Chicken::sum('number');

                //return response()->json($chicken);

                return view('Admin.index', compact('chicken', 'Count'));
            } else if ($usertype === 'admin') {


                return view('Admin.index');
            }
        } else {
            return view('auth.login');
        }
    }

    public function RegisterPoultry()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if ($usertype === 'farmer') {
                $bidder = auth()->user();

                return view('Admin.RegisterPoultry');
            } else if ($usertype === 'admin') {


                return view('Admin.RegisterPoultry');
            }
        } else {
            return view('auth.login');
        }

    }

    public function eggs()
    {
        $Count=Chicken::sum('number');
        $eggs=Egg::sum('number');

        return view('Admin.eggs', compact('Count', 'eggs'));
    }
}
