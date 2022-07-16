<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     title="MedicalLog",
 *     description="MedicalLog model",
 *     @OA\Xml(
 *         name="MedicalLog"
 *     )
 * )
 */
class MedicalLog extends Model
{
    protected $fillable  = ['medical_id', 'status'];

    private $id;

    /**
     * @OA\Property(
     *     title="Medical_id",
     *     description="Id пациента",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $medical_id;

    /**
     * @OA\Property(
     *     title="Status",
     *     description="0 - неуспешно, 1 - успешно",
     *     example=1
     * )
     *
     * @var string
     */
    private $status;
    use HasFactory;
}
