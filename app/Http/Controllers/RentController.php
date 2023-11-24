<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rent;
use App\Models\RentHistory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search') ?: '';
        $start_date = $request->get('start_date') ?: '';
        $end_date = $request->get('end_date') ?: '';

        $data['cars'] = [];
        if($start_date != '' && $end_date != '') {
            $cars = Car::where('owner_id',  '!=', auth()->id())->where('is_rent', false);
            $data['cars'] = $cars->get();
        }
        $data['total_day'] = Carbon::parse($end_date)->diffInDays($start_date);
        $data['search'] = $search;
        return view('rentals.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attr = $this->validate($request, [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'car_id' => 'required|integer',
            'amount' => 'required'
        ]);
        $checkCar = Car::where('id', $attr['car_id'])->where('is_rent', false)->first();
        if(!$checkCar) return redirect()->route('rentals.index')->with('error', "Car not available");
        $attr['user_id'] = auth()->id();
        $rent = Rent::create($attr);
        RentHistory::create([
            'rent_id' => $rent->id,
            'status' => 'RENT'
        ]);
        $checkCar->update([
            'is_rent' => true,
        ]);
        return redirect()->route('rentals.index')->with('status', "Rental car success");
    }
}