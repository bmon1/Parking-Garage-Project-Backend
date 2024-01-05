<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class VehicleController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $vehicles = $user->vehicles;

        return response()->json(['vehicles' => $vehicles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $validatedData = $request->validate([
                'year' => 'required|integer',
                'make' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'color' => 'required|string|max:255',
                'license_plate' => 'required|string|max:255',
            ]);

            $validatedData['user_id'] = $user->id;
            $validatedData['currently_parked'] = false;

            $vehicle = Vehicle::create($validatedData);

            return response()->json(['message' => 'Vehicle created successfully', 'data' => $vehicle], 201);
        } catch (ValidationException $e) {

            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (ModelNotFoundException $e) {

            return response()->json(['message' => 'User not found'], 404);
        } catch (QueryException $e) {

            return response()->json(['message' => 'Failed to create the vehicle', 'error' => $e->getMessage()], 500);
        } catch (\Exception $e) {

            return response()->json(['message' => 'An error occurred', 'error' => $e->errors()], 500);
        }
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

        return response()->json(['message' => 'Vehicle deleted successfully']);
    }
}