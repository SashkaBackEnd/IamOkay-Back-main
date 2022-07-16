<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comments;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * @OA\Put(
     *      path="/comment/",
     *      tags={"Comment"},
     *      summary="Создать новый комментарий",
     *      description="Создатьновый комментарий, возвращается объект комментария",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Comments")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Comments")
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
    public function create(CommentRequest $request) {
        $patient = Patient::where('id', $request->patient_id)->first();
        if($patient == null) {
            return response([
                'status' => 'error',
                'message' => 'Patient with id '.$request->patient_id.' not found'
            ], 404);
        }

        $user = User::where('id', $request->user_id)->first();
        if($user == null) {
            return response([
                'status' => 'error',
                'message' => 'User with id '.$request->user_id.' not found'
            ], 404);
        }

        return Comments::create($request->validated());
    }


    /**
     * @OA\Delete(
     *      path="/comment/{id}",
     *      tags={"Comment"},
     *      summary="Удалить комментарий",
     *      description="Удалить комментарий",
     *      @OA\Parameter(
     *          name="id",
     *          description="id комментария",
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
            'status' => Comments::where('id', $request->id)->delete()
        ]);
    }
}
