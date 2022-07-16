<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     title="Calibration",
 *     description="Calibration model",
 *     @OA\Xml(
 *         name="Calibration"
 *     )
 * )
 */
class Calibration extends Model
{
    protected $fillable = [
        'patient_id', 
        'systolic_1', 
        'systolic_2',
        'systolic_3',
        'diastolic_1',
        'diastolic_2',
        'diastolic_3'
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
     *     title="systolic_1",
     *     description="Систолическое давление 1",
     *     format="int64",
     *     example=120
     * )
     *
     * @var integer
     */
    private $systolic_1;

    /**
     * @OA\Property(
     *     title="systolic_2",
     *     description="Систолическое давление 2",
     *     format="int64",
     *     example=120
     * )
     *
     * @var integer
     */
    private $systolic_2;

    /**
     * @OA\Property(
     *     title="systolic_3",
     *     description="Систолическое давление 3",
     *     format="int64",
     *     example=120
     * )
     *
     * @var integer
     */
    private $systolic_3;

    /**
     * @OA\Property(
     *     title="diastolic_1",
     *     description="Диастолическое давление 1",
     *     format="int64",
     *     example=80
     * )
     *
     * @var integer
     */
    private $diastolic_1;

    /**
     * @OA\Property(
     *     title="diastolic_2",
     *     description="Диастолическое давление 2",
     *     format="int64",
     *     example=80
     * )
     *
     * @var integer
     */
    private $diastolic_2;

    /**
     * @OA\Property(
     *     title="diastolic_3",
     *     description="Диастолическое давление 3",
     *     format="int64",
     *     example=80
     * )
     *
     * @var integer
     */
    private $diastolic_3;
    

    
    use HasFactory;
}
