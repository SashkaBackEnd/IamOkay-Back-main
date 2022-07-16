<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalRequest;
use App\Models\Medical;
use Illuminate\Http\Request;

class MedicalController extends Controller
{
    /**
     * @OA\Get(
     *      path="/medical/{patient_id}",
     *      tags={"Medical"},
     *      summary="Медикаменты пользователя",
     *      description="Возвращается объект медикаментов",
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
        return Medical::where('patient_id', $request->patient_id)->get();
    }

    /**
     * @OA\Put(
     *      path="/medical/",
     *      tags={"Medical"},
     *      summary="Создать новый медикамент",
     *      description="Создатьновый медикамент, возвращается объект медикамент",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Medical")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Medical")
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
    public function create(MedicalRequest $request) {
        return Medical::create($request->validated());
    }


    /**
     * @OA\Delete(
     *      path="/medical/{id}",
     *      tags={"Medical"},
     *      summary="Удалить медикамент",
     *      description="Удалить медикамент",
     *      @OA\Parameter(
     *          name="id",
     *          description="id медикамента",
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
            'status' => Medical::where('id', $request->id)->delete()
        ]);
    }
}
