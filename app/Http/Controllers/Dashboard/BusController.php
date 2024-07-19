<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buses=Bus::all();
        return view('buses.index',compact('buses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('buses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            
            'route_name' => 'required',
            'start_location' => 'required',
            'end_location' => 'required',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'vehicle_type' => 'required',
            
        ]);
        $validatedData['department_id']=Auth::user()->department_id;
        Bus::create($validatedData);
        toastr('Bus Added Successfully');
        return redirect()->route('dashboard.buses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bus $bus)
    {
        return view('buses.show',compact('bus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bus $bus)
    {
       
       return view('buses.edit',compact('bus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bus $bus)
    {
        $validatedData = $request->validate([
            
            'route_name' => 'required',
            'start_location' => 'required',
            'end_location' => 'required',
            'departure_time' => 'required|date_format:H:i:s',
            'arrival_time' => 'required|date_format:H:i:s',
            'vehicle_type' => 'required',
        ]);
    
        $bus->update($validatedData);

        toastr('Bus Updated Successfully');
        return redirect()->route('dashboard.buses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bus $bus)
    {
        $bus->delete();
        toastr('Bus Deleted Successfully');
        return redirect()->route('dashboard.buses.index');
    }
}
