<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * @OA\Get(
     *      path="/setting/",
     *      tags={"Setting"},
     *      summary="Цена подписки",
     *      description="Возвращается цена подписки",
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
    public function index() {
        $setting = Setting::where('name', 'subscription')->first();
        if($setting != null) {
            return $setting->value;
        }
        return response(404);
    }
    /**
     * @OA\Put(
     *      path="/setting/",
     *      tags={"Setting"},
     *      summary="Изменить цену подписки",
     *      description="Изменить цену подписки",
     *      @OA\Parameter(
     *          name="price",
     *          description="Цена",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
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
    public function changePrice(Request $request) {
        if(!$request->has('price')) {
            return response(400);
        }
        $setting = Setting::where('name', 'subscription')->first();
        if($setting == null) {
            return Setting::create([
                'name' => 'subscription',
                'value' => $request->price
            ]);
        }
        return Setting::where('name', 'subscription')->update([
            'value' => $request->price
        ]);
    }
}
