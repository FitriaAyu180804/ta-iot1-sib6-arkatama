<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Dht11Sensor;

class Dht11SensorController extends Controller
{
    public function index()
    {
        return response()->json(Dht11Sensor::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'humidity' => 'required|numeric',
            'temperature' => 'required|numeric',
        ]);

        $dht11Sensor = new Dht11Sensor();
        $dht11Sensor->humidity = $request->humidity;
        $dht11Sensor->temperature = $request->temperature;
        $dht11Sensor->save();

        return response()->json([
            'message' => 'Sensor data stored successfully',
            'data' => $dht11Sensor
        ], 201);
    }
}
