<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function execute($email, $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new \Exception("Invalid login email or password");
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $token;
    }
}
