<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogoutService
{
    public function execute()
    {
        try {
            auth()->user()->tokens()->delete();
        } catch (\Throwable $th) {
            Log::error("Erro ao fazer logout: " . $th->getMessage());
            throw new \Exception("Não foi possível fazer logout.");
        }
    }
}
