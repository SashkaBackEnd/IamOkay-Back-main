<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalibrationRequest;
use App\Models\Calibration;
use App\Models\Patient;
use Illuminate\Http\Request;

class CalibrationController extends Controller
{
    /**
     * @OA\Get(
     *      path="/calibration/{patient_id}",
     *      tags={"Calibration"},
     *      summary="Калибровка пациента",
     *      description="Возвращается объект показателей калибровки по пациенту",
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
     *     )
     */
    public function index(Request $request) {
        return Calibration::where('patient_id',$request->patient_id)->first();
    }

    /**
     * @OA\Put(
     *      path="/calibration/",
     *      tags={"Calibration"},
     *      summary="Создать/обновить калибровка",
     *      description="Создать/обновить калибровку, возвращается объект калибровки",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Calibration")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Calibration")
     *       ),
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
    public function create(CalibrationRequest $request) {
        $patient = Patient::where('id', $request->patient_id)->first();
        if($patient == null) {
            return response([
                'status' => 'error',
                'message' => 'Patient with id '.$request->patient_id.' not found'
            ], 404);
        }

        $calibration = Calibration::where('patient_id', $request->patient_id)->first();

        if($calibration == null) {
            return Calibration::create($request->validated());
        }

        return Calibration::where('patient_id', $request->patient_id)->update($request->validated());
    }
}
