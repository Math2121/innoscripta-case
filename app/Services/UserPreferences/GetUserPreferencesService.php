<?php

namespace App\Services\UserPreferences;

use App\Models\Article;
use App\Models\UserPreferences;
use Illuminate\Support\Facades\Auth;

class GetUserPreferencesService{

    public function execute(){
        $user = Auth::user();
        $preferences = UserPreferences::where(['user_id' => Auth::id()])->get(['preferred_sources', 'preferred_categories', 'preferred_authors'])->toArray();

        $combined = [];

        foreach ($preferences as $item) {
            $combined = array_merge_recursive($combined, $item);
        }

        $uniqueCombined = array_map('array_unique', $combined);

        $query = Article::query();

        if ($uniqueCombined) {
            if ($uniqueCombined['preferred_sources']) {

                $query->orWhereIn('source', $uniqueCombined['preferred_sources']);

            }

            if ($uniqueCombined['preferred_categories']) {
                $query->orWhereIn('category', $uniqueCombined['preferred_categories']);
            }

            if ($uniqueCombined['preferred_authors']) {
                $query->orWhereIn('author', $uniqueCombined['preferred_authors']);
            }
        }
        $articles = $query->latest()->paginate();

        return $articles;

    }

}
