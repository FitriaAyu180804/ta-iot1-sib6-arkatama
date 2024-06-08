<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dht11Sensor;

class Dht11SensorController extends Controller
{
    public function index()
    {
        $sensors = Dht11Sensor::all();
        return response()->json($sensors);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'humidity' => 'required|numeric',
            'temperature' => 'required|numeric',
        ]);

        $sensor = Dht11Sensor::create($validatedData);

        return response()->json($sensor, 201);
    }
}
