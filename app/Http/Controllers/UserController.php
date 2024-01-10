<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::all();

            return response()->json(['users' => $users]);
        } catch (ModelNotFoundException $e) {

            return response()->json(['error' => 'Users not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['message' => 'An error occurred', 'error' => $e], 500);
        }

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
        $user = User::findOrFail($id);

        return response()->json(['user' => $user]);
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
        try {
            $user = User::findOrFail($id);
            $validatedData = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|string|max:255',
            ]);

            $user->update($validatedData);

            return response()->json(['message' => 'User updated successfully', 'data' => $user]);
        } catch(ModelNotFoundException $e) {

            return response()->json(['Error' => 'User not found'], 404);
        } catch (\Exception $e) {

            return response()->json(['message' => 'An error occurred', 'error' => $e], 500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function getAuthUser() {
        $user = Auth::user();

        return response()->json(['user' => $user]);
    }
}