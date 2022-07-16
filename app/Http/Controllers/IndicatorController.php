<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{
    /**
     * @OA\Get(
     *      path="/indicator/{patient_id}",
     *      tags={"Indicator"},
     *      summary="Показатели пациента",
     *      description="Возвращается объект всех показаний по пациенту",
     *      @OA\Parameter(
     *          name="patient_id",
     *          description="ID пациента",
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="date_from",
     *          description="Дата начала",
     *          in="query"
     *      ),
     *      @OA\Parameter(
     *          name="date_to",
     *          description="Дата конца",
     *          in="query"
     *      ),
     *      @OA\Parameter(
     *          name="period",
     *          description="day|week|month|year",
     *          in="query"
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
     *     )
     */
    public function index(Request $request) {
        $indicator = Indicator::where('patient_id',$request->patient_id)->orderBy('created_at', 'desc');
        if($request->has('date_from')) {
            $indicator->where('created_at', '>', $request->date_from);
        }
        if($request->has('date_to')) {
            $indicator->where('created_at', '<=', $request->date_to);
        }
        if($request->has('period')) {
            if($request->period == 'day') {
                $indicator->where('created_at', '>', Carbon::now()->subDays(1));
            }
            if($request->period == 'week') {
                $indicator->where('created_at', '>', Carbon::now()->subDays(7));
            }
            if($request->period == 'month') {
                $indicator->where('created_at', '>', Carbon::now()->subMonth(1));
            }
            if($request->period == 'year') {
                $indicator->where('created_at', '>', Carbon::now()->subYear(1));
            }
        }
        return $indicator->get();
    }

    /**
     * @OA\Put(
     *      path="/indicator/",
     *      tags={"Indicator"},
     *      summary="Создать нового запись данных показаний",
     *      description="Создать нового запись данных показаний, возвращается объект показаний",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/requestBodies/VehicleStoreRequestBody")
     *      ),
     *      requestBody={"$ref": "#/components/requestBodies/VehicleStoreRequestBody"},
     *      @OA\Response(
     *           response="200",
     *           description="Successful",
     *            @OA\JsonContent()
     *          ),
     *      )
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
        $count = 0;
        foreach($some as $value) {
            if(isset($value['patient_id'])) {
                $count++;
                $patient = Patient::where('id', $value['patient_id'])->first();
                if($patient == null) {
                    return response([
                        'status' => 0
                    ],400);
                }
                $indicator = Indicator::create([
                    'patient_id' => $value['patient_id'],
                    'time' => isset($value['time']) ? $value['time'] : '',
                    'saturation' => isset($value['saturation']) ? $value['saturation'] : 0,
                    'systolic_pressure' => isset($value['pressure']['systolic']) ? $value['pressure']['systolic'] : 0,
                    'diastolic_pressure' => isset($value['pressure']['diastolic']) ? $value['pressure']['diastolic'] : 0,
                    'pulse_average' => isset($value['pulse']['average']) ? $value['pulse']['average'] : 0,
                    'pulse_min' => isset($value['pulse']['min']) ? $value['pulse']['min'] : 0,
                    'pulse_max' => isset($value['pulse']['max']) ? $value['pulse']['max'] : 0,
                    'dispersion' => isset($value['pulse']['dispersion']) ? $value['pulse']['dispersion'] : 0,
                    'accelerometer_x' => isset($value['accelerometer']['x']) ? $value['accelerometer']['x'] : 0,
                    'accelerometer_y' => isset($value['accelerometer']['y']) ? $value['accelerometer']['y'] : 0,
                    'accelerometer_z' => isset($value['accelerometer']['z']) ? $value['accelerometer']['z'] : 0,
                    'steps' => isset($value['steps']) ? $value['steps'] : 0,
                    'sleep' => isset($value['sleep']) ? $value['sleep'] : 0
                ]);
                if(!$indicator) {
                    return response([
                        'status' => 0
                    ],400);
                }
            } 
        }
        if($count == 0) {
            return response([
                'status' => 0
            ], 400);
        }
        return response([
            'status' => 1
        ], 201);
        // $indicator = Indicator::create();
        // return $indicator;
    }
}
