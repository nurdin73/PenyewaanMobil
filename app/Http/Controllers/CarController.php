<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search') ?: '';
        $isRent = $request->get('is_rent') ?: '';

        $cars = Car::where('owner_id', auth()->id());
        
        if($isRent != '') $cars = $cars->where('is_rent', $isRent);
        if($search != '') $cars = $cars->where(function(Builder $query) use($search) {
            return $query->where('merk', 'like', "%{$search}%")
                ->orWhere('model', 'like', "%{$search}%")
                ->orWhere('no_plat', 'like', "%{$search}%");
        });


        $data['cars'] = $cars->paginate(10);
        $data['search'] = $search;
        $data['isRent'] = $isRent;
        return view('cars.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attr = $this->validate($request, [
            'merk' => 'required|string',
            'model' => 'required|string',
            'no_plat' => 'required|string',
            'price_rent_by_day' => 'required|integer'
        ]);
        $attr['owner_id'] = auth()->id();
        $create = Car::create($attr);

        return redirect()->route('cars.index')->with('status', "Car success created");
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $data['car'] = $car;
        return view('cars.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $attr = $this->validate($request, [
            'merk' => 'required|string',
            'model' => 'required|string',
            'no_plat' => 'required|string',
            'price_rent_by_day' => 'required|integer'
        ]);

        $car->update($attr);

        return redirect()->route('cars.index')->with('status', "Success update car");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('status', "Success deleted car");
    }
}