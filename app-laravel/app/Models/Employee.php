<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = [ 'password' ];

    protected $casts = [ 'password' => 'hashed' ];

    protected $dates = ['deleted_at'];
}
