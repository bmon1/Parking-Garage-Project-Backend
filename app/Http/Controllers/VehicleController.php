<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::all();

        return response()->json(['vehicles' => $vehicles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return response()->json(['vehicle' => $vehicle]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $vehicle->delete();

        return response()->json(['message' => 'Vehicle soft deleted successfully']);
    }
}