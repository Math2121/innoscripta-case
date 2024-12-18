<?php

namespace App\Jobs;

use App\Models\Article;
use App\Services\Api\FetchNewYorkService;
use App\Services\Api\FetchTheGuardinService;
use App\Services\Api\NewsApiService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class FetchNewArticles implements ShouldQueue
{
    use Queueable;

    private $newApiArticles;
    private $newYorkArticles;
    private $guardianServices;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
        $this->newApiArticles = new NewsApiService();
        $this->newYorkArticles = new FetchNewYorkService();
        $this->guardianServices = new FetchTheGuardinService();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Fetch articles from NewsAPI
            $generalArticles = $this->newApiArticles->execute();
            $this->storeArticles($generalArticles);

            // Fetch articles from New York Times
            $newYorkArticles = $this->newYorkArticles->execute();
            $this->storeArticles($newYorkArticles);

            // Fetch articles from The Guardian
            $guardianArticles = $this->guardianServices->execute();
            $this->storeArticles($guardianArticles);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    private function storeArticles($articles)
    {
        if (!empty($articles)) {
            foreach ($articles as $article) {
                $existGeneralArticle = Article::where('title', $article['title'])->first();
                if (!$existGeneralArticle) {
                    Log::info("New article found: " . $article['title']); // Corrected log message
                    Article::create([
                        'title' => $article['title'],
                        'category' => $article['category'],
                        'url' => $article['url'],
                        'source' => $article['source'],
                        "date" => $article["date"],
                    ]);
                }
            }
        }
    }
}
