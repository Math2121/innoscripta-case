<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputLoginRequest;
use App\Http\Requests\InputRegisterRequest;
use App\Services\Auth\LoginService;
use App\Services\Auth\LogoutService;
use App\Services\Auth\RegisterService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $registerService;
    private $loginService;
    private $logoutService;





    public function __construct(RegisterService $registerService, LoginService $loginService, LogoutService $logoutService)
    {
        $this->registerService = $registerService;
        $this->loginService = $loginService;
        $this->logoutService = $logoutService;
    }
    //

    /**
     *  @OA\Info(title="Innoscripta API", version="0.1")
     *  @OA\POST(
     *      path="/api/user/register",
     *      summary="Register a User",
     *      description="Register a user a receive a token",
     *      tags={"Auth"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"name": "a3fb6", "email": "teste2@gmail.com", "password": "12345678"}
     *             )
     *         )
     *     ),
     * @OA\Response(
     *         response=201,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="token",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     )
     *
     *  )
     */


    public function register(InputRegisterRequest $request)
    {

        $name = $request->get('name');
        $password = $request->get('password');
        $email = $request->get('email');

        $token = $this->registerService->execute($name, $email, $password);
        return response()->json(['token' => $token], 201);
    }

    /**
     *  @OA\POST(
     *      path="/api/user/login",
     *      summary="Login a User",
     *      description="Login a user a receive a token",
     *      tags={"Auth"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"email": "teste2@gmail.com", "password": "12345678"}
     *             )
     *         )
     *     ),
     * @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="token",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     )
     *
     *  )
     */
    public function login(InputLoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $token = $this->loginService->execute($email, $password);

        return response()->json(['token' => $token], 200);
    }

    /**
     *  @OA\DELETE(
     *      path="/api/user/logout",
     *      summary="Logout a User",
     *      security={{"sanctum":{}}},
     *      description="Logout a user and destroy all the tokens",
     *      tags={"Auth"},
     *      @OA\Response(
     *         response=204,
     *         description="OK"
     *     )
     *  )
     */

    public function logout()
    {
        $this->logoutService->execute();
        return response()->json([], 204);
    }
}
