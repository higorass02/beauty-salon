<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return response()->json([
            'data' => $services
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $services = Service::create($data);

        return response()->json([
            'message' => 'Service created successfully!',
            'data' => $services
        ]);
    }

    public function show(Service $service)
    {
        return response()->json([
            'data' => $service
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $service->update($data);

        return response()->json([
            'message' => 'Service updated successfully!',
            'data' => $service
        ]);
    }

    public function destroy(Service $service)
    {
        $service->delete();
        
        return response()->json([
            'message' => 'Service deleted successfully!',
            'data' => $service
        ]);
    }
}
