<?php

namespace App\Http\Controllers;

use App\Models\ParkingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ParkingHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            $history = $user->history;

            return response()->json(['history' => $history]);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Users not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['message' => 'An error occurred', 'error' => $e], 500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        Log::info($user);
        $vehicleHistory = ParkingHistory::where('user_id', $user->id)->where('vehicle_id', $id)->get();

        return response()->json(['vehicleHistory' => $vehicleHistory]);
    }
}
