<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class ApiCustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return response()->json( $customers );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
        ]);

        $customers = Customer::create($data);

        return response()->json([
            'message' => 'Customer created successfully!',
            'data' => $customers
        ]);
    }

    public function show(Customer $customer)
    {
        return response()->json([
            'data' => $customer
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
        ]);

        $customer->update($data);

        return response()->json([
            'message' => 'Customer updated successfully!',
            'data' => $customer
        ]);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json([
            'message' => 'Customer deleted successfully!',
            'data' => $customer
        ]);
    }
}
