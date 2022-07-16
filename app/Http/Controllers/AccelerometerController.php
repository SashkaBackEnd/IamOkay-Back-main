<?php

namespace App\Http\Controllers;

use App\Models\Accelerometer;
use App\Models\Calibration;
use App\Models\Patient;
use Illuminate\Http\Request;

class AccelerometerController extends Controller
{
    /**
     * @OA\Get(
     *      path="/accelerometer/{patient_id}",
     *      tags={"Accelerometer"},
     *      summary="Показатели пациента",
     *      description="Возвращается объект всех показаний по пациенту",
     *      @OA\Parameter(
     *          name="patient_id",
     *          description="ID пациента",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *  )
     */
    public function index(Request $request) {
        return Accelerometer::where('patient_id', $request->patient_id)->get();
    }

    /**
     * @OA\Put(
     *      path="/accelerometer/{patient_id}",
     *      tags={"Accelerometer"},
     *      summary="Создать нового запись данных показаний",
     *      description="Создать нового запись данных показаний, возвращается объект показаний",
     *      @OA\Parameter(
     *          name="patient_id",
     *          description="ID пациента",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/requestBodies/AccelRequestBody")
     *      ),
     *      requestBody={"$ref": "#/components/requestBodies/AccelRequestBody"},
     *      @OA\Response(
     *           response=200,
     *           description="Successful"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
    **/
    public function create(Request $request) {
        $some = $request->json()->all();
        foreach($some as $value) {
            $patient = Patient::where('id', $request->patient_id)->first();
            if($patient == null) {
                return response([
                    'status' => 0
                ],400);
            }
            if(!Accelerometer::create([
                'patient_id' => $request->patient_id,
                'x' => isset($value['x']) ? $value['x'] : 0,
                'y' => isset($value['y']) ? $value['y'] : 0,
                'z' => isset($value['z']) ? $value['z'] : 0,
            ])) {
                return response([
                    'status' => 0
                ],400);
            }
        }
        return response([
            'status' => 1
        ]);
    }
}
