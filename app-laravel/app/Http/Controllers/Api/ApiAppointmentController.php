<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Service;
use Exception;
use PHPUnit\Event\Code\Throwable;

class ApiAppointmentController extends Controller
{
    public function index()
    {
        $apponintment = Appointment::all();
        return response()->json([
            'data' => $apponintment
        ]);
    }

    public function validateExists($data)
    {
        if(!Customer::find($data['customer_id'])) {
            throw new Exception('Customer not found');
        }

        if(!Service::find($data['service_id'])) {
            throw new Exception('Service not found');
        }

        if(!Employee::find($data['employee_id'])) {
            throw new Exception('Employee not found');
        }
    }

    public function validateData($data, $update = false) {
        if(!$update){
            if(
                Appointment::where('date_time', $data['date_time'])
                ->where('customer_id',$data['customer_id'] )
                ->where('service_id',$data['service_id'] )
                ->where('employee_id',$data['employee_id'] )
                ->exists())
            {
                throw new Exception('There is already a schedule at this time');
            }
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'customer_id'=> 'required|integer',
                'employee_id'=> 'required|integer',
                'service_id'=> 'required|integer',
                'date_time'=> 'required|date',
                'status' => 'integer|max:1',
            ]);

            $this->validateExists($data);
            $this->validateData($data);

            $apponintment = Appointment::create($data);

            return response()->json([
                'message' => 'Appointment created successfully!',
                'data' => $apponintment
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
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

        $this->validateExists($data);
        $this->validateData($data, true);

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
