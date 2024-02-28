<?php

namespace App\Http\Controllers;

use App\Models\Chicken;
use App\Models\Egg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OperationController extends Controller
{
    public function RegisterChickens(Request $request)
    {
        try {
            $request->validate([
                'farmerName' => 'required|string',
                'farmerPhone' => 'required|string',
                'chicken_number' => 'required|integer',
                'date' => 'required|date',
                'comments' => 'required|string',
            ]);

            $chicken=new Chicken();

            $chicken->farmerName=$request->farmerName;
            $chicken->farmerPhone=$request->farmerPhone;
            $chicken->number=$request->chicken_number;
            $chicken->date=$request->date;
            $chicken->comments=$request->comments;

            //return response()->json($chicken);
            $chicken->save();
            return redirect()->back()->with('success', 'chicken registered successfully');

        } catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }


    public function RegisterEggs(Request $request)
    {
        try {
            $request->validate([
                'eggs_number' => 'required|integer',
                'comments' => 'required|string',
            ]);

            $eggs = new Egg();
            $user= auth()->user();

            $eggs->farmerPhone=$user->name;
            $eggs->farmerPhone=$user->phone;
            $eggs->date=Carbon::now()->format('d M Y');
            $eggs->eggs_number=$request->eggs_number;
            $eggs->comments = $request->comments;

        }catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
