<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     title="Accelerometer",
 *     description="Accelerometer model",
 *     @OA\Xml(
 *         name="Accelerometer"
 *     )
 * )
 */
class Accelerometer extends Model
{
    use HasFactory;

    protected $fillable  = [
        'patient_id', 
        'x',
        'y',
        'z'
    ];

    private $id;

    /**
     * @OA\Property(
     *     title="patient_id",
     *     description="ID пациента",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $patient_id;

    /**
     * @OA\Property(
     *     title="x",
     *     description="Координата x",
     *     example=96
     * )
     *
     * @var float
     */
    private $x;

    /**
     * @OA\Property(
     *     title="y",
     *     description="Координата y",
     *     example=96
     * )
     *
     * @var float
     */
    private $y;

    /**
     * @OA\Property(
     *     title="z",
     *     description="Координата z",
     *     example=96
     * )
     *
     * @var float
     */
    private $z;
}
