<?php

namespace App\Http\Controllers;

use App\Services\Article\GetAllArticleService;
use App\Services\Article\GetArticleService;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    private $getArticleService;
    private $getAllArticleService;

    public function __construct(GetArticleService $getArticleService, GetAllArticleService $getAllArticleService)
    {
        $this->getArticleService = $getArticleService;
        $this->getAllArticleService = $getAllArticleService;
    }

    /**
     * @OA\Get(
     *     path="/api/article/{id}",
     *     summary="Get a one article",
     *     description="Retrieve one article",
     *     security={{"sanctum":{}}},
     *     tags={"Article"},
     *      @OA\Parameter(
     *         description="Parameter for get article id",
     *         in="path",
     *         name="id",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *            @OA\Schema(
     *               example={
     * "data": {
     *           "id": 3,
     *           "title": "Dr.",
     *           "source": "David",
     *           "url": "http://www.corwin.com/dolore-velit-blanditiis-necessitatibus-atque-sed-cum-voluptatem.html",
     *           "date": "2000-06-27 11:07:51",
     *           "category": "development",
     *           "created_at": "2024-12-16T20:11:09.000000Z",
     *           "updated_at": "2024-12-16T20:11:09.000000Z"
     *          },
     *
     * }
     *             )
     *          )
     *     )
     * )
     */

    public function  show($id)
    {
        $article = $this->getArticleService->execute($id);

        return response()->json(['data' => $article], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/article",
     *     summary="Get a list of articles",
     *     description="Retrieve of list of articles",
     *     security={{"sanctum":{}}},
     *     tags={"Article"},
     *      @OA\Parameter(
     *         name="category",
     *         in="query",
     *         description="Search for category",
     *         required=false,
     *      ),
     *     @OA\Parameter(
     *         name="source",
     *         in="query",
     *         description="Search for source",
     *         required=false,
     *      ),
     *      @OA\Parameter(
     *         name="created_at",
     *         in="query",
     *         description="Search for created_at",
     *         required=false,
     *      ),
     *
     *      @OA\Parameter(
     *         name="keyword",
     *         in="query",
     *         description="Search for keyword",
     *         required=false,
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *            @OA\Schema(
     *               example={
     *               "current_page": 1,
     * "data": {
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

    public function index(Request $request)
    {

        $params = $request->only(['category', 'source', 'created_at', 'keyword']);

        $articles = $this->getAllArticleService->execute($params);

        return response()->json(['data' => $articles], 200);
    }
}
