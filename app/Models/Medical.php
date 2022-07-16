<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



/**
 * @OA\Schema(
 *     title="Medical",
 *     description="Medical model",
 *     @OA\Xml(
 *         name="Medical"
 *     )
 * )
 */
class Medical extends Model
{
    protected $fillable  = ['patient_id','time', 'name', 'type'];

    private $id;

    /**
     * @OA\Property(
     *     title="Patient_id",
     *     format="int64",
     *     description="Id пациента",
     *     example=1
     * )
     *
     * @var integer
     */
    private $patient_id;

    /**
     * @OA\Property(
     *     title="Name",
     *     description="Название медикамента",
     *     example="Глицин"
     * )
     *
     * @var integer
     */
    private $name;

    /**
     * @OA\Property(
     *     title="Time",
     *     description="Время приема",
     *     example="Глицин"
     * )
     *
     * @var integer
     */
    private $time;

    /**
     * @OA\Property(
     *     title="Type",
     *     format="int64",
     *     description="Иконка (1,2,3)",
     *     example=1
     * )
     *
     * @var integer
     */
    private $type;

 
    use HasFactory;
}
