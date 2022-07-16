<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateRegister extends Model
{
    protected $fillable = ['device_id'];
    use HasFactory;
}
