<?php

namespace App\Http\Controllers;

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

                return view('Admin.index');
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
}
