<?php

namespace App\Services\Api;

use App\Models\Article;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Builder;
use jcobhams\NewsApi\NewsApi;

class NewsApiService
{
    protected $client;
    private $apiKey = "934f6192367544d8bd10c4d256adfb84";

    public function fetchTopHeadlines()
    {
        $newsapi = new NewsApi($this->apiKey);

        $topHeadlines = $newsapi->getTopHeadLines(null, null, null, "general", 20, null);
        $articles = [];
        foreach ($topHeadlines->articles as $article) {
            $transformedArticle = [
                'source' => $article['source']['name'],
                'author' => $article['author'],
                'title' => $article['title'],
                'url' => $article['url'],
                "category" => "general"
            ];

            $articles[] = $transformedArticle;
        }
        return $articles;
    }
}
