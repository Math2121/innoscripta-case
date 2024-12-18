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

    /**
     * @OA\Get(
     *     path="/api/preferences",
     *     summary="Get a list of articles based on user´s preferences",
     *     description="Retrieve of list of articles",
     *     security={{"sanctum":{}}},
     *     tags={"Preferences"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *            @OA\Schema(
     *               example={
     *               "current_page": 1,
     *          "data": {
     *       {
     *           "id": 3,
     *           "title": "Dr.",
     *           "source": "David",
     *           "url": "http://www.corwin.com/dolore-velit-blanditiis-necessitatibus-atque-sed-cum-voluptatem.html",
     *           "date": "2000-06-27 11:07:51",
     *           "category": "development",
     *           "created_at": "2024-12-16T20:11:09.000000Z",
     *           "updated_at": "2024-12-16T20:11:09.000000Z"
     *       }
     *   },
     *  "first_page_url": "http://127.0.0.1:8000/api/article?page=1",
     *   "from": 1,
     *   "last_page": 1,
     *   "last_page_url": "http://127.0.0.1:8000/api/article?page=1",
     *   "links": {
     *       {
     *           "url": null,
     *           "label": "&laquo; Previous",
     *           "active": false
     *       },
     *       {
     *           "url": "http://127.0.0.1:8000/api/article?page=1",
     *           "label": "1",
     *           "active": true
     *       },
     *      {
     *          "url": null,
     *           "label": "Next &raquo;",
     *          "active": false
     *      }
     *  },
     *   "next_page_url": null,
     *   "path": "http://127.0.0.1:8000/api/article",
     *  "per_page": 15,
     *  "prev_page_url": null,
     *   "to": 1,
     *   "total": 1
     *
     *
     * }
     *             )
     *          )
     *     )
     * )
     */

    public function index()
    {

        $preferences = $this->getPreferencesService->execute();
        return response()->json($preferences, 200);
    }

    /**
     *  @OA\POST(
     *      path="/api/preferences",
     *      summary="Register a preference",
     *      description="Register a user preference",
     *      security={{"sanctum":{}}},
     *      tags={"Preferences"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="preferred_sources",
     *                     type="array",
     *                    @OA\Items(
     *                         type="string"
     *                     )
     *                  ),
     *                 @OA\Property(
     *                     property="preferred_categories",
     *                     type="array",
     *                    @OA\Items(
     *                         type="string"
     *                     )
     *                  ),
     *                 @OA\Property(
     *                     property="preferred_authors",
     *                     type="array",
     *                    @OA\Items(
     *                         type="string"
     *                     )
     *                  ),
     *                 example={        "preferred_sources" : {"nba","new york"},
     *  "preferred_categories": {"ai"},
     *   "preferred_authors" : {"paulo","jose"}}
     *              )
     *         )
     *     ),
     * @OA\Response(
     *         response=201,
     *         description="OK",
     *     )
     *
     *  )
     */

    public function store(InputUserPreferenceRequest $request)
    {

        $output = $this->setPreferencesService->execute($request->all());

        return response()->json($output, 201);
    }
}
