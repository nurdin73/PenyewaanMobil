<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rent;
use App\Models\RentHistory;
use Illuminate\Http\Request;

class MyRentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search ?: '';
        $rents = Rent::with('car', 'history')->where('user_id', auth()->id())->get();
        $data['rents'] = $rents;
        $data['search'] = $search;
        return view('my-rentals.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $rent)
    {
        $rent = Rent::find($rent);
        if($rent->user_id != auth()->id()) return redirect()->back()->with('error', "Not your rent!");
        RentHistory::create([
            'rent_id' => $rent->id,
            'status' => 'RETURNED'
        ]);
        Car::where('id', $rent->id)->update([
            'is_rent' => false
        ]);
        return redirect()->back()->with('status', "Car success returned");
    }
}