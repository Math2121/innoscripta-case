<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterService
{
    public function execute($name, $email, $password): string
    {

        try {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);


            $token = $user->createToken('auth_token')->plainTextToken;

            return $token;
        } catch (\Throwable $th) {
            Log::error("Erro ao fazer register: " . $th->getMessage());
            throw new \Exception("It was not possible to register");
        }
    }
}
