<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Events;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/events/{patient_id}",
     *      tags={"Events"},
     *      summary="Уведомления пациента",
     *      description="Возвращается объект уведомлений пациента",
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
        $events = Events::with('indicator')->where('patient_id',$request->patient_id);
        if($request->has('date_from')) {
            $events->where('created_at', '>', $request->date_from);
        }
        if($request->has('date_to')) {
            $events->where('created_at', '<=', $request->date_to);
        }
        if($request->has('period')) {
            if($request->period == 'day') {
                $events->where('created_at', '>', Carbon::now()->subDays(1));
            }
            if($request->period == 'week') {
                $events->where('created_at', '>', Carbon::now()->subDays(7));
            }
            if($request->period == 'month') {
                $events->where('created_at', '>', Carbon::now()->subMonth(1));
            }
            if($request->period == 'year') {
                $events->where('created_at', '>', Carbon::now()->subYear(1));
            }
        }
        return $events->paginate(15);
    }

    /**
     * @OA\Put(
     *      path="/events/",
     *      tags={"Events"},
     *      summary="Запись уведомления",
     *      description="Создать нового пациента, возвращается объект пациента",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Events")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Events")
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
    public function create(EventRequest $request) {
        $patient = Patient::where('id', $request->patient_id)->first();
        if($patient == null) {
            return response([
                'error' => 'Patient with id '.$request->patient_id.' not found'
            ],400);
        }
        $event = Events::create($request->validated());

        return $event;
    }


    /**
     * @OA\Delete(
     *      path="/events/{id}",
     *      tags={"Events"},
     *      summary="Удалить уведомление",
     *      description="Удалить уведомление",
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
            'status' => Event::where('id', $request->id)->delete()
        ]);
    }
}
