<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Patient",
 *     description="Patient model",
 *     @OA\Xml(
 *         name="Patient"
 *     )
 * )
 */

class Setting extends Model
{
    protected $fillable = ['name', 'value'];
    use HasFactory;
}
