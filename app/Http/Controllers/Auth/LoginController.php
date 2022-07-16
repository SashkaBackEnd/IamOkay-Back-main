<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }

    /**
     * @OA\Post(
     *      path="/login/",
     *      tags={"User"},
     *      summary="Авторизация",
     *      description="Авторизация, возвращается объект пользователя",
     *      @OA\Parameter(
     *          name="phone",
     *          description="Телефон",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
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
     */
    public function auth(Request $request)
    {
        $request->validate([
            'phone' => 'required'
        ]);
        $code = '123456';
        $user = User::where('phone', $request->phone)->first();
        if($user != null) {
            User::where('phone', $request->phone)->update([
                'code' => $code
            ]);
            return response([
                'status' => 'code sent'
            ]);
        }
        User::create([
            'phone' => $request->phone,
            // 'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),
            'code' => '123456',
            'role_id' => 0
        ]);
        return response([
            'status' => 'code sent'
        ]);
    }


    /**
     * @OA\Post(
     *      path="/loginEmail/",
     *      tags={"User"},
     *      summary="Авторизация",
     *      description="Авторизация через почту и пароль, возвращается объект пользователя",
     *      @OA\Parameter(
     *          name="email",
     *          description="Почта",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="Пароль",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
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
     */
    public function loginEmail(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            User::where('email', $request->email)->update([
                'api_token' =>  Str::random(60)
            ]);
            return User::where('email', $request->email)->first();
        }
 
        return response([
            'status' => 'error',
            'message' => 'Неверная почта или пароль'
        ], 404);    
    }

    /**
     * @OA\Post(
     *      path="/confim/",
     *      tags={"User"},
     *      summary="Подтверждение по коду",
     *      description="Авторизация, возвращается объект пользователя",
     *      @OA\Parameter(
     *          name="phone",
     *          description="Телефон",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="code",
     *          description="Код",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
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
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'code' => 'required'
        ]);
        $user = User::where('phone', $request->phone)->first();
        if($user == null) {
            return response([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        if ($user->code == $request->code) {
            User::where('phone', $request->phone)->update([
                'api_token' =>  Str::random(60),
                'code' => 0,
                'phone_verified_at' => Carbon::now()
            ]);
            return User::where('phone', $request->phone)->first();
        } else {
            return response([
                'status' => 'error',
                'message' => 'Invalid code'
            ], 200);
        }

    }
}
