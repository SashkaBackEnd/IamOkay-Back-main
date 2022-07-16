<?php

namespace App\Http\Controllers;

use App\Models\Medical;
use App\Models\MedicalLog;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalLogController extends Controller
{
    /**
     * @OA\Get(
     *      path="/medicallog/{patient_id}",
     *      tags={"MedicalLog"},
     *      summary="Прием таблеток пациента",
     *      description="Возвращается объект приема таблеток пациента",
     *      @OA\Parameter(
     *          name="patient_id",
     *          description="patient_id",
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
        $medical = Medical::where('patient_id', $request->patient_id)->get();
        $temp = [];
        foreach($medical as $item) {
            $temp[] = $item->id;
        }
        return response([
            'data' => MedicalLog::whereIn('medical_id',$temp)->get(),
            'count_success' => MedicalLog::whereIn('medical_id',$temp)->where('status', 1)->get()->count(),
            'count_error' => MedicalLog::whereIn('medical_id',$temp)->where('status', 1)->get()->count()
        ]);
    }

    /**
     * @OA\Put(
     *      path="/medicallog/",
     *      tags={"MedicalLog"},
     *      summary="Запись приема таблеток",
     *      description="Создать нового пациента, возвращается объект приема таблеток пациента",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/MedicalLog")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/MedicalLog")
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
    public function create(Request $request) {
        $patient = Medical::where('id', $request->medical_id)->first(); 
        if($patient == null) {
            return response([
                'error' => 'Medical with id '.$request->medical_id.' not found'
            ],400);
        }
        $medicallog = MedicalLog::create([
            'medical_id' => $request->medical_id,
            'status' => $request->status
        ]);

        return $medicallog;
    }


    /**
     * @OA\Delete(
     *      path="/medicallog/{id}",
     *      tags={"MedicalLog"},
     *      summary="Удалить запись приема таблеток",
     *      description="Удалить запись приема таблеток",
     *      @OA\Parameter(
     *          name="id",
     *          description="id уведомления",
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
    public function delete(Request $request)
    {
        return response([
            'status' => MedicalLog::where('id', $request->id)->delete()
        ]);
    }
}
