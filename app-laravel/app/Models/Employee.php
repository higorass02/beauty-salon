<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'email', 'password', 'birthday', 'status'];

    protected $hidden = [ 'password', 'status' ];

    protected $casts = [ 'password' => 'hashed' ];

    protected $dates = ['deleted_at', 'birthday'];
}
