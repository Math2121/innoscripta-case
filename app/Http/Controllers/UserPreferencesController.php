<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputUserPreferenceRequest;
use App\Models\User;
use App\Services\UserPreferences\GetUserPreferencesService;
use App\Services\UserPreferences\SetUserPreferences;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class UserPreferencesController extends Controller
{
    private $getPreferencesService;
    private $setPreferencesService;

    public function __construct(GetUserPreferencesService $getPreferencesService, SetUserPreferences $setPreferencesService)
    {
        $this->getPreferencesService = $getPreferencesService;
        $this->setPreferencesService = $setPreferencesService;
    }

    public function index()
    {

        $preferences = $this->getPreferencesService->execute();
        return response()->json($preferences, 200);
    }

    public function store(InputUserPreferenceRequest $request){

        $output = $this->setPreferencesService->execute($request->all());

        return response()->json($output, 201);
    }
}
