<?php

namespace App\Services\Article;


class GetArticleService
{
    public function execute($id)
    {
        try {

            $article = \App\Models\Article::find($id);
            if (!$article) {
                throw new \Exception('Article not found');
            }
            return $article;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
