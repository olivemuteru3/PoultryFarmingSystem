<?php

namespace App\Http\Controllers;

use App\Models\Chicken;
use Illuminate\Http\Request;

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
}
