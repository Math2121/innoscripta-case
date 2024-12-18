<?php

namespace App\Services\Api;

use App\Models\Article;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;
use jcobhams\NewsApi\NewsApi;

class FetchTheGuardinService
{
    protected $client;
    private $apiKey = "c7a0fada-544d-47a7-9716-a136c185c34b";

    public function __construct()
    {
        $this->client =  Http::get("https://content.guardianapis.com/search?q=education&api-key=" . $this->apiKey);
    }

    public function execute()
    {

        $articles = [];

        foreach ($this->client->json()["response"]["results"] as $article) {


            $transformedArticle = [
                'source' => "The Guardian",
                'author' => "The Guardian",
                'title' => $article['webTitle'],
                'url' => $article['webUrl'],
                "category" => "education",
                "date" => $article['webPublicationDate'],

            ];

            $articles[] = $transformedArticle;
        }


        return $articles;
    }
}
