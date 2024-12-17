<?php

namespace App\Services\UserPreferences;

use App\Models\UserPreferences;
use Illuminate\Support\Facades\Auth;

class SetUserPreferences
{

    public function execute($preferences)
    {

        try {
            $preferences = UserPreferences::updateOrCreate(
                ['user_id' => Auth::id()],
                [
                    'preferred_sources' => $preferences["preferred_sources"],
                    'preferred_categories' => $preferences["preferred_categories"],
                    'preferred_authors' => $preferences["preferred_authors"],
                ]

            );
            return $preferences;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
