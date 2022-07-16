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
class Patient extends Model
{
    protected $fillable  = ['name','user_id', 'subscription', 'birth', 'gender_id', 'growth', 'wieght' ,'stride_lenth'];

    private $id;

    /**
     * @OA\Property(
     *     title="User_id",
     *     description="ID пользователя",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $user_id;

    /**
     * @OA\Property(
     *     title="Name",
     *     description="ФИО пациента",
     *     example="Иванов Иван Иванович"
     * )
     *
     * @var integer
     */
    private $name;

    /**
     * @OA\Property(
     *     title="Birth",
     *     description="Дата рождения",
     *     example="06.08.1960"
     * )
     *
     * @var string
     */
    private $birth;

    /**
     * @OA\Property(
     *     title="Gender_id",
     *     description="Пол",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $gender_id;

    /**
     * @OA\Property(
     *     title="Growth",
     *     description="Рост",
     *     format="int64",
     *     example=184
     * )
     *
     * @var integer
     */
    private $growth;

    /**
     * @OA\Property(
     *     title="Wieght",
     *     description="Вес",
     *     format="int64",
     *     example=66
     * )
     *
     * @var integer
     */
    private $wieght;

    /**
     * @OA\Property(
     *     title="Stride_lenth",
     *     description="Длина шага",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $stride_lenth;

    /**
     * @OA\Property(
     *     title="subscription",
     *     description="Дата подписки",
     *     example=null
     * )
     *
     * @var integer
     */
    private $subscription;
  
    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function event()
    {
        return $this->hasOne(Events::class, 'id', 'patient_id')->orderBy('created_at', 'desc');
    }

    public function calibrate()
    {
        return $this->hasOne(Calibration::class, 'id', 'patient_id')->first();
    }

    public function comment()
    {
        return $this->hasMany(Comments::class, 'id', 'patient_id');
    }
    
    use HasFactory;
}
