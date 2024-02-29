<?php

namespace App\Http\Controllers;

use App\Models\Chicken;
use App\Models\Egg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
                $eggs=Egg::sum('eggs_number');
                $eggsRecord=Egg::all();

                // Convert today's date to the format "d M Y"
                $todayFormatted = Carbon::today()->format('d M Y');

                // Find the eggs laid today based on the formatted date
                $todaysEggs = Egg::where('date', 'LIKE', $todayFormatted . '%')->sum('eggs_number');

                //$todaysEggs = Egg::whereDate('date', '=', Carbon::createFromFormat('d M Y', Carbon::today()->format('d M Y')))->sum('eggs_number');


                //return response()->json($chicken);

                return view('Admin.index', compact('chicken', 'Count', 'eggs', 'eggsRecord', 'todaysEggs'));
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

                $Count=Chicken::sum('number');
                $eggs=Egg::sum('eggs_number');
                $chicks = Chicken::all();

                // Convert today's date to the format "d M Y"
                $todayFormatted = Carbon::today()->format('d M Y');

                // Find the eggs laid today based on the formatted date
                $todaysEggs = Egg::where('date', 'LIKE', $todayFormatted . '%')->sum('eggs_number');


                return view('Admin.RegisterPoultry', compact('eggs', 'chicks', 'Count', 'todaysEggs'));
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
        $eggs=Egg::sum('eggs_number');
        $eggsCount = Egg::all();
        // Convert today's date to the format "d M Y"
        $todayFormatted = Carbon::today()->format('d M Y');

        // Find the eggs laid today based on the formatted date
        $todaysEggs = Egg::where('date', 'LIKE', $todayFormatted . '%')->sum('eggs_number');

        return view('Admin.eggs', compact('Count', 'eggs', 'eggsCount', 'todaysEggs'));
    }

    public function eggsDetails(Request $request)
    {

        $Count=Chicken::sum('number');
        $eggs=Egg::sum('eggs_number');
        //$eggsCount = Egg::where('id', $request->id)->get();
        $eggsCount = Egg::find($request->id);
        // Convert today's date to the format "d M Y"
        $todayFormatted = Carbon::today()->format('d M Y');

        // Find the eggs laid today based on the formatted date
        $todaysEggs = Egg::where('date', 'LIKE', $todayFormatted . '%')->sum('eggs_number');
        return view('Admin.eggsdetails', compact('Count', 'eggs', 'eggsCount', 'todaysEggs'));

    }

    public function chickenDetails(Request $request)
    {

        $Count=Chicken::sum('number');
        $eggs=Egg::sum('eggs_number');
        //$eggsCount = Egg::where('id', $request->id)->get();
        $eggsCount = Chicken::find($request->id);
        // Convert today's date to the format "d M Y"
        $todayFormatted = Carbon::today()->format('d M Y');

        // Find the eggs laid today based on the formatted date
        $todaysEggs = Egg::where('date', 'LIKE', $todayFormatted . '%')->sum('eggs_number');
        return view('Admin.chickendetails', compact('Count', 'eggs', 'eggsCount', 'todaysEggs'));

    }

    public function sales()
    {

        $Count=Chicken::sum('number');
        $eggs=Egg::sum('eggs_number');
        //$eggsCount = Egg::where('id', $request->id)->get();
        $eggsCount = Chicken::all();
        $chicken=Egg::all();
        // Convert today's date to the format "d M Y"
        $todayFormatted = Carbon::today()->format('d M Y');

        // Find the eggs laid today based on the formatted date
        $todaysEggs = Egg::where('date', 'LIKE', $todayFormatted . '%')->sum('eggs_number');
        return view('Admin.sales', compact('Count', 'eggs', 'eggsCount', 'todaysEggs'));

    }

    public function prices()
    {

        $chicken=Chicken::all();
        $Count=Chicken::sum('number');
        $eggs=Egg::sum('eggs_number');
        $eggsRecord=Egg::all();

        // Convert today's date to the format "d M Y"
        $todayFormatted = Carbon::today()->format('d M Y');

        // Find the eggs laid today based on the formatted date
        $todaysEggs = Egg::where('date', 'LIKE', $todayFormatted . '%')->sum('eggs_number');

        return view('Admin.newPrices', compact('chicken', 'Count', 'eggs', 'eggsRecord', 'todaysEggs'));

    }
}
