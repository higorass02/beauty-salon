<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'price'];
    
    protected $hidden = [ 'status' ];
    
    protected $dates = ['deleted_at', 'creted_at', 'updated_at'];
}
