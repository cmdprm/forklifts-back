<?php

namespace App\Http\Controllers;

use App\Models\Forklift;
use Illuminate\Http\Request;

class ForkliftController extends Controller
{
    public function index()
    {
        return Forklift::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string',
            'number' => 'required|string',
            'capacity' => 'required|integer',
        ]);

        return Forklift::create($request->all());
    }

    public function update(Request $request, Forklift $forklift)
    {
        $validatedData = $request->validate([
            'brand' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        $forklift->update($validatedData);

        return response()->json($forklift, 200);
    }

    public function show(Forklift $forklift)
    {
        return $forklift->load('malfunctions');
    }

    public function destroy(Forklift $forklift)
    {
        $forklift->delete();

        return response()->json(['message' => 'Forklift deleted successfully'], 200);
    }
}
