<?php

namespace App\Services\Article;

use App\Models\Article;
use Illuminate\Database\Eloquent\Builder;

class GetAllArticleService
{
    public function execute($params)
    {
        try {
            $query = Article::query();
            
            $query = $this->applyFilters($query, $params);

            return $query->paginate();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function applyFilters(Builder $query, $params): Builder
    {

        if (!empty($params['keyword']) && $params['keyword']) {
            $query = $this->applyKeywordFilter($query, $params['keyword']);
        }

        if (!empty($params['date']) && $params['date']) {
            $query = $this->applyDateFilter($query, $params['date']);
        }

        if (!empty($params['category']) && $params['category']) {
            $query = $this->applyCategoryFilter($query, $params['category']);
        }

        if (!empty($params['source']) &&  $params['source']) {
            $query = $this->applySourceFilter($query, $params['source']);
        }

        return $query;
    }
    protected function applyKeywordFilter(Builder $query, string $keyword): Builder
    {
        return $query->where(function ($query) use ($keyword) {
            $query->where('title', 'like', "%$keyword%");
        });
    }


    protected function applyDateFilter(Builder $query, string $date): Builder
    {
        return $query->whereDate('created_at', $date);
    }


    protected function applyCategoryFilter(Builder $query, int $categoryId): Builder
    {
        return $query->whereLike('category', $categoryId);
    }


    protected function applySourceFilter(Builder $query, string $source): Builder
    {
        return $query->whereLike('source', $source);
    }
}
