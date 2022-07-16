<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @OA\Schema(
 *     title="Events",
 *     description="Events model",
 *     @OA\Xml(
 *         name="Events"
 *     )
 * )
 */
class Events extends Model
{
    protected $fillable  = ['patient_id', 'indicator_id', 'event_type', 'title'];

    private $id;

    /**
     * @OA\Property(
     *     title="Patient_id",
     *     description="Id пациента",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $patient_id;

    /**
     * @OA\Property(
     *     title="Indicator_id",
     *     description="Id показаний",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $indicator_id;

    /**
     * @OA\Property(
     *     title="Event_type",
     *     description="Тип события",
     *     example="1"
     * )
     *
     * @var string
     */
    private $event_type;

    /**
     * @OA\Property(
     *     title="Title",
     *     description="Пол",
     *     example="Текстовое описание"
     * )
     *
     * @var integer
     */
    private $title;


    public function indicator()
    {
        return $this->hasOne(Indicator::class, 'indicator_id', 'id');
    }

    use HasFactory;
}
