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

    public function register(InputRegisterRequest $request)
    {

        $name = $request->get('name');
        $password = $request->get('password');
        $email = $request->get('email');

        $token = $this->registerService->execute($name, $email, $password);
        return response()->json(['token' => $token], 201);
    }
    public function login(InputLoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        $token = $this->loginService->execute($email, $password);

        return response()->json(['token' => $token], 200);
    }

    public function logout()
    {
        $this->logoutService->execute();
        return response()->json([], 204);
    }
}
