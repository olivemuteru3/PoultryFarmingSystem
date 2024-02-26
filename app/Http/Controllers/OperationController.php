<?php

namespace App\Http\Controllers;

use App\Models\Chicken;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function RegisterChickens(Request $request)
    {

        $this -> $request->validate([
            'name' => 'required|string',
            'contact_number' => 'required|string',
            'num_chickens' => 'required|integer',
            'date' => 'required|date',
            'comments' => 'required|string',
        ]);
        $chicken=new Chicken();
        $chicken->farmerName=$request->farmerName;
        $chicken->farmerPhone=$request->farmerPhone;
        $chicken->number=$request->chicken_number;
        $chicken->date=$request->date;
        $chicken->comments=$request->comments;

        return response()->json($chicken);

    }
}
