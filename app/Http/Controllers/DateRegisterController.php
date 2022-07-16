<?php

namespace App\Http\Controllers;

use App\Models\DateRegister;
use Illuminate\Http\Request;

class DateRegisterController extends Controller
{
    /**
     * @OA\Get(
     *      path="/device/",
     *      tags={"Device"},
     *      summary="Дата регистрации устройств",
     *      description="Возвращается объект всех устройств",
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
    public function list() {
        return DateRegister::orderBy('created_at', 'desc')->get();
    }

    /**
     * @OA\Get(
     *      path="/device/{device_id}",
     *      tags={"Device"},
     *      summary="Дата регистрации устройства",
     *      description="Возвращается объект устройства",
     *      @OA\Parameter(
     *          name="device_id",
     *          description="ID устройства",
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
    public function single(Request $request) {
        return DateRegister::where('device_id', $request->device_id)->first()->created_at;
    }
    /**
     * @OA\Post(
     *      path="/device/",
     *      tags={"Device"},
     *      summary="Зарегистрировать устройства",
     *      description="Возвращается объект устройства",
     *      @OA\Parameter(
     *          name="device_id",
     *          description="ID устройства",
     *          required=true,
     *          in="query",
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
    public function create(Request $request) {
        $dateRegister = DateRegister::where('device_id', $request->device_id)->first();
        if($request->has('device_id') && $request->device_id != '' && $dateRegister == null) {
            return DateRegister::create(['device_id' => $request->device_id]); 
        }
        return response([
            'status' => 'error'
        ],400);
    }
}
