<?php

namespace App\Services\Api;

use App\Models\Article;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;
use jcobhams\NewsApi\NewsApi;

class FetchNewYorkService
{
    protected $client;
    private $apiKey = "jDBJRim9duo2Id9nlPZKpFlltZSycoQC";

    public function __construct()
    {
        $this->client =  Http::get("https://api.nytimes.com/svc/archive/v1/2024/1.json?api-key=" . $this->apiKey);
    }

    public function execute()
    {

        $articles = [];


        foreach ($this->client->json()["response"]["docs"] as $article) {


            $transformedArticle = [
                'source' => $article['source'],
                'author' => $article['byline']["original"],
                'title' => $article['abstract'],
                'url' => $article['web_url'],
                "category" => $article['section_name'],
                "date" =>
                $article['pub_date'],

            ];

            $articles[] = $transformedArticle;
        }


        return $articles;
    }
}
