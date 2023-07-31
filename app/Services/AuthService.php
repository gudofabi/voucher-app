<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Exceptions\BusinessRuleException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Bouncer;

class AuthService
{
    protected $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function register($request)
    {
        $user = $this->user->create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
        ]);

        Bouncer::assign('Regular')->to($user);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];

    }

    public function login($request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw BusinessRuleException::invoke($message = 'Invalid login credentials');
        }

        $user = $this->user->where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'roles'       => $user->getRoles()
        ];
    }

    public function me(Request $request)
    {
        return 'Hello World!';
    }

    public function logout() 
    {
        Auth::logout();

        return "Successfully, Logout!";
    }
}
