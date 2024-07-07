<?php

namespace App\Http\Controllers;

use App\Models\Malfunction;
use Illuminate\Http\Request;

class MalfunctionController extends Controller
{
    public function index()
    {
        return Malfunction::all();
    }

    public function getMalfunctionsByForklift($forkliftId)
    {
        $malfunctions = Malfunction::where('forklift_id', $forkliftId)->get();

        return response()->json($malfunctions);
    }

    public function store(Request $request)
    {
        $request->validate([
            'detected_at' => 'required|date',
            'description' => 'required|string',
            'resolved_at' => 'required|date',
            'forklift_id' => 'required|exists:forklifts,id',
        ]);

        return Malfunction::create($request->all());
    }

    public function update(Request $request, Malfunction $malfunction)
    {
        $validatedData = $request->validate([
            'detected_at' => 'required|date',
            'resolved_at' => 'required|date',
            'description' => 'required|string',
        ]);

        $malfunction->update($validatedData);

        if (!is_null($malfunction->resolved_at)) {
            $malfunction->downtime = $malfunction->resolved_at->diffInMinutes($malfunction->detected_at);
            $malfunction->save();
        }

        return response()->json($malfunction, 200);
    }

    public function destroy(Malfunction $malfunction)
    {
        $malfunction->delete();

        return response()->json(['message' => 'Malfunction deleted successfully'], 200);
    }
}
