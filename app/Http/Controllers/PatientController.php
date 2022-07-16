<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Http\Resources\PatientListResource;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use App\Models\PatientUser;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * @OA\Get(
     *      path="/patient/{id}",
     *      tags={"Patient"},
     *      summary="Пациент",
     *      description="Возвращается объект пациента",
     *      @OA\Parameter(
     *          name="id",
     *          description="id",
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
        $patient = Patient::where('id', $request->id)->first();
        if($patient == null) {
            return response(404);
        }
        return new PatientResource(Patient::where('id', $request->id)->first());
    }

    /**
     * @OA\Get(
     *      path="/patients/",
     *      tags={"Patient"},
     *      summary="Пациенты",
     *      description="Возвращается объект пациентов",
     *      @OA\Parameter(
     *          name="name_sort",
     *          description="Сортировка по имени asc/desc",
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="who_sort",
     *          description="Сортировка по кем приходится asc/desc",
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="last_edit",
     *          description="Сортировка по последней дате изменения asc/desc",
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          description="Сортировка по имени пациента",
     *          in="path",
     *          @OA\Schema(
     *              type="string"
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
    public function list(Request $request) {
        $patient = Patient::query();
        if($request->has('name_sort')) {
            $patient->orderBy('name', $request->name_sort);
        }
        return PatientListResource::collection(Patient::paginate(15));
    }

    /**
     * @OA\Put(
     *      path="/patient/",
     *      tags={"Patient"},
     *      summary="Создать нового пациента",
     *      description="Создать нового пациента, возвращается объект пациента",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Patient")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Patient")
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
    public function create(PatientRequest $request) {
        $patient = Patient::create($request->validated());
        // PatientUser::create(['user_id' => $request->user_id, 'patient_id' => $patient->id]);
        return $patient;
    }


    /**
     * @OA\Patch(
     *      path="/patient/{id}",
     *      tags={"Patient"},
     *      summary="Обновить пациента",
     *      description="Обновить пациента, возвращается объект пациента",
     *      @OA\Parameter(
     *          name="id",
     *          description="id пациента",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Patient")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Patient")
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
     */
    public function update(PatientRequest $request)
    {   
        Patient::where('id', $request->id)->update($request->all());
        return Patient::where('id',$request->id)->first();
    }


    /**
     * @OA\Delete(
     *      path="/patient/{id}",
     *      tags={"Patient"},
     *      summary="Удалить пациента",
     *      description="Удалить пациента",
     *      @OA\Parameter(
     *          name="id",
     *          description="id пациента",
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
            'status' => Patient::where('id', $request->id)->delete()
        ]);
    }
}
