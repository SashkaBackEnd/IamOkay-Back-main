<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Indicator",
 *     description="Indicator model",
 *     @OA\Xml(
 *         name="Indicator"
 *     )
 * )
 */
class Indicator extends Model
{
    protected $fillable  = ['patient_id', 
        'systolic_pressure', 
        'diastolic_pressure', 
        'saturation', 
        'time', 
        'pulse_average', 
        'pulse_min', 
        'pulse_max', 
        'dispersion', 
        'sleep', 
        'steps',
        'accelerometer_x',
        'accelerometer_y',
        'accelerometer_z'
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
     *     title="Systolic_pressure",
     *     description="Систолическое давление",
     *     format="int64",
     *     example=120
     * )
     *
     * @var integer
     */
    private $systolic_pressure;

    /**
     * @OA\Property(
     *     title="Diastolic_pressure",
     *     description="Диастолическое давление",
     *     format="int64",
     *     example=80
     * )
     *
     * @var integer
     */
    private $diastolic_pressure;

    
    /**
     * @OA\Property(
     *     title="Pulse",
     *     description="Пульс",
     *     format="int64",
     *     example=60
     * )
     *
     * @var integer
     */
    private $pulse;

    /**
     * @OA\Property(
     *     title="Sleep",
     *     description="Сон",
     *     format="int64",
     *     example=10
     * )
     *
     * @var integer
     */
    private $sleep;

    /**
     * @OA\Property(
     *     title="Steps",
     *     description="Кол-во шагов",
     *     format="int64",
     *     example=60
     * )
     *
     * @var integer
     */
    private $steps;


    /**
     * @OA\Property(
     *     title="Saturation",
     *     description="Сатурация",
     *     example=96
     * )
     *
     * @var float
     */
    private $saturation;


    /**
     * @OA\Property(
     *     title="Accelerometer_x",
     *     description="Акселерометр x",
     *     example=96
     * )
     *
     * @var float
     */
    private $accelerometer_x;

    /**
     * @OA\Property(
     *     title="Accelerometer_y",
     *     description="Акселерометр y",
     *     example=96
     * )
     *
     * @var float
     */
    private $accelerometer_y;

    /**
     * @OA\Property(
     *     title="Accelerometer_z",
     *     description="Акселерометр z",
     *     example=96
     * )
     *
     * @var float
     */
    private $accelerometer_z;

    
    use HasFactory;
}
