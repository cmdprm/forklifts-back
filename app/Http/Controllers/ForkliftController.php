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

    public function search(Request $request)
    {
        $number = $request->query('number');

        if (!$number) {
            $forklifts = Forklift::all();
        } else {
            $forklifts = Forklift::where('number', 'ILIKE', "%$number%")->get();
        }

        return response()->json($forklifts, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string',
            'number' => 'required|string',
            'capacity' => 'required|integer',
        ]);

        $forklift = Forklift::create($request->all());

        return response()->json($forklift, 201);
    }

    public function update(Request $request, $id)
    {
        $forklift = Forklift::findOrFail($id);

        $request->validate([
            'brand' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        $forklift->update($request->all());

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
