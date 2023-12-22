<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class GarageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $garages = Garage::all();

        return response()->json(['garages' => $garages]);
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
        $garage = Garage::findOrFail($id);

        return response()->json(['garage' => $garage]);
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
        $garage = Garage::findOrFail($id);

        $garage->delete();

        return response()->json(['message' => 'Garage deleted successfully']);
    }
}