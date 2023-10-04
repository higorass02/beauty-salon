<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['customer_id', 'employee_id', 'service_id', 'date_time', 'status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
