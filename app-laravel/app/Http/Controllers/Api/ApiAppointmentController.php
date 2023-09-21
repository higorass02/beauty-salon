<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiServiceController extends Controller
{
    public function index()
    {
        $apponintment = Appointment::all();
        return response()->json([
            'data' => $apponintment
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id'=> 'required|integer',
            'employee_id'=> 'required|integer',
            'service_id'=> 'required|integer',
            'date_time'=> 'required|date',
            'status' => 'integer|max:1',
        ]);

        $apponintment = Appointment::create($data);

        return response()->json([
            'message' => 'Appointment created successfully!',
            'data' => $apponintment
        ]);
    }

    public function show(Appointment $apponitment)
    {
        return response()->json([
            'data' => $apponitment
        ]);
    }

    public function update(Request $request, Appointment $apponitment)
    {
        $data = $request->validate([
            'customer_id'=> 'required|integer',
            'employee_id'=> 'required|integer',
            'service_id'=> 'required|integer',
            'date_time'=> 'required|date',
            'status' => 'integer|max:1',
        ]);

        $apponitment->update($data);

        return response()->json([
            'message' => 'Appointment updated successfully!',
            'data' => $apponitment
        ]);
    }

    public function destroy(Appointment $apponitment)
    {
        $apponitment->delete();
        
        return response()->json([
            'message' => 'Appointment deleted successfully!',
            'data' => $apponitment
        ]);
    }
}
