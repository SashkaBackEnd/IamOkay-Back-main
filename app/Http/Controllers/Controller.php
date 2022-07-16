<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API сервиса iAmOkey",
 *      description="Документация сервиса.",
 *      @OA\Contact(
 *          email="nfs2025@mail.ru"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 * /**
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )

 *
 * @OA\Tag(
 *     name="Patient",
 *     description="Профиль пациента"
 * )
 * 
 * 
 * @OA\Tag(
 *     name="Medical",
 *     description="Медикаменты"
 * )
 * 
 * 
 * @OA\Tag(
 *     name="User",
 *     description="Пользователи"
 * )
 * 
 * @OA\Tag(
 *     name="Indicator",
 *     description="Показатели"
 * )
 * @OA\Tag(
 *     name="Device",
 *     description="Устройство (дата регистрации)"
 * )
 * 
 * 
 * @OA\Examples(
 *        summary="Indicator",
 *        example = "Indicator",
 *        value = {
 *          {
 *              "patient_id": 1,
 *              "pressure": {
 *                     "systolic": 120,
 *                     "diastolic": 80,
 *              },
 *              "pulse": {
 *                    "average": 80,
 *                    "min": 60,
 *                    "max":90,
 *                    "dispersion": 96
 *              },
 *              "accelerometer": {
 *                    "x": 80,
 *                    "y": 60,
 *                    "z":90,
 *              },
 *              "saturation": 96,
 *              "sleep": 5,
 *              "steps": 60,
 *              "time": "2021-12-29 09:23:40"
 *          },
 *          {
 *              "patient_id": 1,
 *              "pressure": {
 *                     "systolic": 120,
 *                     "diastolic": 80,
 *              },
 *              "pulse": {
 *                    "average": 80,
 *                    "min": 60,
 *                    "max":90,
 *                    "dispersion": 96
 *              },
 *              "accelerometer": {
 *                    "x": 80,
 *                    "y": 60,
 *                    "z":90,
 *              },
 *              "saturation": 96,
 *              "sleep": 5,
 *              "steps": 60,
 *              "time": "2021-12-29 09:23:40"
 *          }
 *         },
 *  )
 * @OA\Examples(
 *        summary="Accelerometer",
 *        example = "Accelerometer",
 *        value = {
 *          {
 *               "x": 80,
 *               "y": 60,
 *               "z":90  
 *          },
 *          {
 *               "x": 80,
 *               "y": 60,
 *               "z":90  
 *          },
 *          {
 *               "x": 80,
 *               "y": 60,
 *               "z":90  
 *          }
 *      }
 *  )
 * @OA\RequestBody(
 *     request="VehicleStoreRequestBody",
 *     description="Indicator",
 *     required=true,
 *     @OA\JsonContent(
 *       examples = {
 *          "example" : @OA\Schema( ref="#/components/examples/Indicator", example="#/components/examples/Indicator")
 *      }
 *    )
 * )
 * @OA\RequestBody(
 *     request="AccelRequestBody",
 *     description="Accelerometer",
 *     required=true,
 *     @OA\JsonContent(
 *       examples = {
 *          "example" : @OA\Schema( ref="#/components/examples/Accelerometer", example="#/components/examples/Accelerometer")
 *      }
 *    )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
