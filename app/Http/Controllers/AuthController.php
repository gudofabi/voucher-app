<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ResponseFormatterTrait;
use App\Services\AuthService;

use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    use ResponseFormatterTrait;

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        return $this->responseSuccess(
            message: "Successfully created!",
            data: $this->authService->register($request)
        );
    }

    public function login(LoginRequest $request)
    {
         return $this->responseSuccess(
            message: "Successfully login!",
            data: $this->authService->login($request)
        );
    }

    public function logout()
    {
        return response()->json([
            "message" => $this->authService->logout()
         ]);
    }

    public function me(Request $request)
    {
        return 'Hello World!';
    }

}
