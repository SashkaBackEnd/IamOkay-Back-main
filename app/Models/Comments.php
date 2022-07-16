<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     title="Comments",
 *     description="Comments model",
 *     @OA\Xml(
 *         name="Comments"
 *     )
 * )
 */
class Comments extends Model
{
    protected $fillable = [
        'user_id', 
        'patient_id', 
        'comment' 
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
     *     title="user_id",
     *     description="ID пользвателя",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $user_id;

    /**
     * @OA\Property(
     *     title="comment",
     *     description="Комментарий",
     *     example="Комментарий"
     * )
     *
     * @var integer
     */
    private $comment;

    use HasFactory;
}
