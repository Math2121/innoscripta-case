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


    public function  show($id)
    {
        $article = $this->getArticleService->execute($id);

        return response()->json(['data' => $article], 200);
    }

    public function index(Request $request)
    {

        $params = $request->only(['category', 'source', 'created_at', 'keyword']);

        $articles = $this->getAllArticleService->execute($params);

        return response()->json(['data' => $articles], 200);
    }
}
