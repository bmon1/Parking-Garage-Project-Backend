<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Garage;
use App\Models\ParkingHistory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        try {
            $user = Auth::user();
            $vehicles = $user->vehicles;

            return response()->json(['vehicles' => $vehicles]);
        } catch (ModelNotFoundException $e) {

            return response()->json(['message' => 'User not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['message' => 'An error occurred', 'error' => $e], 500);
        }
        
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

            return response()->json(['message' => 'Failed to create the vehicle', 'error' => $e], 500);
        } catch (\Exception $e) {

            return response()->json(['message' => 'An error occurred', 'error' => $e->errors()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);

            return response()->json(['vehicle' => $vehicle]);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Vehicle not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['message' => 'An error occurred', 'error' => $e], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { 
        try {
            $vehicle = Vehicle::findOrFail($id);

            $validatedData = $request->validate([
                'year' => 'sometimes|integer',
                'make' => 'sometimes|string|max:255',
                'model' => 'sometimes|string|max:255',
                'color' => 'sometimes|string|max:255',
                'license_plate' => 'sometimes|string|max:255',
            ]);

            $vehicle->update($validatedData);

            return response()->json(['message' => 'Vehicle updated successfully', 'data' => $vehicle]);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Vehicle not found'], 404);
        } catch (ValidationException $e) {

            return response()->json(['message' => 'Validation failed', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {

            return response()->json(['message' => 'An error occurred', 'error' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);

            $vehicle->delete();

            return response()->json(['message' => 'Vehicle deleted successfully']);
        } catch (ModelNotFoundException $e) {

            return response()->json(['message' => 'Vehicle not found'], 404);
        } catch (QueryException $e) {

            return response()->json(['message' => 'Failed to destroy the vehicle', 'error' => $e], 500);
        } catch (\Exception $e) {

            return response()->json(['message' => 'An error occurred', 'error' => $e], 500);
        }
    }

    /**
     * Park the specified vehicle
     */
    public function parkVehicle(Request $request, string $vehicleId, string $garageId)
    {
            try{
                Log::info($vehicleId);
                Log::info($garageId);

                DB::beginTransaction();

                $vehicle = Vehicle::findOrFail($vehicleId);
                $garage = Garage::findOrFail($garageId);

                $vehicle->currently_parked = 1;
                $vehicle->parked_in_garage = $garageId;
                $vehicle->entered_garage = now();
                $vehicle->save();

                $garage->decrement('open_parking_spots');
                $garage->save();

                $parkingHistory = new ParkingHistory();

                $parkingHistory->vehicle_id = $vehicle->id;
                $parkingHistory->user_id = $vehicle->user_id;
                $parkingHistory->garage = $garage->id;
                $parkingHistory->save();

                DB::commit();

                return response()->json(['message' => 'Vehicle parked successfully']);
            } catch (ModelNotFoundException $e) {
                DB::rollBack();
                return response()->json(['message' => 'Vehicle or garage not found'], 404);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['message' => 'An error occurred', 'error' => $e], 500);
            }
    }
}