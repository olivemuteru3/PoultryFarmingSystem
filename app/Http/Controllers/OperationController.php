<?php

namespace App\Http\Controllers;

use App\Models\Chicken;
use App\Models\Egg;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use mysql_xdevapi\Exception;

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
            $user = auth()->user();

            // Assuming $user->phone is correct, change $eggs->farmerPhone to $eggs->farmerName
            $eggs->farmerName = $user->name;
            $eggs->farmerPhone = $user->phone;

            // Formatting the date using Carbon
            $eggs->date = Carbon::now()->format('d M Y');

            $eggs->eggs_number = $request->eggs_number;
            $eggs->comments = $request->comments;


           // return response()->json($eggs);
            $eggs->save();

            return redirect()->back()->with('success', 'eggs registered successfully');

        }catch (\Exception $e) {
            // Log the exception or handle it accordingly
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }


    public function newPrice(Request $request)
    {

        try {
            $request->validate([
                'salesType' => 'required',
                'price' => 'required|integer',
            ]);
            $price = new Price();

            $price->salesType=$request->salesType;
            $price->price=$request->price;
            $price->date=now()->format('d-m-Y');

            $price->save();

            //return response()->json($price);

            return  redirect()->back()->with('success', 'price entered successfully');
        }
        catch  (\Exception $e) {
            // Log the exception or handle it accordingly
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }
}
