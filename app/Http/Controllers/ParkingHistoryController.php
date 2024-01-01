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
        $user = Auth::user();
        $history = $user->history;

        return response()->json(['history' => $history]);
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
        $user = Auth::user();
        Log::info($user);
        $vehicleHistory = ParkingHistory::where('user_id', $user->id)->where('vehicle_id', $id)->get();

        return response()->json(['vehicleHistory' => $vehicleHistory]);
    }
}
